<?php

/**
 * Beds24 API.
 *
 * https://wiki.beds24.com/index.php/Category:API_V2
 * https://beds24.com/api/v2/
 *
 * @link       https://github.com/magicoli/multipass
 * @since      0.1.0
 *
 * @package    MultiPass
 * @subpackage MultiPass/includes
 */

/**
 * Beds24 Class.
 *
 * @package    MultiPass
 * @subpackage MultiPass/includes
 * @author     Magiiic <info@magiiic.com>
 */
class Mltp_Beds24 extends Mltp_Modules {

	protected $api_url;
	protected $api_key;
	protected $callback_url;
	protected $prefix;
	public $locale;
	protected $namespace;
	protected $route;
	protected $webhooks_subscribe;
	protected $debug;

	protected $error_codes = array(
		1009 => 'Not allowed for this role',
		1010 => 'No write access',
		1016 => 'Usage limit exceeded in last 5 minutes',
		1020 => 'Usage limit exceeded in last 5 minutes',
		1021 => 'Account has no credit',
		1022 => 'Not whitelisted',
	);

	/**
	 * Initialize the collections used to maintain the actions and filters.
	 *
	 * @since    0.1.0
	 */
	public function __construct() {
		$this->prefix  = 'beds24_';
		$this->api_url = 'https://beds24.com/api/v2';
		$this->api_key = self::get_option( 'beds24_api_key' );

		$this->locale = MultiPass::get_locale();

		$this->namespace = 'multipass/v1';
		$this->route     = '/beds24';

		$server_addr              = ( empty( $_SERVER['SERVER_ADDR'] ) ) ? null : $_SERVER['SERVER_ADDR'];
		$this->webhooks_subscribe = ( filter_var(
			$server_addr,
			FILTER_VALIDATE_IP,
			FILTER_FLAG_IPV4 | FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE
		) ) ? array(
			// 'rate_change'            => true,
			// 'availability_change'    => true,
			// 'booking_new_any_status' => true,
			'booking_change'         => true,
		) : array();

		// error_log('webhooks_subscribe ' . print_r($this->webhooks_subscribe, true));

		// register_activation_hook( MULTIPASS_FILE, array( $this, 'subscribe_webhooks' ) );
		// register_deactivation_hook( MULTIPASS_FILE, array( $this, 'unsubscribe_webhooks' ) );
	}

	/**
	 * Register the filters and actions with WordPress.
	 *
	 * @since    0.1.0
	 */
	public function init() {
		// Activate REST API route
		add_action( 'rest_api_init', array( $this, 'register_api_callback_route' ) );

		// Register settings pages and fields
		add_filter( 'mb_settings_pages', array( $this, 'register_settings_pages' ) );
		add_filter( 'rwmb_meta_boxes', array( $this, 'register_settings_fields' ) );
		
		// Register resources custom fields
		add_filter( 'rwmb_meta_boxes', array( $this, 'register_fields' ) );

		// $filters = array(
		// 	array(
		// 		'hook'     => 'multipass_register_terms_mltp_detail-source',
		// 		'callback' => 'register_sources_filter',
		// 	),
		// );

		// $defaults = array(
		// 	'component'     => $this,
		// 	'priority'      => 10,
		// 	'accepted_args' => 1,
		// );

		// foreach ( $filters as $hook ) {
		// 	$hook = array_merge( $defaults, $hook );
		// 	add_filter( $hook['hook'], array( $hook['component'], $hook['callback'] ), $hook['priority'], $hook['accepted_args'] );
		// }

		// foreach ( $actions as $hook ) {
		// 	$hook = array_merge( $defaults, $hook );
		// 	add_action( $hook['hook'], array( $hook['component'], $hook['callback'] ), $hook['priority'], $hook['accepted_args'] );
		// }

	}

	function register_settings_pages( $settings_pages ) {
		$settings_pages[] = array(
			'menu_title' => __( 'Beds24', 'multipass' ),
			'id'         => 'multipass-beds24',
			'position'   => 25,
			'parent'     => 'multipass',
			'capability' => 'mltp_administrator',
			'style'      => 'no-boxes',
			'icon_url'   => 'dashicons-admin-generic',
			// 'columns' => 1,
		);

		return $settings_pages;
	}

