<?php

/**
 * Lodgify API.
 *
 * https://www.lodgify.com/docs/api
 * https://docs.lodgify.com/reference/
 *
 * @link       https://github.com/magicoli/multipass
 * @since      0.1.0
 *
 * @package    MultiPass
 * @subpackage MultiPass/includes
 */

/**
 * Lodgify Class.
 *
 * @package    MultiPass
 * @subpackage MultiPass/includes
 * @author     Magiiic <info@magiiic.com>
 */
class Mltp_Lodgify extends Mltp_Modules {

	protected $api_url;
	protected $api_key;

	/**
	 * Initialize the collections used to maintain the actions and filters.
	 *
	 * @since    0.1.0
	 */
	public function __construct() {
		$this->prefix  = 'lodgify_';
		$this->api_url = 'https://api.lodgify.com';
		$this->api_key = self::get_option( 'lodgify_api_key' );

		$this->locale = MultiPass::get_locale();

		$this->namespace = 'multipass/v1';
		$this->route     = '/lodgify';

		$this->webhooks_subscribe = ( filter_var(
			$_SERVER['SERVER_ADDR'],
			FILTER_VALIDATE_IP,
			FILTER_FLAG_IPV4 | FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE
		) ) ? array(
			'rate_change'            => true,
			'availability_change'    => true,
			'booking_new_any_status' => true,
			'booking_change'         => true,
		) : array();

		register_activation_hook( MULTIPASS_FILE, array( $this, 'subscribe_webhooks' ) );
		register_deactivation_hook( MULTIPASS_FILE, array( $this, 'unsubscribe_webhooks' ) );
	}

	/**
	 * Register the filters and actions with WordPress.
	 *
	 * @since    0.1.0
	 */
	public function init() {

		$actions = array(
			array(
				'hook'     => 'rest_api_init',
				'callback' => 'register_api_callback_route',
			),
		);

		$filters = array(
			array(
				'hook'     => 'mb_settings_pages',
				'callback' => 'register_settings_pages',
			),
			array(
				'hook'     => 'rwmb_meta_boxes',
				'callback' => 'register_settings_fields',
			),
			array(
				'hook'     => 'rwmb_meta_boxes',
				'callback' => 'register_fields',
			),

			array(
				'hook'     => 'multipass_register_terms_mltp_detail-source',
				'callback' => 'register_sources_filter',
			),
		);

		$defaults = array(
			'component'     => $this,
			'priority'      => 10,
			'accepted_args' => 1,
		);

		foreach ( $filters as $hook ) {
			$hook = array_merge( $defaults, $hook );
			add_filter( $hook['hook'], array( $hook['component'], $hook['callback'] ), $hook['priority'], $hook['accepted_args'] );
		}

		foreach ( $actions as $hook ) {
			$hook = array_merge( $defaults, $hook );
			add_action( $hook['hook'], array( $hook['component'], $hook['callback'] ), $hook['priority'], $hook['accepted_args'] );
		}

	}

