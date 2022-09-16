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
class Mltp_Item {

	/**
	 * The array of actions registered with WordPress.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      array    $actions    The actions registered with WordPress to fire when the plugin loads.
	 */
	// protected $actions;

	/**
	 * The array of filters registered with WordPress.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      array    $filters    The filters registered with WordPress to fire when the plugin loads.
	 */
	// protected $filters;

	// protected $ID;
	// protected $post;

	/**
	 * Initialize the collections used to maintain the actions and filters.
	 *
	 * @since    1.0.0
	 */
	public function __construct($args = NULL) {
		$this->post = $this->get($args);
		if($this->post) $this->ID = $this->post->ID;

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
				'hook' => 'save_post', // use save_post because save_post_prestation_item is fired before actual save and meta values are not yet updated
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
				'callback' => 'insert_prestation_item_data',
				'accepted_args' => 4,
			),
			// array(
			// 	'hook' => 'update_post_metadata',
			// 	'callback' => 'update_metadata_filter',
			// 	'accepted_args' => 5,
			// ),

			array(
				'hook' => 'sanitize_post_meta_customer_for_prestation_item',
				'callback' => 'sanitize_prestation_item_meta',
				'accepted_args' => 3,
			),
			array(
				'hook' => 'sanitize_post_meta_attendee_for_prestation_item',
				'callback' => 'sanitize_prestation_item_meta',
				'accepted_args' => 3,
			),