	function register_settings_fields( $meta_boxes ) {
		$prefix = $this->prefix;
		// $beds24 = new Mltp_Beds24();

		// $properties = $this->get_properties();
		$rooms = $this->get_rooms();

		// Lodify Settings tab
		$meta_boxes[] = array(
			'title'          => __( 'Beds24 Settings', 'multipass' ),
			'id'             => 'multipass-beds24-settings',
			'settings_pages' => array( 'multipass-beds24' ),
			// 'tab'            => 'beds24',
			'fields'         => array(
				array(
					'name'              => __( 'API access', 'multipass' ),
					'id'                => $prefix . 'api',
					'type'              => 'group',
					'sanitize_callback' => array( $this, 'sanitize_api' ),
					'desc'        => sprintf(
						__( 'A token is required to connect to %s. Get it from %s.', 'multipass' ),
						'Beds24',
						sprintf(
							'<a href="%s" target="_blank">%s</a>',
							'https://beds24.com/control3.php?pagetype=apiv2',
							'Beds24 Settings > Apps & Integration > API',
						)
					),
					'fields'            => array(
						array(
							'id'   => 'use_invite',
							'name' => __( 'Use invite code', 'multipass' ),
							'type' => 'switch',
							'desc'	   => __( 'Invite code is required to connect to Beds24 with read/write access.', 'multipass' ),
						),
						array(
							'name' => __( 'Invite Code', 'multipass' ),
							'id'   => 'invite_code',
							'type' => 'text',
							'save_field' => false,
							'required' => $this->get_token() ? false : true,
							'visible'    => array(
								'when'     => array(
									array( 'use_invite', '=', true ),
								),
								'relation' => 'or',
							),
							'desc' => __( 'The invite code allows read/write access to Beds24 and is used only once to generate the refresh token that will be used for authentication.', 'multipass' ),
						),
						array(
							'id' => 'refresh_token',
							'name' => __('Refresh token', 'multipass'),
							'type' => 'text',
							'readonly' => true,
							'visible'    => array(
								'when'     => array(
									array( 'use_invite', '=', true ),
								),
								'relation' => 'or',
							),
							'desc' => __( 'The refresh token will expire if no connections are made for 30 days.', 'multipass' ),
						),
						array(
							'id' => 'long_life_token',
							'name' => __('Long Life Token', 'multipass'),
							'type' => 'text',
							'readonly' => false,
							'required' => true,
							'visible'    => array(
								'when'     => array(
									array( 'use_invite', '=', false ),
								),
								'relation' => 'or',
							),
							'desc' => __( 'Long life token allows readonly access to Beds24 API and does not expire.', 'multipass' ),
						),
						array(
							'id' => 'token',
							'name' => __('Token', 'multipass'),
							'type' => 'text',
							'save_field' => false,
							'readonly' => true,
							'std' => $this->get_token(),
							'desc' => __( 'The token is generated automatically and is used to authenticate API requests, it expires after 1 hour.', 'multipass' ),
							// 'visible'    => $this->get_token(),
						),
					),
				),
				array(
					'name' => __( 'Webhook', 'multipass' ),
					'id'   => $prefix . 'callback_url',
					'type' => 'text',
					'std' => 'callback url: ' . $this->callback_url(),
					'value' => 'value: ' . $this->callback_url(),
					'readonly' => true,
					'sanitize_callback' => array( $this, 'sanitize_callback_url' ),
					'desc' => sprintf(
						__( 'Callback URL for webhooks. Copy this URL to %s.', 'multipass' ),
						sprintf(
							'<a href="%s" target="_blank">%s</a>',
							'https://beds24.com/control3.php?pagetype=syncroniserwebhooks',
							'Beds24 Settings > Apps & Integration > Webhooks',
						)
					),
				),
				array(
					'name' => __( 'Rooms', 'multipass' ),
					'id'   => $prefix . 'rooms',
					'type' => 'custom_html',
					'callback' => array( $this, 'room_list' ),
					'save_field' => false,
				),
				array(
					// 'name'              => __( 'Debug', 'multipass' ),
					'id'       => $prefix . 'debug',
					'type'     => 'custom_html',
					'callback' => 'MultiPass::render_debug',
					'visible' => MultiPass::debug(),
				),
			),
		);

		if ( self::get_option( 'api_key_verified' ) === true ) {
			// if( ! empty ( $this->api_key ) ) {
			$meta_boxes['multipass-beds24-resources'] = array(
				'name'           => __( 'Resources', 'multipass' ),
				'id'             => 'multipass-beds24-resources',
				'settings_pages' => array( 'multipass-beds24' ),
				// 'tab'            => 'beds24',
				// 'fields'            => $this->resource_group_fields(),
				'fields'         => array(
					array(
						'name'              => __( 'Resources', 'multipass' ),
						'id'                => 'resources',
						'type'              => 'group',
						'fields'            => $this->resource_group_fields(),
						'sanitize_callback' => array( $this, 'sanitize_resources_settings' ),
					),
				),
			);
			$meta_boxes['multipass-beds24-synchronize'] = array(
				'name'           => __( 'Synchronize', 'multipass' ),
				'id'             => 'multipass-beds24-synchronize',
				'settings_pages' => array( 'multipass-beds24' ),
				'fields'         => array(
					array(
						'name'              => __( 'Import now', 'multipass' ),
						'id'                => $prefix . 'import_now',
						'type'              => 'switch',
						'desc'              => __( 'Import Beds24 bookings, create or resync matching prestations and entries. Only useful after plugin activation or if out of sync.', 'multipass' ),
						'style'             => 'rounded',
						'sanitize_callback' => array( $this, 'import_now' ),
						'save_field'        => false,
						'visible'           => array(
							'when'     => array(
								array( 'api_key', '!=', '' ),
								array( 'api_key_verified', '=', '1' ),
							),
							'relation' => 'and',
						),
					),
				),
			);
		}

		return $meta_boxes;
	}

	static function callback_url() {
		$transient_key = 'multipass_beds24-callback_url';
		$callback_url = get_transient( $transient_key );
		return $callback_url;
	}

