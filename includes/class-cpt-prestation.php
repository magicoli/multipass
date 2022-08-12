<?php

/**
 * Register all actions and filters for the plugin
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    W4OS
 * @subpackage W4OS/includes
 */

/**
 * Register all actions and filters for the plugin.
 *
 * Maintain a list of all hooks that are registered throughout
 * the plugin, and register them with the WordPress API. Call the
 * run function to execute the list of actions and filters.
 *
 * @package    W4OS
 * @subpackage W4OS/includes
 * @author     Your Name <email@example.com>
 */
class Prestations_Prestation {

	/**
	 * The array of actions registered with WordPress.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      array    $actions    The actions registered with WordPress to fire when the plugin loads.
	 */
	protected $actions;

	/**
	 * The array of filters registered with WordPress.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      array    $filters    The filters registered with WordPress to fire when the plugin loads.
	 */
	protected $filters;

	/**
	 * Initialize the collections used to maintain the actions and filters.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {

		$this->actions = array();
		$this->filters = array();

	}

	/**
	 * Add a new action to the collection to be registered with WordPress.
	 *
	 * @since    1.0.0
	 * @param    string               $hook             The name of the WordPress action that is being registered.
	 * @param    object               $component        A reference to the instance of the object on which the action is defined.
	 * @param    string               $callback         The name of the function definition on the $component.
	 * @param    int                  $priority         Optional. The priority at which the function should be fired. Default is 10.
	 * @param    int                  $accepted_args    Optional. The number of arguments that should be passed to the $callback. Default is 1.
	 */
	public function add_action( $hook, $component, $callback, $priority = 10, $accepted_args = 1 ) {
		$this->actions = $this->add( $this->actions, $hook, $component, $callback, $priority, $accepted_args );
	}

	/**
	 * Add a new filter to the collection to be registered with WordPress.
	 *
	 * @since    1.0.0
	 * @param    string               $hook             The name of the WordPress filter that is being registered.
	 * @param    object               $component        A reference to the instance of the object on which the filter is defined.
	 * @param    string               $callback         The name of the function definition on the $component.
	 * @param    int                  $priority         Optional. The priority at which the function should be fired. Default is 10.
	 * @param    int                  $accepted_args    Optional. The number of arguments that should be passed to the $callback. Default is 1
	 */
	public function add_filter( $hook, $component, $callback, $priority = 10, $accepted_args = 1 ) {
		$this->filters = $this->add( $this->filters, $hook, $component, $callback, $priority, $accepted_args );
	}

	/**
	 * A utility function that is used to register the actions and hooks into a single
	 * collection.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @param    array                $hooks            The collection of hooks that is being registered (that is, actions or filters).
	 * @param    string               $hook             The name of the WordPress filter that is being registered.
	 * @param    object               $component        A reference to the instance of the object on which the filter is defined.
	 * @param    string               $callback         The name of the function definition on the $component.
	 * @param    int                  $priority         The priority at which the function should be fired.
	 * @param    int                  $accepted_args    The number of arguments that should be passed to the $callback.
	 * @return   array                                  The collection of actions and filters registered with WordPress.
	 */
	private function add( $hooks, $hook, $component, $callback, $priority, $accepted_args ) {

		$hooks[] = array(
			'hook'          => $hook,
			'component'     => $component,
			'callback'      => $callback,
			'priority'      => $priority,
			'accepted_args' => $accepted_args
		);

		return $hooks;

	}

