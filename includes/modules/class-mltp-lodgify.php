<?php

/**
 * Register all actions and filters for the plugin
 *
 * @link       https://github.com/magicoli/multipass
 * @since      0.1.0
 *
 * @package    MultiPass
 * @subpackage MultiPass/includes
 */

/**
 * Register all actions and filters for the plugin.
 *
 * Maintain a list of all hooks that are registered throughout
 * the plugin, and register them with the WordPress API. Call the
 * run function to execute the list of actions and filters.
 *
 * @package    MultiPass
 * @subpackage MultiPass/includes
 * @author     Your Name <email@example.com>
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
		$this->api_url = 'https://api.lodgify.com';
		$this->api_key = MultiPass::get_option( 'lodgify_api_key' );

		$this->locale = MultiPass::get_locale();

		// register_activation_hook( MULTIPASS_FILE, __CLASS__ . '::activate' );
		// register_deactivation_hook( MULTIPASS_FILE, __CLASS__ . '::deactivate' );
	}

	/**
	 * Register the filters and actions with WordPress.
	 *
	 * @since    0.1.0
	 */
	public function run() {

		$actions = array();

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
				'hook'     => 'multipass_register_terms_prestation-item-source',
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
		$settings_pages['multipass']['tabs']['lodgify'] = 'Lodgify';

		return $settings_pages;
	}

	function register_settings_fields( $meta_boxes ) {
		$prefix  = 'lodgify_';
		// $lodgify = new Mltp_Lodgify();

		// Lodify Settings tab
		$meta_boxes[] = array(
			'title'          => __( 'Lodgify Settings', 'multipass' ),
			'id'             => 'lodgify-settings',
			'settings_pages' => array( 'multipass' ),
			'tab'            => 'lodgify',
			'fields'         => array(
				array(
					'name'              => __( 'API Key', 'multipass' ),
					'id'                => $prefix . 'api_key',
					'type'              => 'text',
					'sanitize_callback' => __CLASS__ . '::api_key_validation',
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
					'visible'    => array( 'api_key', '=', '' ),
				),
				array(
					'name'              => __( 'Synchronize now', 'multipass' ),
					'id'                => $prefix . 'sync_now',
					'type'              => 'switch',
					'desc'              => __( 'Sync Lodgify bookings with prestations, create prestation if none exist. Only useful after plugin activation or if out of sync.', 'multipass' ),
					'style'             => 'rounded',
					'sanitize_callback' => array ($this,  'sync_now'),
					'save_field'        => false,
					'visible'           => array(
						'when'     => array( array( 'api_key', '!=', '' ) ),
						'relation' => 'or',
					),
				),
				array(
					'id'                => $prefix . 'debug',
					'type'              => 'custom_html',
					'callback'	=> array($this, 'render_debug'),
				),
			),
		);

		return $meta_boxes;
	}

	function render_debug() {
		return 'this <pre>' . print_r($this, true) . '</pre>';
	}

	function register_fields( $meta_boxes ) {
		// $prefix  = 'lodgify_';
		// $lodgify = new Mltp_Lodgify();

		$meta_boxes['resources']['fields'][] = array(
			'name'          => __( 'Lodgify Property', 'multipass' ),
			'id'            => 'resource_lodgify_id',
			'type'          => 'select_advanced',
			'options'       => $this->get_property_options(),
			'admin_columns' => array(
				'position'   => 'before date',
				'sort'       => true,
				'searchable' => true,
			),
			'columns'       => 3,
		);

		return $meta_boxes;
	}

	function register_sources_filter( $sources ) {
		$sources['lodgify'] = 'Lodgify';
		return $sources;
	}

	function get_properties() {
		$transient_key = sanitize_title( __CLASS__ . '-' . __FUNCTION__ );
		$properties    = get_transient( $transient_key );
		if ( $properties ) {
			return $properties;
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

	function get_property_options() {
		$options    = array();
		$properties = $this->get_properties();
		if ( $properties ) {
			foreach ( $properties as $id => $property ) {
				$options[ $id ] = $property['name'];
			}
		}
		return $options;
	}

	function api_request( $path, $args = array() ) {
		$url      = $this->api_url . "$path?" . http_build_query( $args );
		$options  = array(
			// 'method'  => 'GET',
			'timeout' => 10,
			// 'ignore_errors' => true,
			'headers' => array(
				'X-ApiKey'        => $this->api_key,
				'Accept-Language' => $this->locale,
			),
		);
		$response = wp_remote_get( $url, $options );
		if ( is_wp_error( $response ) ) {
			return $response;
		} elseif ( $response['response']['code'] != 200 ) {
			return new WP_Error( __FUNCTION__ . '-wrongresponse', 'Response code ' . $response['response']['code'] );
		} else {
			$json_data = json_decode( $response['body'], true );
		}

		return $json_data;
	}

	static function api_key_validation( $value, $field, $oldvalue ) {
		if ( empty( $value ) ) {
			return false;
		}
		if ( $value == $oldvalue ) {
			return $value; // we assume it has already been checked
		}

		$lodgify          = new Mltp_Lodgify();
		$lodgify->api_key = $value;

		$result = $lodgify->api_request( '/v1/properties', array() );

		if ( is_wp_error( $result ) ) {
			$lodgify->api_key = null;
			$message = sprintf(
				__( 'API Key verification failed (%s).', 'multipass' ),
				$result->get_error_message(),
			);
			add_settings_error( $field['id'], $field['id'], $message, 'error' );
			return false;
		}

		return $value;
	}

	function get_bookings() {
		$cache_key = sanitize_title( __CLASS__ . '-' . __METHOD__ );
		$response  = wp_cache_get( $cache_key );
		if ( $response ) {
			return $response;
		}

		$args = array(
			// 'size' => 10,
			'includeCount'        => 'true',
			'includeTransactions' => 'true',
			'includeExternal' => true,
			'includeQuoteDetails' => 'true',
			'stayFilter'          => 'Upcoming', // Upcoming (default), Current, Historic, All
		);

		$response = $this->api_request( '/v2/reservations/bookings', $args );
		if ( is_wp_error( $response ) ) {
			$error_id = sanitize_title( __CLASS__ . '-' . __METHOD__ );
			$message  = sprintf( __( '%1$s failed (%2$s).', 'multipass' ), $error_id, $response->get_error_message() );
			add_settings_error( $error_id, $error_id, $message, 'error' );
			return $response;
		}

		if ( $response['count'] > count( $response['items'] ) ) {
			error_log( 'missing some, getting them all ' . $response['count'] );
			$args['size'] = $response['count'];
			$response     = $this->api_request( '/v2/reservations/bookings', $args );
			if ( is_wp_error( $response ) ) {
				$error_id = sanitize_title( __CLASS__ . '-' . __METHOD__ );
				$message  = sprintf( __( '%1$s failed (%2$s).', 'multipass' ), $error_id, $response->get_error_message() );
				add_settings_error( $error_id, $error_id, $message, 'error' );
				return $response;
			}
		}

		wp_cache_set( $cache_key, $response );
		return $response;
	}

	static function bookings_options() {
		$lodgify  = new Mltp_Lodgify();
		$options  = array();
		$response = $lodgify->get_bookings();
		if ( is_wp_error( $response ) ) {
			return false;
		}
		if ( ! is_array( $response['items'] ) ) {
			return false;
		}

		foreach ( $response['items'] as $key => $booking ) {
			$options[ $booking['id'] ] = sprintf(
				'%s, %sp %s (#%s)',
				$booking['attendee']['name'],
				$booking['rooms'][0]['people'],
				MultiPass::format_date_range(
					array(
						$booking['arrival'],
						$booking['departure'],
					),
					true
				),
				$booking['id'],
			);
		}

		return $options;
	}

	/**
	 * Sync bookings from Lodgify.
	 *
	 * TODO: Include blocked dates.
	 * TODO: Check why existing prestation from other source is not found.
	 *
	 * @param  boolean $value                  Sync now.
	 * @param  array   $field                  Field from settings.
	 * @param  [type]  $oldvalue               Always false
	 * @return void
	 */
	function sync_now( $value = true, $field = [], $oldvalue = null) {
		if ( ! $value ) {
			return;
		}
		$properties = $this->get_properties();

		$response = $this->get_bookings();
		if ( is_wp_error( $response ) ) {
			return false;
		}

		$bookings = $response['items'];
		$z = 0;
		foreach ( $bookings as $key => $booking ) {
			$status = $booking['status'];
			if(in_array($status, [ 'Declined', 'Open', 'Unavailable' ] )) continue;

			if( ! in_array( $status, [ 'Booked', 'Tentative' ] ) ) {
				error_log(
					"Unknown status "
					. print_r( $booking, true )
				);
				// break;
			}
			$confirmed = (in_array($status, [ 'Booked' ])) ? true : false;

			$from = strtotime($booking['arrival']);
			$to = strtotime($booking['departure']);
			$dates = [ 'from' => $from, 'to' => $to ];
			$date_range = MultiPass::format_date_range( $dates );
			$attendees = $booking['rooms'][0]['people'];
			$resource_id = Mltp_Resource::get_resource_id( 'lodgify', $booking['property_id'] );
			if($resource_id) {
				$resource = new Mltp_Resource($resource_id);
				$name =  $resource->name;
			} else {
				$name = 'lodgify-' . $booking['property_id'];
			}
			$description = sprintf(
				'%s (%sp, %s)',
				$name,
				$attendees,
				$date_range,
			);
			$subtotal = $booking['subtotals']['stay'] + $booking['subtotals']['fees'] + $booking['subtotals']['addons'];

			$prestation_args = array(
				'customer_name' => $booking['guest']['name'],
				'customer_email' => $booking['guest']['email'],
				'customer_phone' => $booking['guest']['phone'],
				// 'confirmed' => $confirmed,
				'from' => $from,
				'to' => $to,
			);
			$prestation = new Mltp_Prestation( $prestation_args);

			$item_args = array(
				'source' => 'lodgify',
				'source_id' => $booking['id'],
				'source_item_id' => $booking['property_id'],
				'view_url'       => 'https://app.lodgify.com/#/reservation/inbox/B' . $booking['id'],
				// 'edit_url'       => $order->get_edit_order_url(),
				'resource_id'    => $resource_id,
				'status' => $status,
				'confirmed' => $confirmed,
				'source_details' => array(
					'rooms' => $booking['rooms'],
					'language' => $booking['language'],
					'created' => strtotime($booking['created_at']),
					'updated' => strtotime($booking['updated_at']),
					'canceled' => strtotime($booking['canceled_at']),
					'is_deleted' => $booking['is_deleted'],
					'currency_code' => $booking['currency_code'],
					'currency_code' => $booking['currency_code'],
					'quote' => $booking['quote'],
				),
				'origin' => $booking['source'],
				'description'    => $description,
				'prestation_id'  => $prestation->ID,
				'customer'       => array(
					// TODO: try to get WP user if exists
					// 'user_id' => $customer_id,
					'name'    => $booking['guest']['name'],
					'email'   => $booking['guest']['email'],
					'phone'   => $booking['guest']['phone'],
				),
				'dates'          => $dates,
				'attendees' => $attendees,
				// // 'beds' => $beds,
				'price'          => array(
					// 'quantity'  => 1,
					'unit'      => $subtotal,
					'sub_total' => $subtotal,
				),
				'discount'       => $booking['subtotals']['promotions'],
				'total'          => $booking['total_amount'],
				// // TODO: ensure paid status is updated immediatly, not after second time save
				// //
				'paid'           => $booking['amount_paid'],
				'balance'        => $booking['amount_due'],
				'type'           => 'booking',
			);
			$prestation_item = new Mltp_Item( $item_args );
			$prestation->update();

			// error_log(
			// 	"booking $key "
			// 	// . print_r( $booking, true )
			// 	. '
			// 	 prestation ' . $prestation->ID . ' ' . $prestation->name
			// 	. '
			// 	 item ' .  $prestation_item->ID . ' ' . $prestation_item->name
			// 	 . "\n"
			// );

		}

		// if(isset($_REQUEST['lodgify_sync_now']) && $_REQUEST['lodgify_sync_now'] == true) {
		// $orders = wc_get_orders( array(
		// 'limit'        => -1, // Query all orders
		// 'orderby'      => 'date',
		// 'order'        => 'ASC',
		// 'meta_key'     => 'prestation_id', // The postmeta key field
		// 'meta_compare' => 'NOT EXISTS', // The comparison argument
		// ));
		// error_log("found " . count($orders) . " order(s) without prestation");
		// foreach ($orders as $key => $order) {
		// $order_post = get_post($order->get_id());
		// self::update_order_prestation($order_post->ID, $order_post, true);
		// }
		// }
	}

}

$this->modules[] = new Mltp_Lodgify();