	function register_api_callback_route() {
		$transient_key = 'multipass_beds24-callback_url';
		// register_rest_route( 'multipass/v1', '/users/market=(?P<market>[a-zA-Z0-9-]+)/lat=(?P<lat>[a-z0-9 .\-]+)/long=(?P<long>[a-z0-9 .\-]+)', array(
		register_rest_route(
			$this->namespace,
			$this->route,
			array(
				'methods'             => 'POST',
				'callback'            => array( $this, 'handle_api_callback' ),
				'permission_callback' => '__return_true',
			)
		);
		$callback_url = get_rest_url( null, $this->namespace . $this->route );
		set_transient( $transient_key, $callback_url, 3600 );
	}

	function handle_api_callback( WP_REST_Request $request ) {
		// $callback_url = $request->get_param('callback_url');
		$data = $request->get_params();
		$route = $request->get_route();

		$action = $data['action'] ?? null;
		if( empty( $action ) ) {
			return new WP_Error( 'multipass_beds24-no-action', 'No action specified.' );
		}

		switch( $action ) {
			case 'SYNC_ROOM':
				$roomId = $data['roomId'] ?? null;
				$propId = $data['propId'] ?? null;
				$ownerId = $data['ownerId'] ?? null;
				
				// Beds24 retry time is 30 minutes, so we fetch bookings modified less than 1 hour ago.
				$args = array(
					'roomId' => $roomId,
					'propId' => $propId,
					'modifiedFrom' => date( 'Y-m-d H:i:s', strtotime( '-1 hour' ) ),
				);
				$bookings = $this->api_request_data( '/bookings', $args );
				error_log('modified bookings (' . count( $bookings) . ') ' . print_r( $bookings, true ) );

				break;

			default:
				error_log('Unknown action ' . $action);
				return new WP_Error( 'multipass_beds24-unknown-action', 'Unknown action.' );
		}
		return 'OK';
	}

	function resource_group_fields() {
		$fields  = array();
		$options = $this->get_property_options();
		asort( $options );
		// error_log('options ' . print_r($options, true));

		foreach ( $options as $key => $value ) {
			$fields[] = array(
				'id'          => $this->prefix . $key,
				'name'        => $value,
				'type'        => 'post',
				'post_type'   => array( 'mltp_resource' ),
				'field_type'  => 'select_advanced',
				'placeholder' => __( 'Do not synchronize', 'multipass' ),
				'size'        => 5,
			);
		}
		// error_log('fields ' . print_r($fields, true));
		return $fields;
	}

	function sanitize_resources_settings( $values, $field, $old_value ) {
		// $options = $this->get_property_options();
		$options    = $this->get_property_options( $this->prefix );
		$array_keys = array_fill_keys( array_keys( $this->get_property_options( $this->prefix ) ), null );
		$values     = array_replace( $array_keys, $values );
		$prefix     = 'resource_' . $this->prefix;
		// $meta_key = $this->prefix . 'id';

		foreach ( $values as $key => $resource_id ) {
			$beds24_id = preg_replace( "/^$this->prefix/", '', $key );

			$query = $this->query_resources( $beds24_id );
			while ( $query->have_posts() ) {
				$query->the_post();
				$post_id = get_the_ID();
				if ( $post_id !== $resource_id ) {
					update_post_meta( $post_id, $prefix . 'id', null );
					update_post_meta( $post_id, $prefix . 'name', null );
				}
			}

			if ( ! empty( $resource_id ) ) {
				// add reference to resource
				$resource = new Mltp_Resource( $resource_id );
				if ( $resource ) {
					// error_log('options ' . print_r($options))
					update_post_meta( $resource->id, $prefix . 'id', $beds24_id );
					update_post_meta( $resource->id, $prefix . 'name', $options[ $key ] );
				} else {
					$resource_id = null;
				}
			}
		}

		return $values;
	}

	function query_resources( $property_id = null ) {
		$meta_key = 'resource_' . $this->prefix . 'id';
		// $meta_key = $this->prefix . 'id';

		$args  = array(
			'posts_per_page' => -1,
			'post_type'      => 'mltp_resource',
			'meta_query'     => array(
				array(
					'meta_key' => $meta_key,
					'value'    => $property_id,
				),
			),
		);
		$query = new WP_Query( $args );
		return $query;
	}

	function get_resource_id( $property_id = null ) {
		if ( empty( $property_id ) ) {
			return;
		}
		$query = $this->query_resources( $property_id );
		if ( $query->have_posts() ) {
			$query->the_post();
			return get_the_ID();
		}
	}

	function render_debug() {
		$debug = '';
		// $availabilities = $response['items'];
		if ( ! empty( $debug ) ) {
			return '<label>Debug</label><pre>' . $debug . '</pre>';
		}
	}