	function register_settings_pages( $settings_pages ) {
		$one = 1;
		$two = 2;

		$settings_pages[] = array(
			'menu_title' => __( 'Lodgify', 'multipass' ),
			'id'         => 'multipass-lodgify',
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
		// $lodgify = new Mltp_Lodgify();

		// Lodify Settings tab
		$meta_boxes[] = array(
			'title'          => __( 'Lodgify Settings', 'multipass' ),
			'id'             => 'multipass-lodgify-settings',
			'settings_pages' => array( 'multipass-lodgify' ),
			// 'tab'            => 'lodgify',
			'fields'         => array(
				array(
					'name'              => __( 'API Key', 'multipass' ),
					'id'                => $prefix . 'api_key',
					'type'              => 'text',
					'sanitize_callback' => array( $this, 'verify_api_key' ),
				),
				array(
					'name'              => __( 'API key is valid', 'multipass' ),
					'id'                => 'api_key_verified',
					'type'              => 'hidden',
					// 'readonly' => true,
					// 'disabled' => true,
					// 'save_field' => false,
					'sanitize_callback' => array( $this, 'api_key_verified' ),
				),
				array(
					'id'         => $prefix . 'api_key_required',
					'save_field' => false,
					'type'       => 'custom_html',
					'std'        => sprintf(
						'%s <a href="%s" target="_blank">%s</a>',
						__( 'An API key is required to connect to Lodgify.', 'multipass' ),
						'https://app.lodgify.com/#/reservation/settings/publicApiToken',
						__( 'Get your API key from Logdify Settings page > Public API', 'multipass' ),
					),
					'visible'    => array(
						'when'     => array(
							array( 'api_key', '=', '' ),
							array( 'api_key_verified', '=', '' ),
						),
						'relation' => 'or',
					),
				),
				array(
					// 'name'              => __( 'Debug', 'multipass' ),
					'id'       => $prefix . 'debug',
					'type'     => 'custom_html',
					'callback' => array( $this, 'render_debug' ),
				),
			),
		);

		if ( self::get_option( 'api_key_verified' ) === true ) {
			// if( ! empty ( $this->api_key ) ) {
			$meta_boxes['multipass-lodgify-resources'] = array(
				'name'           => __( 'Resources', 'multipass' ),
				'id'             => 'multipass-lodgify-resources',
				'settings_pages' => array( 'multipass-lodgify' ),
				// 'tab'            => 'lodgify',
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
			$meta_boxes['multipass-lodgify-synchronize'] = array(
				'name'           => __( 'Synchronize', 'multipass' ),
				'id'             => 'multipass-lodgify-synchronize',
				'settings_pages' => array( 'multipass-lodgify' ),
				'fields'         => array(
					array(
						'name'              => __( 'Import now', 'multipass' ),
						'id'                => $prefix . 'import_now',
						'type'              => 'switch',
						'desc'              => __( 'Import Lodgify bookings, create or resync matching prestations and entries. Only useful after plugin activation or if out of sync.', 'multipass' ),
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

	function register_api_callback_route() {
		// register_rest_route( 'multipass/v1', '/users/market=(?P<market>[a-zA-Z0-9-]+)/lat=(?P<lat>[a-z0-9 .\-]+)/long=(?P<long>[a-z0-9 .\-]+)', array(
		//
		$events = $this->webhooks_subscribe;
		foreach ( $events as $event => $subscribe ) {
			if ( ! $subscribe ) {
				continue;
			}
			$route = "$this->route/$event";
			register_rest_route(
				$this->namespace,
				$route,
				array(
					'methods'             => 'POST',
					'callback'            => array( $this, 'handle_api_callback' ),
					'permission_callback' => '__return_true',
				)
			);
		}
	}

	function handle_api_callback( WP_REST_Request $request ) {
		// error_log(__METHOD__ . ' ' . print_r($request, true) );
		// $callback_url = $request->get_param('callback_url');
		$datas = $request->get_params();
		$route = $request->get_route();
		$event = str_replace( "/$this->namespace$this->route/", '', $route );
		foreach ( $datas as $data ) {
			if ( ! isset( $data['action'] ) ) {
				continue;
			}

			switch ( $data['action'] ) {
				case 'booking_new_any_status':
				case 'booking_change':
					$booking = new Mltp_Lodgify_Booking( $data );
					$result  = $booking->save();
					break;

				default:
					error_log( 'unmanaged action ' . $data['action'] );
			}

			// error_log(print_r($data, true));
		}

		// Perform actions with the received callback URL, such as saving it to the database or triggering an event.
		// $debug = array(
		// 'message' => 'Callback URL registered.',
		// 'callback_url' => $callback_url,
		// 'route' => $route,
		// 'event' => $event,
		// 'remote' => $_SERVER['REMOTE_ADDR'],
		// 'content_type' => $request->get_content_type(),
		// 'data' => $data,
		// );
		// error_log(print_r($debug, true));
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
			$lodgify_id = preg_replace( "/^$this->prefix/", '', $key );

			$query = $this->query_resources( $lodgify_id );
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
					update_post_meta( $resource->id, $prefix . 'id', $lodgify_id );
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
		// $lodgify = new Mltp_Lodgify();

		$meta_boxes['resources']['fields'][] = array(
			'name'          => __( 'Lodgify Property', 'multipass' ),
			'id'            => 'resource_' . $prefix . 'name',
			'type'          => 'custom_html',
			'callback'      => array( $this, 'property_name' ),
			'save_field'    => false,
			'admin_columns' => array(
				'position'   => 'before date',
				'sort'       => true,
				'searchable' => true,
			),
			'columns'       => 3,
		);

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
		$sources['lodgify']    = 'Lodgify';
		$sources['bookingcom'] = 'Booking.com';
		$sources['airbnb']     = 'Airbnb';
		$sources['expedia']    = 'Expedia';
		return $sources;
	}

	function get_properties() {
		$transient_key = sanitize_title( __CLASS__ . '-' . __FUNCTION__ );
		$properties    = get_transient( $transient_key );
		if ( $properties ) {
			$check = reset( $properties );
			if ( ! empty( $check ) && preg_match( '/^(Elite Royal Apartment|The Freeman)/', $check['name'] ) ) {
				error_log( 'Demo data properties received from Lodgify, ignoring.' );
			} else {
				return $properties;
			}
		}

		if ( empty( $this->api_key ) ) {
			return array();
		}
		$results = $this->api_request( '/v1/properties', array() );
		if ( is_wp_error( $results ) ) {
			$message = sprintf(
				'%s failed ("%s")',
				__CLASS__ . '::' . __METHOD__,
				$results->get_error_message(),
			);
			error_log( $message );
			// add_settings_error( $field['id'], $field['id'], $message, 'error' );
			return array();
		}

		$properties = array();
		foreach ( $results as $result ) {
			$properties[ $result['id'] ] = $result;
		}

		set_transient( $transient_key, $properties, 3600 );
		return $properties;
	}

	function get_property_options( $prefix = '' ) {
		$options    = array();
		$properties = $this->get_properties();
		if ( $properties ) {
			foreach ( $properties as $id => $property ) {
				$options[ $prefix . $id ] = $property['name'];
			}
		}
		return $options;
	}

	function api_request( $path, $args = array() ) {
		$method = ( empty( $args['method'] ) ) ? 'GET' : $args['method'];
		unset( $args['method'] );

		if ( preg_match( '~^[a-z]+://~', $path ) ) {
			$url = $path;
		} else {
			$url = $this->api_url . $path . ( empty( $args ) ? '' : '?' . http_build_query( $args ) );
		}
		$options = array(
			'method'  => $method,
			'timeout' => 20,
			// 'ignore_errors' => true,
			'headers' => array(
				'X-ApiKey'        => $this->api_key,
				'Accept-Language' => $this->locale,
			),
		);

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
			error_log( __CLASS__ . '::' . __METHOD__ . ' fail ' . $response->get_error_message() . " $url" );
			return $response;
		} elseif ( $response['response']['code'] != 200 && $response['response']['code'] != 201 ) {
			error_log( __CLASS__ . '::' . __METHOD__ . ' fail ' . $response['response']['code'] );
			return new WP_Error( __FUNCTION__ . '-wrongresponse', 'Response code ' . $response['response']['code'] . " $url" );
		} else {
			// MultiPass::debug( __CLASS__ . '::' . __METHOD__ . " success $url" );
			$json_data = json_decode( $response['body'], true );
		}

		return $json_data;
	}

	static function get_option( $option, $default = false ) {
		if ( preg_match( '/:/', $option ) ) {
			return MultiPass::get_option( $option, $default );
		} else {
			return MultiPass::get_option( 'multipass-lodgify:' . $option, $default );
		}
	}

	function update_option( $option, $value, $autoload = null ) {
		if ( preg_match( '/:/', $option ) ) {
			return MultiPass::update_option( $option, $value, $autoload );
		} else {
			return MultiPass::update_option( 'multipass-lodfify:' . $option, $value, $autoload );
		}
	}

	function api_key_verified( $value, $field, $oldvalue ) {
		return wp_cache_get( 'multipass_lodgify-api_key_verified' );
		// // add_settings_error( $field['id'], $field['id'], $message, 'error' );
		// if($status === 'valid')  return true;
		//
		// return false;
	}

	function verify_api_key( $api_key, $field, $oldapi_key ) {
		if ( empty( $api_key ) ) {
			// $this->update_option('api_key_verified', false);
			wp_cache_set( 'multipass_lodgify-api_key_verified', false );
			return false;
		}
		if ( $api_key == $oldapi_key ) {
			wp_cache_set( 'multipass_lodgify-api_key_verified', self::get_option( 'api_key_verified' ) );
			$this->subscribe_webhooks();
			return $api_key; // we assume it has already been checked
		}

		$this->api_key = $api_key;
		$result        = $this->api_request( '/v1/properties', array() );
		if ( is_wp_error( $result ) ) {
			$this->api_key = null;
			$message       = sprintf(
				__( 'API Key verification failed (%s).', 'multipass' ),
				$result->get_error_message(),
			);
			add_settings_error( $field['id'], $field['id'], $message, 'error' );
			wp_cache_set( 'multipass_lodgify-api_key_verified', false );
			return false;
		}

		$this->subscribe_webhooks();

		wp_cache_set( 'multipass_lodgify-api_key_verified', true );
		return $api_key;
	}

	/**
	 * Subscribe to Lodgify webhooks
	 *
	 * @return void
	 */
	function subscribe_webhooks() {
		if ( get_transient( 'multipass_lodgify-subscribed' ) == $this->webhooks_subscribe ) {
			return;
		}
		$transient_value = $this->webhooks_subscribe;

		$this->callback_url = get_rest_url( null, $this->namespace . $this->route );
		$subscribe          = $this->webhooks_subscribe;
		$unsubscribe        = array();
		/*
		 * Get currently subscribed hooks
		 */
		$response = $this->api_request( '/webhooks/v1/list', array() );
		if ( $response ) {
			foreach ( $response as $subscription ) {
				$event              = $subscription['event'];
				$event_callback_url = $this->callback_url . '/' . $event;
				if ( $subscription['url'] != $event_callback_url && $subscription['url'] != $this->callback_url ) {
					continue;
				}
				if ( isset( $subscribe[ $event ] ) && true === $subscribe[ $event ] ) {
					unset( $subscribe[ $event ] );
				} else {
					unset( $subscribe[ $event ] );
					$unsubscribe[ $event ] = $subscription['id'];
				}
			}
		}
		MultiPass::debug( 'subscribe', $subscribe, 'unsubscribe', $unsubscribe );

		foreach ( $subscribe as $event => $subscribe ) {
			$event_callback_url = $this->callback_url . '/' . $event;
			$body               = json_encode(
				array(
					'target_url' => $event_callback_url,
					'event'      => $event,
				),
				JSON_UNESCAPED_SLASHES
			);
			$params             = array(
				'method'  => 'POST',
				'body'    => $body,
				'headers' => array(
					'accept'       => 'application/json',
					'content-type' => 'application/*+json',
				),
			);
			$response           = $this->api_request( '/webhooks/v1/subscribe', $params );

			// error_log(print_r($response, true));
		}
		foreach ( $unsubscribe as $event => $id ) {
			$body     = array(
				'id' => $id,
			);
			$params   = array(
				'method'  => 'DELETE',
				'body'    => $body,
				'headers' => array(
					'accept'       => 'application/json',
					'content-type' => 'application/*+json',
				),
			);
			$response = $this->api_request( '/webhooks/v1/unsubscribe', $params );
		}

		set_transient( 'multipass_lodgify-subscribed', $transient_value, 3600 );
	}

	function unsubscribe_webhooks() {
		$this->webhooks_subscribe = array();
		$this->subscribe_webhooks();
		delete_transient( 'multipass_lodgify-subscribed' );
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
	// $resource    = Mltp_Resource::get_resource( 'lodgify', $property_id );
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
	// $period['source_url']                = 'https://app.lodgify.com/#/reservation/calendar/multi/closed-period/' . $period['closed_period']['id'];
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
			error_log( $error_id . ' ' . print_r( $response, true ) );
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
			error_log( $error_id . ' ' . print_r( $response, true ) );
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
			error_log( __CLASS__ . '::' . __METHOD__ . "() partial result $count/$total" );
		} else {
			error_log( __CLASS__ . '::' . __METHOD__ . "result $count/$total" );
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
	 * Callback for "Import now" Lodgify settings switch.
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
	 * Import bookings from Lodgify. Create entries for new bookings, update
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
			// $booking = new Mltp_Lodgify_Booking( $data );
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
		$booking = new Mltp_Lodgify_Booking( $data );

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

require_once MULTIPASS_DIR . 'includes/modules/class-mltp-lodgify-booking.php';

$this->modules[] = new Mltp_Lodgify();