	/**
	 * Register the filters and actions with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {

		$actions = array(
			array(
				'hook' => 'init',
				'callback' => 'register_post_types',
			),
			array(
				'hook' => 'init',
				'callback' => 'register_taxonomies',
			),
			// array(
			// 	'hook' => 'mb_relationships_init',
			// 	'callback' => 'register_relationships',
			// 	'priority' => 20,
			// ),
		);
		// add_action( 'init', 'register_taxonomies' );

		$filters = array(
			array(
				'hook' => 'rwmb_meta_boxes',
				'callback' => 'register_fields'
			),
			array(
				'hook' => 'term_link',
				'callback' => 'term_link_filter',
				'accepted_args' => 3,
			),
		);

		foreach ( $filters as $hook ) {
			(empty($hook['component'])) && $hook['component'] = __CLASS__;
			(empty($hook['priority'])) && $hook['priority'] = 10;
			(empty($hook['accepted_args'])) && $hook['accepted_args'] = 1;
			add_filter( $hook['hook'], array( $hook['component'], $hook['callback'] ), $hook['priority'], $hook['accepted_args'] );
		}

		foreach ( $actions as $hook ) {
			(empty($hook['component'])) && $hook['component'] = __CLASS__;
			(empty($hook['priority'])) && $hook['priority'] = 10;
			(empty($hook['accepted_args'])) && $hook['accepted_args'] = 1;
			add_action( $hook['hook'], array( $hook['component'], $hook['callback'] ), $hook['priority'], $hook['accepted_args'] );
		}

	}

	static function register_post_types() {
		$labels = [
			'name'                     => esc_html__( 'Prestations', 'prestations' ),
			'singular_name'            => esc_html__( 'Prestation', 'prestations' ),
			'add_new'                  => esc_html__( 'Add New', 'prestations' ),
			'add_new_item'             => esc_html__( 'Add new prestation', 'prestations' ),
			'edit_item'                => esc_html__( 'Edit Prestation', 'prestations' ),
			'new_item'                 => esc_html__( 'New Prestation', 'prestations' ),
			'view_item'                => esc_html__( 'View Prestation', 'prestations' ),
			'view_items'               => esc_html__( 'View Prestations', 'prestations' ),
			'search_items'             => esc_html__( 'Search Prestations', 'prestations' ),
			'not_found'                => esc_html__( 'No prestations found', 'prestations' ),
			'not_found_in_trash'       => esc_html__( 'No prestations found in Trash', 'prestations' ),
			'parent_item_colon'        => esc_html__( 'Parent Prestation:', 'prestations' ),
			'all_items'                => esc_html__( 'All Prestations', 'prestations' ),
			'archives'                 => esc_html__( 'Prestation Archives', 'prestations' ),
			'attributes'               => esc_html__( 'Prestation Attributes', 'prestations' ),
			'insert_into_item'         => esc_html__( 'Insert into prestation', 'prestations' ),
			'uploaded_to_this_item'    => esc_html__( 'Uploaded to this prestation', 'prestations' ),
			'featured_image'           => esc_html__( 'Featured image', 'prestations' ),
			'set_featured_image'       => esc_html__( 'Set featured image', 'prestations' ),
			'remove_featured_image'    => esc_html__( 'Remove featured image', 'prestations' ),
			'use_featured_image'       => esc_html__( 'Use as featured image', 'prestations' ),
			'menu_name'                => esc_html__( 'Prestations', 'prestations' ),
			'filter_items_list'        => esc_html__( 'Filter prestations list', 'prestations' ),
			'filter_by_date'           => esc_html__( '', 'prestations' ),
			'items_list_navigation'    => esc_html__( 'Prestations list navigation', 'prestations' ),
			'items_list'               => esc_html__( 'Prestations list', 'prestations' ),
			'item_published'           => esc_html__( 'Prestation published', 'prestations' ),
			'item_published_privately' => esc_html__( 'Prestation published privately', 'prestations' ),
			'item_reverted_to_draft'   => esc_html__( 'Prestation reverted to draft', 'prestations' ),
			'item_scheduled'           => esc_html__( 'Prestation scheduled', 'prestations' ),
			'item_updated'             => esc_html__( 'Prestation updated', 'prestations' ),
			'text_domain'              => esc_html__( 'prestations', 'prestations' ),
		];
		$args = [
			'label'               => esc_html__( 'Prestations', 'prestations' ),
			'labels'              => $labels,
			'description'         => '',
			'public'              => false,
			'hierarchical'        => false,
			'exclude_from_search' => true,
			'publicly_queryable'  => false,
			'show_ui'             => true,
			'show_in_nav_menus'   => true,
			'show_in_admin_bar'   => true,
			'show_in_rest'        => true,
			'query_var'           => true,
			'can_export'          => true,
			'delete_with_user'    => true,
			'has_archive'         => true,
			'rest_base'           => '',
			'show_in_menu'        => true,
			'menu_position'       => NULL,
			'menu_icon'           => 'dashicons-book-alt',
			'capability_type'     => 'post',
			'supports'            => ['revisions', 'title'],
			'taxonomies'          => [],
			'rewrite'             => [
				'with_front' => false,
			],
		];

		register_post_type( 'prestation', $args );
	}

	static function register_fields( $meta_boxes ) {
		$prefix = 'prestation_';

		$meta_boxes[] = [
			'title'      => __( 'Prestations', 'prestations' ),
			'id'         => 'prestations',
			'post_types' => ['prestation'],
			'context'    => 'after_title',
			'style'      => 'seamless',
			'autosave'   => true,
			'fields'     => [
				[
					'name'          => __( 'Customer', 'prestations' ),
					'id'            => $prefix . 'customer',
					'type'          => 'user',
					'field_type'    => 'select_advanced',
					'admin_columns' => [
						'position'   => 'after title',
						'sort'       => true,
						'searchable' => true,
					],
				],
				[
					'name'          => __( 'Customer name', 'prestations' ),
					'id'            => $prefix . 'customer_name',
					'type'          => 'text',
					'admin_columns' => [
						'position'   => 'after prestation_customer',
						'sort'       => true,
						'searchable' => true,
					],
					'visible'       => [
						'when'     => [['customer', '=', '']],
						'relation' => 'or',
					],
				],
				[
					'name'    => __( 'Customer Email', 'prestations' ),
					'id'      => $prefix . 'customer_email',
					'type'    => 'email',
					'visible' => [
						'when'     => [['customer', '=', '']],
						'relation' => 'or',
					],
				],
				[
						'name'          => __( 'From', 'prestations' ),
						'id'            => $prefix . 'date_from',
						'type'          => 'date',
						'admin_columns' => [
								'position' => 'replace date',
								'sort'     => true,
						],
				],
				[
						'name'          => __( 'To', 'prestations' ),
						'id'            => $prefix . 'date_to',
						'type'          => 'date',
						'admin_columns' => [
								'position' => 'after prestation_date_from',
								'sort'     => true,
						],
				],
				[
					'name'          => __( 'Orders', 'prestations' ),
					'id'            => $prefix . 'orders',
					'type'          => 'post',
					'post_type'     => ['shop_order'],
					'field_type'    => 'select_advanced',
					'multiple'      => true,
					'placeholder'   => __( 'Select an order', 'prestations' ),
					'admin_columns' => 'after prestation_customer_name',
				],
			],
		];

		$prefix = 'prestation_';
		$meta_boxes[] = [
			'title'      => __( 'Prestation Items', 'prestations' ),
			'id'         => 'prestation-items',
			'post_types' => ['prestation'],
			'fields'     => [
				[
					'id'     => $prefix . 'item',
					'type'   => 'group',
					'clone'  => true,
					'fields' => [
						[
							'name'    => __( 'Reference', 'prestations' ),
							'id'      => $prefix . 'item_id',
							'type'    => 'select_advanced',
							'columns' => 2,
							'options' => self::get_available_items(),
						],
						[
							'name'    => __( 'Additional details', 'prestations' ),
							'id'      => $prefix . 'details',
							'type'    => 'text',
							'columns' => 4,
						],
						[
							'name'    => __( 'Quantity', 'prestations' ),
							'id'      => $prefix . 'quantity',
							'type'    => 'number',
							'columns' => 1,
						],
						[
							'name'    => __( 'Price', 'prestations' ),
							'id'      => $prefix . 'price',
							'type'    => 'number',
							'columns' => 2,
						],
					],
				],
			],
		];

		$prefix = 'prestation_';
		$meta_boxes[] = [
			'title'      => __( 'Payments', 'prestations' ),
			'id'         => 'prestation-payments',
			'post_types' => ['prestation'],
			'fields'     => [
				[
					'id'     => $prefix . 'payment',
					'type'   => 'group',
					'clone'  => true,
					'fields' => [
						[
							'name'    => __( 'Payment ID', 'prestations' ),
							'id'      => $prefix . 'payment_id',
							'type'    => 'select_advanced',
							'options' => self::get_available_payments(),
							'columns' => 2,
						],
						[
							'name'    => __( 'Type', 'prestations' ),
							'id'      => $prefix . 'type',
							'type'    => 'select',
							'options' => [
								'cash'        => __( 'Cash', 'prestations' ),
								'wire'        => __( 'Wire Transfer', 'prestations' ),
								'order'       => __( 'WooCommerce Order', 'prestations' ),
								'hbook'       => __( 'HBook Order', 'prestations' ),
								'booking_com' => __( 'Booking.com', 'prestations' ),
								'airbnb'      => __( 'Airbnb', 'prestations' ),
							],
							'columns' => 2,
						],
						[
							'name'    => __( 'Reference', 'prestations' ),
							'id'      => $prefix . 'reference',
							'type'    => 'text',
							'columns' => 3,
						],
						[
							'name'    => __( 'Amount', 'prestations' ),
							'id'      => $prefix . 'amount',
							'type'    => 'number',
							'columns' => 2,
						],
					],
				],
			],
		];

		$prefix = 'prestation_balance_';
		$meta_boxes[] = [
			'title'      => __( 'Balance', 'prestations' ),
			'id'         => 'prestation-balance',
			'post_types' => ['prestation'],
			'context'    => 'side',
			'fields'     => [
				[
					'name'           => __( 'Status', 'prestations' ),
					'id'             => 'prestation_status',
					'type'           => 'taxonomy',
					'taxonomy'       => ['prestation-status'],
					'field_type'     => 'select',
					// 'disabled' => true,
					'readonly' => true,
					// 'save_field' => false,
					// 'placeholder' => ' ',
					'remove_default' => true,
					'admin_columns'  => [
						'position' => 'after prestation_date_to',
						// 'sort'       => true,
						'filterable' => true,
					],
				],
				[
					'name'          => __( 'Total', 'prestations' ),
					'id'            => $prefix . 'total',
					'type'          => 'custom_html',
					'callback'      => 'Prestations_Prestation::get_balance_total',
				],
				[
					'name'     => __( 'Deposit %', 'prestations' ),
					'id'       => $prefix . 'deposit_percent',
					'type'     => 'custom_html',
					'callback' => 'Prestations_Prestation::get_balance_deposit_percent',
				],
				[
					'name'     => __( 'Deposit', 'prestations' ),
					'id'       => $prefix . 'deposit',
					'type'     => 'custom_html',
					'callback' => 'Prestations_Prestation::get_balance_deposit',
				],
				[
					'name'          => __( 'Paid', 'prestations' ),
					'id'            => $prefix . 'paid',
					'type'          => 'custom_html',
					'callback'      => 'Prestations_Prestation::get_balance_paid',
					'admin_columns' => 'after prestation_balance_total',
				],
				[
					'name'          => __( 'Due', 'prestations' ),
					'id'            => $prefix . 'due',
					'type'          => 'custom_html',
					'callback'      => 'Prestations_Prestation::get_balance_due',
					'admin_columns' => 'after prestation_balance_paid',
				],
			],
		];

		return $meta_boxes;
	}

	// static function register_relationships() {
	// 	MB_Relationships_API::register( [
	// 		'id'   => 'prestations-orders',
	// 		'from' => [
	// 			'object_type'  => 'post',
	// 			'post_type'    => 'prestation',
	// 			'admin_column' => [
	// 				'position' => 'after title',
	// 				'link'     => 'view',
	// 			],
	// 			'meta_box'     => [
	// 				'title'    => 'Bookings',
	// 				'context'  => 'normal',
	// 				'priority' => 'high',
	// 				// 'style'    => 'seamless',
	// 			],
	// 			'field'        => [
	// 				'max_clone' => '1',
	// 			],
	// 		],
	// 		'to'   => [
	// 			'object_type'  => 'post',
	// 			'post_type'    => 'wc_booking',
	// 			// 'admin_column' => [
	// 			// 	'position' => 'replace title',
	// 			// 	'link'     => 'edit',
	// 			// ],
	// 			'meta_box'     => [
	// 				'title' => 'Prestation',
	// 				// 'style' => 'seamless',
	// 			],
	// 		],
	// 	]);
	// }

	static function register_taxonomies() {
		$labels = [
			'name'                       => esc_html__( 'Prestation statuses', 'prestations' ),
			'singular_name'              => esc_html__( 'Prestation status', 'prestations' ),
			'menu_name'                  => esc_html__( 'Prestation statuses', 'prestations' ),
			'search_items'               => esc_html__( 'Search Prestation statuses', 'prestations' ),
			'popular_items'              => esc_html__( 'Popular Prestation statuses', 'prestations' ),
			'all_items'                  => esc_html__( 'All Prestation statuses', 'prestations' ),
			'parent_item'                => esc_html__( 'Parent Prestation status', 'prestations' ),
			'parent_item_colon'          => esc_html__( 'Parent Prestation status', 'prestations' ),
			'edit_item'                  => esc_html__( 'Edit Prestation status', 'prestations' ),
			'view_item'                  => esc_html__( 'View Prestation status', 'prestations' ),
			'update_item'                => esc_html__( 'Update Prestation status', 'prestations' ),
			'add_new_item'               => esc_html__( 'Add new prestation status', 'prestations' ),
			'new_item_name'              => esc_html__( 'New prestation status name', 'prestations' ),
			'separate_items_with_commas' => esc_html__( 'Separate prestation statuses with commas', 'prestations' ),
			'add_or_remove_items'        => esc_html__( 'Add or remove prestation statuses', 'prestations' ),
			'choose_from_most_used'      => esc_html__( 'Choose most used prestation statuses', 'prestations' ),
			'not_found'                  => esc_html__( 'No prestation statuses found', 'prestations' ),
			'no_terms'                   => esc_html__( 'No Prestation statuses', 'prestations' ),
			'filter_by_item'             => esc_html__( 'Filter by prestation status', 'prestations' ),
			'items_list_navigation'      => esc_html__( 'Prestation statuses list pagination', 'prestations' ),
			'items_list'                 => esc_html__( 'Prestation statuses list', 'prestations' ),
			'most_used'                  => esc_html__( 'Most Used', 'prestations' ),
			'back_to_items'              => esc_html__( 'Back to prestation statuses', 'prestations' ),
			'text_domain'                => 'prestations',
		];
		$args = [
			'label'              => esc_html__( 'Prestation statuses', 'prestations' ),
			'labels'             => $labels,
			'description'        => '',
			'public'             => false,
			'publicly_queryable' => false,
			'hierarchical'       => false,
			'show_ui'            => true,
			'show_in_menu'       => false,
			'show_in_nav_menus'  => false,
			'show_in_rest'       => true,
			'show_tagcloud'      => false,
			'show_in_quick_edit' => false,
			'show_admin_column'  => false,

			'query_var'          => true,
			'sort'               => false,
			'meta_box_cb'        => 'post_tags_meta_box',
			'rest_base'          => '',
			'rewrite'            => [
				'with_front'   => false,
				'hierarchical' => false,
			],
		];
		register_taxonomy( 'prestation-status', ['prestation'], $args );
	}

	static function get_available_items() {
		return [];
	}

	static function get_available_payments() {
		return [];
	}

	static function get_balance_total($args = []) {
		global $post;
		$amount = 0;
		error_log(__FUNCTION__ . ' ' . print_r($post, true));
		return wc_price($amount);
	}

	static function get_balance_deposit($args = []) {
		global $post;
		$amount = 0;
		return wc_price($amount);
	}

	static function get_balance_paid($args = []) {
		global $post;
		$amount = 0;
		return wc_price($amount);
	}

	static function get_balance_due($args = []) {
		global $post;
		$amount = 0;
		return wc_price($amount);
	}

	static function get_balance_deposit_percent($args = []) {
		global $post;
		$percent = 0;
		error_log(__FUNCTION__ . ' ' . print_r($post, true));
		return number_format_i18n($number, 2) . '%';
	}

	static function term_link_filter ( $termlink, $term, $taxonomy ) {
		if ( 'prestation-status' === $taxonomy ) {
			return add_query_arg( array(
				'prestation-status' => $term->slug,
			), admin_url(sprintf(basename($_SERVER['REQUEST_URI']))) );
		}
		return $termlink;
	}

}