	function register_fields( $meta_boxes ) {
		$prefix = $this->prefix;
		// $beds24 = new Mltp_Beds24();
		$meta_boxes['resources']['fields'][] = array(
			'name'          => __( 'Beds24 Room', 'multipass' ),
			'id'            => 'resource_' . $prefix . 'id',
			'type'          => 'select_advanced',
			'options'       => $this->get_room_options(),
			'placeholder'   => __( 'Select a room', 'multipass' ),
			'admin_columns' => array(
				'position'   => 'before date',
				'sort'       => true,
				'searchable' => true,
			),
			'columns'       => 3,
		);

		// $meta_boxes['resources']['fields'][] = array(
		// 	'name'          => __( 'Beds24 Room', 'multipass' ),
		// 	'id'            => 'resource_' . $prefix . 'roomid',
		// 	'type'          => 'custom_html',
		// 	'callback'      => array( $this, 'property_name' ),
		// 	'save_field'    => false,
		// 	'admin_columns' => array(
		// 		'position'   => 'before date',
		// 		'sort'       => true,
		// 		'searchable' => true,
		// 	),
		// 	'columns'       => 3,
		// );

		return $meta_boxes;
	}

	function property_name( $value = '', $field = array() ) {
		if ( empty( $value ) ) {
			$post_id = get_the_ID();
			$prefix  = 'resource_' . $this->prefix;
			$value   = get_post_meta( $post_id, $prefix . 'name', true );
		}

		return $value;
	}

	function register_sources_filter( $sources ) {
		$sources['beds24']    = 'Beds24';
		$sources['bookingcom'] = 'Booking.com';
		$sources['airbnb']     = 'Airbnb';
		$sources['expedia']    = 'Expedia';
		return $sources;
	}

	function get_room_options() {
		$rooms = $this->get_rooms();
		$options = array();
		foreach ( $rooms as $room ) {
			$name = $room['name'] ?? $room['roomId'];
			$name .= empty( $room['resource_name'] ) ? '' : ' (' . $room['resource_name'] . ')';
			$options[ $room['roomId'] ] = $name;
		}
		return $options;
	}

	function room_list() {
		$rooms = $this->get_rooms();
		$list  = array();
		foreach( $rooms as $room ) {
			$name = $room['name'] ?? $room['roomId'];
			$name .= empty( $room['resource_name'] ) ? '' : ' (' . $room['resource_name'] . ')';
			$list[ $room['roomId'] ] = $name;
		}
		return '<ul class="room-list"><li>' . implode( '</li><li>', $list ) . '</li></ul>';
	}

	function get_rooms() {
		$transient_key = sanitize_title( __METHOD__ );

		$rooms = get_transient( $transient_key );
		if ( $rooms ) {
			return $rooms;
		}

		$token = $this->get_token();

		if ( empty( $token ) ) {
			// error_log( __METHOD__ . ' empty token, abort' );
			return array();
		}
		// $args = array();
		$args = array(
			'arrival' => date( 'Y-m-d' ),
			'departure' => date( 'Y-m-d', strtotime( '+1 day' ) ),
			'numAdults' => 1,
		);

		$result = $this->api_request( '/inventory/rooms/offers', $args );

		if ( is_array( $result ) && ! empty( $result['success'] ) && ! empty( $result['data'] ) ) {
			// TODO: get room data (requires additional API call or web scraping)
			foreach( $result['data'] as $room ) {
				$id = $room['roomId'];
				$rooms[$id] = $room;
				// WP Query to find resource post type with meta field 'beds24_resource_id' matching $id
				$query = new WP_Query( array(
					'post_type' => 'mltp_resource',
					'meta_query' => array(
						array(
							'key' => 'resource_beds24_id',
							'value' => $id,
						),
					),
				) );
				if ( $query->have_posts() ) {
					$query->the_post();
					$rooms[$id]['resource_id'] = get_the_ID();
					$rooms[$id]['resource_name'] = get_the_title();
				}
			}

			// $rooms = $result['data'];
			// MultiPass::debug( __METHOD__, 'rooms', $rooms );
			set_transient( $transient_key, $rooms, 3600 );
			return $rooms;
		}

		if ( is_wp_error( $result ) ) {
			$message = sprintf(
				'%s failed ("%s")',
				__METHOD__,
				$result->get_error_message(),
			);
			error_log( $message );
			return array();
		}  else {
			$message = sprintf(
				'%s failed (unmanaged error) %s',
				__METHOD__,
				print_r( $result, true ),
			);
		}
		error_log( $message );
		return array();
	}

	function get_properties() {

		$transient_key = sanitize_title( __METHOD__ );
		$properties    = get_transient( $transient_key );
		if ( $properties ) {
			// MultiPass::debug( __METHOD__, 'using transient', $properties );
			return $properties;
			// $check = reset( $properties );
			// if ( ! empty( $check ) && preg_match( '/^(Elite Royal Apartment|The Freeman)/', $check['name'] ) ) {
			// 	error_log( 'Demo data properties received from Beds24, ignoring.' );
			// } else {
			// }
		}

		$token = $this->get_token();

		if ( empty( $token ) ) {
			error_log( __METHOD__ . ' empty token, abort' );
			return array();
		}

		$result = $this->api_request( '/properties', array() );

		if ( is_array( $result ) && ! empty( $result['success'] ) && ! empty( $result['data'] ) ) {
			error_log( __METHOD__ . ' success ' . print_r( $result['data'], true ) );
			$properties = $result['data'];
			set_transient( $transient_key, $properties, 3600 );
			// MultiPass::debug( __METHOD__ . ' properties', $properties );
			return $properties;
		}
		
		if ( is_wp_error( $result ) ) {
			$message = sprintf(
				'%s failed ("%s")',
				__METHOD__,
				$result->get_error_message(),
			);
			error_log( $message );
			// add_settings_error( $field['id'], $field['id'], $message, 'error' );
			return array();
		}  else {
			$message = sprintf(
				'%s failed (unmanaged error) %s',
				__METHOD__,
				print_r( $result, true ),
			);
		}
		error_log( $message );
		return array();
	}

