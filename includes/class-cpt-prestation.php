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

			array (
				'hook' => 'save_post_prestation',
				'callback' => 'update_prestation_amounts',
				'accepted_args' => 3,
			),

			array(
				'hook' => 'pre_get_posts',
				'callback' => 'sortable_columns_order',
			),

			// array(
			// 	'hook' => 'mb_relationships_init',
			// 	'callback' => 'register_relationships',
			// 	'priority' => 20,
			// ),
		);

		$filters = array(
			array(
				'hook' => 'rwmb_meta_boxes',
				'callback' => 'register_fields'
			),
			array(
				'hook' => 'wp_insert_post_data',
				'callback' => 'new_post_random_slug',
				'accepted_args' => 2
			),

			array(
				'hook' => 'term_link',
				'callback' => 'term_link_filter',
				'accepted_args' => 3,
			),

			array(
				'hook' => 'manage_prestation_posts_columns',
				'callback' => 'add_admin_columns',
			),
			array(
				'hook' => 'manage_prestation_posts_custom_column',
				'callback' => 'admin_columns_display',
				'priority' => 99,
				'accepted_args' => 2,
			),
			array(
				'hook' => 'manage_edit-prestation_sortable_columns',
				'callback' => 'sortable_columns',
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
			'text_domain'              => 'prestations',
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
			'supports'            => ['revisions' ],
			'taxonomies'          => [],
			'rewrite'             => [
				'with_front' => false,
			],
		];

		register_post_type( 'prestation', $args );
	}

	static function title_html() {
		return preg_replace('/(#[[:alnum:]]+)/', '<code>$1</code>', the_title('<h1>', '</h1>', false));
		// return the_title('<h1>', '</h1>', false);
	}

	static function register_fields( $meta_boxes ) {
		$prefix = '';

		$meta_boxes[] = [
			'title'      => __( 'Prestations', 'prestations' ),
			'id'         => 'prestations',
			'post_types' => ['prestation'],
			'context'    => 'after_title',
			'style'      => 'seamless',
			'autosave'   => true,
			'fields'     => [
				[
					'id'            => $prefix . 'title_html',
					'type'          => 'custom_html',
					'callback' => __CLASS__ . '::title_html',
				],
				[
					'name'          => __( 'Customer', 'prestations' ),
					'id'            => $prefix . 'customer_id',
					'type'          => 'user',
					'field_type'    => 'select_advanced',
					'admin_columns' => [
						'position'   => 'after title',
						'sort'       => true,
						'searchable' => true,
					],
				],
				[
					'name'          => __( 'Guest name', 'prestations' ),
					'id'            => $prefix . 'guest_name',
					'type'          => 'text',
					'description'		=> __('Leave empty if same as customer name', 'prestations'),
				],
				[
					'name'          => __( 'Guest', 'prestations' ),
					'id'            => $prefix . 'display_name',
					'type'          => 'hidden',
					'admin_columns' => [
						'position'   => 'after customer_id',
						'sort'       => true,
						'searchable' => true,
					],
				],
				[
					'name'    => __( 'Customer Email', 'prestations' ),
					'id'      => $prefix . 'customer_email',
					'type'    => 'email',
					'visible' => [
						'when'     => [['customer_id', '=', '']],
						'relation' => 'or',
					],
				],
				[
				  'name'   => __( 'Dates', 'prestations' ),
				  'id'     => $prefix . 'dates',
				  'type'   => 'group',
					'class' => 'inline',
					// 'admin_columns' => [
					// 	'position' => 'replace date',
					// 	'sort'     => true,
					// ],
				  'fields' => [
						[
							'prepend'          => __( 'From', 'prestations' ),
							'id'            => $prefix . 'from',
							'type'          => 'date',
						],
						[
							'prepend'          => __( 'To', 'prestations' ),
							'id'            => $prefix . 'to',
							'type'          => 'date',
						],
					],
				],
				[
				  'name'   => __( 'Discount', 'prestations' ),
				  'id'     => $prefix . 'discount',
				  'type'   => 'group',
					'class' => 'inline',
				  'fields' => [
				    [
				      'id'      => $prefix . 'percent',
				      'type'    => 'number',
				      'min'     => 0,
				      'max'     => 100,
				      'size'    => 5,
				      'prepend' => '%',
				    ],
				    [
				      'id'      => $prefix . 'amount',
				      'type'    => 'number',
				      'min'     => 0,
				      'step'    => 'any',
				      'size'    => 10,
				      'prepend' => get_woocommerce_currency_symbol(),
				      'visible' => [
				        'when'     => [['discount_percent', '=', '']],
				        'relation' => 'or',
				      ],
				    ],
				  ],
				],
				[
					'name'   => __( 'Deposit', 'prestations' ),
					'id'     => $prefix . 'deposit',
					'type'   => 'group',
					'class'	 => 'inline',
					'fields' => [
						[
							'id'      => $prefix . 'percent',
							'type'    => 'number',
							'min'     => 0,
							'max'     => 100,
							'size'    => 5,
							'prepend' => '%',
							'class' => 'percent class',
						],
						[
							'id'      => $prefix . 'amount',
							'type'    => 'number',
							'min'     => 0,
							'step'    => 'any',
							'size'    => 10,
							'prepend' => get_woocommerce_currency_symbol(),
							'class' => 'amount class',
							'visible' => [
								'when'     => [['deposit_percent', '=', '']],
								'relation' => 'or',
							],
						],
						[
								'prepend'          => __( 'Before', 'prestations' ),
								'id'            => $prefix . 'deposit_before',
								'type'          => 'date',
								'visible' => [
									'when'     => [
										['deposit_percent', '!=', ''],
										['deposit_amount', '!=', ''],
									],
									'relation' => 'or',
								],
						],
					],
				],
			],
		];

		// $meta_boxes['prestations-extensions'] = [
		// 	'title'      => __( 'Managed Services', 'prestations' ),
		// 	'id'         => 'prestations-extensions',
		// 	'post_types' => ['prestation'],
		// 	'style' => 'seamless',
		// 	'fields'     => [
		// 	],
		// ];

		$items_list_fields = [
			'items' => [
				'id'     => $prefix . 'items',
				'type'   => 'group',
				'clone'  => true,
				'readonly' => false,
				'class' => 'low-gap',
				'fields' => [
					[
						'name'    => __( 'ID', 'prestations' ),
						'id'      => $prefix . 'item_id',
						'type'    => 'text',
						'readonly' => true,
						'columns' => 1,
						'options' => self::get_available_items(),
					],
					[
						'name'    => __( 'Source', 'prestations' ),
						'id'      => $prefix . 'source',
						'type'    => 'text',
						'readonly' => true,
						'columns' => 1,
					],
					[
						'name'    => __( 'Description', 'prestations' ),
						'id'      => $prefix . 'description',
						'type'    => 'text',
						'columns' => 3,
					],
					[
							'name'          => __( 'From', 'prestations' ),
							'id'            => $prefix . 'from',
							'type'          => 'date',
							'columns' => 1,
					],
					[
							'name'          => __( 'To', 'prestations' ),
							'id'            => $prefix . 'to',
							'type'          => 'date',
							'columns' => 1,
					],
					[
						'name'    => __( 'Quantity', 'prestations' ),
						'id'      => $prefix . 'quantity',
						'type'    => 'number',
						'step' => 'any',
						'columns' => 1,
					],
					[
						'name'    => __( 'Unit Price', 'prestations' ),
						'id'      => $prefix . 'unit_price',
						'type'    => 'number',
						'step' => 'any',
						'columns' => 1,
					],
					[
						'name'    => __( 'Discount', 'prestations' ),
						'id'      => $prefix . 'discount',
						'type'    => 'number',
						'step' => 'any',
						'columns' => 1,
					],
					[
						'name'    => __( 'Price', 'prestations' ),
						'id'      => $prefix . 'price',
						'type'    => 'number',
						'step' => 'any',
						'columns' => 1,
					],
					[
						'name'    => __( 'Paid', 'prestations' ),
						'id'      => $prefix . 'paid',
						'type'    => 'number',
						'step' => 'any',
						'columns' => 1,
					],
				],
			],
		];

		// $prefix = 'managed';
		$meta_boxes['managed'] = [
			'id'         => 'prestation-managed',
			'post_types' => ['prestation'],
			'style' => 'seamless',
			'readonly' => true,
			'fields'     => [
				'items' => [
					// 'name'      => __( 'Managed orders and bookings', 'prestations' ),
					'id'     => $prefix . 'managed',
					'type'   => 'group',
					// 'clone'  => true,
					// 'multiple'  => true,
					'class' => 'low-gap',
					'fields' => [
						[
							'name'    => __( 'ID', 'prestations' ),
							'id'      => $prefix . 'item_id',
							'type'    => 'text',
							'readonly' => true,
							'columns' => 1,
							'options' => self::get_available_items(),
							'readonly' => true,
						],
						[
							'name'    => __( 'Source', 'prestations' ),
							'id'      => $prefix . 'source',
							'type'    => 'text',
							'readonly' => true,
							'columns' => 1,
							'readonly' => true,
						],
						[
							'name'    => __( 'Description', 'prestations' ),
							'id'      => $prefix . 'description',
							'type'    => 'text',
							'columns' => 3,
							'readonly' => true,
						],
						[
								'name'          => __( 'From', 'prestations' ),
								'id'            => $prefix . 'from',
								'type'          => 'date',
								'columns' => 1,
								'readonly' => true,
						],
						[
								'name'          => __( 'To', 'prestations' ),
								'id'            => $prefix . 'to',
								'type'          => 'date',
								'columns' => 1,
								'readonly' => true,
						],
						[
							'name'    => __( 'Quantity', 'prestations' ),
							'id'      => $prefix . 'quantity',
							'type'    => 'number',
							'step' => 'any',
							'columns' => 1,
							'readonly' => true,
						],
						[
							'name'    => __( 'Unit Price', 'prestations' ),
							'id'      => $prefix . 'unit_price',
							'type'    => 'number',
							'step' => 'any',
							'columns' => 1,
							'readonly' => true,
						],
						[
							'name'    => __( 'Discount', 'prestations' ),
							'id'      => $prefix . 'discount',
							'type'    => 'number',
							'step' => 'any',
							'columns' => 1,
							'readonly' => true,
						],
						[
							'name'    => __( 'Price', 'prestations' ),
							'id'      => $prefix . 'price',
							'type'    => 'number',
							'step' => 'any',
							'columns' => 1,
							'readonly' => true,
						],
						[
							'name'    => __( 'Paid', 'prestations' ),
							'id'      => $prefix . 'paid',
							'type'    => 'number',
							'step' => 'any',
							'columns' => 1,
							'readonly' => true,
						],
					],
				],
			],
		];
		// $meta_boxes['managed']['fields']['items']['clone'] = false;
		// $meta_boxes['managed']['fields']['items']['name'] = $meta_boxes['managed']['title'];
		// foreach($meta_boxes['managed']['fields']['items']['fields'] as $key => $field) {
		// 	$meta_boxes['managed']['fields']['items']['fields'][$key]['readonly'] = true;
		// }

		// $prefix = 'manual';
		// error_log(print_r($meta_boxes['managed'], true));
		$meta_boxes[] = [
			'id'         => 'prestation-items',
			'post_types' => ['prestation'],
			'style' => 'seamless',
			'fields'     => [
				'items' => [
					'name'      => __( 'Unmanaged Items', 'prestations' ),
					'id'     => $prefix . 'manual_items',
					'type'   => 'group',
					'clone'  => true,
					'readonly' => false,
					'class' => 'low-gap',
					'fields' => [
						[
							'name'    => __( 'Type', 'prestations' ),
							'id'      => $prefix . 'type',
							'type'    => 'select',
							'options' => [
									'product' => __( 'Unmanaged Product', 'prestations' ),
									'booking' => __( 'Unmanaged Booking', 'prestations' ),
									'payment' => __( 'Unmanaged Payment', 'prestations' ),
							],
							'placeholder' => __('Select a type', 'prestations'),
							'columns' => 2,
						],
						[
							'name'    => __( 'Description', 'prestations' ),
							'id'      => $prefix . 'description',
							'type'    => 'text',
							'columns' => 3,
						],
						[
								'name'          => __( 'Date', 'prestations' ),
								'id'            => $prefix . 'from',
								'type'          => 'date',
								'columns' => 1,
								'required' => true,
								'visible' => [
									'when'     => [
										['type', '=', 'booking'],
										['type', '=', 'payment']
									],
									'relation' => 'or',
								],
						],
						[
								'name'          => __( 'To', 'prestations' ),
								'id'            => $prefix . 'to',
								'type'          => 'date',
								'columns' => 1,
								'visible' => [
									'when'     => [
										['type', '=', 'booking'],
										['from', '!=', '' ],
									],
									'relation' => 'and',
								],
						],
						[
							'name'    => __( 'Quantity', 'prestations' ),
							'id'      => $prefix . 'quantity',
							'type'    => 'number',
							'step' => 'any',
							'columns' => 1,
							'visible' => [
								'when'     => [
									['type', '!=', ''],
									['type', '!=', 'payment'],
								],
								'relation' => 'and',
							],
						],
						[
							'name'    => __( 'Unit Price', 'prestations' ),
							'id'      => $prefix . 'unit_price',
							'type'    => 'number',
							'step' => 'any',
							'columns' => 1,
							'visible' => [
								'when'     => [
									['type', '!=', ''],
									['type', '!=', 'payment'],
								],
								'relation' => 'and',
							],
						],
						[
							'name'    => __( 'Discount', 'prestations' ),
							'id'      => $prefix . 'discount',
							'type'    => 'number',
							'step' => 'any',
							'columns' => 1,
							'visible' => [
								'when'     => [
									['type', '!=', ''],
									['type', '!=', 'payment'],
								],
								'relation' => 'and',
							],
						],
						[
							'name'    => __( 'Price', 'prestations' ),
							'id'      => $prefix . 'price',
							'type'    => 'number',
							'step' => 'any',
							'columns' => 1,
							'visible' => [
								'when'     => [
									['type', '!=', ''],
									['type', '!=', 'payment'],
								],
								'relation' => 'and',
							],
						],
						[
							'name'    => __( 'Paid', 'prestations' ),
							'id'      => $prefix . 'paid',
							'type'    => 'number',
							'step' => 'any',
							'columns' => 1,
							'visible' => [
								'when'     => [
									['type', '!=', ''],
								],
							],
						],
					],
				],
			],
		];

		// $prefix
		// $meta_boxes[] = [
		// 	'title'      => __( 'Manual payments', 'prestations' ),
		// 	'id'         => 'prestation-payments',
		// 	'post_types' => ['prestation'],
		// 	'class' => 'low-gap',
		// 	'fields'     => [
		// 		[
		// 			'id'     => $prefix . 'payments',
		// 			'type'   => 'group',
		// 			'clone'  => true,
		// 			'fields' => [
		// 				[
		// 					'name'    => __( 'Type', 'prestations' ),
		// 					'id'      => $prefix . 'type',
		// 					'type'    => 'select',
		// 					'placeholder' => __('Select a payment method'),
		// 					'options' => [
		// 						'cash'        => __( 'Cash', 'prestations' ),
		// 						'wire'        => __( 'Wire Transfer', 'prestations' ),
		// 						'order'       => __( 'WooCommerce Order', 'prestations' ),
		// 						'hbook'       => __( 'HBook Order', 'prestations' ),
		// 						'booking_com' => __( 'Booking.com', 'prestations' ),
		// 						'airbnb'      => __( 'Airbnb', 'prestations' ),
		// 					],
		// 					'columns' => 2,
		// 				],
		// 				[
		// 					'name'    => __( 'Payment ID', 'prestations' ),
		// 					'id'      => $prefix . 'payment_id',
		// 					'type'    => 'text',
		// 					'readonly' => true,
		// 					'options' => self::get_available_payments(),
		// 					'columns' => 2,
		// 				],
		// 				[
		// 					'name'    => __( 'Payment reference', 'prestations' ),
		// 					'id'      => $prefix . 'payment_reference',
		// 					'type'    => 'text',
		// 					'columns' => 3,
		// 				],
		// 				[
		// 					'name'    => __( 'Amount', 'prestations' ),
		// 					'id'      => $prefix . 'amount',
		// 					'type'    => 'number',
		// 					'columns' => 2,
		// 					'step' => 'any',
		// 				],
		// 			],
		// 		],
		// 	],
		// ];

		$meta_boxes['prestation-summary'] = [
			'title'      => __( 'Summary', 'prestations' ),
			'id'         => 'prestation-summary',
			'post_types' => ['prestation'],
			'context'    => 'side',
			'fields'     => [
				[
					'name'          => __( 'Regular Price', 'prestations' ),
					'id'            => $prefix . 'price_html',
					'type'          => 'custom_html',
					'callback'      => 'Prestations_Prestation::get_summary_price',
				],
				[
					'name'          => __( 'Discount', 'prestations' ),
					'id'            => $prefix . 'discount_html',
					'type'          => 'custom_html',
					'callback'      => 'Prestations_Prestation::get_summary_discount',
				],
				[
					'name'          => __( 'Total', 'prestations' ),
					'id'            => $prefix . 'total_html',
					'type'          => 'custom_html',
					'class'          => 'total',
					'callback'      => 'Prestations_Prestation::get_summary_total',
				],
				[
					'name'     => __( 'Deposit', 'prestations_html' ),
					'id'       => $prefix . 'deposit_amount_html',
					'type'     => 'custom_html',
					'callback' => 'Prestations_Prestation::get_summary_deposit',
				],
				[
					'name'          => __( 'Paid', 'prestations' ),
					'id'            => $prefix . 'paid_html',
					'type'          => 'custom_html',
					'callback'      => 'Prestations_Prestation::get_summary_paid',
					'admin_columns' => 'after total',
				],
				[
					'name'          => __( 'Balance', 'prestations' ),
					'id'            => $prefix . 'balance_html',
					'type'          => 'custom_html',
					'class' => 'balance',
					'callback'      => 'Prestations_Prestation::get_summary_balance',
					'admin_columns' => 'after paid',
				],
				// [
				// 	'name'          => __( 'Due', 'prestations' ),
				// 	'id'            => $prefix . 'due_html',
				// 	'type'          => 'custom_html',
				// 	'callback'      => 'Prestations_Prestation::get_summary_due',
				// 	'admin_columns' => 'after paid',
				// ],
				[
					'name'          => __( 'Reference #', 'prestations' ),
					'id'            => $prefix . 'reference',
					'type'          => 'custom_html',
					'callback'      => 'Prestations_Prestation::get_summary_reference',
				],
				[
					'name'           => __( 'Status', 'prestations' ),
					'id'             => 'status',
					'type'           => 'taxonomy',
					'taxonomy'       => ['prestation-status'],
					'field_type'     => 'custom_html',
					'callback' => __CLASS__ . '::display_status',
					'class' => 'status',
					// 'disabled' => true,
					'readonly' => true,
					// 'save_field' => false,
					// 'placeholder' => ' ',
					'remove_default' => true,
					'admin_columns'  => [
						'position' => 'after dates',
						// 'sort'       => true,
						'filterable' => true,
					],
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
			'hierarchical'       => true,
			'show_ui'            => true,
			'show_in_menu'       => false,
			'show_in_nav_menus'  => false,
			'show_in_rest'       => true,
			'show_tagcloud'      => false,
			'show_in_quick_edit' => false,
			'show_admin_column'  => false,

			'query_var'          => true,
			'sort'               => true,
			'meta_box_cb'        => 'post_tags_meta_box',
			'rest_base'          => '',
			'rewrite'            => [
				'with_front'   => false,
				'hierarchical' => false,
			],
		];
		register_taxonomy( 'prestation-status', ['prestation'], $args );

		/**
		 * Prestation statuses, we use basically the same terminology as
		 * WooCommerce, but it is not mandatory.
		 */
		$terms = array(
			// Open (still modifiable, available for new order inclusion)
			'pending' => [ 'name' => __('Pending payment', 'prestations') ],  // unpaid or paid less than deposit, not confirmed
			'on-hold' => [ 'name' => __('On hold', 'prestations') ], // fully paid and not started
			'processing' => [ 'name' => __('Processing', 'prestations') ], // paid and started

			// Closed (not modifiable except refunds, not available for new order inclusion)
			'completed' => [ 'name' => __('Completed', 'prestations') ], // paid and finished
			'cancelled' => [ 'name' => __('Cancelled', 'prestations') ],
			'refunded' => [ 'name' => __('Refunded', 'prestations') ],
			'failed' => [ 'name' => __('Failed', 'prestations') ], // shouldn't need that at prestation level

			// Draft (not available for new order inclusion)
			'checkout-draft' => [ 'name' => __('Draft', 'prestations') ],

			'deposit' => [ 'name' => __('Deposit paid', 'prestations'), 'parent' => 'on-hold' ],
			'paid' => [ 'name' => __('Paid', 'prestations'), 'parent' => 'on-hold' ],

			'unpaid' => [ 'name' => __('Unpaid', 'prestations'), 'parent' => 'pending' ],
			'partial' => [ 'name' => __('Partially paid', 'prestations'), 'parent' => 'pending' ],
		);

		foreach($terms as $slug => $term) {
			$targs = array_merge( $term, [ 'slug' => $slug ] );
			if(isset($targs['parent'])) {
				$parent = term_exists( $targs['parent'], 'prestation-status' );
    		if( $parent && isset($parent['term_id']) ) {
					$targs['parent'] = $parent['term_id'];
				}
				else unset($targs['parent']);
			}
			unset($targs['name']);
			wp_insert_term( $term['name'], 'prestation-status', $targs );
		}

	}

	static function get_available_items() {
		return [];
	}

	static function get_available_payments() {
		return [];
	}

	static function get_summary_price($args = []) {
		global $post;
		$amount = get_post_meta($post->ID, 'price', true);
		if(empty($amount)) $amount = 0;
		return wc_price($amount);
	}

	static function get_summary_discount($args = []) {
		global $post;
		$discount = get_post_meta($post->ID, 'discount', true);
		$amount = (isset($discount['total'])) ? $discount['total'] : NULL;
		if( $amount > 0) return wc_price($amount);
	}

	static function get_summary_total($args = []) {
		global $post;
		$amount = get_post_meta($post->ID, 'total', true);
		if(empty($amount)) $amount = 0;
		return wc_price($amount);
	}

	static function get_summary_deposit_percent($args = []) {
		global $post;
		$deposit = get_post_meta($post->ID, 'deposit', true);
		$percent = (isset($deposit['percent'])) ? $deposit['percent'] : NULL;
		if($percent > 0) return number_format_i18n($percent, 0) . '%';
	}

	static function get_summary_deposit($args = []) {
		global $post;
		$deposit = get_post_meta($post->ID, 'deposit', true);
		$amount = (isset($deposit['total'])) ? $deposit['total'] : NULL;
		if($amount > 0) return wc_price($amount);
	}

	static function get_summary_paid($args = []) {
		global $post;
		$amount = get_post_meta($post->ID, 'paid', true);
		return wc_price($amount);
	}

	static function get_summary_balance($args = []) {
		global $post;
		$amount = get_post_meta($post->ID, 'balance', true);
		return wc_price($amount);
	}

	static function get_summary_reference($args = []) {
		global $post;
		if ($post->post_type != 'prestation') return;
		if( Prestations::is_new_post() ) return; // triggered when opened new post page, empty

		if(is_post_type_viewable( $post->post_type )) {
			return sprintf(
				'<a href="%s"><code>%s</code></a>',
				// '<a href="%s" class="thickbox"><code>%s</code></a>',
				get_permalink($post),
				$post->post_name,
			);
		} else {
			return sprintf(
				'<code>%s</code>',
				$post->post_name,
			);
		}
	}


	static function term_link_filter ( $termlink, $term, $taxonomy ) {
		if ( 'prestation-status' === $taxonomy ) {
			return add_query_arg( array(
				'prestation-status' => $term->slug,
			), admin_url(basename($_SERVER['REQUEST_URI'])) );
		}
		return $termlink;
	}

	static function display_status() {
		$paid_status = NULL;
		global $post;
		$terms = get_the_terms($post, 'prestation-status');

		if(is_array($terms) && isset($terms[0])) {
			$status = [];
			foreach($terms as $term) {
				$status[] = sprintf(
					'<span class="%1$s-status-box status-%2$s">%3$s</span>',
					$post->post_type,
					$term->slug,
					$term->name,
				);
			}
			return implode(' ', $status);
			// $term = $terms[0];
			// if(!empty($term)) return sprintf(
			// 	'<span class="%1$s-status-box status-%2$s">%3$s</span>',
			// 	$post->post_type,
			// 	$term->slug,
			// 	$term->name,
			// );
		}
	}

	static function update_prestation_amounts($post_id, $post, $update ) {
		if( !$update ) return;
		if( Prestations::is_new_post() ) return; // triggered when opened new post page, empty
		if( is_object($post) && $post->post_type != 'prestation' ) return;
		if( isset($_REQUEST['action']) && $_REQUEST['action'] == 'trash' ) return;

		remove_action(current_action(), __CLASS__ . '::' . __FUNCTION__);

		$updates['customer_id'] = get_post_meta($post_id, 'customer_id', true);
		$updates['customer_email'] = get_post_meta($post_id, 'customer_email', true);
		$updates['customer_name'] = get_post_meta($post_id, 'customer_name', true);
		$updates['guest_name'] = get_post_meta($post_id, 'guest_name', true);

		$amounts['items'] = get_post_meta($post_id, 'items', true);
		$amounts['managed'] = get_post_meta($post_id, 'managed', true);
		$amounts['payments'] = get_post_meta($post_id, 'payments', true);
		$updates['deposit'] = get_post_meta($post_id, 'deposit', true);
		$updates['discount'] = get_post_meta($post_id, 'discount', true);
		$updates['balance'] = get_post_meta($post_id, 'balance', true);
		$updates['dates'] = get_post_meta($post_id, 'dates', true);

		if(is_array($_REQUEST)) {
		  foreach ($updates as $key => $value) {
		    if(isset($_REQUEST[$key])) $updates[$key] = is_array($_REQUEST[$key]) ? $_REQUEST[$key] : esc_attr($_REQUEST[$key]);
		  }
		  foreach ($amounts as $key => $value) {
		    if(isset($_REQUEST[$key])) $amounts[$key] = is_array($_REQUEST[$key]) ? $_REQUEST[$key] : esc_attr($_REQUEST[$key]);
		  }
		}
		if(!is_array($updates['discount'])) $updates['discount'] = [ 'percent' => NULL, 'amount' => NULL ];
		if(!is_array($updates['deposit'])) $updates['deposit'] = [ 'percent' => NULL, 'amount' => NULL ];

		// error_log("prestation $post_id orders " . print_r(get_post_meta($post_id, 'managed-woocommerce'), true));

		$updates['price'] = 0; // get_post_meta($post_id, 'price', true);

		if(is_array($amounts['items'])) {
		  foreach($amounts['items'] as $item) {
		    if(empty($item['quantity'])) {
		      if(empty($item['unit_price'])) continue;
		      else $item['quantity'] = 1;
		    }
		    if(empty($item['quantity']) || empty($item['unit_price'])) continue;
		    $updates['price'] += $item['quantity'] * $item['unit_price'];
		  }
		}

		if($updates['discount']['percent'] > 0) {
			$updates['discount']['amount'] = $updates['price'] * $updates['discount']['percent'] / 100;
		} else {
			$updates['discount']['amount'] = (empty($updates['discount']['amount'])) ? NULL : $updates['discount']['amount'];
		}
		// if($updates['discount']['amount'] > $updates['price']) $updates['discount']['amount'] = $updates['price'];

		$updates['total'] = $updates['price'] - $updates['discount']['amount'];

		$updates['paid'] = 0; // Will be overridden // get_post_meta($post_id, 'paid', true);
		if(is_array($amounts['payments'])) {
		  foreach($amounts['payments'] as $payment) {
		    if(empty($payment['amount'])) continue;
		    $amount = esc_attr($payment['amount']);
		    $updates['paid'] += $amount;
		  }
		}

		$updates['discount']['managed'] = 0;
		$updates['deposit']['managed'] = 0;
		$updates['refunded'] = 0;
		$updates['discount']['total'] = 0;
		$updates['deposit']['total'] = 0;
		foreach(get_post_meta($post_id) as $key => $serialized) {
			if(preg_match('/^managed-/', $key)) {
				$managed = unserialize($serialized[0]);
				// error_log("$key = " . print_r($managed, true));
				// continue;
				$updates['price'] += @$managed['subtotal'];
				$updates['deposit']['managed'] += @$managed['deposit'];
				$updates['discount']['managed'] += @$managed['discount'];
				$updates['refunded'] += @$managed['refunded'];
				$updates['total'] += @$managed['total'];
				$updates['paid'] += @$managed['paid'];
			}
		}
		$updates['discount']['total'] += $updates['discount']['amount'] + $updates['discount']['managed'];

		if($updates['total'] > 0 && $updates['deposit']['percent'] > 0 ) {
			$updates['deposit']['amount'] = $updates['total'] * $updates['deposit']['percent'] / 100;
		} else {
			$updates['deposit']['amount'] = (empty($updates['deposit']['amount'])) ? NULL : $updates['deposit']['amount'];
		}
		$updates['deposit']['total'] += $updates['deposit']['amount'] + $updates['deposit']['managed'];

		// error_log("updates after " . print_r($updates, true));

		$updates['balance'] = ($updates['total'] - $updates['paid'] == 0) ? NULL : $updates['total'] - $updates['paid'];

		$post_status = $post->post_status;

		switch($post->post_status) {
			case 'publish':
			if($updates['total'] <= 0) {
				$paid_status = 'on-hold';
			} else if($updates['paid'] < $updates['total']) {
				if($updates['paid'] >= $updates['deposit']['total'] )  {
					$post_status = 'publish';
					if($updates['deposit']['total'] > 0) {
						$paid_status = 'deposit';
					} else {
						$paid_status = 'partial';
					}
				} else {
					$post_status = 'pending';
					if ($updates['paid'] > 0)
					$paid_status = 'partial';
					else
					$paid_status = 'unpaid';
				}
				// } else if($updates['paid'] > $updates['total']) {
				// 	$paid_status = 'overpaid';
			} else {
				$post_status = 'publish';
				$paid_status = 'paid';
			}
			break;

			default:
			$paid_status = $post->post_status;
		}
		$paid_status = (is_array($paid_status)) ? $paid_status : [ $paid_status ];

		if(! empty($updates['customer_id'])) {
			$updates['customer_name'] = trim(get_userdata($updates['customer_id'])->first_name. ' ' . get_userdata($updates['customer_id'])->last_name);
			$updates['customer_email'] = get_userdata($updates['customer_id'])->user_email;
		}

		if(empty($updates['guest_name'])) $updates['guest_name'] = $updates['customer_name'];
		$display_name = trim($updates['guest_name']);

		if(empty($updates['guest_email'])) $updates['guest_email'] = $updates['customer_email'];

		$updates['sort_date'] = (isset($updates['dates']) && isset($updates['dates']['from'])) ? $updates['dates']['from'] : '';
		$updates['display_name'] = $display_name;

		$post_update = array(
			'ID' => $post_id,
			'post_title' => trim($display_name . ' ' . "#" . ((empty($post->post_name)) ? $post_id : $post->post_name)),
			'post_status' => $post_status,
			'meta_input' => $updates,
			'tax_input' => array(
				'prestation-status' => $paid_status,
			),
		);

		wp_update_post($post_update);
		/*
		* TODO: get why metadata and taxonomies are not saved with wp_update_post
		* In the meantime, we force the update
		*/
		foreach ($updates as $key => $value) update_post_meta( $post_id, $key, $value );
		wp_set_object_terms( $post_id, $paid_status, 'prestation-status');

		add_action(current_action(), __CLASS__ . '::' . __FUNCTION__, 10, 3);
		return;
	}

	static function dates_column_callback() {
		echo "echo";
		return "return";
	}

	static function add_admin_columns( $columns ) {

		unset($columns['date']);
		$columns['dates'] = __('Dates', 'prestations');

		return $columns;
	}

	static function admin_columns_display( $column, $post_id ) {
	  // Image column
	  switch($column) {
			case 'dates':
			$dates = get_post_meta($post_id, 'dates', true);
			if(is_array($dates)) {
				$dates = array_filter($dates);
				if(! empty($dates))
				echo join(' / ', $dates);
			} else {
				echo "$dates";
			}
			break;
		}
	}

	static function sortable_columns($columns) {
		$columns['dates'] = 'dates';
		// $columns['guest'] = 'guest';
		return $columns;
	}

	static function sortable_columns_order($query) {
		if (!is_admin()) return;
		$orderby = $query->get('orderby');

		switch($orderby) {
			case 'dates':
			$query->set('meta_key', 'sort_date');
			$query->set('orderby', 'meta_value');
			break;
		}
	}

	static function new_post_random_slug( $data, $postarr ) {
		if ( ! in_array( $data['post_type'], [ 'prestation' ], true ) )  return $data;

		if( empty( $postarr['ID'] ) || empty($postarr['post_name']) ) {
			$data['post_name'] = Prestations::unique_random_slug();
		}

		return $data;
	}

}