			array(
				'hook' => 'multiservices_set_prestation_item_title',
				'callback' => 'set_prestation_item_title',
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

	static function item_links_html($value = NULL, $field = []) {
		if(is_object($value)) $post = $value;
		else global $post;
		if(!$post) return;

		$source = get_post_meta($post->ID, 'source', true);
		$term = get_term_by('slug', $source, 'prestation-item-source');
		$source_name = $term->name;
		if($field['format'] == 'icon') {
			$links = array_filter(array(
				'<a class="dashicons dashicons-visibility" href="%s"></a>' => get_post_meta($post->ID, 'view_url', true),
				'<a class="dashicons dashicons-edit" href="%s"></a>' => get_post_meta($post->ID, 'edit_url', true),
			));
		} else {
			$links = array_filter(array(
				__('View %s item', 'multiservices') => get_post_meta($post->ID, 'view_url', true),
				__('Edit %s item', 'multiservices') => get_post_meta($post->ID, 'edit_url', true),
			));
		}
		$links_html = [];
		foreach($links as $label => $link) {
			$links_html[] = sprintf(
				'<a href="%s">%s</a>',
				$link,
				sprintf($label, $source_name),
			);
		}
		return join(' ', $links_html);
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
			'name'                     => esc_html__('Prestations Parts', 'multiservices' ),
			'singular_name'            => esc_html__('Prestation Item', 'multiservices' ),
			'add_new'                  => esc_html__('Add New', 'multiservices' ),
			'add_new_item'             => esc_html__('Add New Part', 'multiservices' ),
			'edit_item'                => esc_html__('Edit Part', 'multiservices' ),
			'new_item'                 => esc_html__('New Part', 'multiservices' ),
			'view_item'                => esc_html__('View Part', 'multiservices' ),
			'view_items'               => esc_html__('View Parts', 'multiservices' ),
			'search_items'             => esc_html__('Search Parts', 'multiservices' ),
			'not_found'                => esc_html__('No prestation_items found.', 'multiservices' ),
			'not_found_in_trash'       => esc_html__('No prestation_items found in Trash.', 'multiservices' ),
			'parent_item_colon'        => esc_html__('Parent Part:', 'multiservices' ),
			'all_items'                => esc_html__('Prestations Parts', 'multiservices' ),
			'archives'                 => esc_html__('Parts Archives', 'multiservices' ),
			'attributes'               => esc_html__('Part Attributes', 'multiservices' ),
			'insert_into_item'         => esc_html__('Insert into prestation_item', 'multiservices' ),
			'uploaded_to_this_item'    => esc_html__('Uploaded to this prestation_item', 'multiservices' ),
			'featured_image'           => esc_html__('Featured image', 'multiservices' ),
			'set_featured_image'       => esc_html__('Set featured image', 'multiservices' ),
			'remove_featured_image'    => esc_html__('Remove featured image', 'multiservices' ),
			'use_featured_image'       => esc_html__('Use as featured image', 'multiservices' ),
			'menu_name'                => esc_html__('Prestations Parts', 'multiservices' ),
			'filter_items_list'        => esc_html__('Filter prestation_items list', 'multiservices' ),
			'filter_by_date'           => esc_html__('', 'multiservices' ),
			'items_list_navigation'    => esc_html__('Parts list navigation', 'multiservices' ),
			'items_list'               => esc_html__('Parts list', 'multiservices' ),
			'item_published'           => esc_html__('Part published.', 'multiservices' ),
			'item_published_privately' => esc_html__('Part published privately.', 'multiservices' ),
			'item_reverted_to_draft'   => esc_html__('Part reverted to draft.', 'multiservices' ),
			'item_scheduled'           => esc_html__('Part scheduled.', 'multiservices' ),
			'item_updated'             => esc_html__('Part updated.', 'multiservices' ),
			'text_domain' => 'multiservices',
		];
		$args = [
			'label'               => esc_html__('Parts', 'multiservices' ),
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

		register_post_type( 'prestation-item', $args );
	}

	static function register_fields( $meta_boxes ) {
		$js_date_format_short = preg_match('/^[Fm]/', get_option('date_format')) ? 'mm-dd-yy' : 'dd-mm-yy';
    $prefix = '';

		$meta_boxes['prestation_item'] = [
			'title'      => __('Parts fields', 'multiservices' ),
			'id'         => 'prestation_item',
			'post_types' => [ 'prestation-item' ],
			'style'      => 'seamless',
			'fields'     => [
				[
					'id'       => $prefix . 'title_html',
					'type'     => 'custom_html',
					'callback' => 'MultiPass::title_html',
				],
				[
					'name'          => __('Source', 'multiservices' ),
					'id'            => $prefix . 'source',
					'type'          => 'taxonomy',
					'taxonomy'      => ['prestation-item-source'],
					'field_type'    => 'select',
					'placeholder'   => _x('None', '(prestation_item) source', 'multiservices' ),
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
					'readonly' => true,
					'visible' => [
					    'when'     => [['source', '!=', '']],
					    'relation' => 'and',
					],
				],
				[
					'name'    => __('Source Item ID', 'multiservices' ),
					'id'      => $prefix . 'source_item_id',
					'type'    => 'text',
					'readonly' => true,
					'visible' => [
					    'when'     => [['source', '!=', '']],
					    'relation' => 'and',
					],
				],
				[
					'name'    => __('Links', 'multiservices' ),
					'id'      => $prefix . 'links',
					'type'          => 'custom_html',
					'callback'      => __CLASS__ . '::item_links_html',
					'visible' => [
						'when'     => [['source', '!=', '']],
						'relation' => 'and',
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
					'id'         => $prefix . 'prestation_id',
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
						'when'     => [['prestation_id', '!=', '']],
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
						'when'     => [['prestation_id', '=', '']],
						'relation' => 'or',
					],
				],
				[
					'name'              => __('Attendee', 'multiservices' ),
					'id'                => $prefix . 'attendee',
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
					'type'          => 'hidden',
					'disabled' => true,
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
					'name'   => __('Number of Attendees', 'multiservices' ),
					'id'     => $prefix . 'attendees',
					'type'   => 'group',
					'class'  => 'inline',
					'fields' => [
						[
							'name'          => __('Total', 'multiservices' ),
							'id'            => $prefix . 'total',
							'type'          => 'number',
							'min'           => 0,
							'size'          => 5,
							'readonly' => true,
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
					'name'   => __('# Attendees', 'multiservices' ),
					'id'            => $prefix . 'attendees_display',
					'type'          => 'hidden',
					'disabled' => true,
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
							'step' => 'any',
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
							'step'    => 'any',
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
					'type'          => 'hidden',
					'disabled' => true,
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
		new Mltp_Item_Admin_Columns( 'prestation_item', array() );
	}

	static function register_taxonomies() {
		$labels = [
			'name'                       => esc_html__('Part Sources', 'multiservices' ),
			'singular_name'              => esc_html__('Part Source', 'multiservices' ),
			'menu_name'                  => esc_html__('Part Sources', 'multiservices' ),
			'search_items'               => esc_html__('Search Part Sources', 'multiservices' ),
			'popular_items'              => esc_html__('Popular Part Sources', 'multiservices' ),
			'all_items'                  => esc_html__('All Part Sources', 'multiservices' ),
			'parent_item'                => esc_html__('Parent Part Source', 'multiservices' ),
			'parent_item_colon'          => esc_html__('Parent Part Source:', 'multiservices' ),
			'edit_item'                  => esc_html__('Edit Part Source', 'multiservices' ),
			'view_item'                  => esc_html__('View Part Source', 'multiservices' ),
			'update_item'                => esc_html__('Update Part Source', 'multiservices' ),
			'add_new_item'               => esc_html__('Add New Part Source', 'multiservices' ),
			'new_item_name'              => esc_html__('New Part Source Name', 'multiservices' ),
			'separate_items_with_commas' => esc_html__('Separate prestation_item sources with commas', 'multiservices' ),
			'add_or_remove_items'        => esc_html__('Add or remove prestation_item sources', 'multiservices' ),
			'choose_from_most_used'      => esc_html__('Choose most used prestation_item sources', 'multiservices' ),
			'not_found'                  => esc_html__('No prestation_item sources found.', 'multiservices' ),
			'no_terms'                   => esc_html__('No prestation_item sources', 'multiservices' ),
			'filter_by_item'             => esc_html__('Filter by prestation_item source', 'multiservices' ),
			'items_list_navigation'      => esc_html__('Part Sources list pagination', 'multiservices' ),
			'items_list'                 => esc_html__('Part Sources list', 'multiservices' ),
			'most_used'                  => esc_html__('Most Used', 'multiservices' ),
			'back_to_items'              => esc_html__('&larr; Go to Part Sources', 'multiservices' ),
			'text_domain' => 'multiservices',
		];
		$args = [
			'label'              => esc_html__('Part Sources', 'multiservices' ),
			'labels'             => $labels,
			'description'        => '',
			'public'             => false,
			'publicly_queryable' => false,
			'hierarchical'       => false,
			'show_ui'            => true, // false,
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
		register_taxonomy( 'prestation-item-source', ['prestation-item'], $args );

		MultiPass::register_terms('prestation-item-source');

	}

	static function insert_prestation_item_data ($data, $postarr, $unsanitized_postarr, $update ) {
		if(!$update) return $data;
		if($data['post_type'] !== 'prestation-item') return $data;

		$data = apply_filters('multiservices_set_prestation_item_title', $data);

		return $data;
	}

	static function set_prestation_item_title ($data ) {
		// error_log(__CLASS__ . '::' . __FUNCTION__);
		// if(empty($_REQUEST['prestation_item_page_id'])) return $data;
		//
		// if(empty($data['post_title'])) {
		// 	$data['post_title'] = get_the_title($_REQUEST['prestation_item_page_id']);
		// 	$data['post_name'] = sanitize_title($data['post_title']);
		// }
		return $data;
	}

	static function save_post_action($post_id, $post, $update ) {
		if( !$update ) return;
		if( 'prestation-item' !== $post->post_type) return;
		if( 'trash' == $post->post_status) return;

		remove_action(current_action(), __CLASS__ . '::' . __FUNCTION__);

		$prestation_id = get_post_meta($post_id, 'prestation_id', true);
		$prestation_item_info = get_post_meta($post_id, 'customer', true);
		if($prestation_id) {
			$user_info = array_filter(array(
				'user_id' => get_post_meta($prestation_id, 'customer_id', true),
				'name' => get_post_meta($prestation_id, 'attendee_name', true),
				'email' => get_post_meta($prestation_id, 'attendee_email', true),
				'phone' => get_post_meta($prestation_id, 'attendee_phone', true),
			));
		} else {
			$user_info = $prestation_item_info;
		}
		if($user_info != $prestation_item_info) {
			// error_log(__FUNCTION__ . '::' . __FUNCTION__ . ' meta ' . print_r($user_info, true));
			update_post_meta( $post_id, 'customer', $user_info );
		}
		$customer_html  = self::customer_html($post);
		update_post_meta( $post_id, 'customer_display', $customer_html );

		$updates = [];
		$price = get_post_meta($post_id, 'price', true);
		if($price) {
			$unit_price = isset($price['unit']) ? $price['unit']: NULL;
			$qty = isset($price['quantity']) ? $price['quantity'] : ( isset($price['unit']) ? 1 : NULL);
			$sub_total = $qty * $unit_price;
			$updates['price'] = array_merge($price, array(
				'subtotal' => $sub_total,
			));

			$discount = get_post_meta($post_id, 'discount', true);
			if(!is_array($discount)) $discount = [ 'amount' => NULL ];
			$discount_percent = isset($discount['percent']) ? $discount['percent']: NULL;
			if(isset($discount['percent'])) {
				$discount_amount = $sub_total * $discount_percent / 100;
			}
			$updates['discount'] = array_merge($discount, array(
				'amount' => $discount_amount,
			));

			$updates['total'] = $total = $sub_total - $discount_amount;

			$deposit = get_post_meta($post_id, 'deposit', true);
			if(!is_array($deposit)) $deposit = [ 'amount' => NULL ];

			$deposit_percent = isset($deposit['percent']) ? $deposit['percent']: NULL;
			if(isset($deposit['percent'])) {
				$deposit_amount = $total * $deposit_percent / 100;
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
			$updates['paid'] = $paid;
			$updates['balance'] = $total - $paid;
		}

		$attendees = get_post_meta($post_id, 'attendees', true);
		if($attendees) {
			$attendees = array_replace(array(
				'total' => NULL,
			), $attendees );
			$count = array_replace(array(
				'adults' => 0,
				'children' => 0,
				'babies' => 0,
			), $attendees );
			$total_attendees = $count['adults'] + $count['children'] + $count['babies'];
			if($total_attendees == 0) $total_attendees = NULL;
			if($total_attendees != $attendees['total']) {
				$attendees['total'] = $total_attendees;
				$updates['attendees'] = $attendees;
			}
		}

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
		// $metas['subtotal'] = get_post_meta($post_id, 'prestation_id', true);
		// $part = new Mltp_Item($post);
		// $prestation_item->set_prestation();

		add_action(current_action(), __CLASS__ . '::' . __FUNCTION__, 10, 3);
	}

	static function sanitize_prestation_item_meta( $meta_value, $meta_key, $object_type ) {
		switch($meta_key) {
			case 'customer':
			case 'attendee':
			return MultiPass::get_user_info_by_info($meta_value);
		}

		return $meta_value;
	}

	static function update_metadata_filter( $check, $object_id, $meta_key, $meta_value, $prev_value ) {
		return $check;
		//
		// if(get_post_type($object_id) != 'prestation-item') return $check;
		//
		// switch($meta_key) {
		// 	case 'customer':
		// 	$prestation_id = get_post_meta($object_id, 'prestation_id', true);
		// 	$prestation_info = array_filter(array(
		// 		'id' => get_post_meta($prestation_id, 'customer_id', true),
		// 		'name' => get_post_meta($prestation_id, 'attendee_name', true),
		// 		'email' => get_post_meta($prestation_id, 'attendee_email', true),
		// 		'phone' => get_post_meta($prestation_id, 'attendee_phone', true),
		// 	));
		// 	$prestation_item_info = MultiPass::get_user_info_by_info($meta_value);
		// 	$meta_value = array_replace($prestation_item_info, $prestation_info);
		// 	error_log("object $object_id user info " . print_r($meta_value, true) );
		// 	return $meta_value;
		// 	break;
		//
		// }
		// return $check;
	}

	function set_prestation($post = NULL) {
		$post = $this->post;
		if( $post->post_type != 'prestation-item' ) return;
		if( $post->post_status == 'trash' ) return; // TODO: update previously linked prestation

		// // remove_action(current_action(), __CLASS__ . '::wp_insert_post_action');

		$prestation_id = get_post_meta($post->ID, 'prestation_id', true);
		$prestation = get_post($prestation_id);

		$user_info = get_post_meta($post->ID, 'customer');
		error_log(__FUNCTION__ . '::' . __FUNCTION__ . ' meta ' . print_r($user_info, true));

		// $user_info = MultiPass::get_user_info_by_info($user_info);
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
		// 		'orderby' => 'post_date',
		// 		'order' => 'desc',
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
		// 				'key' => 'attendee_email',
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
		// 				'key' => 'attendee_name',
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
		// 	// Mltp_Item::update_prestation_prestation_items($prestation_id, get_post($prestation_id), true );
		// }
		//
		// // add_action(current_action(), __CLASS__ . '::wp_insert_post_action', 10, 3);
		return;
	}

	function get($args) {
		$prestation_item = NULL;
		switch(gettype($args)) {
			case 'object':
			$post = $args;
			if(isset($post->post_type) && $post->post_type == 'prestation-item')
			$prestation_item = $args;
			break;

			case 'integer':
			$post = get_post($args);
			if(isset($post->post_type) && $post->post_type == 'prestation-item')
			$prestation_item = $post;
			break;

			case 'array':
			$source_term_id = (empty($args['source'])) ? NULL : get_term_by('slug', $args['source'], 'prestation-item-source');
			$query_args = array(
				'post_type' => 'prestation-item',
				'post_status' => 'publish',
				'numberposts' => 1,
				'orderby' => 'post_date',
				'order' => 'asc',
				'tax_query' => array(array(
					'taxonomy' => 'prestation-item-source',
					'field' => 'slug',
					'terms' => [ $args['source'] ],
					'operator' => 'IN',
				)),
				'meta_query' => array(
					'relation' => 'AND',
					array(
						'key' => 'source_id',
						'value' => $args['source_id'],
					),
					array(
						'key' => 'source_item_id',
						'value' => $args['source_item_id'],
					),
				),
			);
			$prestation_items = get_posts($query_args);
			if($prestation_items) {
				$prestation_item = reset($prestation_items);
			} else {
				$postarr = array(
					'post_author' => $args['customer']['user_id'],
					'post_title' => sprintf(
						'#%s-%s %s',
						$args['source_id'],
						$args['source_item_id'],
						$args['description'],
					),
					// 'post_date' => esc_attr($args['date']),
					// 'post_date_gmt' => esc_attr($args['date_gmt']),
					'post_type' => 'prestation-item',
					'post_status' => 'publish',
					'meta_input' => $args,
					'tax_input' => array(
						'prestation-item-source' => $args['source'],
					),
				);

				$prestation_item_id = wp_insert_post($postarr);
				$prestation_item = get_post($prestation_item_id);
			}
			break;

		}

		// if(!empty($prestation_item)) {
		// 	$this->post = $prestation_item;
		// 	$this->ID = $prestation_item->ID;
		// }
		return $prestation_item;
	}
}

class Mltp_Item_Admin_Columns extends \MBAC\Post {
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
					echo MultiPass::format_date_range(get_post_meta($post_id, 'dates', true));
					break;

					case 'attendees_display';
					$attendees = get_post_meta($post_id, 'attendees', true);
					if(is_array($attendees) && isset($attendees['total'])) echo $attendees['total'];
					break;

					case 'deposit_amount';
					$deposit = get_post_meta($post_id, 'deposit', true);
					if(is_array($deposit) && isset($deposit['amount'])) echo $deposit['amount'];
					break;
        }
    }
}