	function get_property_options( $prefix = '' ) {
		// $options    = array();
		// $properties = $this->get_properties();
		// if ( $properties ) {
		// 	foreach ( $properties as $id => $property ) {
		// 		$options[ $prefix . $id ] = $property['name'];
		// 	}
		// }
		// return $options;
	}

	function get_token() {
		$token = get_transient( 'multipass_beds24-token' );
		if ( $token ) {
			return $token;
		}
		$api = self::get_option( 'beds24_api' );
		$api = wp_parse_args( $api, array(
			'use_invite' => false,
			'invite_code' => null,
			'refresh_token' => null,
			'long_life_token' => null,
			'token' => null,
		) );
		
		if( $api['use_invite'] && ! empty( $api['invite_code'] . $api['refresh_token'] ) ) {
			if( ! empty( $api['invite_code'] ) ) {
				$auth_field = 'beds24_api_invite_code';
				$code = $api['invite_code'];
			} else {
				$auth_field = 'beds24_api_refresh_token'; 
				$code = $api['refresh_token'];
			}
		} else if ( ! empty( $api['long_life_token'] ) ) {
			unset( $api['invite_code'] );
			$auth_field = 'beds24_api_long_life_token';
			$code = $api['long_life_token'] ?? null;
		}
		
		$result       = $this->api_request( '/authentication/setup', [ 'code' => $code ] );

		if ( is_wp_error( $result ) ) {
			$message      = sprintf(
				__( 'Token verification failed (%s).', 'multipass' ),
				$result->get_error_message(),
			);
			error_log( __METHOD__ . ' ' . $message );
			$field_id = $auth_field ?? $field['id'];
			delete_transient( 'multipass_beds24-token' );
			return false;
		}

		// if( ! empty( $result['refreshToken'] ) ) {
		// 	// wp_cache_set( 'multipass_beds24-invite_verified', true );
		// 	$api['refresh_token'] = $result['refreshToken'];
		// }
		if( ! empty( $result['token'] ) && ! empty( $result['expiresIn'] ) ) {
			set_transient( 'multipass_beds24-token', $result['token'], $result['expiresIn'] );
			return $result['token'];
		}

		// $token = $this->api_request( '/authentication/setup', array() );
		// if ( ! empty( $token['refreshToken'] ) ) {
		// 	wp_cache_set( 'multipass_beds24-token', $token['refreshToken'], $token['expiresIn'] );
		// 	return $token['refreshToken'];
		// }
		return null;
	}

	function api_request_data( $path, $args = array() ) {
		$result = $this->api_request( $path, $args );
		if ( is_wp_error( $result ) ) {
			return $result;
		}

		if ( is_array( $result ) && ! empty( $result['success'] ) && ! empty( $result['data'] ) ) {
			MultiPass::debug( __METHOD__, ' success ', $result['data'] );
			return $result['data'];
		}

		error_log( __METHOD__ . ' ' . $path . ' fail ' . print_r( $result, true ) );
		return false;
	}

	function api_request( $path, $args = array() ) {
		$method = ( empty( $args['method'] ) ) ? 'GET' : $args['method'];
		unset( $args['method'] );

		if ( preg_match( '~^[a-z]+://~', $path ) ) {
			$url = $path;
		} else {
			$url = $this->api_url . $path;
		}
		$args = array_filter(wp_parse_args(
			array(
			),
			$args
		) );
		$json_data = array();

		// $token = $args['token'] ?? get_transient( 'multipass_beds24-token', false);
		// if ( empty( $token ) ) {
		// 	error_log( __METHOD__ . ' empty token' );
		// 	return new WP_Error( __FUNCTION__ . '-notoken', 'No token' );
		// }

		$options = array(
			'method'  => $method,
			'timeout' => 20,
			// 'ignore_errors' => true,
			'headers' => array_filter( array(
				'accept'        => 'application/json',
				'code'  => $args['code'] ?? null,
				'token' => $args['token'] ?? get_transient( 'multipass_beds24-token', null),
				// 'X-ApiKey'        => $this->api_key,
				// 'Accept-Language' => $this->locale,
			) ),
		);

		unset($args['token']);
		unset($args['code']);
		
		if ( 'GET' === $method ) {
			if ( ! empty( $args ) ) {
				$url = $url . '?' . http_build_query( $args );
			}
		} else {
			$options = array_merge_recursive( $options, $args );
			if ( is_array( $options['body'] ) ) {
				$options['body'] = json_encode( $options['body'], JSON_UNESCAPED_SLASHES );
			}
		}

		$response = wp_remote_request( $url, $options );
		
		if ( is_wp_error( $response ) ) {
			error_log( __METHOD__ . ' fail ' . $response->get_error_message() . " $url" );
			return $response;
		} elseif ( $response['response']['code'] != 200 && $response['response']['code'] != 201 ) {
			error_log( __METHOD__ . ' fail ' . $response['response']['code'] );
			return new WP_Error( __FUNCTION__ . '-wrongresponse', 'Response code ' . $response['response']['code'] . " $url" );
		} else {
			// MultiPass::debug( __METHOD__ . " success $url" );
			$json_data = json_decode( $response['body'], true );
		}
		
		return $json_data;
	}

