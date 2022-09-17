<?php

/**
 * Register all actions and filters for the plugin
 *
 * @link       http://example.com
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
		$this->api_key = MultiPass::get_option('lodgify_api_key');

		$this->locale = $this->get_locale();

		// register_activation_hook( MULTIPASS_FILE, __CLASS__ . '::activate' );
		// register_deactivation_hook( MULTIPASS_FILE, __CLASS__ . '::deactivate' );
	}

	/**
	 * Register the filters and actions with WordPress.
	 *
	 * @since    0.1.0
	 */
	public function run() {

		$this->actions = array(
		);

		$this->filters = array(
			array (
				'hook' => 'mb_settings_pages',
				'callback' => 'register_settings_pages',
			),
			array(
				'hook' => 'rwmb_meta_boxes',
				'callback' => 'register_fields'
			),

			array(
				'hook' => 'multipass_register_terms_prestation-item-source',
				'callback' => 'register_sources_filter',
			),
		);

		$defaults = array( 'component' => __CLASS__, 'priority' => 10, 'accepted_args' => 1 );

		foreach ( $this->filters as $hook ) {
			$hook = array_merge($defaults, $hook);
			add_filter( $hook['hook'], array( $hook['component'], $hook['callback'] ), $hook['priority'], $hook['accepted_args'] );
		}

		foreach ( $this->actions as $hook ) {
			$hook = array_merge($defaults, $hook);
			add_action( $hook['hook'], array( $hook['component'], $hook['callback'] ), $hook['priority'], $hook['accepted_args'] );
		}

	}

	static function register_settings_pages( $settings_pages ) {
		$settings_pages['multipass']['tabs']['lodgify'] = 'Lodgify';

		return $settings_pages;
	}

	static function register_fields( $meta_boxes ) {
		$prefix = 'lodgify_';
		$lodgify = new Mltp_Lodgify();

		// Lodify Settings tab
    $meta_boxes[] = [
        'title'          => __('Lodgify Settings', 'multipass' ),
        'id'             => 'lodgify-settings',
        'settings_pages' => ['multipass'],
        'tab'            => 'lodgify',
        'fields'         => [
            [
                'name' => __('API Key', 'multipass' ),
                'id'   => $prefix . 'api_key',
                'type' => 'text',
								'sanitize_callback' => __CLASS__ . '::api_key_validation',
            ],
						[
							'id' => $prefix . 'api_key_required',
							'save_field' => false,
							'type' => 'custom_html',
							'std' => sprintf(
								'%s <a href="%s" target="_blank">%s</a>',
								__('An API key is required to connect to Lodgify.', 'multipass'),
								'https://app.lodgify.com/#/reservation/settings/publicApiToken',
								__('Get your API key from Logdify Settings page > Public API', 'multipass'),
							),
							'visible' => ['api_key', '=', ''],
						],
						[
							'name'              => __('Synchronize now', 'multipass' ),
							'id'                => $prefix . 'sync_bookings',
							'type'              => 'switch',
							'desc'              => __('Sync Lodgify bookings with prestations, create prestation if none exist. Only useful after plugin activation or if out of sync.', 'multipass' ),
							'style'             => 'rounded',
							'sanitize_callback' => 'Mltp_Lodgify::sync_bookings',
							'save_field' => false,
							'visible' => [
									'when'     => [['api_key', '!=', '']],
									'relation' => 'or',
							],
						],
        ],
    ];

		$meta_boxes['services']['fields'][] = [
			'name'       => __('Lodgify Property', 'multipass' ),
			'id'         => 'service_lodgify_id',
			'type'       => 'select_advanced',
			'options'	=> $lodgify->get_property_options(),
			'admin_columns' => [
					'position'   => 'before date',
					'sort'       => true,
					'searchable' => true,
			],
			'columns' => 3,
		];

		return $meta_boxes;
	}

	static function register_sources_filter($sources) {
		$sources['lodgify'] = 'Lodgify';
		return $sources;
	}

	function get_properties() {
		$transient_key = sanitize_title(__CLASS__ . '-' . __FUNCTION__);
		$properties = get_transient($transient_key);
		if($properties) return $properties;

		if(empty($this->api_key)) return [];
		$results = $this->api_request('/v1/properties', array());
		if(is_wp_error($results)) {
			$message = sprintf(
				'%s failed ("%s") for %s',
				__CLASS__ .'::' . __METHOD__,
				$results->get_error_message(),
			 	print_r($this, true),
			);
			error_log($message);
			// add_settings_error( $field['id'], $field['id'], $message, 'error' );
			return [];
		}

		$properties = [];
		foreach ($results as $result) {
			$properties[$result['id']] = $result;
		}

		set_transient($transient_key, $properties, 3600);
		return $properties;
	}

	function get_property_options() {
		$options = [];
		$properties = $this->get_properties();
		if($properties) foreach($properties as $id => $property) {
			$options[$id] = $property['name'];
		}
		return $options;
	}

	function api_request($path, $args = []) {
		$url = $this->api_url . "$path?" . http_build_query($args);
		$options = array(
			// 'method'  => 'GET',
			'timeout' => 10,
			// 'ignore_errors' => true,
			'headers'  => array(
				'X-ApiKey' => $this->api_key,
				'Accept-Language' => $this->locale,
			),
		);
		$response = wp_remote_get( $url, $options );
		if(is_wp_error($response)) {
			return $response;
		} else if ( $response['response']['code'] != 200 ) {
			return new WP_Error ( __FUNCTION__ . '-wrongresponse', 'Response code ' . $response['response']['code'] );
		} else {
			$json_data = json_decode($response['body'], true);
		}

		return $json_data;
	}

	static function api_key_validation($value, $field, $oldvalue) {
		if(empty($value)) return false;
		if($value == $oldvalue) return $value; // we assume it has already been checked

		$lodgify = new Mltp_Lodgify();
		$lodgify->api_key = $value;

		$result = $lodgify->api_request('/v1/properties', array());

		if(is_wp_error($result)) {
			$message = sprintf(
				__('API Key verification failed (%s).', 'multipass' ) ,
				$result->get_error_message(),
			);
			add_settings_error( $field['id'], $field['id'], $message, 'error' );
			return false;
		}

		return $value;
	}

	function get_bookings() {
		$cache_key = sanitize_title(__CLASS__ . '-' . __METHOD__);
		$response = wp_cache_get($cache_key);
		if($response) return $response;

		$args = array(
			// 'size' => 10,
			'includeCount' => 'true',
			'includeTransactions' => 'true',
			// 'includeExternal' => false,
			'includeQuoteDetails' => 'true',
			'stayFilter' => 'Upcoming', // Upcoming (default), Current, Historic, All
		);

		$response = $this->api_request('/v2/reservations/bookings', $args);
		if(is_wp_error($response)) {
			$error_id = sanitize_title(__CLASS__ . '-' . __METHOD__);
			$message = sprintf( __('%s failed (%s).', 'multipass' ) , $error_id, $response->get_error_message() );
			add_settings_error( $error_id, $error_id, $message, 'error' );
			return $response;
		}

		if($response['count'] > count($response['items'])) {
			error_log('missing some, getting them all ' . $response['count']);
			$args['size'] = $response['count'];
			$response = $this->api_request('/v2/reservations/bookings', $args);
			if(is_wp_error($response)) {
				$error_id = sanitize_title(__CLASS__ . '-' . __METHOD__);
				$message = sprintf( __('%s failed (%s).', 'multipass' ) , $error_id, $response->get_error_message() );
				add_settings_error( $error_id, $error_id, $message, 'error' );
				return $response;
			}
		}

		wp_cache_set($cache_key, $response);
		return $response;
	}

	static function bookings_options() {
		$lodgify = new Mltp_Lodgify();
		$options = [];
		$response = $lodgify->get_bookings();
		if(is_wp_error($response)) return false;
		if(!is_array($response['items'])) return false;

		foreach ($response['items'] as $key => $booking) {
			$options[$booking['id']] = sprintf(
				'%s, %sp %s (#%s)',
				$booking['attendee']['name'],
				$booking['rooms'][0]['people'],
				MultiPass::format_date_range(array(
					$booking['arrival'],
					$booking['departure'],
				), true),
				$booking['id'],
			);
		}

		return $options;
	}

	static function sync_bookings($value, $field, $oldvalue) {
		if(!$value) return;

		$lodgify = new Mltp_Lodgify();
		$response = $lodgify->get_bookings();
		if(is_wp_error($response)) return false;
		error_log(__CLASS__ . '::' . __METHOD__ . ' ' . $response['count'] . ' ' . count($response['items']));

		$bookings = $response['items'];
		foreach ($bookings as $key => $booking) {
			error_log("booking $key " . print_r($booking, true));
			break;
		}

		// if(isset($_REQUEST['lodgify_sync_bookings']) && $_REQUEST['lodgify_sync_bookings'] == true) {
		// 	$orders = wc_get_orders( array(
		// 		'limit'        => -1, // Query all orders
		// 		'orderby'      => 'date',
		// 		'order'        => 'ASC',
		// 		// 'meta_key'     => 'prestation_id', // The postmeta key field
		// 		// 'meta_compare' => 'NOT EXISTS', // The comparison argument
		// 	));
		// 	// error_log("found " . count($orders) . " order(s) without prestation");
		// 	foreach ($orders as $key => $order) {
		// 		$order_post = get_post($order->get_id());
		// 		self::update_order_prestation($order_post->ID, $order_post, true);
		// 	}
		// }
	}

}

$this->modules[] = new Mltp_Lodgify();
