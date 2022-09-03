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
class MultiServices_Service {

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
			array(
				'hook' => 'admin_init',
				'callback' => 'add_custom_columns',
				'priority' => 20,
			),

			array (
				'hook' => 'save_post', // use save_post because save_post_service is fired before actual save and meta values are not yet updated
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
				'hook' => 'multiservices_set_service_title',
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

	static function dates_html($value = NULL, $field = []) {
		return "dates";
	}

	static function customer_html($value = NULL, $field = []) {
		if(is_object($value)) $post = $value;
		else global $post;

		if(is_array($value)) $customer_info = $value;
		else $customer_info = get_post_meta($post->ID, 'customer', true);

		$customer_html = '';
		if(is_array($customer_info)) {
			$customer_html  = join(' ', array_filter(array(
				(!empty($customer_info['user_id']))
				? sprintf(
					'<a href="%s">%s</a>',
					get_edit_profile_url($customer_info['user_id']),
					$customer_info['name'],
				) : $customer_info['name'],
				(empty($customer_info['email'])) ? NULL : sprintf('<a href="mailto:%1$s">%1$s</a>', $customer_info['email']),
				(empty($customer_info['phone'])) ? NULL : sprintf('<a href="tel:%1$s">%1$s</a>', $customer_info['phone']),
			)));
		}

		return $customer_html;
	}

	static function register_post_types() {
		$labels = [
			'name'                     => esc_html__('Services', 'multiservices' ),
			'singular_name'            => esc_html__('Service', 'multiservices' ),
			'add_new'                  => esc_html__('Add New', 'multiservices' ),
			'add_new_item'             => esc_html__('Add New Service', 'multiservices' ),
			'edit_item'                => esc_html__('Edit Service', 'multiservices' ),
			'new_item'                 => esc_html__('New Service', 'multiservices' ),
			'view_item'                => esc_html__('View Service', 'multiservices' ),
			'view_items'               => esc_html__('View Services', 'multiservices' ),
			'search_items'             => esc_html__('Search Services', 'multiservices' ),
			'not_found'                => esc_html__('No services found.', 'multiservices' ),
			'not_found_in_trash'       => esc_html__('No services found in Trash.', 'multiservices' ),
			'parent_item_colon'        => esc_html__('Parent Service:', 'multiservices' ),
			'all_items'                => esc_html__('Services', 'multiservices' ),
			'archives'                 => esc_html__('Service Archives', 'multiservices' ),
			'attributes'               => esc_html__('Service Attributes', 'multiservices' ),
			'insert_into_item'         => esc_html__('Insert into service', 'multiservices' ),
			'uploaded_to_this_item'    => esc_html__('Uploaded to this service', 'multiservices' ),
			'featured_image'           => esc_html__('Featured image', 'multiservices' ),
			'set_featured_image'       => esc_html__('Set featured image', 'multiservices' ),
			'remove_featured_image'    => esc_html__('Remove featured image', 'multiservices' ),
			'use_featured_image'       => esc_html__('Use as featured image', 'multiservices' ),
			'menu_name'                => esc_html__('Services', 'multiservices' ),
			'filter_items_list'        => esc_html__('Filter services list', 'multiservices' ),
			'filter_by_date'           => esc_html__('', 'multiservices' ),
			'items_list_navigation'    => esc_html__('Services list navigation', 'multiservices' ),
			'items_list'               => esc_html__('Services list', 'multiservices' ),
			'item_published'           => esc_html__('Service published.', 'multiservices' ),
			'item_published_privately' => esc_html__('Service published privately.', 'multiservices' ),
			'item_reverted_to_draft'   => esc_html__('Service reverted to draft.', 'multiservices' ),
			'item_scheduled'           => esc_html__('Service scheduled.', 'multiservices' ),
			'item_updated'             => esc_html__('Service updated.', 'multiservices' ),
			'text_domain' => 'multiservices',
		];
		$args = [
			'label'               => esc_html__('Services', 'multiservices' ),
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
		$js_date_format_short = preg_match('/^[Fm]/', get_option('date_format')) ? 'mm-dd-yy' : 'dd-mm-yy';

    $prefix = '';

    $meta_boxes[] = [
        'title'      => __('Services fields', 'multiservices' ),
        'id'         => 'services-fields',
        'post_types' => ['service'],
        'style'      => 'seamless',
        'fields'     => [
            [
                'id'       => $prefix . 'title_html',
                'type'     => 'custom_html',
                'callback' => 'MultiServices::title_html',
            ],
            [
                'name'          => __('Source', 'multiservices' ),
                'id'            => $prefix . 'source',
                'type'          => 'taxonomy',
                'taxonomy'      => ['service-source'],
                'field_type'    => 'select',
                'placeholder'   => __('None', 'multiservices' ),
                'admin_columns' => [
                    'position'   => 'replace date',
                    'sort'       => true,
                    'searchable' => true,
                    'filterable' => true,
                ],
            ],
            [
                'name'    => __('Source ID', 'multiservices' ),
                'id'      => $prefix . 'source_id',
                'type'    => 'text',
                'visible' => [
                    'when'     => [['source', '!=', '']],
                    'relation' => 'or',
                ],
            ],
            [
                'name'     => __('Source URL', 'multiservices' ),
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
                'name'    => __('Item ID', 'multiservices' ),
                'id'      => $prefix . 'item',
                'type'    => 'text',
                'class'   => 'inline',
                'visible' => [
                    'when'     => [['source', '!=', '']],
                    'relation' => 'or',
                ],
            ],
            [
                'name'    => __('Description', 'multiservices' ),
                'id'      => $prefix . 'description',
                'type'    => 'text',
                'visible' => [
                    'when'     => [['source', '=', '']],
                    'relation' => 'or',
                ],
            ],
            [
                'name'       => __('Prestation', 'multiservices' ),
                'id'         => $prefix . 'prestation',
                'type'       => 'post',
                'post_type'  => ['prestation'],
                'field_type' => 'select_advanced',
            ],
						[
                'name'          => __('Customer', 'multiservices' ),
                'id'            => $prefix . 'customer_display',
                'type'          => 'custom_html',
                'callback'      => __CLASS__ . '::customer_html',
                'admin_columns' => [
                    'position'   => 'after title',
                    // 'title'      => 'Customer',
                    'sort'       => true,
                    'searchable' => true,
                ],
								'visible'           => [
                    'when'     => [['prestation', '!=', '']],
                    'relation' => 'or',
                ],
            ],
						[
                'name'              => __('Customer', 'multiservices' ),
                'id'                => $prefix . 'customer',
                'type'              => 'group',
                'class'             => 'inline',
                'fields'            => [
                    [
                        'name'       => __('Existing User', 'multiservices' ),
                        'id'         => $prefix . 'user_id',
                        'type'       => 'user',
                        'field_type' => 'select_advanced',
                    ],
                    [
                        'name'          => __('Name', 'multiservices' ),
                        'id'            => $prefix . 'name',
                        'type'          => 'text',
                        'size'          => 30,
                        'admin_columns' => 'after title',
                    ],
                    [
                        'name' => __('Email', 'multiservices' ),
                        'id'   => $prefix . 'email',
                        'type' => 'email',
                        'size' => 30,
                    ],
                    [
                        'name' => __('Phone', 'multiservices' ),
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
                'name'              => __('Guest', 'multiservices' ),
                'id'                => $prefix . 'guest',
                'type'              => 'group',
                'class'             => 'inline',
								'desc'              => __('Fill only if different from customer.', 'multiservices' ),
                'fields'            => [
                    [
                        'name'       => __('Existing User', 'multiservices' ),
                        'id'         => $prefix . 'user_id',
                        'type'       => 'user',
                        'field_type' => 'select_advanced',
                    ],
                    [
                        'name'          => __('Name', 'multiservices' ),
                        'id'            => $prefix . 'name',
                        'type'          => 'text',
                        'size'          => 30,
                        // 'admin_columns' => 'after title',
                    ],
                    [
                        'name' => __('Email', 'multiservices' ),
                        'id'   => $prefix . 'email',
                        'type' => 'email',
                        'size' => 30,
                    ],
                    [
                        'name' => __('Phone', 'multiservices' ),
                        'id'   => $prefix . 'phone',
                        'type' => 'text',
                    ],
                ],
            ],
            [
                'id'   => $prefix . 'sep',
                'type' => 'custom_html',
                'std'  => '<hr>',
            ],
						[
                'name'          => __('Dates', 'multiservices' ),
                'id'            => $prefix . 'dates_admin_list',
                'type'          => 'admin_list_column',
                'admin_columns' => [
                    'position'   => 'before source',
                    'sort'       => true,
                ],
            ],
            [
                'name'          => __('Dates', 'multiservices' ),
                'id'            => $prefix . 'dates',
                'type'          => 'group',
                'class'         => 'inline',
                'fields'        => [
                    [
                        'name'      => __('From', 'multiservices' ),
                        'id'        => $prefix . 'from',
                        'type'      => 'datetime',
												'timestamp'     => true,
												'js_options'    => [
														'dateFormat' => $js_date_format_short,
												],
                    ],
                    [
                        'name'      => __('To', 'multiservices' ),
                        'id'        => $prefix . 'to',
                        'type'      => 'datetime',
												'timestamp'     => true,
												'js_options'    => [
														'dateFormat' => $js_date_format_short,
												],
                    ],
                ],
            ],
            [
                'name'   => __('Guests', 'multiservices' ),
                'id'     => $prefix . 'guests',
                'type'   => 'group',
                'class'  => 'inline',
                'fields' => [
                    [
                        'name'          => __('Total', 'multiservices' ),
                        'id'            => $prefix . 'total',
                        'type'          => 'number',
                        'min'           => 0,
                        'size'          => 5,
                    ],
                    [
                        'name' => __('Adults', 'multiservices' ),
                        'id'   => $prefix . 'adults',
                        'type' => 'number',
                        'min'  => 0,
                        'size' => 5,
                    ],
                    [
                        'name' => __('Children', 'multiservices' ),
                        'id'   => $prefix . 'children',
                        'type' => 'number',
                        'min'  => 0,
                        'size' => 5,
                    ],
                    [
                        'name' => __('Babies', 'multiservices' ),
                        'id'   => $prefix . 'babies',
                        'type' => 'number',
                        'min'  => 0,
                        'size' => 5,
                    ],
                ],
            ],
            [
							'name'   => __('Guests', 'multiservices' ),
                'id'            => $prefix . 'guests_display',
                'type'          => 'admin_list_column',
                'admin_columns' => [
                    'position' => 'after customer_display',
                    'sort'     => true,
                ],
            ],
            [
                'name'   => __('Beds', 'multiservices' ),
                'id'     => $prefix . 'beds',
                'type'   => 'group',
                'class'  => 'inline',
                'fields' => [
                    [
                        'name' => __('Double', 'multiservices' ),
                        'id'   => $prefix . 'double',
                        'type' => 'number',
                        'min'  => 0,
                        'size' => 5,
                    ],
                    [
                        'name' => __('Single', 'multiservices' ),
                        'id'   => $prefix . 'single',
                        'type' => 'number',
                        'min'  => 0,
                        'size' => 5,
                    ],
                    [
                        'name' => __('Baby', 'multiservices' ),
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
                'name'   => __('Price', 'multiservices' ),
                'id'     => $prefix . 'price',
                'type'   => 'group',
                'class'  => 'inline',
                'fields' => [
                    [
                        'name' => __('Quantity', 'multiservices' ),
                        'id'   => $prefix . 'quantity',
                        'type' => 'number',
                        'min'  => 0,
                        'step' => 'any',
                        'size' => 5,
                    ],
                    [
                        'name' => __('Unit Price', 'multiservices' ),
                        'id'   => $prefix . 'unit',
                        'type' => 'number',
                        'min'  => 0,
                        'step' => 'any',
                        'size' => 10,
                    ],
                    [
                        'name'     => __('Subtotal', 'multiservices' ),
                        'id'       => $prefix . 'subtotal',
                        'type'     => 'number',
                        'size'     => 10,
                        'readonly' => true,
                    ],
                ],
            ],
            [
                'name'   => __('Discount', 'multiservices' ),
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
                'name'          => __('Total', 'multiservices' ),
                'id'            => $prefix . 'total',
                'type'          => 'number',
                'min'           => 0,
                'step'          => 'any',
                'size'          => 10,
                'readonly'      => true,
                'admin_columns' => [
                    'position' => 'before source',
                    'sort'     => true,
                ],
            ],
            [
                'name'          => __('Deposit', 'multiservices' ),
                'id'            => $prefix . 'deposit',
                'type'          => 'group',
                // 'admin_columns' => 'after total',
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
                        'placeholder' => __('Before', 'multiservices' ),
												'timestamp'     => true,
												'js_options'    => [
														'dateFormat' => $js_date_format_short,
												],
                    ],
                ],
            ],
            [
                'name'   => __('Payment', 'multiservices' ),
                'id'     => $prefix . 'payment',
                'type'   => 'group',
                'clone'  => true,
                'class'  => 'inline',
                'fields' => [
                    [
                        'name' => __('Date', 'multiservices' ),
                        'id'   => $prefix . 'date',
                        'type' => 'datetime',
												'timestamp'     => true,
												'js_options'    => [
														'dateFormat' => $js_date_format_short,
												],
                    ],
                    [
                        'name' => __('Amount', 'multiservices' ),
                        'id'   => $prefix . 'amount',
                        'type' => 'number',
                        'min'  => 0,
                        'step' => 'any',
                        'size' => 10,
                    ],
                    [
                        'name' => __('Method', 'multiservices' ),
                        'id'   => $prefix . 'method',
                        'type' => 'text',
                    ],
                    [
                        'name' => __('Reference', 'multiservices' ),
                        'id'   => $prefix . 'reference',
                        'type' => 'text',
                    ],
                ],
            ],
						[
                'name'          => __('Deposit', 'multiservices' ),
                'id'            => $prefix . 'deposit_amount',
                'type'          => 'admin_list_column',
                'admin_columns' => [
                    'position'   => 'before source',
                    'sort'       => true,
                ],
            ],
            [
                'name'          => __('Paid', 'multiservices' ),
                'id'            => $prefix . 'paid',
                'type'          => 'number',
                'min'           => 0,
                'step'          => 'any',
                'size'          => 10,
                'readonly'      => true,
                'admin_columns' => 'after deposit_amount',
            ],
            [
                'name'          => __('Balance', 'multiservices' ),
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
                'name'          => __('Status', 'multiservices' ),
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

	static function add_custom_columns() {
		new MultiServices_Service_Admin_Columns( 'service', array() );
	}

	static function register_taxonomies() {
		$labels = [
			'name'                       => esc_html__('Service Sources', 'multiservices' ),
			'singular_name'              => esc_html__('Service Source', 'multiservices' ),
			'menu_name'                  => esc_html__('Service Sources', 'multiservices' ),
			'search_items'               => esc_html__('Search Service Sources', 'multiservices' ),
			'popular_items'              => esc_html__('Popular Service Sources', 'multiservices' ),
			'all_items'                  => esc_html__('All Service Sources', 'multiservices' ),
			'parent_item'                => esc_html__('Parent Service Source', 'multiservices' ),
			'parent_item_colon'          => esc_html__('Parent Service Source:', 'multiservices' ),
			'edit_item'                  => esc_html__('Edit Service Source', 'multiservices' ),
			'view_item'                  => esc_html__('View Service Source', 'multiservices' ),
			'update_item'                => esc_html__('Update Service Source', 'multiservices' ),
			'add_new_item'               => esc_html__('Add New Service Source', 'multiservices' ),
			'new_item_name'              => esc_html__('New Service Source Name', 'multiservices' ),
			'separate_items_with_commas' => esc_html__('Separate service sources with commas', 'multiservices' ),
			'add_or_remove_items'        => esc_html__('Add or remove service sources', 'multiservices' ),
			'choose_from_most_used'      => esc_html__('Choose most used service sources', 'multiservices' ),
			'not_found'                  => esc_html__('No service sources found.', 'multiservices' ),
			'no_terms'                   => esc_html__('No service sources', 'multiservices' ),
			'filter_by_item'             => esc_html__('Filter by service source', 'multiservices' ),
			'items_list_navigation'      => esc_html__('Service Sources list pagination', 'multiservices' ),
			'items_list'                 => esc_html__('Service Sources list', 'multiservices' ),
			'most_used'                  => esc_html__('Most Used', 'multiservices' ),
			'back_to_items'              => esc_html__('&larr; Go to Service Sources', 'multiservices' ),
			'text_domain' => 'multiservices',
		];
		$args = [
			'label'              => esc_html__('Service Sources', 'multiservices' ),
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
		return apply_filters('multiservices_register_sources', array(
			'' => __('None', 'multiservices' ),
		));
	}

	static function insert_service_data ($data, $postarr, $unsanitized_postarr, $update ) {
		if(!$update) return $data;
		if($data['post_type'] !== 'pr_service') return $data;

		$data = apply_filters('multiservices_set_service_title', $data);

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
		error_log(__CLASS__ . '::' . __FUNCTION__);
		if( !$update ) return;
		if( 'service' !== $post->post_type) return;

		remove_action(current_action(), __CLASS__ . '::' . __FUNCTION__);

		$prestation_id = get_post_meta($post_id, 'prestation', true);
		$service_info = get_post_meta($post_id, 'customer', true);
		if($prestation_id) {
			$user_info = array_filter(array(
				'user_id' => get_post_meta($prestation_id, 'customer_id', true),
				'name' => get_post_meta($prestation_id, 'guest_name', true),
				'email' => get_post_meta($prestation_id, 'guest_email', true),
				'phone' => get_post_meta($prestation_id, 'guest_phone', true),
			));
		} else {
			$user_info = $service_info;
		}
		if($user_info != $service_info) {
			// error_log(__FUNCTION__ . '::' . __FUNCTION__ . ' meta ' . print_r($user_info, true));
			update_post_meta( $post_id, 'customer', $user_info );
		}
		$customer_html  = self::customer_html($post);
		update_post_meta( $post_id, 'customer_display', $customer_html );

		$updates = [];
		$price = get_post_meta($post_id, 'price', true);
		if($price) {
			error_log('price ' . print_r($price, true));
			$unit_price = isset($price['unit']) ? $price['unit']: NULL;
			$qty = isset($price['quantity']) ? $price['quantity'] : ( isset($price['unit']) ? 1 : NULL);
			$sub_total = $qty * $unit_price;
			$updates['price'] = array_merge($price, array(
				'subtotal' => $sub_total,
			));

			$discount = get_post_meta($post_id, 'discount', true);
			$discount_percent = isset($discount['percent']) ? $discount['percent']: NULL;
			if(isset($discount['percent'])) {
				$discount_amount = $sub_total * $discount_percent / 100;
			} else {
				$discount['amount'] = ( isset($discount['amount']) ? $discount['amount'] : NULL);
			}
			$updates['discount'] = array_merge($discount, array(
				'amount' => $discount_amount,
			));

			$updates['total'] = $total = $sub_total - $discount_amount;

			$deposit = get_post_meta($post_id, 'deposit', true);
			$deposit_percent = isset($deposit['percent']) ? $deposit['percent']: NULL;
			if(isset($deposit['percent'])) {
				$deposit_amount = $total * $deposit_percent / 100;
			} else {
				$deposit['amount'] = ( isset($deposit['amount']) ? $deposit['amount'] : NULL);
			}
			$updates['deposit'] = array_merge($deposit, array(
				'amount' => $deposit_amount,
			));

			$payments = get_post_meta($post_id, 'payment', true);
			$paid = NULL;
			foreach ($payments as $key => $payment) {
				if(isset($payment['amount'])) $paid += $payment['amount'];
				// code...
			}
			error_log("payment " . print_r($payment, true));
			$updates['paid'] = $paid;
			$updates['balance'] = $total - $paid;
		}
		error_log("updates " . print_r($updates, true));

		if(!empty($updates)) {
			$post_update = array(
				'ID' => $post_id,
				// 'post_title' => trim($display_name . ' ' . "#" . ((empty($post->post_name)) ? $post_id : $post->post_name)),
				// 'post_status' => $post_status,
				'meta_input' => $updates,
				// 'tax_input' => array(
				// 	'prestation-status' => $paid_status,
				// ),
			);

			wp_update_post($post_update);
			/*
			* TODO: get why metadata and taxonomies are not saved with wp_update_post
			* In the meantime, we force the update
			*/
			// foreach ($updates as $key => $value) update_post_meta( $post_id, $key, $value );
			// wp_set_object_terms( $post_id, $paid_status, 'prestation-status');
			//
		}
		// $metas['subtotal'] = get_post_meta($post_id, 'prestation', true);
		// $service = new MultiServices_Service($post);
		// $service->set_prestation();

		add_action(current_action(), __CLASS__ . '::' . __FUNCTION__, 10, 3);
	}

	static function sanitize_service_meta( $meta_value, $meta_key, $object_type ) {
		switch($meta_key) {
			case 'customer':
			case 'guest':
			return MultiServices::get_user_info_by_info($meta_value);
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
		// 	$service_info = MultiServices::get_user_info_by_info($meta_value);
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

		// $user_info = MultiServices::get_user_info_by_info($user_info);
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
		// 	// MultiServices_Service::update_prestation_services($prestation_id, get_post($prestation_id), true );
		// }
		//
		// // add_action(current_action(), __CLASS__ . '::wp_insert_post_action', 10, 3);
		return;
	}


}

class MultiServices_Service_Admin_Columns extends \MBAC\Post {
    // public function columns( $columns ) {
    //     $columns  = parent::columns( $columns );
    //     $position = '';
    //     $target   = '';
    //     $this->add( $columns, 'deposit', __('Deposit', 'multiservices'), $position, $target );
    //     // Add more if you want
    //     return $columns;
    // }

    public function show( $column, $post_id ) {
        switch ( $column ) {
					case 'dates_admin_list':
					echo MultiServices::format_date_range(get_post_meta($post_id, 'dates', true));
					break;

					case 'guests_display';
					$guests = get_post_meta($post_id, 'guests', true);
					if(is_array($guests) && isset($guests['total'])) echo $guests['total'];
					break;

					case 'deposit_amount';
					$deposit = get_post_meta($post_id, 'deposit', true);
					if(is_array($deposit) && isset($deposit['amount'])) echo $deposit['amount'];
					break;
        }
    }
}