	static function get_option( $option, $default = false ) {
		if ( preg_match( '/:/', $option ) ) {
			return MultiPass::get_option( $option, $default );
		} else {
			return MultiPass::get_option( 'multipass-beds24:' . $option, $default );
		}
	}

	function update_option( $option, $value, $autoload = null ) {
		if ( preg_match( '/:/', $option ) ) {
			return MultiPass::update_option( $option, $value, $autoload );
		} else {
			return MultiPass::update_option( 'multipass-lodfify:' . $option, $value, $autoload );
		}
	}

	function sanitize_callback_url( $value, $field, $oldvalue ) {
		return get_transient( 'multipass_beds24-callback_url' );
	}

	function sanitize_api( $api, $field, $oldapi ) {
		$api = wp_parse_args( $api, array(
			'use_invite' => false,
			'invite_code' => null,
			'refresh_token' => null,
			'long_life_token' => null,
			'token' => null,
		) );
		
		if( $api['use_invite'] && ! empty( $api['invite_code'] . $api['refresh_token'] ) ) {
			if( ! empty( $api['invite_code'] ) ) {
				$auth_field = 'beds24_api_invite_code';
				$code = $api['invite_code'];
			} else {
				$auth_field = 'beds24_api_refresh_token'; 
				$code = $api['refresh_token'];
			}
		} else if ( ! empty( $api['long_life_token'] ) ) {
			unset( $api['invite_code'] );
			$auth_field = 'beds24_api_long_life_token';
			$code = $api['long_life_token'] ?? null;
		}
		
		if ( empty( $code ) ) {
			$message = __( 'An invite code or a long life token is required.', 'multipass' );
			add_settings_error( 'beds24_api_long_life_token', 'beds24_api_long_life_token-error-empty', $message, 'error' );
			add_settings_error( 'beds24_api_invite_code', 'beds24_api_invite_code-error-empty', $message, 'error' );

			error_log( __METHOD__ . ' empty invite code/token' );
			// $this->update_option('invite_verified', false);
			wp_cache_set( 'multipass_beds24-invite_verified', false );
			return false;
		}

		$result       = $this->api_request( '/authentication/setup', [ 'code' => $code ] );

		if ( is_wp_error( $result ) ) {
			$message      = sprintf(
				__( 'Token verification failed (%s).', 'multipass' ),
				$result->get_error_message(),
			);
			$field_id = $auth_field ?? $field['id'];
			add_settings_error( $field_id, $field_id . '-error-auth-failed', $message, 'error' );
			delete_transient( 'multipass_beds24-token' );
			unset( $api['refresh_token'] );
			// wp_cache_set( 'multipass_beds24-invite_verified', false );
			return $api;
		}

		if( ! empty( $result['refreshToken'] ) ) {
			// wp_cache_set( 'multipass_beds24-invite_verified', true );
			$api['refresh_token'] = $result['refreshToken'];
		}
		if( ! empty( $result['token'] ) && ! empty( $result['expiresIn'] ) ) {
			set_transient( 'multipass_beds24-token', $result['token'], $result['expiresIn'] );
			// wp_cache_set( 'multipass_beds24-token', $result['token'], $result['expiresIn'] );
		}

		// $this->get_properties();

		$api['invite_code'] = null;
		return $api;
	}

