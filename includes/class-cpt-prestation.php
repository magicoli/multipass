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
class MultiServices_Prestation {

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
	public function __construct($args = NULL) {
		$this->post = $this->get($args);
		$this->ID = ($this->post) ? $this->post->ID : false;

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
			'name'                     => esc_html__('Prestations', 'multiservices' ),
			'singular_name'            => esc_html__('Prestation', 'multiservices' ),
			'add_new'                  => esc_html__('Add New', 'multiservices' ),
			'add_new_item'             => esc_html__('Add new prestation', 'multiservices' ),
			'edit_item'                => esc_html__('Edit Prestation', 'multiservices' ),
			'new_item'                 => esc_html__('New Prestation', 'multiservices' ),
			'view_item'                => esc_html__('View Prestation', 'multiservices' ),
			'view_items'               => esc_html__('View Prestations', 'multiservices' ),
			'search_items'             => esc_html__('Search Prestations', 'multiservices' ),
			'not_found'                => esc_html__('No prestations found', 'multiservices' ),
			'not_found_in_trash'       => esc_html__('No prestations found in Trash', 'multiservices' ),
			'parent_item_colon'        => esc_html__('Parent Prestation:', 'multiservices' ),
			'all_items'                => esc_html__('All Prestations', 'multiservices' ),
			'archives'                 => esc_html__('Prestation Archives', 'multiservices' ),
			'attributes'               => esc_html__('Prestation Attributes', 'multiservices' ),
			'insert_into_item'         => esc_html__('Insert into prestation', 'multiservices' ),
			'uploaded_to_this_item'    => esc_html__('Uploaded to this prestation', 'multiservices' ),
			'featured_image'           => esc_html__('Featured image', 'multiservices' ),
			'set_featured_image'       => esc_html__('Set featured image', 'multiservices' ),
			'remove_featured_image'    => esc_html__('Remove featured image', 'multiservices' ),
			'use_featured_image'       => esc_html__('Use as featured image', 'multiservices' ),
			'menu_name'                => esc_html__('Prestations', 'multiservices' ),
			'filter_items_list'        => esc_html__('Filter prestations list', 'multiservices' ),
			'filter_by_date'           => esc_html__('', 'multiservices' ),
			'items_list_navigation'    => esc_html__('Prestations list navigation', 'multiservices' ),
			'items_list'               => esc_html__('Prestations list', 'multiservices' ),
			'item_published'           => esc_html__('Prestation published', 'multiservices' ),
			'item_published_privately' => esc_html__('Prestation published privately', 'multiservices' ),
			'item_reverted_to_draft'   => esc_html__('Prestation reverted to draft', 'multiservices' ),
			'item_scheduled'           => esc_html__('Prestation scheduled', 'multiservices' ),
			'item_updated'             => esc_html__('Prestation updated', 'multiservices' ),
			'text_domain' => 'multiservices',
		];
		$args = [
			'label'               => esc_html__('Prestations', 'multiservices' ),
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

	static function register_fields( $meta_boxes ) {
		$js_date_format_short = preg_match('/^[Fm]/', get_option('date_format')) ? 'mm-dd-yy' : 'dd-mm-yy';

		$prefix = '';
		$meta_boxes['prestation-cpt'] = [
			'title'      => __('Prestations', 'multiservices' ),
			'id'         => 'prestation-fields',
			'post_types' => ['prestation'],
			'context'    => 'after_title',
			'style'      => 'seamless',
			'autosave'   => true,
			'fields'     => [
				[
					'id'            => $prefix . 'title_html',
					'type'          => 'custom_html',
					'callback' => 'MultiServices::title_html',
				],
				[
					'name'          => __('Customer', 'multiservices' ),
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
					'name'          => __('Attendee name', 'multiservices' ),
					'id'            => $prefix . 'attendee_name',
					'type'          => 'text',
					'description'		=> __('Leave empty if same as customer name', 'multiservices' ),
				],
				[
					'name'          => __('Attendee', 'multiservices' ),
					'id'            => $prefix . 'display_name',
					'type'          => 'hidden',
					'admin_columns' => [
						'position'   => 'after customer_id',
						'sort'       => true,
						'searchable' => true,
					],
				],
				[
					'name'    => __('Customer Email', 'multiservices' ),
					'id'      => $prefix . 'customer_email',
					'type'    => 'email',
					// 'visible' => [
					// 	'when'     => [['customer_id', '=', '']],
					// 	'relation' => 'or',
					// ],
				],
				[
				  'name'   => __('Dates', 'multiservices' ),
				  'id'     => $prefix . 'dates',
				  'type'   => 'group',
					'class' => 'inline',
					// 'admin_columns' => [
					// 	'position' => 'replace date',
					// 	'sort'     => true,
					// ],
				  'fields' => [
						[
							'prepend'          => __('From', 'multiservices' ),
							'id'            => $prefix . 'from',
							'readonly' => true,
							'size' => 10,
							'type'          => 'date',
							'timestamp'     => true,
							'js_options'    => [
									'dateFormat' => $js_date_format_short,
							],
						],
						[
							'prepend'          => __('To', 'multiservices' ),
							'id'            => $prefix . 'to',
							'type'          => 'date',
							'timestamp'     => true,
							'readonly' => true,
							'size' => 10,
							'js_options'    => [
									'dateFormat' => $js_date_format_short,
							],
						],
					],
				],
				[
				  'name'   => __('Discount', 'multiservices' ),
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
				      'type'    => 'text',
							'pattern'  => '[0-9]+([,\.][0-9]+)?',
				      'min'     => 0,
				      'size'    => 10,
				      'prepend' => MultiServices::get_currency_symbol(),
				      'visible' => [
				        'when'     => [['discount_percent', '=', '']],
				        'relation' => 'or',
				      ],
				    ],
				  ],
				],
				[
					'name'   => __('Deposit', 'multiservices' ),
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
							'type'    => 'text',
							'pattern'  => '[0-9]+([,\.][0-9]+)?',
							'min'     => 0,
							'step'    => 'any',
							'size'    => 10,
							'prepend' => MultiServices::get_currency_symbol(),
							'class' => 'amount class',
							'visible' => [
								'when'     => [['deposit_percent', '=', '']],
								'relation' => 'or',
							],
						],
						[
								'prepend'          => __('Before', 'multiservices' ),
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


		$prefix = 'managed_';
		$meta_boxes['managed'] = [
			'id'         => 'prestation-managed',
			'post_types' => ['prestation'],
			'style' => 'seamless',
			'readonly' => true,
			'fields'     => [
				[
					// 'name'          => __('Managed Items', 'multiservices' ),
					'id'            => $prefix . 'list',
					'type'          => 'custom_html',
					'callback'      => __CLASS__ . '::get_managed_list',
					'columns' => 12,
				],
			],
		];
		// 		'items' => [
		// 			// 'name'      => __('Managed orders and bookings', 'multiservices' ),
		// 			'id'     => $prefix . 'managed',
		// 			'type'   => 'group',
		// 			'clone'  => true,
		// 			'readonly' => true,
		// 			// 'multiple'  => true,
		// 			'class' => 'low-gap',
		// 			'fields' => [
		// 				[
		// 					'name'    => __('ID', 'multiservices' ),
		// 					'id'      => $prefix . 'id',
		// 					'type'    => 'text',
		// 					'readonly' => true,
		// 					'columns' => 1,
		// 					'options' => self::get_available_items(),
		// 					'readonly' => true,
		// 				],
		// 				[
		// 					'name'    => __('Source', 'multiservices' ),
		// 					'id'      => $prefix . 'source',
		// 					'type'    => 'text',
		// 					'readonly' => true,
		// 					'columns' => 1,
		// 					'readonly' => true,
		// 				],
		// 				[
		// 					'name'    => __('Description', 'multiservices' ),
		// 					'id'      => $prefix . 'description',
		// 					'type'    => 'text',
		// 					'columns' => 3,
		// 					'readonly' => true,
		// 				],
		// 				[
		// 						'name'          => __('From', 'multiservices' ),
		// 						'id'            => $prefix . 'from',
		// 						'type'          => 'date',
		// 						'columns' => 1,
		// 						'readonly' => true,
		// 				],
		// 				[
		// 						'name'          => __('To', 'multiservices' ),
		// 						'id'            => $prefix . 'to',
		// 						'type'          => 'date',
		// 						'columns' => 1,
		// 						'readonly' => true,
		// 				],
		// 				[
		// 					'name'    => __('Quantity', 'multiservices' ),
		// 					'id'      => $prefix . 'quantity',
		// 					'type'    => 'text',
		// 					'step' => 'any',
		// 					'columns' => 1,
		// 					'readonly' => true,
		// 				],
		// 				[
		// 					'name'    => __('Unit Price', 'multiservices' ),
		// 					'id'      => $prefix . 'unit_price',
		// 					'type'    => 'text',
		// 					'step' => 'any',
		// 					'columns' => 1,
		// 					'readonly' => true,
		// 				],
		// 				[
		// 					'name'    => __('Discount', 'multiservices' ),
		// 					'id'      => $prefix . 'discount',
		// 					'type'    => 'text',
		// 					'step' => 'any',
		// 					'columns' => 1,
		// 					'readonly' => true,
		// 				],
		// 				[
		// 					'name'    => __('Total', 'multiservices' ),
		// 					'id'      => $prefix . 'total',
		// 					'type'    => 'text',
		// 					'step' => 'any',
		// 					'columns' => 1,
		// 					'readonly' => true,
		// 				],
		// 				[
		// 					'name'    => __('Paid', 'multiservices' ),
		// 					'id'      => $prefix . 'paid',
		// 					'type'    => 'text',
		// 					'step' => 'any',
		// 					'columns' => 1,
		// 					'readonly' => true,
		// 				],
		// 			],
		// 		],
		// 	],
		// ];

		$prefix = '';
		$meta_boxes[] = [
			'id'         => 'prestation-items',
			'post_types' => ['prestation'],
			'style' => 'seamless',

			'fields'     => [
				'items' => [
					'name'      => __('Manual operations', 'multiservices' ),
					'id'     => $prefix . 'manual_items',
					'type'   => 'group',
					'clone'  => true,
					'readonly' => false,
					'class' => 'low-gap',
					'label_description' => '<p>' . __('Use manual operations only for items not managed by modules.', 'multiservices' ) . '</p>',
					'fields' => [
						[
							'name'    => __('Type', 'multiservices' ),
							'id'      => $prefix . 'type',
							'type'    => 'select',
							'options' => [
									'product' => __('Product', 'multiservices' ),
									'booking' => __('Booking', 'multiservices' ),
									'payment' => __('Payment', 'multiservices' ),
							],
							'placeholder' => __('Select a type', 'multiservices' ),
							'columns' => 2,
						],
						[
							'name'    => __('Description', 'multiservices' ),
							'id'      => $prefix . 'description',
							'type'    => 'text',
							'columns' => 3,
						],
						[
								'name'          => __('Date', 'multiservices' ),
								'id'            => $prefix . 'from',
								'type'          => 'date',
								'type'          => 'date',
								'timestamp'     => true,
								'js_options'    => [
										'dateFormat' => $js_date_format_short,
								],
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
								'name'          => __('To', 'multiservices' ),
								'id'            => $prefix . 'to',
								'type'          => 'date',
								'type'          => 'date',
								'timestamp'     => true,
								'js_options'    => [
										'dateFormat' => $js_date_format_short,
								],
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
							'name'    => __('Quantity', 'multiservices' ),
							'id'      => $prefix . 'quantity',
							'type'    => 'number',
							'class' => 'item_quantity',
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
							'name'    => __('Unit Price', 'multiservices' ),
							'id'      => $prefix . 'unit_price',
							'class' => 'item_unit_price',
							'type'    => 'text',
							'pattern'  => '[0-9]+([,\.][0-9]+)?',
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
							'name'    => __('Discount', 'multiservices' ),
							'id'      => $prefix . 'discount',
							'type'    => 'text',
							'class' => 'item_discount',
							'pattern'  => '[0-9]+([,\.][0-9]+)?',
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
							'name'    => __('Price', 'multiservices' ),
							'id'      => $prefix . 'price',
							'class' => 'item_price',
							'type'    => 'text',
							'readonly' => true,
							// 'pattern'  => '[0-9]+([,\.][0-9]+)?',
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
							'name'    => __('Paid', 'multiservices' ),
							'id'      => $prefix . 'paid',
							'class' => 'item_paid',
							'type'    => 'text',
							'step' => 'any',
							'columns' => 1,
							'visible' => [
								'when'     => [
									['type', '!=', ''],
								],
							],
							'pattern'  => '[0-9]+([,\.][0-9]+)?',
						],
					],
				],
			],
		];

		// $prefix
		// $meta_boxes[] = [
		// 	'title'      => __('Manual payments', 'multiservices' ),
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
		// 					'name'    => __('Type', 'multiservices' ),
		// 					'id'      => $prefix . 'type',
		// 					'type'    => 'select',
		// 					'placeholder' => __('Select a payment method'),
		// 					'options' => [
		// 						'cash'        => __('Cash', 'multiservices' ),
		// 						'wire'        => __('Wire Transfer', 'multiservices' ),
		// 						'order'       => __('WooCommerce Order', 'multiservices' ),
		// 						'hbook'       => __('HBook Order', 'multiservices' ),
		// 						'booking_com' => __('Booking.com', 'multiservices' ),
		// 						'airbnb'      => __('Airbnb', 'multiservices' ),
		// 					],
		// 					'columns' => 2,
		// 				],
		// 				[
		// 					'name'    => __('Payment ID', 'multiservices' ),
		// 					'id'      => $prefix . 'payment_id',
		// 					'type'    => 'text',
		// 					'readonly' => true,
		// 					'options' => self::get_available_payments(),
		// 					'columns' => 2,
		// 				],
		// 				[
		// 					'name'    => __('Payment reference', 'multiservices' ),
		// 					'id'      => $prefix . 'payment_reference',
		// 					'type'    => 'text',
		// 					'columns' => 3,
		// 				],
		// 				[
		// 					'name'    => __('Amount', 'multiservices' ),
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
			'title'      => __('Summary', 'multiservices' ),
			'id'         => 'prestation-summary',
			'post_types' => ['prestation'],
			'context'    => 'side',
			'fields'     => [
				[
					'name'          => __('Regular Price', 'multiservices' ),
					'id'            => $prefix . 'price_html',
					'type'          => 'custom_html',
					'callback'      => 'MultiServices_Prestation::get_summary_price',
				],
				[
					'name'          => __('Discount', 'multiservices' ),
					'id'            => $prefix . 'discount_html',
					'type'          => 'custom_html',
					'callback'      => 'MultiServices_Prestation::get_summary_discount',
				],
				[
					'name'          => __('Total', 'multiservices' ),
					'id'            => $prefix . 'total_html',
					'type'          => 'custom_html',
					'class'          => 'total',
					'callback'      => 'MultiServices_Prestation::get_summary_total',
				],
				[
					'name'     => __('Deposit', 'multiservices' ),
					'id'       => $prefix . 'deposit_amount_html',
					'type'     => 'custom_html',
					'callback' => 'MultiServices_Prestation::get_summary_deposit',
				],
				[
					'name'          => __('Paid', 'multiservices' ),
					'id'            => $prefix . 'paid_html',
					'type'          => 'custom_html',
					'callback'      => 'MultiServices_Prestation::get_summary_paid',
					'admin_columns' => 'after total',
				],
				[
					'name'          => __('Balance', 'multiservices' ),
					'id'            => $prefix . 'balance_html',
					'type'          => 'custom_html',
					'class' => 'balance',
					'callback'      => 'MultiServices_Prestation::get_summary_balance',
					'admin_columns' => 'after paid',
				],
				// [
				// 	'name'          => __('Due', 'multiservices' ),
				// 	'id'            => $prefix . 'due_html',
				// 	'type'          => 'custom_html',
				// 	'callback'      => 'MultiServices_Prestation::get_summary_due',
				// 	'admin_columns' => 'after paid',
				// ],
				[
					'name'          => __('Reference #', 'multiservices' ),
					'id'            => $prefix . 'reference',
					'type'          => 'custom_html',
					'callback'      => 'MultiServices_Prestation::get_summary_reference',
				],
				[
					'name'           => __('Status', 'multiservices' ),
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
			'name'                       => esc_html__( 'Service Types', 'multiservices' ),
			'singular_name'              => esc_html__( 'Service Type', 'multiservices' ),
			'menu_name'                  => esc_html__( 'Service Types', 'multiservices' ),
			'search_items'               => esc_html__( 'Search Service Types', 'multiservices' ),
			'popular_items'              => esc_html__( 'Popular Service Types', 'multiservices' ),
			'all_items'                  => esc_html__( 'All Service Types', 'multiservices' ),
			'parent_item'                => esc_html__( 'Parent Service Type', 'multiservices' ),
			'parent_item_colon'          => esc_html__( 'Parent Service Type:', 'multiservices' ),
			'edit_item'                  => esc_html__( 'Edit Service Type', 'multiservices' ),
			'view_item'                  => esc_html__( 'View Service Type', 'multiservices' ),
			'update_item'                => esc_html__( 'Update Service Type', 'multiservices' ),
			'add_new_item'               => esc_html__( 'Add New Service Type', 'multiservices' ),
			'new_item_name'              => esc_html__( 'New Service Type Name', 'multiservices' ),
			'separate_items_with_commas' => esc_html__( 'Separate service types with commas', 'multiservices' ),
			'add_or_remove_items'        => esc_html__( 'Add or remove service types', 'multiservices' ),
			'choose_from_most_used'      => esc_html__( 'Choose most used service types', 'multiservices' ),
			'not_found'                  => esc_html__( 'No service types found.', 'multiservices' ),
			'no_terms'                   => esc_html__( 'No service types', 'multiservices' ),
			'filter_by_item'             => esc_html__( 'Filter by service type', 'multiservices' ),
			'items_list_navigation'      => esc_html__( 'Service Types list pagination', 'multiservices' ),
			'items_list'                 => esc_html__( 'Service Types list', 'multiservices' ),
			'most_used'                  => esc_html__( 'Most Used', 'multiservices' ),
			'back_to_items'              => esc_html__( '&larr; Go to Service Types', 'multiservices' ),
			'text_domain'                => esc_html__( 'multiservices', 'multiservices' ),
		];
		$args = [
			'label'              => esc_html__( 'Service Types', 'multiservices' ),
			'labels'             => $labels,
			'description'        => '',
			'public'             => false,
			'publicly_queryable' => false,
			'hierarchical'       => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'show_in_nav_menus'  => true,
			'show_in_rest'       => true,
			'show_tagcloud'      => false,
			'show_in_quick_edit' => true,
			'show_admin_column'  => true,
			'query_var'          => true,
			'sort'               => false,
			'meta_box_cb'        => 'post_categories_meta_box',
			'rest_base'          => '',
			'rewrite'            => [
				'with_front'   => false,
				'hierarchical' => false,
			],
		];
		register_taxonomy( 'service-type', ['prestation', 'product', 'pr_association', 'prestation-part'], $args );

		MultiServices::register_terms('service-type', array(
			'booking' => __('Booking', 'multiservices'),
		));

		$labels = [
			'name'                       => esc_html__('Prestation statuses', 'multiservices' ),
			'singular_name'              => esc_html__('Prestation status', 'multiservices' ),
			'menu_name'                  => esc_html__('Prestation statuses', 'multiservices' ),
			'search_items'               => esc_html__('Search Prestation statuses', 'multiservices' ),
			'popular_items'              => esc_html__('Popular Prestation statuses', 'multiservices' ),
			'all_items'                  => esc_html__('All Prestation statuses', 'multiservices' ),
			'parent_item'                => esc_html__('Parent Prestation status', 'multiservices' ),
			'parent_item_colon'          => esc_html__('Parent Prestation status', 'multiservices' ),
			'edit_item'                  => esc_html__('Edit Prestation status', 'multiservices' ),
			'view_item'                  => esc_html__('View Prestation status', 'multiservices' ),
			'update_item'                => esc_html__('Update Prestation status', 'multiservices' ),
			'add_new_item'               => esc_html__('Add new prestation status', 'multiservices' ),
			'new_item_name'              => esc_html__('New prestation status name', 'multiservices' ),
			'separate_items_with_commas' => esc_html__('Separate prestation statuses with commas', 'multiservices' ),
			'add_or_remove_items'        => esc_html__('Add or remove prestation statuses', 'multiservices' ),
			'choose_from_most_used'      => esc_html__('Choose most used prestation statuses', 'multiservices' ),
			'not_found'                  => esc_html__('No prestation statuses found', 'multiservices' ),
			'no_terms'                   => esc_html__('No Prestation statuses', 'multiservices' ),
			'filter_by_item'             => esc_html__('Filter by prestation status', 'multiservices' ),
			'items_list_navigation'      => esc_html__('Prestation statuses list pagination', 'multiservices' ),
			'items_list'                 => esc_html__('Prestation statuses list', 'multiservices' ),
			'most_used'                  => esc_html__('Most Used', 'multiservices' ),
			'back_to_items'              => esc_html__('Back to prestation statuses', 'multiservices' ),
			'text_domain' => 'multiservices',
		];
		$args = [
			'label'              => esc_html__('Prestation statuses', 'multiservices' ),
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
		MultiServices::register_terms('prestation-status', array(
			// Open (still modifiable, available for new order inclusion)
			'pending' => [ 'name' => __('Pending payment', 'multiservices' ) ],  // unpaid or paid less than deposit, not confirmed
			'on-hold' => [ 'name' => __('On hold', 'multiservices' ) ], // fully paid and not started
			'processing' => [ 'name' => __('Processing', 'multiservices' ) ], // paid and started

			// Closed (not modifiable except refunds, not available for new order inclusion)
			'completed' => [ 'name' => __('Completed', 'multiservices' ) ], // paid and finished
			'cancelled' => [ 'name' => __('Cancelled', 'multiservices' ) ],
			'refunded' => [ 'name' => __('Refunded', 'multiservices' ) ],
			'failed' => [ 'name' => __('Failed', 'multiservices' ) ], // shouldn't need that at prestation level

			// Draft (not available for new order inclusion)
			'checkout-draft' => [ 'name' => __('Draft', 'multiservices' ) ],

			'deposit' => [ 'name' => __('Deposit paid', 'multiservices' ), 'parent' => 'on-hold' ],
			'paid' => [ 'name' => __('Paid', 'multiservices' ), 'parent' => 'on-hold' ],

			'unpaid' => [ 'name' => __('Unpaid', 'multiservices' ), 'parent' => 'pending' ],
			'partial' => [ 'name' => __('Partially paid', 'multiservices' ), 'parent' => 'pending' ],
		));
	}

	static function get_available_items() {
		return [];
	}

	static function get_available_payments() {
		return [];
	}

	static function get_managed_list($args = [], $field = []) {
		$html = apply_filters('multiservices_managed_list', NULL);

		// if(empty($html))
		// $html = __('No data', 'multiservices' );

		return $html;
	}

	static function get_summary_price($args = []) {
		global $post;
		$amount = get_post_meta($post->ID, 'price', true);
		if(empty($amount)) $amount = 0;
		return MultiServices::price($amount);
	}

	static function get_summary_discount($args = []) {
		global $post;
		$discount = get_post_meta($post->ID, 'discount', true);
		$amount = (isset($discount['total'])) ? $discount['total'] : NULL;
		if( $amount > 0) return MultiServices::price($amount);
	}

	static function get_summary_total($args = []) {
		global $post;
		$amount = get_post_meta($post->ID, 'total', true);
		if(empty($amount)) $amount = 0;
		return MultiServices::price($amount);
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
		if($amount > 0) return MultiServices::price($amount);
	}

	static function get_summary_paid($args = []) {
		global $post;
		$amount = get_post_meta($post->ID, 'paid', true);
		return MultiServices::price($amount);
	}

	static function get_balance($args = []) {
		global $post;
		$amount = get_post_meta($post->ID, 'balance', true);
		return $amount;
	}

	static function get_summary_balance($args = []) {
		// global $post;
		// $amount = get_post_meta($post->ID, 'balance', true);
		$amount = self::get_balance();
		return MultiServices::price($amount);
	}

	static function get_summary_reference($args = []) {
		global $post;
		if ($post->post_type != 'prestation') return;
		if( MultiServices::is_new_post() ) return; // triggered when opened new post page, empty

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
					__($term->name, 'multiservices' ),
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

	static function get_post($object) {
		if(self::is_prestation_post($object)) return $object;
		if(get_class($object) == __CLASS__ ) $post = $object->post;
		else if(is_numeric($object)) $post = get_post($object);
		else return false;

		return (self::is_prestation_post($post)) ? $post : false;
	}

	static function is_prestation_post($object) {
		if(!is_object($object)) return false;
		if( get_class($object) != 'WP_Post' ) return false;
		if( $object->post_type != 'prestation') return false;

		return true;
	}

	static function update_prestation_amounts($post_id, $post, $update ) {
		if( !$update ) return;
		if( MultiServices::is_new_post() ) return; // triggered when opened new post page, empty
		if( ! self::is_prestation_post($post) ) return;
		if( $post->post_status == 'trash' ) return; // TODO: remove prestation reference from other post types
		if( isset($_REQUEST['action']) && $_REQUEST['action'] == 'trash' ) return; // maybe redundant?

		remove_action(current_action(), __CLASS__ . '::' . __FUNCTION__);

		$updates['customer_id'] = get_post_meta($post_id, 'customer_id', true);
		$updates['customer_email'] = get_post_meta($post_id, 'customer_email', true);
		$updates['customer_name'] = get_post_meta($post_id, 'customer_name', true);
		$updates['attendee_name'] = get_post_meta($post_id, 'attendee_name', true);

		$amounts['items'] = get_post_meta($post_id, 'manual_items', true);
		$amounts['managed'] = get_post_meta($post_id, 'managed', true);
		$amounts['payments'] = get_post_meta($post_id, 'payments', true);
		$updates['deposit'] = get_post_meta($post_id, 'deposit', true);
		$updates['discount'] = get_post_meta($post_id, 'discount', true);
		$updates['balance'] = get_post_meta($post_id, 'balance', true);
		$updates['dates'] = get_post_meta($post_id, 'dates', true);

		$updates['price'] = 0; // get_post_meta($post_id, 'price', true);
		$updates['paid'] = 0; // Will be overridden // get_post_meta($post_id, 'paid', true);
		$dates = [];


		if(is_array($_REQUEST)) {
		  foreach ($updates as $key => $value) {
		    if(isset($_REQUEST[$key])) $updates[$key] = is_array($_REQUEST[$key]) ? $_REQUEST[$key] : esc_attr($_REQUEST[$key]);
		  }
		  foreach ($amounts as $key => $value) {
		    if(isset($_REQUEST[$key])) $amounts[$key] = is_array($_REQUEST[$key]) ? $_REQUEST[$key] : esc_attr($_REQUEST[$key]);
		  }
		}

		if(!is_array($updates['deposit'])) $updates['deposit'] = [ 'percent' => NULL, 'amount' => NULL ];
		// if(empty($updates['deposit'])) $updates['deposit'] = [];
		$updates['deposit']['managed'] = 0;
		$updates['deposit']['total'] = 0;

		if(!is_array($updates['discount'])) $updates['discount'] = [ 'percent' => NULL, 'amount' => NULL ];
		// if(empty($updates['discount'])) $updates['discount'] = [];
		// $updates['discount']['amount'] = (empty($updates['discount']['amount'])) ? 0 : $updates['discount']['amount'];
		// $updates['discount']['total'] = $updates['discount']['amount'];
		$updates['discount']['managed'] = 0;
		$updates['discount']['total'] = 0;
		$updates['refunded'] = 0;
		$updates['discount']['total'] = 0;

		if(is_array($amounts['items'])) {
		  foreach($amounts['items'] as $item) {
				if(isset($item['paid'])) $updates['paid'] += (float)$item['paid'];

				if(isset($item['discount']))
				$updates['discount']['total'] += (float)$item['discount'];

		    if(empty($item['quantity'])) {
		      if(empty($item['unit_price'])) continue;
		      else $item['quantity'] = 1;
		    }
		    if(empty($item['quantity']) || empty($item['unit_price'])) continue;
				$updates['price'] += (float)$item['quantity'] * (float)$item['unit_price'];

				if(!empty($item['from']['timestamp'])) $dates[] = $item['from']['timestamp'];
				if(!empty($item['to']['timestamp'])) $dates[] = $item['to']['timestamp'];
		  }
		}

		if($updates['discount']['percent'] > 0) {
			$updates['discount']['amount'] = $updates['price'] * $updates['discount']['percent'] / 100;
		} else {
			$updates['discount']['amount'] = (empty($updates['discount']['amount'])) ? NULL : $updates['discount']['amount'];
		}
		// if($updates['discount']['amount'] > $updates['price']) $updates['discount']['amount'] = $updates['price'];

		$updates['total'] = $updates['price'] - $updates['discount']['amount'];

		if(is_array($amounts['payments'])) {
		  foreach($amounts['payments'] as $payment) {
		    if(empty($payment['amount'])) continue;
		    $amount = esc_attr($payment['amount']);
		    $updates['paid'] += $amount;
		  }
		}

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
				if(is_array(@$managed['dates']) &! empty($managed['dates'])) {
					$dates[] = min($managed['dates']);
					$dates[] = max($managed['dates']);
				}
			}
		}

		$dates = array_unique(array_filter($dates));
		if(!empty($dates)) {
			$updates['dates'] = [
				'from' => min($dates),
				'to' => max($dates),
			];
			if($updates['dates']['to'] == $updates['dates']['from']) unset($updates['dates']['to']);
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
			} else if( $updates['paid'] < $updates['total'] ) {
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

		if(empty($updates['attendee_name'])) $updates['attendee_name'] = $updates['customer_name'];
		$display_name = trim($updates['attendee_name']);

		if(empty($updates['attendee_email'])) $updates['attendee_email'] = $updates['customer_email'];

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
		$columns['dates'] = __('Dates', 'multiservices' );

		return $columns;
	}

	static function admin_columns_display( $column, $post_id ) {
	  // Image column
	  switch($column) {
			case 'dates':
			echo MultiServices::format_date_range(get_post_meta($post_id, 'dates', true));
			break;
		}
	}

	static function sortable_columns($columns) {
		$columns['dates'] = 'dates';
		// $columns['attendee'] = 'attendee';
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
			$data['post_name'] = MultiServices::unique_random_slug();
		}

		return $data;
	}

	function get($args) {
		if(empty($args)) return $args;
		if(is_numeric($args)) {
			$prestation = get_post($args);
			error_log('get prestation by id: ' . $prestation->ID);
		} else if(is_object($args) && $args->post_type == 'prestation') {
			$prestation = $args;
			error_log('get prestation by post: ' . $prestation->ID);
		}
		if(isset($prestation)) return $prestation;

		$prestation_id = $args['prestation_id'];
		$customer_id = $args['customer_id'];
		$customer_name= $args['customer_name'];
		$customer_email = $args['customer_email'];

		// Check by customer id, email or name
		$query_args = array(
			'post_type' => 'prestation',
			'post_status__in' => [ 'pending', 'on-hold', 'deposit', 'partial', 'unpaid', 'processing' ],
			'orderby' => 'post_date',
			'order' => 'desc',
		);
		if(!empty($customer_id)) {
			$query_args['meta_query'] = array(
				array(
					'key' => 'customer_id',
					'value' => esc_attr($customer_id),
				)
			);
		} else if (!empty($customer_email)) {
			$query_args['meta_query'] = array(
				'relation' => 'OR',
				array(
					'key' => 'customer_email',
					'value' => esc_attr($customer_email),
				),
				array(
					'key' => 'attendee_email',
					'value' => esc_attr($customer_email),
				),
			);
		} else if (!empty($customer_name)) {
			$query_args['meta_query'] = array(
				'relation' => 'OR',
				array(
					'key' => 'customer_name',
					'value' => esc_attr($customer_name),
				),
				array(
					'key' => 'attendee_name',
					'value' => esc_attr($customer_name),
				),
			);
		}
		$prestations = get_posts($query_args);
		$prestation = false;
		if($prestations) {
			$prestation = $prestations[0];
			$prestation_id = $prestation->ID;
			// error_log("$prestation->ID $prestation->post_title " . print_r($prestation, true));
			// update_post_meta( $order_id, 'prestation_id', $prestation_id );
		}
		if($prestation) return $prestation;

		// Nothing worked so far, create one
		$meta = array(
			// 'prestation_id' => $prestation_id,
			'customer_id' => $customer_id,
			'customer_name' => $customer_name,
			'customer_email' => $customer_email,
		);
		$postarr = array(
			'post_author' => $customer_id,
			'post_date' => esc_attr($args['date']),
			'post_date_gmt' => esc_attr($args['date_gmt']),
			'post_type' => 'prestation',
			'post_status' => 'publish',
			'meta_input' => $meta,
		);
		$prestation_id = wp_insert_post($postarr);
		// update_post_meta( $order_id, 'prestation_id', $prestation_id );
		// foreach ($postarr['meta_input'] as $key => $value) update_post_meta( $order_id, $key, $value );

		// if(!empty($prestation_id)) {
			// foreach ($meta as $key => $value) update_post_meta( $order_id, $key, $value );
			// MultiServices_WooCommerce::update_prestation_orders($prestation_id, get_post($prestation_id), true );
		// }

		$prestation = get_post($prestation_id);
		return $prestation;
	}

}
