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
class Prestations_Service {

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

	protected $ID;
	protected $post;

	/**
	 * Initialize the collections used to maintain the actions and filters.
	 *
	 * @since    1.0.0
	 */
	public function __construct($post = NULL) {
		if(is_numeric($post)) {
			$this->ID = $post;
			$post = get_post($this->ID);
		} else if(isset($post->post_type) && $post->post_type == 'service') {
			$this->post = $post;
			$this->ID = $post->ID;
		}

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
				'hook' => 'save_post',
				'callback' => 'save_post_action',
				'accepted_args' => 3,
			),
		);


		$filters = array(
			array(
				'hook' => 'rwmb_meta_boxes',
				'callback' => 'register_fields'
			),

			array(
				'hook' => 'wp_insert_post_data',
				'callback' => 'insert_service_data',
				'accepted_args' => 4,
			),
			// array(
			// 	'hook' => 'update_post_metadata',
			// 	'callback' => 'update_metadata_filter',
			// 	'accepted_args' => 5,
			// ),

			array(
				'hook' => 'sanitize_post_meta_customer_for_service',
				'callback' => 'sanitize_service_meta',
				'accepted_args' => 3,
			),
			array(
				'hook' => 'sanitize_post_meta_guest_for_service',
				'callback' => 'sanitize_service_meta',
				'accepted_args' => 3,
			),

			array(
				'hook' => 'prestations_set_service_title',
				'callback' => 'set_service_title',
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
			'name'                     => esc_html__( 'Services', 'prestations' ),
			'singular_name'            => esc_html__( 'Service', 'prestations' ),
			'add_new'                  => esc_html__( 'Add New', 'prestations' ),
			'add_new_item'             => esc_html__( 'Add New Service', 'prestations' ),
			'edit_item'                => esc_html__( 'Edit Service', 'prestations' ),
			'new_item'                 => esc_html__( 'New Service', 'prestations' ),
			'view_item'                => esc_html__( 'View Service', 'prestations' ),
			'view_items'               => esc_html__( 'View Services', 'prestations' ),
			'search_items'             => esc_html__( 'Search Services', 'prestations' ),
			'not_found'                => esc_html__( 'No services found.', 'prestations' ),
			'not_found_in_trash'       => esc_html__( 'No services found in Trash.', 'prestations' ),
			'parent_item_colon'        => esc_html__( 'Parent Service:', 'prestations' ),
			'all_items'                => esc_html__( 'Services', 'prestations' ),
			'archives'                 => esc_html__( 'Service Archives', 'prestations' ),
			'attributes'               => esc_html__( 'Service Attributes', 'prestations' ),
			'insert_into_item'         => esc_html__( 'Insert into service', 'prestations' ),
			'uploaded_to_this_item'    => esc_html__( 'Uploaded to this service', 'prestations' ),
			'featured_image'           => esc_html__( 'Featured image', 'prestations' ),
			'set_featured_image'       => esc_html__( 'Set featured image', 'prestations' ),
			'remove_featured_image'    => esc_html__( 'Remove featured image', 'prestations' ),
			'use_featured_image'       => esc_html__( 'Use as featured image', 'prestations' ),
			'menu_name'                => esc_html__( 'Services', 'prestations' ),
			'filter_items_list'        => esc_html__( 'Filter services list', 'prestations' ),
			'filter_by_date'           => esc_html__( '', 'prestations' ),
			'items_list_navigation'    => esc_html__( 'Services list navigation', 'prestations' ),
			'items_list'               => esc_html__( 'Services list', 'prestations' ),
			'item_published'           => esc_html__( 'Service published.', 'prestations' ),
			'item_published_privately' => esc_html__( 'Service published privately.', 'prestations' ),
			'item_reverted_to_draft'   => esc_html__( 'Service reverted to draft.', 'prestations' ),
			'item_scheduled'           => esc_html__( 'Service scheduled.', 'prestations' ),
			'item_updated'             => esc_html__( 'Service updated.', 'prestations' ),
			'text_domain'              => 'prestations',
		];
		$args = [
			'label'               => esc_html__( 'Services', 'prestations' ),
			'labels'              => $labels,
			'description'         => '',
			'public'              => true,
			'hierarchical'        => false,
			'exclude_from_search' => true,
			'publicly_queryable'  => true,
			'show_ui'             => true,
			'show_in_nav_menus'   => true,
			'show_in_admin_bar'   => true,
			'show_in_rest'        => true,
			'query_var'           => true,
			'can_export'          => true,
			'delete_with_user'    => true,
			'has_archive'         => true,
			'rest_base'           => '',
			'show_in_menu'        => 'edit.php?post_type=prestation',
			'menu_icon'           => 'dashicons-admin-generic',
			'capability_type'     => 'post',
			'supports'            => false,
			'taxonomies'          => [],
			'rewrite'             => [
			'with_front' => false,
			],
		];

		register_post_type( 'service', $args );
	}

	static function register_fields( $meta_boxes ) {
    $prefix = '';

    $meta_boxes[] = [
        'title'      => __( 'Services fields', 'prestations' ),
        'id'         => 'services-fields',
        'post_types' => ['service'],
        'style'      => 'seamless',
        'fields'     => [
            [
                'id'       => $prefix . 'title_html',
                'type'     => 'custom_html',
                'callback' => 'Prestations::title_html',
            ],
            [
                'name'          => __( 'Source', 'prestations' ),
                'id'            => $prefix . 'source',
                'type'          => 'taxonomy',
                'taxonomy'      => ['service-source'],
                'field_type'    => 'select',
                'placeholder'   => __( 'None', 'prestations' ),
                'admin_columns' => [
                    'position'   => 'replace date',
                    'sort'       => true,
                    'searchable' => true,
                    'filterable' => true,
                ],
            ],
            [
                'name'    => __( 'Source ID', 'prestations' ),
                'id'      => $prefix . 'source_id',
                'type'    => 'text',
                'visible' => [
                    'when'     => [['source', '!=', '']],
                    'relation' => 'or',
                ],
            ],
            [
                'name'     => __( 'Source URL', 'prestations' ),
                'id'       => $prefix . 'source_url',
                'type'     => 'url',
                'readonly' => true,
                'class'    => 'inline',
                'visible'  => [
                    'when'     => [['source', '!=', '']],
                    'relation' => 'or',
                ],
            ],
            [
                'name'    => __( 'Item ID', 'prestations' ),
                'id'      => $prefix . 'item',
                'type'    => 'text',
                'class'   => 'inline',
                'visible' => [
                    'when'     => [['source', '!=', '']],
                    'relation' => 'or',
                ],
            ],
            [
                'name'    => __( 'Description', 'prestations' ),
                'id'      => $prefix . 'description',
                'type'    => 'text',
                'visible' => [
                    'when'     => [['source', '=', '']],
                    'relation' => 'or',
                ],
            ],
            [
                'name'       => __( 'Prestation', 'prestations' ),
                'id'         => $prefix . 'prestation',
                'type'       => 'post',
                'post_type'  => ['prestation'],
                'field_type' => 'select_advanced',
            ],
            [
                'name'              => __( 'Customer', 'prestations' ),
                'id'                => $prefix . 'customer',
                'type'              => 'group',
                'class'             => 'inline',
                'fields'            => [
                    [
                        'name'       => __( 'Existing User', 'prestations' ),
                        'id'         => $prefix . 'user_id',
                        'type'       => 'user',
                        'field_type' => 'select_advanced',
                    ],
                    [
                        'name'          => __( 'Name', 'prestations' ),
                        'id'            => $prefix . 'name',
                        'type'          => 'text',
                        'size'          => 30,
                        'admin_columns' => 'after title',
                    ],
                    [
                        'name' => __( 'Email', 'prestations' ),
                        'id'   => $prefix . 'email',
                        'type' => 'email',
                        'size' => 30,
                    ],
                    [
                        'name' => __( 'Phone', 'prestations' ),
                        'id'   => $prefix . 'phone',
                        'type' => 'text',
                    ],
                ],
                'visible'           => [
                    'when'     => [['prestation', '=', '']],
                    'relation' => 'or',
                ],
            ],
						[
                'name'              => __( 'Guest', 'prestations' ),
                'id'                => $prefix . 'guest',
                'type'              => 'group',
                'class'             => 'inline',
								'desc'              => __( 'Fill only if different from customer.', 'prestations' ),
                'fields'            => [
                    [
                        'name'       => __( 'Existing User', 'prestations' ),
                        'id'         => $prefix . 'user_id',
                        'type'       => 'user',
                        'field_type' => 'select_advanced',
                    ],
                    [
                        'name'          => __( 'Name', 'prestations' ),
                        'id'            => $prefix . 'name',
                        'type'          => 'text',
                        'size'          => 30,
                        'admin_columns' => 'after title',
                    ],
                    [
                        'name' => __( 'Email', 'prestations' ),
                        'id'   => $prefix . 'email',
                        'type' => 'email',
                        'size' => 30,
                    ],
                    [
                        'name' => __( 'Phone', 'prestations' ),
                        'id'   => $prefix . 'phone',
                        'type' => 'text',
                    ],
                ],
            ],
            [
                'id'            => $prefix . 'customer_display',
                'type'          => 'hidden',
                'admin_columns' => [
                    'position'   => 'after title',
                    'title'      => 'Customer',
                    'sort'       => true,
                    'searchable' => true,
                ],
            ],
            [
                'id'   => $prefix . 'sep',
                'type' => 'custom_html',
                'std'  => '<hr>',
            ],
            [
                'name'          => __( 'Dates', 'prestations' ),
                'id'            => $prefix . 'dates',
                'type'          => 'group',
                'admin_columns' => [
                    'position' => 'before source',
                    'sort'     => true,
                ],
                'class'         => 'inline',
                'fields'        => [
                    [
                        'name'      => __( 'From', 'prestations' ),
                        'id'        => $prefix . 'from',
                        'type'      => 'datetime',
                        'timestamp' => true,
                    ],
                    [
                        'name'      => __( 'To', 'prestations' ),
                        'id'        => $prefix . 'to',
                        'type'      => 'datetime',
                        'timestamp' => true,
                    ],
                ],
            ],
            [
                'name'   => __( 'Guests', 'prestations' ),
                'id'     => $prefix . 'guests',
                'type'   => 'group',
                'class'  => 'inline',
                'fields' => [
                    [
                        'name'          => __( 'Total', 'prestations' ),
                        'id'            => $prefix . 'total',
                        'type'          => 'number',
                        'min'           => 0,
                        'size'          => 5,
                        'admin_columns' => [
                            'position' => 'after title',
                            'title'    => 'Guests',
                        ],
                    ],
                    [
                        'name' => __( 'Adults', 'prestations' ),
                        'id'   => $prefix . 'adults',
                        'type' => 'number',
                        'min'  => 0,
                        'size' => 5,
                    ],
                    [
                        'name' => __( 'Children', 'prestations' ),
                        'id'   => $prefix . 'children',
                        'type' => 'number',
                        'min'  => 0,
                        'size' => 5,
                    ],
                    [
                        'name' => __( 'Babies', 'prestations' ),
                        'id'   => $prefix . 'babies',
                        'type' => 'number',
                        'min'  => 0,
                        'size' => 5,
                    ],
                ],
            ],
            [
                'id'            => $prefix . 'guests_display',
                'type'          => 'hidden',
                'admin_columns' => [
                    'position' => 'after customer_display',
                    'title'    => 'Guests',
                    'sort'     => true,
                ],
            ],
            [
                'name'   => __( 'Beds', 'prestations' ),
                'id'     => $prefix . 'beds',
                'type'   => 'group',
                'class'  => 'inline',
                'fields' => [
                    [
                        'name' => __( 'Double', 'prestations' ),
                        'id'   => $prefix . 'double',
                        'type' => 'number',
                        'min'  => 0,
                        'size' => 5,
                    ],
                    [
                        'name' => __( 'Single', 'prestations' ),
                        'id'   => $prefix . 'single',
                        'type' => 'number',
                        'min'  => 0,
                        'size' => 5,
                    ],
                    [
                        'name' => __( 'Baby', 'prestations' ),
                        'id'   => $prefix . 'baby',
                        'type' => 'number',
                        'min'  => 0,
                        'size' => 5,
                    ],
                ],
            ],
            [
                'id'   => $prefix . 'sep2',
                'type' => 'custom_html',
                'std'  => '<hr>',
            ],
            [
                'name'   => __( 'Price', 'prestations' ),
                'id'     => $prefix . 'price',
                'type'   => 'group',
                'class'  => 'inline',
                'fields' => [
                    [
                        'name' => __( 'Quantity', 'prestations' ),
                        'id'   => $prefix . 'quantity',
                        'type' => 'number',
                        'min'  => 0,
                        'step' => 'any',
                        'size' => 5,
                    ],
                    [
                        'name' => __( 'Unit Price', 'prestations' ),
                        'id'   => $prefix . 'unit',
                        'type' => 'number',
                        'min'  => 0,
                        'step' => 'any',
                        'size' => 10,
                    ],
                    [
                        'name'     => __( 'Subtotal', 'prestations' ),
                        'id'       => $prefix . 'subtotal',
                        'type'     => 'number',
                        'size'     => 10,
                        'readonly' => true,
                    ],
                ],
            ],
            [
                'name'   => __( 'Discount', 'prestations' ),
                'id'     => $prefix . 'discount',
                'type'   => 'group',
                'class'  => 'inline',
                'fields' => [
                    [
                        'id'      => $prefix . 'percent',
                        'type'    => 'number',
                        'min'     => 0,
                        'max'     => 100,
                        'step'    => 'any',
                        'size'    => 5,
                        'prepend' => '%',
                    ],
                    [
                        'id'      => $prefix . 'amount',
                        'type'    => 'number',
                        'size'    => 10,
                        'prepend' => '€',
                    ],
                ],
            ],
            [
                'name'          => __( 'Total', 'prestations' ),
                'id'            => $prefix . 'total',
                'type'          => 'number',
                'min'           => 0,
                'step'          => 'any',
                'size'          => 10,
                'readonly'      => true,
                'admin_columns' => [
                    'position' => 'after dates',
                    'sort'     => true,
                ],
            ],
            [
                'name'          => __( 'Deposit', 'prestations' ),
                'id'            => $prefix . 'deposit',
                'type'          => 'group',
                'admin_columns' => 'after total',
                'class'         => 'inline',
                'fields'        => [
                    [
                        'id'      => $prefix . 'percent',
                        'type'    => 'number',
                        'min'     => 0,
                        'max'     => 100,
                        'step'    => 'any',
                        'size'    => 5,
                        'prepend' => '%',
                    ],
                    [
                        'id'      => $prefix . 'amount',
                        'type'    => 'number',
                        'size'    => 10,
                        'prepend' => '€',
                    ],
                    [
                        'id'          => $prefix . 'before',
                        'type'        => 'date',
                        'placeholder' => __( 'Before', 'prestations' ),
                        'timestamp'   => true,
                    ],
                ],
            ],
            [
                'name'   => __( 'Payment', 'prestations' ),
                'id'     => $prefix . 'payment',
                'type'   => 'group',
                'clone'  => true,
                'class'  => 'inline',
                'fields' => [
                    [
                        'name' => __( 'Date', 'prestations' ),
                        'id'   => $prefix . 'date',
                        'type' => 'datetime',
                    ],
                    [
                        'name' => __( 'Amount', 'prestations' ),
                        'id'   => $prefix . 'amount',
                        'type' => 'number',
                        'min'  => 0,
                        'step' => 'any',
                        'size' => 10,
                    ],
                    [
                        'name' => __( 'Method', 'prestations' ),
                        'id'   => $prefix . 'method',
                        'type' => 'text',
                    ],
                    [
                        'name' => __( 'Reference', 'prestations' ),
                        'id'   => $prefix . 'reference',
                        'type' => 'text',
                    ],
                ],
            ],
            [
                'name'          => __( 'Paid', 'prestations' ),
                'id'            => $prefix . 'paid',
                'type'          => 'number',
                'min'           => 0,
                'step'          => 'any',
                'size'          => 10,
                'readonly'      => true,
                'admin_columns' => 'after deposit',
            ],
            [
                'name'          => __( 'Balance', 'prestations' ),
                'id'            => $prefix . 'balance',
                'type'          => 'number',
                'min'           => 0,
                'step'          => 'any',
                'size'          => 10,
                'readonly'      => true,
                'admin_columns' => [
                    'position' => 'after paid',
                    'sort'     => true,
                ],
            ],
            [
                'name'          => __( 'Status', 'prestations' ),
                'id'            => $prefix . 'status',
                'type'          => 'taxonomy',
                'taxonomy'      => ['prestation-status'],
                'field_type'    => 'select',
                'admin_columns' => [
                    'position'   => 'before source',
                    'sort'       => true,
                    'filterable' => true,
                ],
            ],
        ],
    ];

    return $meta_boxes;
	}

	static function register_taxonomies() {
		$labels = [
			'name'                       => esc_html__( 'Service Sources', 'prestations' ),
			'singular_name'              => esc_html__( 'Service Source', 'prestations' ),
			'menu_name'                  => esc_html__( 'Service Sources', 'prestations' ),
			'search_items'               => esc_html__( 'Search Service Sources', 'prestations' ),
			'popular_items'              => esc_html__( 'Popular Service Sources', 'prestations' ),
			'all_items'                  => esc_html__( 'All Service Sources', 'prestations' ),
			'parent_item'                => esc_html__( 'Parent Service Source', 'prestations' ),
			'parent_item_colon'          => esc_html__( 'Parent Service Source:', 'prestations' ),
			'edit_item'                  => esc_html__( 'Edit Service Source', 'prestations' ),
			'view_item'                  => esc_html__( 'View Service Source', 'prestations' ),
			'update_item'                => esc_html__( 'Update Service Source', 'prestations' ),
			'add_new_item'               => esc_html__( 'Add New Service Source', 'prestations' ),
			'new_item_name'              => esc_html__( 'New Service Source Name', 'prestations' ),
			'separate_items_with_commas' => esc_html__( 'Separate service sources with commas', 'prestations' ),
			'add_or_remove_items'        => esc_html__( 'Add or remove service sources', 'prestations' ),
			'choose_from_most_used'      => esc_html__( 'Choose most used service sources', 'prestations' ),
			'not_found'                  => esc_html__( 'No service sources found.', 'prestations' ),
			'no_terms'                   => esc_html__( 'No service sources', 'prestations' ),
			'filter_by_item'             => esc_html__( 'Filter by service source', 'prestations' ),
			'items_list_navigation'      => esc_html__( 'Service Sources list pagination', 'prestations' ),
			'items_list'                 => esc_html__( 'Service Sources list', 'prestations' ),
			'most_used'                  => esc_html__( 'Most Used', 'prestations' ),
			'back_to_items'              => esc_html__( '&larr; Go to Service Sources', 'prestations' ),
			'text_domain'                => esc_html__( 'prestations', 'prestations' ),
		];
		$args = [
			'label'              => esc_html__( 'Service Sources', 'prestations' ),
			'labels'             => $labels,
			'description'        => '',
			'public'             => false,
			'publicly_queryable' => false,
			'hierarchical'       => false,
			'show_ui'            => false,
			'show_in_menu'       => false,
			'show_in_nav_menus'  => false,
			'show_in_rest'       => false,
			'show_tagcloud'      => false,
			'show_in_quick_edit' => false,
			'show_admin_column'  => false,
			'query_var'          => false,
			'sort'               => false,
			'meta_box_cb'        => 'post_tags_meta_box',
			'rest_base'          => '',
			'rewrite'            => [
				'with_front'   => false,
				'hierarchical' => false,
			],
			'_builtin' => true,
		];
		register_taxonomy( 'service-source', ['service'], $args );
	}

	static function get_source_options() {
		return apply_filters('prestations_register_sources', array(
			'' => __( 'None', 'prestations' ),
		));
	}

	static function insert_service_data ($data, $postarr, $unsanitized_postarr, $update ) {
		if(!$update) return $data;
		if($data['post_type'] !== 'pr_service') return $data;

		$data = apply_filters('prestations_set_service_title', $data);

		return $data;
	}

	static function set_service_title ($data ) {
		// error_log(__CLASS__ . '::' . __FUNCTION__);
		// if(empty($_REQUEST['service_page_id'])) return $data;
		//
		// if(empty($data['post_title'])) {
		// 	$data['post_title'] = get_the_title($_REQUEST['service_page_id']);
		// 	$data['post_name'] = sanitize_title($data['post_title']);
		// }
		return $data;
	}

	static function save_post_action($post_id, $post, $update ) {
		if( !$update ) return;
		if( 'service' !== $post->post_type) return;

		remove_action(current_action(), __CLASS__ . '::' . __FUNCTION__);

		$service_info = get_post_meta($post->ID, 'customer', true);
		$prestation_id = get_post_meta($post_id, 'prestation', true);
		$prestation_info = array_filter(array(
			'user_id' => get_post_meta($prestation_id, 'customer_id', true),
			'name' => get_post_meta($prestation_id, 'guest_name', true),
			'email' => get_post_meta($prestation_id, 'guest_email', true),
			'phone' => get_post_meta($prestation_id, 'guest_phone', true),
		));
		$user_info = array_replace($service_info, $prestation_info);
		if($user_info != $service_info) {
			error_log(__FUNCTION__ . '::' . __FUNCTION__ . ' meta ' . print_r($user_info, true));
			update_post_meta( $post_id, 'customer', $user_info );
		}

		// $service = new Prestations_Service($post);
		// $service->set_prestation();

		add_action(current_action(), __CLASS__ . '::' . __FUNCTION__, 10, 3);
	}

	static function sanitize_service_meta( $meta_value, $meta_key, $object_type ) {
		switch($meta_key) {
			case 'customer':
			case 'guest':
			return Prestations::get_user_info_by_info($meta_value);
		}

		return $meta_value;
	}

	static function update_metadata_filter( $check, $object_id, $meta_key, $meta_value, $prev_value ) {
		return $check;
		//
		// if(get_post_type($object_id) != 'service') return $check;
		//
		// switch($meta_key) {
		// 	case 'customer':
		// 	$prestation_id = get_post_meta($object_id, 'prestation', true);
		// 	$prestation_info = array_filter(array(
		// 		'id' => get_post_meta($prestation_id, 'customer_id', true),
		// 		'name' => get_post_meta($prestation_id, 'guest_name', true),
		// 		'email' => get_post_meta($prestation_id, 'guest_email', true),
		// 		'phone' => get_post_meta($prestation_id, 'guest_phone', true),
		// 	));
		// 	$service_info = Prestations::get_user_info_by_info($meta_value);
		// 	$meta_value = array_replace($service_info, $prestation_info);
		// 	error_log("object $object_id user info " . print_r($meta_value, true) );
		// 	return $meta_value;
		// 	break;
		//
		// }
		// return $check;
	}

	function set_prestation($post = NULL) {
		$post = $this->post;
		if( $post->post_type != 'service' ) return;
		if( $post->post_status == 'trash' ) return; // TODO: update previously linked prestation

		// // remove_action(current_action(), __CLASS__ . '::wp_insert_post_action');

		$prestation_id = get_post_meta($post->ID, 'prestation_id', true);
		$prestation = get_post($prestation_id);


		$user_info = get_post_meta($post->ID, 'customer');
		error_log(__FUNCTION__ . '::' . __FUNCTION__ . ' meta ' . print_r($user_info, true));

		// $user_info = Prestations::get_user_info_by_info($user_info);
		// error_log('user info ' . print_r($user_info, true));
		// if($user) {
		// 	$user_info = array_replace($user_info, array_filter(array(
		// 		'name' => $user->display_name,
		// 		'email' => $user->user_email,
		// 		'phone' => get_user_meta($user->ID, 'billing_phone'),
		// 	)));
		// }

		// $customer_id = get_post_meta($this->ID, '_customer_user', true);
		// $customer = get_user_by('id', $customer_id);
		// if($customer) {
		// 	$customer_name = $customer->display_name;
		// 	$customer_email = $customer->user_email;
		// 	// error_log("customer " . print_r($customer, true));
		// } else {
		// 	$customer_name = trim(get_post_meta($this->ID, '_billing_first_name', true) . ' ' . get_post_meta($this->ID, '_billing_last_name', true));
		// 	$customer_email = get_post_meta($this->ID, '_billing_email', true);
		// }
		//
		// if(empty($prestation_id) || ! $prestation) {
		// 	$args = array(
		// 		'post_type' => 'prestation',
		// 		'post_status__in' => [ 'pending', 'on-hold', 'deposit', 'partial', 'unpaid', 'processing' ],
		// 		'serviceby' => 'post_date',
		// 		'service' => 'desc',
		// 	);
		// 	if($customer) {
		// 		$args['meta_query'] = array(
		// 			array(
		// 				'key' => 'customer_id',
		// 				'value' => $customer_id,
		// 			)
		// 		);
		// 	} else if (!empty($customer_email)) {
		// 		$args['meta_query'] = array(
		// 			'relation' => 'OR',
		// 			array(
		// 				'key' => 'customer_email',
		// 				'value' => $customer_email,
		// 			),
		// 			array(
		// 				'key' => 'guest_email',
		// 				'value' => $customer_email,
		// 			),
		// 		);
		// 	} else if (!empty($customer_name)) {
		// 		$args['meta_query'] = array(
		// 			'relation' => 'OR',
		// 			array(
		// 				'key' => 'customer_name',
		// 				'value' => $customer_name,
		// 			),
		// 			array(
		// 				'key' => 'guest_name',
		// 				'value' => $customer_name,
		// 			),
		// 		);
		// 	}
		// 	$prestations = get_posts($args);
		// 	if($prestations) {
		// 		$prestation = $prestations[0];
		// 		$prestation_id = $prestation->ID;
		// 		// error_log("$prestation->ID $prestation->post_title " . print_r($prestation, true));
		// 		// update_post_meta( $this->ID, 'prestation_id', $prestation_id );
		// 	}
		// }
		//
		// if(empty($prestation_id) || ! $prestation) {
		// 	$this->postarr = array(
		// 		'post_author' => $this->post->get_customer_id(),
		// 		'post_date' => $this->post->get_date_created(),
		// 		'post_date_gmt' => $this->post->post_date_gmt,
		// 		'post_type' => 'prestation',
		// 		'post_status' => 'publish',
		// 		'meta_input' => array(
		// 			'prestation_id' => $prestation_id,
		// 			'customer_id' => $customer_id,
		// 			'customer_name' => $customer_name,
		// 			'customer_email' => $customer_email,
		// 		),
		// 	);
		// 	$prestation_id = wp_insert_post($this->postarr);
		// 	// update_post_meta( $this->ID, 'prestation_id', $prestation_id );
		// 	// foreach ($this->postarr['meta_input'] as $key => $value) update_post_meta( $this->ID, $key, $value );
		// }
		//
		// if(!empty($prestation_id)) {
		// 	$meta = array(
		// 		'prestation_id' => $prestation_id,
		// 		'customer_id' => $customer_id,
		// 		'customer_name' => $customer_name,
		// 		'customer_email' => $customer_email,
		// 	);
		// 	// foreach ($meta as $key => $value) update_post_meta( $this->ID, $key, $value );
		// 	// Prestations_Service::update_prestation_services($prestation_id, get_post($prestation_id), true );
		// }
		//
		// // add_action(current_action(), __CLASS__ . '::wp_insert_post_action', 10, 3);
		return;
	}


}