	/**
	 * Beds24 does not handle automatic webhook subscription.
	 * Kept for reference. Will be deleted eventually.
	 *
	 * @return void
	 */
	function subscribe_webhooks() {
		// if ( get_transient( 'multipass_beds24-subscribed' ) == $this->webhooks_subscribe ) {
		// 	return;
		// }
		// $transient_value = $this->webhooks_subscribe;

		// $callback_url = get_rest_url( null, $this->namespace . $this->route );
		// $subscribe          = $this->webhooks_subscribe;
		// $unsubscribe        = array();
		// /*
		//  * Get currently subscribed hooks
		//  */
		// $response = $this->api_request( '/webhooks/v1/list', array() );
		// if ( $response ) {
		// 	foreach ( $response as $subscription ) {
		// 		$event              = $subscription['event'];
		// 		$event_callback_url = $callback_url . '/' . $event;
		// 		if ( $subscription['url'] != $event_callback_url && $subscription['url'] != $callback_url ) {
		// 			continue;
		// 		}
		// 		if ( isset( $subscribe[ $event ] ) && true === $subscribe[ $event ] ) {
		// 			unset( $subscribe[ $event ] );
		// 		} else {
		// 			unset( $subscribe[ $event ] );
		// 			$unsubscribe[ $event ] = $subscription['id'];
		// 		}
		// 	}
		// }
		// MultiPass::debug( 'subscribe', $subscribe, 'unsubscribe', $unsubscribe );

		// foreach ( $subscribe as $event => $subscribe ) {
		// 	$event_callback_url = $callback_url . '/' . $event;
		// 	$body               = json_encode(
		// 		array(
		// 			'target_url' => $event_callback_url,
		// 			'event'      => $event,
		// 		),
		// 		JSON_UNESCAPED_SLASHES
		// 	);
		// 	$params             = array(
		// 		'method'  => 'POST',
		// 		'body'    => $body,
		// 		'headers' => array(
		// 			'accept'       => 'application/json',
		// 			'content-type' => 'application/*+json',
		// 		),
		// 	);
		// 	$response           = $this->api_request( '/webhooks/v1/subscribe', $params );

		// 	// error_log(print_r($response, true));
		// }
		// foreach ( $unsubscribe as $event => $id ) {
		// 	$body     = array(
		// 		'id' => $id,
		// 	);
		// 	$params   = array(
		// 		'method'  => 'DELETE',
		// 		'body'    => $body,
		// 		'headers' => array(
		// 			'accept'       => 'application/json',
		// 			'content-type' => 'application/*+json',
		// 		),
		// 	);
		// 	$response = $this->api_request( '/webhooks/v1/unsubscribe', $params );
		// }

		// set_transient( 'multipass_beds24-subscribed', $transient_value, 3600 );
	}

	/*
	 * Not sure Beds24 handles automatic webhook subscription
	 * @return void
	 */
	function unsubscribe_webhooks() {
		// $this->webhooks_subscribe = array();
		// $this->subscribe_webhooks();
		// delete_transient( 'multipass_beds24-subscribed' );
	}

	// /**
	// * Get closed periods, complementary to get_bookings(), as API method
	// * /v2/reservations/bookings does not return dates blocked manually, and v1
	// * api doesn't return details.
	// *
	// * @return array API response as array
	// */
	// function get_closed_periods() {
	// $cache_key = sanitize_title( __CLASS__ . '-' . __METHOD__ );
	// $closed    = wp_cache_get( $cache_key );
	// if ( $closed ) {
	// return $closed;
	// }
	//
	// $closed = array();
	// foreach($props as $propertyId => $prop) {
	// $api_query = array(
	// 'start'          => date( 'Y-m-d', strtotime( 'first day of last month' ) ),
	// 'end'            => date( 'Y-m-d', strtotime( 'last day of next month' ) ),
	// 'end' => date('Y-m-d', strtotime('last day of next month + 2 years') ),
	// 'includeDetails' => true,
	// );
	// $response  = $this->api_request( '/v2/availability', $api_query );
	// if ( is_wp_error( $response ) ) {
	// $error_id = sanitize_title( __CLASS__ . '-' . __METHOD__ );
	// $message  = sprintf( __( '%1$s failed (%2$s).', 'multipass' ), $error_id, $response->get_error_message() );
	// add_settings_error( $error_id, $error_id, $message, 'error' );
	// return $response;
	// }
	//
	// foreach ( $response as $avail ) {
	// $periods     = $avail['periods'];
	// $property_id = $avail['property_id'];
	// $resource    = Mltp_Resource::get_resource( 'beds24', $property_id );
	// if ( ! $resource ) {
	// continue;
	// }
	//
	// $closed[ $property_id ] = array(
	// 'user_id'      => $avail['user_id'],
	// 'property_id'  => $avail['property_id'],
	// 'room_type_id' => $avail['room_type_id'],
	// );
	// foreach ( $periods as $period_key => $period ) {
	// if ( $period['available'] ) {
	// continue;
	// }
	// if ( empty( $period['closed_period'] ) ) {
	// Not available, but there is a booking associated
	// continue;
	// }
	// $period['source_url']                = 'https://app.beds24.com/#/reservation/calendar/multi/closed-period/' . $period['closed_period']['id'];
	// $closed[ $property_id ]['periods'][] = $period;
	// }
	// if ( empty( $closed[ $property_id ]['periods'] ) ) {
	// unset( $closed[ $property_id ] );
	// }
	// }
	// }
	//
	// wp_cache_set( $cache_key, $closed );
	// return $closed;
	// }


