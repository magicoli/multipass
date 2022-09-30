<?php
/**
 * Register all actions and filters for the plugin
 *
 * @link       https://github.com/magicoli/multipass
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
 * @author     Magiiic <info@magiiic.com>
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
	public function __construct( $args = null, $update = false ) {
		if ( empty( $args ) ) {
			return false;
		}
		$this->post = $this->get( $args, $update );
		if ( $this->post ) {
			$this->id = $this->post->ID;
			$this->name = $this->post->post_title;
		}
	}

	/**
	 * Add a new action to the collection to be registered with WordPress.
	 *
	 * @since    1.0.0
	 * @param    string $hook             The name of the WordPress action that is being registered.
	 * @param    object $component        A reference to the instance of the object on which the action is defined.
	 * @param    string $callback         The name of the function definition on the $component.
	 * @param    int    $priority         Optional. The priority at which the function should be fired. Default is 10.
	 * @param    int    $accepted_args    Optional. The number of arguments that should be passed to the $callback. Default is 1.
	 */
	public function add_action( $hook, $component, $callback, $priority = 10, $accepted_args = 1 ) {
		$this->actions = $this->add( $this->actions, $hook, $component, $callback, $priority, $accepted_args );
	}

	/**
	 * Add a new filter to the collection to be registered with WordPress.
	 *
	 * @since    1.0.0
	 * @param    string $hook             The name of the WordPress filter that is being registered.
	 * @param    object $component        A reference to the instance of the object on which the filter is defined.
	 * @param    string $callback         The name of the function definition on the $component.
	 * @param    int    $priority         Optional. The priority at which the function should be fired. Default is 10.
	 * @param    int    $accepted_args    Optional. The number of arguments that should be passed to the $callback. Default is 1
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
	 * @param    array  $hooks            The collection of hooks that is being registered (that is, actions or filters).
	 * @param    string $hook             The name of the WordPress filter that is being registered.
	 * @param    object $component        A reference to the instance of the object on which the filter is defined.
	 * @param    string $callback         The name of the function definition on the $component.
	 * @param    int    $priority         The priority at which the function should be fired.
	 * @param    int    $accepted_args    The number of arguments that should be passed to the $callback.
	 * @return   array                                  The collection of actions and filters registered with WordPress.
	 */
	private function add( $hooks, $hook, $component, $callback, $priority, $accepted_args ) {

		$hooks[] = array(
			'hook'          => $hook,
			'component'     => $component,
			'callback'      => $callback,
			'priority'      => $priority,
			'accepted_args' => $accepted_args,
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
				'hook'     => 'init',
				'callback' => 'register_post_types',
			),
			array(
				'hook'     => 'init',
				'callback' => 'register_taxonomies',
			),
			array(
				'hook'     => 'admin_init',
				'callback' => 'add_custom_columns',
				'priority' => 20,
			),

			array(
				'hook'          => 'save_post', // use save_post because save_post_prestation_item is fired before actual save and meta values are not yet updated
				'callback'      => 'save_post_action',
				'accepted_args' => 3,
			),
		);

		$filters = array(
			array(
				'hook'     => 'rwmb_meta_boxes',
				'callback' => 'register_fields',
			),

			array(
				'hook'          => 'wp_insert_post_data',
				'callback'      => 'insert_prestation_item_data',
				'accepted_args' => 4,
			),
			// array(
			// 'hook' => 'update_post_metadata',
			// 'callback' => 'update_metadata_filter',
			// 'accepted_args' => 5,
			// ),

			array(
				'hook'          => 'sanitize_post_meta_customer_for_prestation_item',
				'callback'      => 'sanitize_prestation_item_meta',
				'accepted_args' => 3,
			),
			array(
				'hook'          => 'sanitize_post_meta_attendee_for_prestation_item',
				'callback'      => 'sanitize_prestation_item_meta',
				'accepted_args' => 3,
			),

			array(
				'hook'     => 'multipass_set_prestation_item_title',
				'callback' => 'set_prestation_item_title',
			),
		);

		foreach ( $filters as $hook ) {
			( empty( $hook['component'] ) ) && $hook['component']         = __CLASS__;
			( empty( $hook['priority'] ) ) && $hook['priority']           = 10;
			( empty( $hook['accepted_args'] ) ) && $hook['accepted_args'] = 1;
			add_filter( $hook['hook'], array( $hook['component'], $hook['callback'] ), $hook['priority'], $hook['accepted_args'] );
		}

		foreach ( $actions as $hook ) {
			( empty( $hook['component'] ) ) && $hook['component']         = __CLASS__;
			( empty( $hook['priority'] ) ) && $hook['priority']           = 10;
			( empty( $hook['accepted_args'] ) ) && $hook['accepted_args'] = 1;
			add_action( $hook['hook'], array( $hook['component'], $hook['callback'] ), $hook['priority'], $hook['accepted_args'] );
		}
	}

	static function item_links_html( $value = null, $field = array() ) {
		if ( is_object( $value ) ) {
			$post = $value;
		} else {
			global $post;
		}
		if ( ! $post ) {
			return;
		}

		$source      = get_post_meta( $post->ID, 'source', true );
		$term        = get_term_by( 'slug', $source, 'prestation-item-source' );
		$source_name = $term->name;
		if ( $field['format'] == 'icon' ) {
			$links = array_filter(
				array(
					'<a class="dashicons dashicons-visibility" href="%s"></a>' => get_post_meta( $post->ID, 'view_url', true ),
					'<a class="dashicons dashicons-edit" href="%s"></a>' => get_post_meta( $post->ID, 'edit_url', true ),
				)
			);
		} else {
			$links = array_filter(
				array(
					__( 'View %s item', 'multipass' ) => get_post_meta( $post->ID, 'view_url', true ),
					__( 'Edit %s item', 'multipass' ) => get_post_meta( $post->ID, 'edit_url', true ),
				)
			);
		}
		$links_html = array();
		foreach ( $links as $label => $link ) {
			$links_html[] = sprintf(
				'<a href="%s">%s</a>',
				$link,
				sprintf( $label, $source_name ),
			);
		}
		return join( ' ', $links_html );
	}

	static function customer_html( $value = null, $field = array() ) {
		if ( is_object( $value ) ) {
			$post = $value;
		} else {
			global $post;
		}

		if ( is_array( $value ) ) {
			$customer_info = $value;
		} else {
			$customer_info = get_post_meta( $post->ID, 'customer', true );
		}
		$customer_info = array_merge(
			array(
				'user_id' => null,
				'name'    => null,
				'phone'   => null,
				'email'   => null,
			),
			$customer_info
		);

		$customer_html = '';
		if ( is_array( $customer_info ) ) {
			$customer_html = join(
				' ',
				array_filter(
					array(
						( ! empty( $customer_info['user_id'] ) )
						? sprintf(
							'<a href="%s">%s</a>',
							get_edit_profile_url( $customer_info['user_id'] ),
							$customer_info['name'],
						) : $customer_info['name'],
						( empty( $customer_info['email'] ) ) ? null : sprintf( '<a href="mailto:%1$s">%1$s</a>', $customer_info['email'] ),
						( empty( $customer_info['phone'] ) ) ? null : sprintf( '<a href="tel:%1$s">%1$s</a>', $customer_info['phone'] ),
					)
				)
			);
		}

		return $customer_html;
	}

	static function register_post_types() {
		$labels = array(
			'name'                     => esc_html__( 'Prestation Details', 'multipass' ),
			'singular_name'            => esc_html__( 'Prestation Detail', 'multipass' ),
			'add_new'                  => esc_html__( 'Add New', 'multipass' ),
			'add_new_item'             => esc_html__( 'Add New Part', 'multipass' ),
			'edit_item'                => esc_html__( 'Edit Part', 'multipass' ),
			'new_item'                 => esc_html__( 'New Part', 'multipass' ),
			'view_item'                => esc_html__( 'View Part', 'multipass' ),
			'view_items'               => esc_html__( 'View Parts', 'multipass' ),
			'search_items'             => esc_html__( 'Search Parts', 'multipass' ),
			'not_found'                => esc_html__( 'No details found.', 'multipass' ),
			'not_found_in_trash'       => esc_html__( 'No details found in Trash.', 'multipass' ),
			'parent_item_colon'        => esc_html__( 'Parent Part:', 'multipass' ),
			'all_items'                => esc_html__( 'Details', 'multipass' ),
			'archives'                 => esc_html__( 'Parts Archives', 'multipass' ),
			'attributes'               => esc_html__( 'Part Attributes', 'multipass' ),
			'insert_into_item'         => esc_html__( 'Insert into prestation_detail', 'multipass' ),
			'uploaded_to_this_item'    => esc_html__( 'Uploaded to this prestation_detail', 'multipass' ),
			'featured_image'           => esc_html__( 'Featured image', 'multipass' ),
			'set_featured_image'       => esc_html__( 'Set featured image', 'multipass' ),
			'remove_featured_image'    => esc_html__( 'Remove featured image', 'multipass' ),
			'use_featured_image'       => esc_html__( 'Use as featured image', 'multipass' ),
			'menu_name'                => esc_html__( 'Prestations Details', 'multipass' ),
			'filter_items_list'        => esc_html__( 'Filter details list', 'multipass' ),
			'filter_by_date'           => esc_html__( 'Filter by date', 'multipass' ),
			'items_list_navigation'    => esc_html__( 'Parts list navigation', 'multipass' ),
			'items_list'               => esc_html__( 'Parts list', 'multipass' ),
			'item_published'           => esc_html__( 'Part published.', 'multipass' ),
			'item_published_privately' => esc_html__( 'Part published privately.', 'multipass' ),
			'item_reverted_to_draft'   => esc_html__( 'Part reverted to draft.', 'multipass' ),
			'item_scheduled'           => esc_html__( 'Part scheduled.', 'multipass' ),
			'item_updated'             => esc_html__( 'Part updated.', 'multipass' ),
			'text_domain'              => 'multipass',
		);
		$args   = array(
			'label'               => esc_html__( 'Parts', 'multipass' ),
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
			'show_in_menu'        => 'multipass',
			'menu_icon'           => 'dashicons-admin-generic',
			'capability_type'     => 'mltp_prestation',
			'supports'            => false,
			'taxonomies'          => array(),
			'rewrite'             => array(
				'with_front' => false,
			),
		);

		register_post_type( 'prestation-item', $args );
	}

	static function register_fields( $meta_boxes ) {
		$js_date_format_short = preg_match( '/^[Fm]/', get_option( 'date_format' ) ) ? 'mm-dd-yy' : 'dd-mm-yy';
		$prefix               = '';

		$meta_boxes['prestation_item'] = array(
			'title'      => __( 'Parts fields', 'multipass' ),
			'id'         => 'prestation_item',
			'post_types' => array( 'prestation-item' ),
			'style'      => 'seamless',
			'fields'     => array(
				array(
					'id'       => $prefix . 'title_html',
					'type'     => 'custom_html',
					'callback' => 'MultiPass::title_html',
				),
				array(
					'name'          => __( 'Source', 'multipass' ),
					'id'            => $prefix . 'source',
					'type'          => 'taxonomy',
					'taxonomy'      => array( 'prestation-item-source' ),
					'field_type'    => 'select',
					'placeholder'   => _x( 'None', '(prestation_item) source', 'multipass' ),
					'admin_columns' => array(
						'position'   => 'replace date',
						'sort'       => true,
						'searchable' => true,
						'filterable' => true,
					),
				),
				array(
					'name'     => __( 'Source ID', 'multipass' ),
					'id'       => $prefix . 'source_id',
					'type'     => 'text',
					'readonly' => true,
					'visible'  => array(
						'when'     => array( array( 'source', '!=', '' ) ),
						'relation' => 'and',
					),
				),
				array(
					'name'     => __( 'Source Item ID', 'multipass' ),
					'id'       => $prefix . 'source_item_id',
					'type'     => 'text',
					'readonly' => true,
					'visible'  => array(
						'when'     => array( array( 'source', '!=', '' ) ),
						'relation' => 'and',
					),
				),
				array(
					'name'     => __( 'Links', 'multipass' ),
					'id'       => $prefix . 'links',
					'type'     => 'custom_html',
					'callback' => __CLASS__ . '::item_links_html',
					'visible'  => array(
						'when'     => array( array( 'source', '!=', '' ) ),
						'relation' => 'and',
					),
				),
				array(
					'name'    => __( 'Description', 'multipass' ),
					'id'      => $prefix . 'description',
					'type'    => 'text',
					'visible' => array(
						'when'     => array( array( 'source', '=', '' ) ),
						'relation' => 'or',
					),
				),
				array(
					'name'          => __( 'Prestation', 'multipass' ),
					'id'            => $prefix . 'prestation_id',
					'type'          => 'post',
					'post_type'     => array( 'prestation' ),
					'field_type'    => 'select_advanced',
					'admin_columns' => array(
						'position'   => 'after title',
						// 'title'      => 'Customer',
						'sort'       => true,
						'searchable' => true,
					),
				),
				array(
					'name'     => __( 'Customer', 'multipass' ),
					'id'       => $prefix . 'customer_display',
					'type'     => 'custom_html',
					'callback' => __CLASS__ . '::customer_html',
					// 'admin_columns' => array(
					// 'position'   => 'after prestation_id',
					// 'title'      => 'Customer',
					// 'sort'       => true,
					// 'searchable' => true,
					// ),
					'visible'  => array(
						'when'     => array( array( 'prestation_id', '!=', '' ) ),
						'relation' => 'or',
					),
				),
				array(
					'name'    => __( 'Customer', 'multipass' ),
					'id'      => $prefix . 'customer',
					'type'    => 'group',
					'class'   => 'inline',
					'fields'  => array(
						array(
							'name'       => __( 'Existing User', 'multipass' ),
							'id'         => $prefix . 'user_id',
							'type'       => 'user',
							'field_type' => 'select_advanced',
						),
						array(
							'name' => __( 'Name', 'multipass' ),
							'id'   => $prefix . 'name',
							'type' => 'text',
							'size' => 30,
							// 'admin_columns' => 'after title',
						),
						array(
							'name' => _x( 'Email', '(noun)', 'multipass' ),
							'id'   => $prefix . 'email',
							'type' => 'email',
							'size' => 30,
						),
						array(
							'name' => _x( 'Phone', '(noun)', 'multipass' ),
							'id'   => $prefix . 'phone',
							'type' => 'text',
						),
					),
					'visible' => array(
						'when'     => array( array( 'prestation_id', '=', '' ) ),
						'relation' => 'or',
					),
				),
				array(
					'name'   => __( 'Attendee', 'multipass' ),
					'id'     => $prefix . 'attendee',
					'type'   => 'group',
					'class'  => 'inline',
					'desc'   => __( 'Fill only if different from customer.', 'multipass' ),
					'fields' => array(
						array(
							'name'       => __( 'Existing User', 'multipass' ),
							'id'         => $prefix . 'user_id',
							'type'       => 'user',
							'field_type' => 'select_advanced',
						),
						array(
							'name' => __( 'Name', 'multipass' ),
							'id'   => $prefix . 'name',
							'type' => 'text',
							'size' => 30,
							// 'admin_columns' => 'after title',
						),
						array(
							'name' => _x( 'Email', '(noun)', 'multipass' ),
							'id'   => $prefix . 'email',
							'type' => 'email',
							'size' => 30,
						),
						array(
							'name' => _x( 'Phone', '(noun)', 'multipass' ),
							'id'   => $prefix . 'phone',
							'type' => 'text',
						),
					),
				),
				array(
					'id'   => $prefix . 'sep',
					'type' => 'custom_html',
					'std'  => '<hr>',
				),
				array(
					'name'          => __( 'Dates', 'multipass' ),
					'id'            => $prefix . 'dates_admin_list',
					'type'          => 'hidden',
					'disabled'      => true,
					'admin_columns' => array(
						'position' => 'before source',
						'sort'     => true,
					),
				),
				array(
					'name'   => __( 'Dates', 'multipass' ),
					'id'     => $prefix . 'dates',
					'type'   => 'group',
					'class'  => 'inline',
					'fields' => array(
						array(
							'name'       => __( 'From', 'multipass' ),
							'id'         => $prefix . 'from',
							'type'       => 'datetime',
							'timestamp'  => true,
							'js_options' => array(
								'dateFormat' => $js_date_format_short,
							),
						),
						array(
							'name'       => __( 'To', 'multipass' ),
							'id'         => $prefix . 'to',
							'type'       => 'datetime',
							'timestamp'  => true,
							'js_options' => array(
								'dateFormat' => $js_date_format_short,
							),
						),
					),
				),
				array(
					'name'   => __( 'Number of Attendees', 'multipass' ),
					'id'     => $prefix . 'attendees',
					'type'   => 'group',
					'class'  => 'inline',
					'fields' => array(
						array(
							'name'     => __( 'Total', 'multipass' ),
							'id'       => $prefix . 'total',
							'type'     => 'number',
							'min'      => 0,
							'size'     => 5,
							'readonly' => true,
						),
						array(
							'name' => __( 'Adults', 'multipass' ),
							'id'   => $prefix . 'adults',
							'type' => 'number',
							'min'  => 0,
							'size' => 5,
						),
						array(
							'name' => __( 'Children', 'multipass' ),
							'id'   => $prefix . 'children',
							'type' => 'number',
							'min'  => 0,
							'size' => 5,
						),
						array(
							'name' => __( 'Babies', 'multipass' ),
							'id'   => $prefix . 'babies',
							'type' => 'number',
							'min'  => 0,
							'size' => 5,
						),
					),
				),
				array(
					'name'          => __( '# Attendees', 'multipass' ),
					'id'            => $prefix . 'attendees_display',
					'type'          => 'hidden',
					'disabled'      => true,
					'admin_columns' => array(
						'position' => 'after prestation_id',
						'sort'     => true,
					),
				),
				array(
					'name'   => __( 'Beds', 'multipass' ),
					'id'     => $prefix . 'beds',
					'type'   => 'group',
					'class'  => 'inline',
					'fields' => array(
						array(
							'name' => __( 'Double', 'multipass' ),
							'id'   => $prefix . 'double',
							'type' => 'number',
							'min'  => 0,
							'size' => 5,
						),
						array(
							'name' => __( 'Single', 'multipass' ),
							'id'   => $prefix . 'single',
							'type' => 'number',
							'min'  => 0,
							'size' => 5,
						),
						array(
							'name' => __( 'Baby', 'multipass' ),
							'id'   => $prefix . 'baby',
							'type' => 'number',
							'min'  => 0,
							'size' => 5,
						),
					),
				),
				array(
					'id'   => $prefix . 'sep2',
					'type' => 'custom_html',
					'std'  => '<hr>',
				),
				array(
					'name'   => __( 'Price', 'multipass' ),
					'id'     => $prefix . 'price',
					'type'   => 'group',
					'class'  => 'inline',
					'fields' => array(
						array(
							'name' => __( 'Quantity', 'multipass' ),
							'id'   => $prefix . 'quantity',
							'type' => 'number',
							'min'  => 0,
							'step' => 'any',
							'size' => 5,
						),
						array(
							'name' => __( 'Unit Price', 'multipass' ),
							'id'   => $prefix . 'unit',
							'type' => 'number',
							'min'  => 0,
							'step' => 'any',
							'size' => 10,
						),
						array(
							'name'     => __( 'Subtotal', 'multipass' ),
							'id'       => $prefix . 'subtotal',
							'type'     => 'number',
							'step'     => 'any',
							'size'     => 10,
							'readonly' => true,
						),
					),
				),
				array(
					'name'   => __( 'Discount', 'multipass' ),
					'id'     => $prefix . 'discount',
					'type'   => 'group',
					'class'  => 'inline',
					'fields' => array(
						array(
							'id'      => $prefix . 'percent',
							'type'    => 'number',
							'min'     => 0,
							'max'     => 100,
							'step'    => 'any',
							'size'    => 5,
							'prepend' => '%',
						),
						array(
							'id'      => $prefix . 'amount',
							'type'    => 'number',
							'size'    => 10,
							'step'    => 'any',
							'prepend' => '€',
						),
					),
				),
				array(
					'name'          => __( 'Total', 'multipass' ),
					'id'            => $prefix . 'total',
					'type'          => 'number',
					'min'           => 0,
					'step'          => 'any',
					'size'          => 10,
					'readonly'      => true,
					'admin_columns' => array(
						'position' => 'before source',
						'sort'     => true,
					),
				),
				array(
					'name'   => __( 'Deposit', 'multipass' ),
					'id'     => $prefix . 'deposit',
					'type'   => 'group',
					// 'admin_columns' => 'after total',
					'class'  => 'inline',
					'fields' => array(
						array(
							'id'      => $prefix . 'percent',
							'type'    => 'number',
							'min'     => 0,
							'max'     => 100,
							'step'    => 'any',
							'size'    => 5,
							'prepend' => '%',
						),
						array(
							'id'      => $prefix . 'amount',
							'type'    => 'number',
							'size'    => 10,
							'prepend' => '€',
						),
						array(
							'id'          => $prefix . 'before',
							'type'        => 'date',
							'placeholder' => __( 'Before', 'multipass' ),
							'timestamp'   => true,
							'js_options'  => array(
								'dateFormat' => $js_date_format_short,
							),
						),
					),
				),
				array(
					'name'   => __( 'Payment', 'multipass' ),
					'id'     => $prefix . 'payment',
					'type'   => 'group',
					'clone'  => true,
					'class'  => 'inline',
					'fields' => array(
						array(
							'name'       => __( 'Date', 'multipass' ),
							'id'         => $prefix . 'date',
							'type'       => 'datetime',
							'timestamp'  => true,
							'js_options' => array(
								'dateFormat' => $js_date_format_short,
							),
						),
						array(
							'name' => __( 'Amount', 'multipass' ),
							'id'   => $prefix . 'amount',
							'type' => 'number',
							'min'  => 0,
							'step' => 'any',
							'size' => 10,
						),
						array(
							'name' => __( 'Method', 'multipass' ),
							'id'   => $prefix . 'method',
							'type' => 'text',
						),
						array(
							'name' => __( 'Reference', 'multipass' ),
							'id'   => $prefix . 'reference',
							'type' => 'text',
						),
					),
				),
				array(
					'name'          => __( 'Deposit', 'multipass' ),
					'id'            => $prefix . 'deposit_amount',
					'type'          => 'hidden',
					'disabled'      => true,
					'admin_columns' => array(
						'position' => 'before source',
						'sort'     => true,
					),
				),
				array(
					'name'          => __( 'Paid', 'multipass' ),
					'id'            => $prefix . 'paid',
					'type'          => 'number',
					'min'           => 0,
					'step'          => 'any',
					'size'          => 10,
					'readonly'      => true,
					'admin_columns' => 'after deposit_amount',
				),
				array(
					'name'          => __( 'Balance', 'multipass' ),
					'id'            => $prefix . 'balance',
					'type'          => 'number',
					'min'           => 0,
					'step'          => 'any',
					'size'          => 10,
					'readonly'      => true,
					'admin_columns' => array(
						'position' => 'after paid',
						'sort'     => true,
					),
				),
				array(
					'name'          => __( 'Status', 'multipass' ),
					'id'            => $prefix . 'status',
					'type'          => 'taxonomy',
					'taxonomy'      => array( 'prestation-status' ),
					'field_type'    => 'select',
					'admin_columns' => array(
						'position'   => 'before source',
						'sort'       => true,
						'filterable' => true,
					),
				),
			),
		);

		return $meta_boxes;
	}

	static function add_custom_columns() {
		new Mltp_Item_Admin_Columns( 'prestation_item', array() );
	}

	static function register_taxonomies() {
		$labels = array(
			'name'                       => esc_html__( 'Sources', 'multipass' ),
			'singular_name'              => esc_html__( 'Source', 'multipass' ),
			'menu_name'                  => esc_html__( 'Sources', 'multipass' ),
			'search_items'               => esc_html__( 'Search sources', 'multipass' ),
			'popular_items'              => esc_html__( 'Popular sources', 'multipass' ),
			'all_items'                  => esc_html__( 'All sources', 'multipass' ),
			'parent_item'                => esc_html__( 'Parent source', 'multipass' ),
			'parent_item_colon'          => esc_html__( 'Parent source:', 'multipass' ),
			'edit_item'                  => esc_html__( 'Edit source', 'multipass' ),
			'view_item'                  => esc_html__( 'View source', 'multipass' ),
			'update_item'                => esc_html__( 'Update source', 'multipass' ),
			'add_new_item'               => esc_html__( 'Add New source', 'multipass' ),
			'new_item_name'              => esc_html__( 'New source Name', 'multipass' ),
			'separate_items_with_commas' => esc_html__( 'Separate sources with commas', 'multipass' ),
			'add_or_remove_items'        => esc_html__( 'Add or remove sources', 'multipass' ),
			'choose_from_most_used'      => esc_html__( 'Choose most used sources', 'multipass' ),
			'not_found'                  => esc_html__( 'No sources found.', 'multipass' ),
			'no_terms'                   => esc_html__( 'No sources', 'multipass' ),
			'filter_by_item'             => esc_html__( 'Filter by prestation_item source', 'multipass' ),
			'items_list_navigation'      => esc_html__( 'Sources list pagination', 'multipass' ),
			'items_list'                 => esc_html__( 'Sources list', 'multipass' ),
			'most_used'                  => esc_html__( 'Most Used', 'multipass' ),
			'back_to_items'              => esc_html__( '&larr; Go to sources', 'multipass' ),
			'text_domain'                => 'multipass',
		);
		$args   = array(
			'label'              => esc_html__( 'Sources', 'multipass' ),
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
			'rewrite'            => array(
				'with_front'   => false,
				'hierarchical' => false,
			),
			'_builtin'           => true,
		);
		register_taxonomy( 'prestation-item-source', array( 'prestation-item' ), $args );

		MultiPass::register_terms( 'prestation-item-source' );

	}

	static function insert_prestation_item_data( $data, $postarr, $unsanitized_postarr, $update ) {
		if ( ! $update ) {
			return $data;
		}
		if ( $data['post_type'] !== 'prestation-item' ) {
			return $data;
		}

		$data = apply_filters( 'multipass_set_prestation_item_title', $data );

		return $data;
	}

	static function set_prestation_item_title( $data ) {
		// error_log(__CLASS__ . '::' . __FUNCTION__);
		// if(empty($_REQUEST['prestation_item_page_id'])) return $data;
		//
		// if(empty($data['post_title'])) {
		// $data['post_title'] = get_the_title($_REQUEST['prestation_item_page_id']);
		// $data['post_name'] = sanitize_title($data['post_title']);
		// }
		return $data;
	}

	static function save_post_action( $post_id, $post, $update ) {
		if ( ! $update ) {
			return;
		}
		if ( 'prestation-item' !== $post->post_type ) {
			return;
		}
		if ( 'trash' == $post->post_status ) {
			return;
		}

		remove_action( current_action(), __CLASS__ . '::' . __FUNCTION__ );

		$item_id   = get_post_meta( $post_id, 'prestation_id', true );
		$item_info = get_post_meta( $post_id, 'customer', true );
		if ( $item_id ) {
			$user_info = array_filter(
				array(
					'user_id' => get_post_meta( $item_id, 'customer_id', true ),
					'name'    => get_post_meta( $item_id, 'attendee_name', true ),
					'email'   => get_post_meta( $item_id, 'attendee_email', true ),
					'phone'   => get_post_meta( $item_id, 'attendee_phone', true ),
				)
			);
		} else {
			$user_info = $item_info;
		}
		if ( $user_info != $item_info ) {
			// error_log(__FUNCTION__ . '::' . __FUNCTION__ . ' meta ' . print_r($user_info, true));
			update_post_meta( $post_id, 'customer', $user_info );
		}
		$customer_html = self::customer_html( $post );
		update_post_meta( $post_id, 'customer_display', $customer_html );

		$updates = array();
		$price   = get_post_meta( $post_id, 'price', true );
		if ( $price ) {
			$unit_price       = isset( $price['unit'] ) ? $price['unit'] : null;
			$qty              = isset( $price['quantity'] ) ? $price['quantity'] : ( isset( $price['unit'] ) ? 1 : null );
			$sub_total        = $qty * $unit_price;
			$updates['price'] = array_merge(
				$price,
				array(
					'subtotal' => $sub_total,
				)
			);

			$discount = get_post_meta( $post_id, 'discount', true );
			if ( ! is_array( $discount ) ) {
				$discount = array( 'amount' => null );
			}
			$discount_amount = ( isset( $discount['amount'] ) ) ? $discount['amount'] : null;
			if ( isset( $discount['percent'] ) ) {
				$discount_amount = $sub_total * $discount['percent'] / 100;
			}
			$updates['discount'] = array_merge(
				$discount,
				array(
					'amount' => $discount_amount,
				)
			);
			$updates['total']    = $total = $sub_total - $discount_amount;

			$deposit = get_post_meta( $post_id, 'deposit', true );
			if ( ! is_array( $deposit ) ) {
				$deposit = array( 'amount' => null );
			}

			$deposit_percent = isset( $deposit['percent'] ) ? $deposit['percent'] : null;
			$deposit_amount  = ( isset( $deposit['amount'] ) ) ? $deposit['amount'] : null;
			if ( isset( $deposit['percent'] ) ) {
				$deposit_amount = $total * $deposit_percent / 100;
			}
			$updates['deposit'] = array_merge(
				$deposit,
				array(
					'amount' => $deposit_amount,
				)
			);

			$payments = get_post_meta( $post_id, 'payment', true );

			$paid = (float) get_post_meta( $post_id, 'paid', true );
			if ( is_array( $payments ) ) {
				foreach ( $payments as $key => $payment ) {
					if ( isset( $payment['amount'] ) ) {
						$paid += (float) $payment['amount'];
					}
				}
			}
			$updates['paid']    = $paid;
			$updates['balance'] = round( $total - $paid, 4 );
			$updates['balance'] = ( empty( $updates['balance'] ) ) ? null : $updates['balance'];
		}

		$attendees = get_post_meta( $post_id, 'attendees', true );
		$attendees = ( ! is_array($attendees) ) ? [ 'total' => $attendees ] : $attendees;
		$attendees = empty($attendees) ? [] : $attendees;
		if ( $attendees ) {
			$attendees       = array_replace(
				array(
					'total' => null,
				),
				$attendees
			);
			$count           = array_replace(
				array(
					'adults'   => 0,
					'children' => 0,
					'babies'   => 0,
				),
				$attendees
			);
			$total_attendees = $count['adults'] + $count['children'] + $count['babies'];
			if ( $total_attendees == 0 ) {
				$total_attendees = null;
			}
			if ( $total_attendees != $attendees['total'] ) {
				$attendees['total']   = $total_attendees;
				$updates['attendees'] = $attendees;
			}
		}

		if ( ! empty( $updates ) ) {
			$updates['flags'] = MultiPass::set_flags($updates);
			$updates['classes'] = MultiPass::get_flag_slugs($updates['flags']);

			$post_update = array(
				'ID'         => $post_id,
				// 'post_title' => trim($display_name . ' ' . "#" . ((empty($post->post_name)) ? $post_id : $post->post_name)),
				// 'post_status' => $post_status,
				'meta_input' => $updates,
				// 'tax_input' => array(
				// 'prestation-status' => $paid_status,
				// ),
			);

			wp_update_post( $post_update );
		}
		// $metas['subtotal'] = get_post_meta($post_id, 'prestation_id', true);
		// $part = new Mltp_Item($post);
		// $item->set_prestation();

		add_action( current_action(), __CLASS__ . '::' . __FUNCTION__, 10, 3 );
	}

	static function sanitize_prestation_item_meta( $meta_value, $meta_key, $object_type ) {
		switch ( $meta_key ) {
			case 'customer':
			case 'attendee':
				return MultiPass::get_user_info_by_info( $meta_value );
		}

		return $meta_value;
	}

	static function update_metadata_filter( $check, $object_id, $meta_key, $meta_value, $prev_value ) {
		return $check;
		//
		// if(get_post_type($object_id) != 'prestation-item') return $check;
		//
		// switch($meta_key) {
		// case 'customer':
		// $item_id = get_post_meta($object_id, 'prestation_id', true);
		// $prestation_info = array_filter(array(
		// 'id' => get_post_meta($item_id, 'customer_id', true),
		// 'name' => get_post_meta($item_id, 'attendee_name', true),
		// 'email' => get_post_meta($item_id, 'attendee_email', true),
		// 'phone' => get_post_meta($item_id, 'attendee_phone', true),
		// ));
		// $item_info = MultiPass::get_user_info_by_info($meta_value);
		// $meta_value = array_replace($item_info, $prestation_info);
		// error_log("object $object_id user info " . print_r($meta_value, true) );
		// return $meta_value;
		// break;
		//
		// }
		// return $check;
	}

	function set_prestation( $post = null ) {
		$post = $this->post;
		if ( $post->post_type != 'prestation-item' ) {
			return;
		}
		if ( $post->post_status == 'trash' ) {
			return; // TODO: update previously linked prestation
		}

		// // remove_action(current_action(), __CLASS__ . '::wp_insert_post_action');

		$item_id    = get_post_meta( $post->ID, 'prestation_id', true );
		$prestation = get_post( $item_id );

		$user_info = get_post_meta( $post->ID, 'customer' );

		// $user_info = MultiPass::get_user_info_by_info($user_info);
		// error_log('user info ' . print_r($user_info, true));
		// if($user) {
		// $user_info = array_replace($user_info, array_filter(array(
		// 'name' => $user->display_name,
		// 'email' => $user->user_email,
		// 'phone' => get_user_meta($user->ID, 'billing_phone'),
		// )));
		// }

		// $customer_id = get_post_meta($this->id, '_customer_user', true);
		// $customer = get_user_by('id', $customer_id);
		// if($customer) {
		// $customer_name = $customer->display_name;
		// $customer_email = $customer->user_email;
		// error_log("customer " . print_r($customer, true));
		// } else {
		// $customer_name = trim(get_post_meta($this->id, '_billing_first_name', true) . ' ' . get_post_meta($this->id, '_billing_last_name', true));
		// $customer_email = get_post_meta($this->id, '_billing_email', true);
		// }
		//
		// if(empty($item_id) || ! $prestation) {
		// $args = array(
		// 'post_type' => 'prestation',
		// 'post_status__in' => [ 'pending', 'on-hold', 'deposit', 'partial', 'unpaid', 'processing' ],
		// 'orderby' => 'post_date',
		// 'order' => 'desc',
		// );
		// if($customer) {
		// $args['meta_query'] = array(
		// array(
		// 'key' => 'customer_id',
		// 'value' => $customer_id,
		// )
		// );
		// } else if (!empty($customer_email)) {
		// $args['meta_query'] = array(
		// 'relation' => 'OR',
		// array(
		// 'key' => 'customer_email',
		// 'value' => $customer_email,
		// ),
		// array(
		// 'key' => 'attendee_email',
		// 'value' => $customer_email,
		// ),
		// );
		// } else if (!empty($customer_name)) {
		// $args['meta_query'] = array(
		// 'relation' => 'OR',
		// array(
		// 'key' => 'customer_name',
		// 'value' => $customer_name,
		// ),
		// array(
		// 'key' => 'attendee_name',
		// 'value' => $customer_name,
		// ),
		// );
		// }
		// $prestations = get_posts($args);
		// if($prestations) {
		// $prestation = $prestations[0];
		// $item_id = $prestation->ID;
		// error_log("$prestation->ID $prestation->post_title " . print_r($prestation, true));
		// update_post_meta( $this->id, 'prestation_id', $item_id );
		// }
		// }
		//
		// if(empty($item_id) || ! $prestation) {
		// $this->postarr = array(
		// 'post_author' => $this->post->get_customer_id(),
		// 'post_date' => $this->post->get_date_created(),
		// 'post_date_gmt' => $this->post->post_date_gmt,
		// 'post_type' => 'prestation',
		// 'post_status' => 'publish',
		// 'meta_input' => array(
		// 'prestation_id' => $item_id,
		// 'customer_id' => $customer_id,
		// 'customer_name' => $customer_name,
		// 'customer_email' => $customer_email,
		// ),
		// );
		// $item_id = wp_insert_post($this->postarr);
		// update_post_meta( $this->id, 'prestation_id', $item_id );
		// foreach ($this->postarr['meta_input'] as $key => $value) update_post_meta( $this->id, $key, $value );
		// }
		//
		// if(!empty($item_id)) {
		// $meta = array(
		// 'prestation_id' => $item_id,
		// 'customer_id' => $customer_id,
		// 'customer_name' => $customer_name,
		// 'customer_email' => $customer_email,
		// );
		// foreach ($meta as $key => $value) update_post_meta( $this->id, $key, $value );
		// Mltp_Item::update_prestation_prestation_items($item_id, get_post($item_id), true );
		// }
		//
		// // add_action(current_action(), __CLASS__ . '::wp_insert_post_action', 10, 3);
		return;
	}

	function get( $args, $update = false ) {
		$post_id = null;
		$post    = null;

		switch ( gettype( $args ) ) {
			case 'object':
				$post = $args;
				if ( isset( $post->post_type ) && 'prestation-item' === $post->post_type ) {
					$post = $args;
				}
				unset( $args );
				break;

			case 'integer':
				$post = get_post( $args );
				if ( isset( $post->post_type ) && 'prestation-item' === $post->post_type ) {
					$post = $post;
				}
				unset( $args );
				break;

			case 'array':
				$source_term_id = ( empty( $args['source'] ) ) ? null : get_term_by( 'slug', $args['source'], 'prestation-item-source' );
				$query_args     = array(
					'post_type'   => 'prestation-item',
					'post_status' => 'publish',
					'numberposts' => 1,
					'orderby'     => 'post_date',
					'order'       => 'asc',
					'tax_query'   => array(
						array(
							'taxonomy' => 'prestation-item-source',
							'field'    => 'slug',
							'terms'    => array( $args['source'] ),
							'operator' => 'IN',
						),
					),
					'meta_query'  => array(
						'relation' => 'AND',
						array(
							'key'   => 'source_id',
							'value' => $args['source_id'],
						),
						array(
							'key'   => 'source_item_id',
							'value' => $args['source_item_id'],
						),
					),
				);
				$posts          = get_posts( $query_args );
				if ( $posts ) {
					$post    = reset( $posts );
					$post_id = $post->ID;
				}
				break;

		}

		if ( is_array( $args ) & ! empty( $args ) && ( empty( $post_id ) || $update ) ) {
			$postarr = array(
				'ID'          => $post_id,
				'post_author' => (empty($args['customer']['user_id'])) ? null : $args['customer']['user_id'],
				'post_title'  => sprintf(
					'#%s-%s %s',
					$args['source_id'],
					$args['source_item_id'],
					$args['description'],
				),
				// 'post_date' => esc_attr($args['date']),
				// 'post_date_gmt' => esc_attr($args['date_gmt']),
				'post_type'   => 'prestation-item',
				'post_status' => 'publish',
				'meta_input'  => $args,
				'tax_input'   => array(
					'prestation-item-source' => $args['source'],
				),
			);

			$type = ( empty( $post_id ) ) ? 'new prestation-item' : "update $post->post_type";

			$post_id = wp_insert_post( $postarr );
			$post    = get_post( $post_id );
		}
		// if(!empty($post)) {
		// $this->post = $post;
		// $this->id = $post->ID;
		// }
		return $post;
	}
}

class Mltp_Item_Admin_Columns extends \MBAC\Post {
	// public function columns( $columns ) {
	// $columns  = parent::columns( $columns );
	// $position = '';
	// $target   = '';
	// $this->add( $columns, 'deposit', __('Deposit', 'multipass'), $position, $target );
	// Add more if you want
	// return $columns;
	// }

	public function show( $column, $post_id ) {
		switch ( $column ) {
			case 'dates_admin_list':
				echo MultiPass::format_date_range( get_post_meta( $post_id, 'dates', true ) );
				break;

			case 'attendees_display';
				$attendees = get_post_meta( $post_id, 'attendees', true );
				if ( is_array( $attendees ) && isset( $attendees['total'] ) ) {
					echo $attendees['total'];
				}
					break;

			case 'deposit_amount';
				$deposit = get_post_meta( $post_id, 'deposit', true );
				if ( is_array( $deposit ) && isset( $deposit['amount'] ) ) {
					echo $deposit['amount'];
				}
					break;
		}
	}
}

$this->loaders[] = new Mltp_Item();
