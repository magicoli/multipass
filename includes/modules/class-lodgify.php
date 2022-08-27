<?php

/**
 * Register all actions and filters for the plugin
 *
 * @link       http://example.com
 * @since      0.1.0
 *
 * @package    Prestations
 * @subpackage Prestations/includes
 */

/**
 * Register all actions and filters for the plugin.
 *
 * Maintain a list of all hooks that are registered throughout
 * the plugin, and register them with the WordPress API. Call the
 * run function to execute the list of actions and filters.
 *
 * @package    Prestations
 * @subpackage Prestations/includes
 * @author     Your Name <email@example.com>
 */
class Prestations_Lodgify extends Prestations_Modules {

	protected $api_url;
	protected $api_key;

	/**
	 * Initialize the collections used to maintain the actions and filters.
	 *
	 * @since    0.1.0
	 */
	public function __construct() {
		$this->api_url = 'https://api.lodgify.com';
		$this->api_key = Prestations::get_option('lodgify_api_key');

		$this->locale = $this->get_locale();

		// register_activation_hook( PRESTATIONS_FILE, __CLASS__ . '::activate' );
		// register_deactivation_hook( PRESTATIONS_FILE, __CLASS__ . '::deactivate' );
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
		$settings_pages['prestations']['tabs']['lodgify'] = 'Lodgify';

		return $settings_pages;
	}

	static function register_fields( $meta_boxes ) {
		$prefix = 'lodgify_';
		$lodgify = new Prestations_Lodgify();

		// Lodify Settings tab
    $meta_boxes[] = [
        'title'          => __( 'Lodgify Settings', 'prestations' ),
        'id'             => 'lodgify-settings',
        'settings_pages' => ['prestations'],
        'tab'            => 'lodgify',
        'fields'         => [
            [
                'name' => __( 'API Key', 'prestations' ),
                'id'   => $prefix . 'api_key',
                'type' => 'text',
								'sanitize_callback' => __CLASS__ . '::api_key_validation',
            ],
						[
							'name'              => __( 'Sync bookings', 'prestations' ),
							'id'                => $prefix . 'sync_bookings',
							'type'              => 'switch',
							'desc'              => __( 'Sync Lodgify bookings with prestations, create prestation if none exist. Only useful after plugin activation or if out of sync.', 'prestations' ),
							'style'             => 'rounded',
							'sanitize_callback' => 'Prestations_Lodgify::sync_bookings',
							'save_field' => false,
							'visible' => [
									'when'     => [['api_key', '!=', '']],
									'relation' => 'or',
							],
						],
        ],
    ];

		$meta_boxes['associations']['fields'][] = [
			'name'       => __( 'Lodgify Property', 'prestations' ),
			'id'         => 'association_lodgify_id',
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

	function get_properties() {
		$transient_key = sanitize_title(__CLASS__ . '-' . __FUNCTION__);
		$properties = get_transient($transient_key);
		if($properties) return $properties;

		$results = $this->api_request('/v1/properties', array());
		if(is_wp_error($results)) {
			$message = sprintf(__('Get properties failed (%s).', 'prestations') , $results->get_error_message(),);
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

		$lodgify = new Prestations_Lodgify();
		$lodgify->api_key = $value;

		$result = $lodgify->api_request('/v1/properties', array());

		if(is_wp_error($result)) {
			$message = sprintf(
				__('API Key verification failed (%s).', 'prestations') ,
				$result->get_error_message(),
			);
			add_settings_error( $field['id'], $field['id'], $message, 'error' );
			return false;
		}

		return $value;
	}
}

$this->modules[] = new Prestations_Lodgify();