	/**
	 * Get all future bookings.
	 *
	 * TODO: fetch only bookings updated since last sync on regular basis (use
	 * 'updatedSince' paramenter). Fetch all less often, or on initial sync or
	 * manual resync.
	 *
	 * @return array API response as array
	 */
	function get_bookings() {
		ini_set( 'max_execution_time', 300 );
		$cache_key = sanitize_title( __CLASS__ . '-' . __METHOD__ );
		$response  = wp_cache_get( $cache_key );
		if ( $response ) {
			return $response;
		}

		$items     = array();
		$count     = -1;
		$total     = -1;
		$api_query = array(
			'offset' => 0,
			'limit'  => 50,
			'trash'  => 'false',
		);
		$response  = $this->api_request( '/v1/reservation', $api_query );
		if ( is_wp_error( $response ) ) {
			$error_id = __CLASS__ . '-' . __METHOD__ . '-' . $response->get_error_code();
			// error_log( $error_id . ' ' . print_r( $response, true ) );
			$message = sprintf( __( '%1$s failed with error %2$s: %3$s', 'multipass' ), __CLASS__ . ' ' . __METHOD__ . '()', $response->get_error_code(), $response->get_error_message() );
			add_settings_error( $error_id, $error_id, $message, 'error' );
			return $response;
		}

		$bookings = $response['items'];
		$total    = $response['total'];
		$count    = count( $response['items'] );

		while ( ! empty( $response['next'] ) ) {
			$response = $this->api_request( $response['next'] );
			if ( is_wp_error( $response ) ) {
				break;
			}

			$count    = count( $response['items'] );
			$bookings = array_merge( $bookings, $response['items'] );
		}

		/**
		 * Second request with v2 API to get notes and other details not provided by
		 * v1. This surely could be improved.
		 */
		// $total = 10; // DEBUG
		// $bookings = array(); // DEBUG
		$api_query = array(
			'page'                => 1,
			'size'                => $total,
			'includeTransactions' => 'true',
			'includeExternal'     => 'true',
			'includeQuoteDetails' => 'true',
		);
		$response  = $this->api_request( '/v2/reservations/bookings', $api_query );
		if ( is_wp_error( $response ) ) {
			$error_id = __CLASS__ . '-' . __METHOD__ . '-second-round-' . $response->get_error_code();
			// error_log( $error_id . ' ' . print_r( $response, true ) );
			$message = sprintf( __( '%1$s failed with error %2$s: %3$s', 'multipass' ), __CLASS__ . ' ' . __METHOD__ . '()', $response->get_error_code(), $response->get_error_message() );
			add_settings_error( $error_id, $error_id, $message, 'error' );
			return $response;
		}
		$bookings = array_merge( $bookings, $response['items'] );

		if ( ! is_wp_error( $response ) ) {
			foreach ( $response['items'] as $booking ) {
				if ( empty( $booking['id'] ) ) {
					continue;
				}
				$id              = $booking['id'];
				$bookings[ $id ] = array_merge_recursive(
					( isset( $bookings[ $id ] ) ) ? $bookings[ $id ] : array(),
					$booking,
				);
				// MultiPass::debug($booking['notes'], $bookingss[$id]['notes']);
			}
			// MultiPass::debug($bookings);
		}

		$count = count( $bookings );
		if ( $count < $total ) {
			error_log( __METHOD__ . "() partial result $count/$total" );
		} else {
			error_log( __METHOD__ . "result $count/$total" );
		}

		$response = array(
			'total' => $total,
			'count' => $count,
			'items' => $bookings,
			// 'closed' => $closed,
		);

		wp_cache_set( $cache_key, $response );
		return $response;
	}

	/**
	 * Callback for "Import now" Beds24 settings switch.
	 *
	 * @param  boolean $value      Checkbox value, process is true.
	 * @param  array   $field      Field from settings.
	 * @param  boolean $oldvalue  Always void
	 * @return void
	 */
	function import_now( $value = true, $field = array(), $oldvalue = null ) {
		if ( ! $value ) {
			return;
		}
		// $this->example_request = new Mltp_Async_Request();
		// $this->example_request->data( array( $this ) );
		// $this->example_request->dispatch();

		$this->import();
	}

	/**
	 * Import bookings from Beds24. Create entries for new bookings, update
	 * exissting ones. Try to match existing prestation (same client, overlapping
	 * period), create new prestation otherwise.
	 *
	 * TODO: Fix bug when name contains special characters.
	 */
	function import() {
		$properties = $this->get_properties();

		$api_response = $this->get_bookings();
		if ( is_wp_error( $api_response ) ) {
			error_log( $api_response->get_error_message() );
			return false;
		}
		$bookings = $api_response['items'];

		$i = 0;
		foreach ( $bookings as $key => $data ) {
			$booking = $this->save_booking( $data );
			// $booking = new Mltp_Beds24_Booking( $data );
			// if ( is_wp_error( $api_response ) ) {
			// error_log( $booking->get_error_message() );
			// continue;
			// }
			// if ( ! $booking->status ) {
			// MultiPass::debug('no resource ', $booking);
			// continue;
			// }
			//
			// if ( in_array( $booking->status, array( 'Declined', 'Open', 'Unavailable' ) ) ) {
			// MultiPass::debug('wrong status ', $booking);
			// continue;
			// }
			//
			// $mltp_detail = $booking->save();
		}
	}

	function save_booking( $data ) {
		if ( ! is_array( $data ) || empty( $data ) ) {
			MultiPass::debug( 'empty data ' );
			return;
		}
		$booking = new Mltp_Beds24_Booking( $data );

		if ( ! $booking->status ) {
			MultiPass::debug( 'no resource ', $booking );
			return $booking;
		}

		if ( in_array( $booking->status, array( 'Declined', 'Open', 'Unavailable' ) ) ) {
			MultiPass::debug( 'wrong status ', $booking );
			return $booking;
		}

		$mltp_detail = $booking->save();

		return $booking;
	}
}

$this->modules[] = new Mltp_Beds24();
