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
class Prestations_WooCommerce {

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
		// error_log(__FUNCTION__);
		//
	}

	/**
	 * Register the filters and actions with WordPress.
	 *
	 * @since    0.1.0
	 */
	public function run() {

		$this->actions = array(
			array(
				'hook' => 'mb_relationships_init',
				'callback' => 'self::register_relationships',
			),
			// array(
			// 	'hook' => 'init',
			// 	'callback' => 'self::background_process',
			// ),
		);

		$this->filters = array(
			array (
				'hook' => 'mb_settings_pages',
				'callback' => 'register_settings_pages',
			),
			array(
				'hook' => 'rwmb_meta_boxes',
				'callback' => 'register_settings_fields',
			),
			array(
				'hook' => 'manage_edit-shop_order_columns',
				'callback' => 'add_shop_order_columns',
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
		$settings_pages['prestations']['tabs']['woocommerce'] = 'WooCommerce';

		return $settings_pages;
	}

	static function register_settings_fields( $meta_boxes ) {
		$prefix = 'woocommerce_';

		$meta_boxes['prestations-woocommerce-settings'] = [
			'title'          => __( 'WooCommerce Settings', 'prestations' ),
			'id'             => 'prestations-woocommerce-settings',
			'settings_pages' => ['prestations'],
			'tab'            => 'woocommerce',
			'fields'         => [
			],
		];

		return $meta_boxes;
	}

	function register_relationships() {
		MB_Relationships_API::register( [
			'id'         => 'wc-order-prestation',
			// 'reciprocal' => true, // Only for items of the same type
			'from'       => [
				'object_type'  => 'post',
				'post_type'    => 'shop_order',
				'admin_column' => true,
				'admin_column' => [
					'position' => 'after order_number',
					'link'     => 'edit',
					'searchable' => true,
				],
				'meta_box'     => [
					'title'    => 'Prestation',
					'priority' => 'high',
				],
			],
			'to'         => [
				'object_type'  => 'post',
				'post_type'    => 'prestation',
				'admin_column' => [
					'position' => 'after dates',
					'link'     => 'view',
					'searchable' => true,
				],
				'meta_box'     => [
					'title'   => 'Orders',
					'context' => 'normal',
				],
				'field'        => [
					'max_clone' => '1',
				],
			],
		]);
	}

	/**
	 * Tweak to force add shop order columns, which should be added by mb_relationships_init but aren't
	 */
	static function add_shop_order_columns( $columns ){
		foreach($columns as $key => $value) {
			$updated_columns[$key] = $value;
			if($key == 'order_number') {
				$updated_columns['wc-order-prestation_to'] = __('Prestation', 'prestations');
			}
		}
		if(isset($updated_columns)) $columns = $updated_columns;
		return $columns;
	}

	function background_process() {
		$this->background_queue = new Prestations_WooCommerce_Process();

 		// $action = __CLASS__ . '::fetch_mails';
		// if(get_transient('Prestations_WooCommerce_wait')) return;
		// set_transient('Prestations_WooCommerce_wait', true, 30);
		//
		// if(Prestations::get_option('prestations:email_processing', false))
		// $this->background_queue->push_to_queue(__CLASS__ . '::fetch_mails');
		//
		// $this->background_queue->save()->dispatch();

		// One-off task:
		//
		// $this->background_request = new Prestations_WooCommerce_Request();
		// $this->background_request->data( array( 'value1' => $value1, 'value2' => $value2 ) );
		// $this->background_request->dispatch();
	}

}
