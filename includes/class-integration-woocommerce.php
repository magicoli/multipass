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
				'hook' => 'save_post_shop_order',
				'callback' => 'set_or_create_prestation',
				'accepted_args' => 3,
			),
			// array(
			// 	'hook' => 'init',
			// 	'callback' => 'self::background_process',
			// ),
		);

		$this->filters = array(
			array(
				'hook' => 'rwmb_meta_boxes',
				'callback' => 'register_fields'
			),
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

			array(
				'hook' => 'manage_prestation_posts_custom_column',
				'callback' => 'prestations_columns_display',
				'accepted_args' => 2,
			),
			array(
				'hook' => 'manage_shop_order_posts_custom_column',
				'callback' => 'shop_orders_columns_display',
				'accepted_args' => 2,
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

	static function register_fields( $meta_boxes ) {
		$prefix = 'prestation_';

		$meta_boxes[] = [
			'title'      => __( 'Prestation', 'prestations' ),
			'id'         => 'prestation-woocommerce-order',
			'post_types' => ['shop_order'],
			'context'    => 'side',
			'fields'     => [
				[
					// 'name'       => __( 'Prestation', 'prestations' ),
					'id'         => $prefix . 'id',
					'type'       => 'post',
					'post_type'  => ['prestation'],
					'field_type' => 'select_advanced',
				],
			],
		];

		return $meta_boxes;
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

	/**
	 * Tweak to force add shop order columns, which should be added by mb_relationships_init but aren't
	 */
	static function add_shop_order_columns( $columns ){
		foreach($columns as $key => $value) {
			$updated_columns[$key] = $value;
			if($key == 'order_number') {
				$updated_columns['prestation'] = __('Prestation', 'prestations');
			}
		}
		if(isset($updated_columns)) $columns = $updated_columns;
		return $columns;
	}

	static function get_related_links($post_id, $relation_id, $direction) {
		if( empty($post_id) || empty($relation_id) ) return [];
		$related = [];

		return $related;
	}

	static function prestations_columns_display( $column, $post_id ) {
		switch($column) {
			case 'wc-order-prestation_to':
			$related = self::get_related_links($post_id, 'wc-order-prestation', 'from');
			echo 'O ' . join(' ', $related);
			break;
		}
	}

	static function shop_orders_columns_display( $column, $post_id ) {
		switch($column) {
			case 'prestation':
			$prestation_id = get_post_meta($post_id, 'prestation_id', true);
			if(!empty($prestation_id)) {
				echo sprintf(
					'<a href="%s">#%s</a>',
					get_edit_post_link($prestation_id),
					get_post_field( 'post_name', $prestation_id),
				);
			}
			break;
		}
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

	static function set_or_create_prestation($post_id, $post, $update ) {
		if( !$update ) return;
		if( Prestations::is_new_post() ) return; // new posts are empty
		if( $post->post_type != 'shop_order' ) return;
		if( isset($_REQUEST['action']) && $_REQUEST['action'] == 'trash' ) return;

		// $loop = new WP_Query( [
		// 	'relationship' => [
		// 		'id'   => 'posts_to_pages',
		// 		'from' => get_the_ID(), // You can pass object ID or full object
		// 	],
		// 	'nopaging'     => true,
		// ]);
		// while ( $loop->have_posts() ) : $loop->the_post() {
		// 	echo sprintf(
		// 		'<a href="%s">%s</a>',
		// 		the_permalink(),
		// 		the_title(),
		// 	);
		// }
		// wp_reset_postdata();

		// error_log(print_r($post, true));

		return;
	}

}
