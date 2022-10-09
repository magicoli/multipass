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
 * @author     Magiiic <info@magiiic.com>
 */
class Mltp_HBook extends Mltp_Modules {

	/**
	 * The array of actions registered with WordPress.
	 *
	 * @since    0.1.0
	 * @access   protected
	 * @var      array    $actions    The actions registered with WordPress to fire when the plugin loads.
	 */
	protected $actions;

	/**
	 * The array of filters registered with WordPress.
	 *
	 * @since    0.1.0
	 * @access   protected
	 * @var      array    $filters    The filters registered with WordPress to fire when the plugin loads.
	 */
	protected $filters;

	/**
	 * Initialize the collections used to maintain the actions and filters.
	 *
	 * @since    0.1.0
	 */
	public function __construct() {
		// register_activation_hook( MULTIPASS_FILE, __CLASS__ . '::activate' );
		// register_deactivation_hook( MULTIPASS_FILE, __CLASS__ . '::deactivate' );
	}

	/**
	 * Register the filters and actions with WordPress.
	 *
	 * @since    0.1.0
	 */
	public function init() {

		$this->actions = array();

		$this->filters = array(
			array(
				'component' => $this,
				'hook'      => 'mb_settings_pages',
				'callback'  => 'register_settings_pages',
			),
			array(
				'component' => $this,
				'hook'      => 'rwmb_meta_boxes',
				'callback'  => 'register_settings_fields',
			),
			array(
				'component' => $this,
				'hook'      => 'rwmb_meta_boxes',
				'callback'  => 'register_fields',
			),

			array(
				'hook'     => 'multipass_register_terms_mltp_detail-source',
				'callback' => 'register_sources_filter',
			),
		);

		$defaults = array(
			'component'     => __CLASS__,
			'priority'      => 10,
			'accepted_args' => 1,
		);

		foreach ( $this->filters as $hook ) {
			$hook = array_merge( $defaults, $hook );
			add_filter( $hook['hook'], array( $hook['component'], $hook['callback'] ), $hook['priority'], $hook['accepted_args'] );
		}

		foreach ( $this->actions as $hook ) {
			$hook = array_merge( $defaults, $hook );
			add_action( $hook['hook'], array( $hook['component'], $hook['callback'] ), $hook['priority'], $hook['accepted_args'] );
		}

	}

	function register_settings_pages( $settings_pages ) {
		$settings_pages['multipass-settings']['tabs']['hbook'] = 'HBook';
		// error_log(__CLASS__ . ' tabs ' . print_r($settings_pages['multipass-settings']['tabs'], true));

		return $settings_pages;
	}

	function register_settings_fields( $meta_boxes ) {
		$prefix = 'hbook_';

		$meta_boxes[] = array(
			'title'          => __( 'HBook Settings', 'multipass' ),
			'id'             => 'hbook-settings',
			'settings_pages' => array( 'multipass-settings' ),
			'tab'            => 'hbook',
			'fields'         => array(
				array(
					'name'              => __( 'Synchronize now', 'multipass' ),
					'id'                => $prefix . 'sync_bookings',
					'type'              => 'switch',
					'desc'              => __( 'Sync HBook bookings with prestations, create prestation if none exist. Only useful after plugin activation or if out of sync.', 'multipass' ),
					'style'             => 'rounded',
					'sanitize_callback' => 'Mltp_HBook::sync_bookings',
					'save_field'        => false,
				),
			),
		);

		return $meta_boxes;
	}

	function register_fields( $meta_boxes ) {
		$prefix = 'hbook_';
		// $hbook  = new Mltp_HBook();

		$meta_boxes['resources']['fields'][] = array(
			'name'          => __( 'HBook Accommodations', 'multipass' ),
			'id'            => 'resource_hbook_id',
			'type'          => 'select_advanced',
			'options'       => $this->get_property_options(),
			'placeholder'   => __( 'Select an accommodation', 'multipass' ),
			'admin_columns' => array(
				'position'   => 'before date',
				'sort'       => true,
				'searchable' => true,
			),
			'columns'       => 3,
		);

		return $meta_boxes;
	}

	static function register_sources_filter( $sources ) {
		$sources['hbook'] = 'HBook';
		return $sources;
	}

	function get_properties() {
		$transient_key = sanitize_title( __CLASS__ . '-' . __FUNCTION__ );
		$properties    = get_transient( $transient_key );
		if ( $properties ) {
			return $properties;
		}

		$properties = wp_cache_get( $transient_key );
		if ( $properties ) {
			return $properties;
		}

		global $wpdb;

		$posts      = get_posts(
			array(
				'numberposts' => -1,
				'post_type'   => 'hb_accommodation',
				'post_status' => 'publish',
				'orderby'     => 'name',
			)
		);
		$properties = array();
		foreach ( $posts as $key => $post ) {
			if ( preg_match( '/"translated/', $post->post_content ) ) {
				continue;
			}
			// error_log("property $post->ID $post->post_title");

			$table   = $wpdb->prefix . 'hb_accom_num_name';
			$sql     = "SELECT * FROM $table WHERE accom_id = $post->ID AND num_name != '1' AND num_name != ''";
			$results = $wpdb->get_results( $sql );
			if ( $results ) {
				// error_log("$sql result " . print_r($results, true));
				foreach ( $results as $result ) {
					$key                = $result->accom_id . '-' . $result->accom_num;
					$properties[ $key ] = $result;
				}
			}

			// $properties[$post->ID] = $post;
		}
		// error_log('fetching properties ' . print_r($properties, true));

		wp_cache_set( $transient_key, $properties );
		// set_transient($transient_key, $properties, 3600);
		return $properties;
	}

	function get_property_options() {
		$options    = array();
		$properties = $this->get_properties();
		if ( $properties ) {
			foreach ( $properties as $id => $property ) {
				$options[ $id ] = $property->num_name;
			}
		}
		return $options;
	}
}

$this->modules[] = new Mltp_HBook();
