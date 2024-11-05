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

	public $id;
	public $name;
	public $post;
	public $from;
	public $to;
	public $flags;

	/**
	 * Initialize the collections used to maintain the actions and filters.
	 *
	 * @since    1.0.0
	 */
	public function __construct( $args = null, $update = false ) {
		if ( empty( $args ) ) {
			return false;
		}

		$this->post = $this->get_post( $args, $update );
		if ( $this->post ) {
			$this->id             = $this->post->ID;
			$this->customer_name  = get_post_meta( $this->id, 'customer_name', true );
			$this->customer_email = get_post_meta( $this->id, 'customer_email', true );
			$this->customer_phone = get_post_meta( $this->id, 'customer_phone', true );
			$this->dates          = get_post_meta( $this->id, 'dates', true );
			$this->from           = get_post_meta( $this->id, 'from', true );
			$this->to             = get_post_meta( $this->id, 'to', true );
			if ( empty( $this->dates ) ) {
				$this->dates = array_filter(
					array(
						'from' => empty( $this->from ) ? null : array( 'timestamp' => $this->from ),
						'to'   => empty( $this->to ) ? null : array( 'timestamp' => $this->to ),
					)
				);
			} else {
				$this->from  = ( empty( $this->dates['from'] ) ) ? null : MultiPass::timestamp( $this->dates['from'] );
				$this->to    = ( empty( $this->dates['to'] ) ) ? null : MultiPass::timestamp( $this->dates['to'] );
				$this->dates = array_filter(
					array(
						'from' => empty( $this->from ) ? null : array( 'timestamp' => $this->from ),
						'to'   => empty( $this->to ) ? null : array( 'timestamp' => $this->to ),
					)
				);
			}
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
	public function init() {

		$actions = array(
			array(
				'hook'     => 'init',
				'callback' => 'register_post_types',
			),
			array(
				'hook'     => 'init',
				'callback' => 'register_taxonomies',
				'priority' => 25,
			),
			array(
				'hook'     => 'admin_init',
				'callback' => 'add_custom_columns',
				'priority' => 20,
			),

			array(
				'hook'          => 'save_post', // use save_post because save_post_mltp_detail is fired before actual save and meta values are not yet updated
				'callback'      => 'save_post_action',
				'accepted_args' => 3,
			),
		);

		$filters = array(
			array(
				'component' => $this,
				'hook'      => 'rwmb_meta_boxes',
				'callback'  => 'register_fields',
			),

			array(
				'hook'          => 'wp_insert_post_data',
				'callback'      => 'insert_mltp_detail_data',
				'accepted_args' => 4,
			),
			// array(
			// 'hook' => 'update_post_metadata',
			// 'callback' => 'update_metadata_filter',
			// 'accepted_args' => 5,
			// ),

			array(
				'hook'          => 'sanitize_post_meta_customer_for_mltp_detail',
				'callback'      => 'sanitize_mltp_detail_meta',
				'accepted_args' => 3,
			),

			// array(
			// 'component' => $this,
			// 'hook' => 'the_title',
			// 'callback' => 'rewrite_the_title',
			// 'accepted_args' => 2,
			// ),
			array(
				'hook'     => 'multipass_set_mltp_detail_title',
				'callback' => 'set_mltp_detail_title',
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
		$post_id = $post->ID;

		$links['view'] = array(
			'url'        => get_post_meta( $post->ID, 'view_url', true ),
			'icon_class' => 'dashicons dashicons-visibility',
			'text'       => __( 'View', 'multipass' ),
		);
		$links         = array(
			'edit' => array(
				'url'        => current_user_can( 'edit_post', $post_id ) ? get_edit_post_link( $post_id ) : null,
				'icon_class' => 'edit dashicons dashicons-edit',
				'text'       => __( 'Edit', 'multipass' ),
			),
		);
		if ( ! empty( $links['edit']['url'] ) ) {
			unset( $links['view'] );
		}

		if ( get_post_meta( $post->ID, 'source_url', true ) ) {
			$source      = get_post_meta( $post->ID, 'source', true );
			$source_term = get_term_by( 'slug', $source, 'mltp_detail-source' );
			if ( $source_term ) {
				$links['source'] = array(
					'url'        => get_post_meta( $post->ID, 'source_url', true ),
					'icon_class' => 'dashicons dashicons-external',
					'text'       => sprintf( __( 'Edit on %s', 'multipass' ), $source_term->name ),
					'slug'       => $source_term->slug,
				);
			}
		}
		if ( get_post_meta( $post->ID, 'origin_url', true ) ) {
			$origin      = get_post_meta( $post->ID, 'origin', true );
			$origin_term = get_term_by( 'slug', $origin, 'mltp_detail-origin' );
			if ( $origin_term ) {
				$links['origin'] = array(
					'url'        => get_post_meta( $post->ID, 'origin_url', true ),
					'icon_class' => 'dashicons dashicons-external',
					'text'       => sprintf( __( 'Edit on %s', 'multipass' ), $origin_term->name ),
					'slug'       => $origin_term->slug,
				);
			}
		}

		$links_html = array();

		foreach ( $links as $key => $link ) {
			if ( empty( $link['url'] ) ) {
				continue;
			}
			$url = $link['url'];
			if ( isset( $links_html[ $link['url'] ] ) ) {
				continue;
			}

			$class = "link-$key";
			if ( isset( $link['slug'] ) ) {
				$class .= " link-${link['slug']} ";
			}

			if ( $field['format'] == 'icon' ) {
				$class .= ' ' . $link['icon_class'];
				$text   = '';
				$title  = $link['text'];
			} else {
				$text  = $link['text'];
				$title = '';
			}
			$links_html[ $link['url'] ] = sprintf(
				'<a href="%s" class="%s" title="%s">%s</a> ',
				$link['url'],
				$class,
				$title,
				$text,
			);
		}
		$output = join( ' ', $links_html );

		return $output;
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
			( empty( $customer_info ) ) ? array() : $customer_info,
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
			'name'                     => esc_html__( 'Prestation Elements', 'multipass' ),
			'singular_name'            => esc_html__( 'Prestation Element', 'multipass' ),
			'add_new'                  => esc_html__( 'Add New', 'multipass' ),
			'add_new_item'             => esc_html__( 'Add New Element', 'multipass' ),
			'edit_item'                => esc_html__( 'Edit Element', 'multipass' ),
			'new_item'                 => esc_html__( 'New Element', 'multipass' ),
			'view_item'                => esc_html__( 'View Element', 'multipass' ),
			'view_items'               => esc_html__( 'View Elements', 'multipass' ),
			'search_items'             => esc_html__( 'Search Elements', 'multipass' ),
			'not_found'                => esc_html__( 'No elements found.', 'multipass' ),
			'not_found_in_trash'       => esc_html__( 'No elements found in Trash.', 'multipass' ),
			'parent_item_colon'        => esc_html__( 'Parent Element:', 'multipass' ),
			'all_items'                => esc_html__( 'Elements', 'multipass' ),
			'archives'                 => esc_html__( 'Elements Archives', 'multipass' ),
			'attributes'               => esc_html__( 'Element Attributes', 'multipass' ),
			'insert_into_item'         => esc_html__( 'Insert into element', 'multipass' ),
			'uploaded_to_this_item'    => esc_html__( 'Uploaded to this element', 'multipass' ),
			'featured_image'           => esc_html__( 'Featured image', 'multipass' ),
			'set_featured_image'       => esc_html__( 'Set featured image', 'multipass' ),
			'remove_featured_image'    => esc_html__( 'Remove featured image', 'multipass' ),
			'use_featured_image'       => esc_html__( 'Use as featured image', 'multipass' ),
			'menu_name'                => esc_html__( 'Prestation Elements', 'multipass' ),
			'filter_items_list'        => esc_html__( 'Filter elements list', 'multipass' ),
			'filter_by_date'           => esc_html__( 'Filter by date', 'multipass' ),
			'items_list_navigation'    => esc_html__( 'Elements list navigation', 'multipass' ),
			'items_list'               => esc_html__( 'Elements list', 'multipass' ),
			'item_published'           => esc_html__( 'Element published.', 'multipass' ),
			'item_published_privately' => esc_html__( 'Element published privately.', 'multipass' ),
			'item_reverted_to_draft'   => esc_html__( 'Element reverted to draft.', 'multipass' ),
			'item_scheduled'           => esc_html__( 'Element scheduled.', 'multipass' ),
			'item_updated'             => esc_html__( 'Element updated.', 'multipass' ),
			'select_an_item'           => esc_html__( 'Select an element', 'multipass' ),
			'text_domain'              => 'multipass',
		);
		$args   = array(
			'label'               => esc_html__( 'Elements', 'multipass' ),
			'labels'              => $labels,
			'description'         => '',
			'public'              => false,
			'hierarchical'        => false,
			'exclude_from_search' => ! current_user_can( 'mltp_reader' ),
			'publicly_queryable'  => false,
			'show_ui'             => true,
			'show_in_nav_menus'   => true,
			'show_in_admin_bar'   => true,
			'show_in_rest'        => true,
			'query_var'           => true,
			'can_export'          => true,
			'delete_with_user'    => true,
			'has_archive'         => false,
			'rest_base'           => '',
			'show_in_menu'        => 'multipass',
			'menu_icon'           => 'dashicons-admin-generic',
			'capability_type'     => 'mltp_prestation',
			'supports'            => array( '' ),
			'taxonomies'          => array(),
			'rewrite'             => array(
				'slug'       => 'elements',
				'with_front' => false,
			),
		);

		register_post_type( 'mltp_detail', $args );
	}

	function register_fields( $meta_boxes ) {
		$js_date_format_short = preg_match( '/^[Fm]/', get_option( 'date_format' ) ) ? 'mm-dd-yy' : 'dd-mm-yy';
		$prefix               = '';

		$meta_boxes['mltp_detail_main_box'] = array(
			'title'      => __( 'Elements fields', 'multipass' ),
			'id'         => 'mltp_detail_main_box',
			'post_types' => array( 'mltp_detail' ),
			// 'context'    => 'form_top',
			'context'    => 'after_title',
			'priority'   => 'high',
			'style'      => 'seamless',
			'fields'     => array(
				array(
					'id'       => $prefix . 'title_html',
					'type'     => 'custom_html',
					'callback' => 'MultiPass::title_html',
				),
				array(
					'name'          => __( 'Resource', 'multipass' ),
					'id'            => $prefix . 'resource_id',
					'type'          => 'post',
					'post_type'     => array( 'mltp_resource' ),
					'field_type'    => 'select_advanced',
					'admin_columns' => array(
						'position'   => 'after title',
						// 'title'      => 'Customer',
						'sort'       => true,
						'searchable' => true,
					),
					'visible'       => array(
						'when'     => array( array( 'source', '=', '' ) ),
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
					'type'          => 'select_advanced',
					'options'		=> Mltp_Prestation::get_prestation_options(),
					'admin_columns' => array(
						'position'   => 'after title',
						// 'title'      => 'Customer',
						'sort'       => true,
						'searchable' => true,
					),
				),
				array(
					'name'          => __( 'External source', 'multipass' ),
					'id'            => $prefix . 'source',
					'type'          => 'taxonomy',
					'taxonomy'      => array( 'mltp_detail-source' ),
					'field_type'    => 'select',
					'placeholder'   => _x( 'None', '(mltp_detail) source', 'multipass' ),
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
			),
		);

		$meta_boxes['mltp_detail'] = array(
			'title'      => __( 'Elements fields', 'multipass' ),
			'id'         => 'mltp_detail',
			'post_types' => array( 'mltp_detail' ),
			'style'      => 'seamless',
			'fields'     => array(
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
					// 'visible'  => array(
					// 'when'     => array( array( 'prestation_id', '!=', '' ) ),
					// 'relation' => 'or',
					// ),
				),
				// array(
				// 'name'    => __( 'Customer', 'multipass' ),
				// 'id'      => $prefix . 'customer',
				// 'type'    => 'group',
				// 'class'   => 'inline',
				// 'fields'  => array(
				// array(
				// 'name'       => __( 'Existing User', 'multipass' ),
				// 'id'         => $prefix . 'user_id',
				// 'type'       => 'user',
				// 'field_type' => 'select_advanced',
				// ),
				// array(
				// 'name' => __( 'Name', 'multipass' ),
				// 'id'   => $prefix . 'name',
				// 'type' => 'text',
				// 'size' => 30,
				// 'admin_columns' => 'after title',
				// ),
				// array(
				// 'name' => _x( 'Email', '(noun)', 'multipass' ),
				// 'id'   => $prefix . 'email',
				// 'type' => 'email',
				// 'size' => 30,
				// ),
				// array(
				// 'name' => _x( 'Phone', '(noun)', 'multipass' ),
				// 'id'   => $prefix . 'phone',
				// 'type' => 'text',
				// ),
				// ),
				// 'visible' => array(
				// 'when'     => array( array( 'prestation_id', '=', '' ) ),
				// 'relation' => 'or',
				// ),
				// ),
				// array(
				// 'name'   => __( 'Attendee', 'multipass' ),
				// 'id'     => $prefix . 'attendee',
				// 'type'   => 'group',
				// 'class'  => 'inline',
				// 'desc'   => __( 'Fill only if different from customer.', 'multipass' ),
				// 'fields' => array(
				// array(
				// 'name'       => __( 'Existing User', 'multipass' ),
				// 'id'         => $prefix . 'user_id',
				// 'type'       => 'user',
				// 'field_type' => 'select_advanced',
				// ),
				// array(
				// 'name' => __( 'Name', 'multipass' ),
				// 'id'   => $prefix . 'name',
				// 'type' => 'text',
				// 'size' => 30,
				// 'admin_columns' => 'after title',
				// ),
				// array(
				// 'name' => _x( 'Email', '(noun)', 'multipass' ),
				// 'id'   => $prefix . 'email',
				// 'type' => 'email',
				// 'size' => 30,
				// ),
				// array(
				// 'name' => _x( 'Phone', '(noun)', 'multipass' ),
				// 'id'   => $prefix . 'phone',
				// 'type' => 'text',
				// ),
				// ),
				// ),
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
							'type'       => 'date',
							'size'       => 10,
							'timestamp'  => true,
							'js_options' => array(
								'dateFormat' => $js_date_format_short,
							),
						),
						array(
							'name'       => __( 'To', 'multipass' ),
							'id'         => $prefix . 'to',
							'type'       => 'date',
							'size'       => 10,
							'timestamp'  => true,
							'js_options' => array(
								'dateFormat' => $js_date_format_short,
							),
						),
					),
				),
				array(
					'name' => __( 'Check in', 'multipass' ),
					'id'   => $prefix . 'checkin',
					'size' => 6,
					'type' => 'time',
				),
				array(
					'name' => __( 'Check out', 'multipass' ),
					'id'   => $prefix . 'checkout',
					'size' => 6,
					'type' => 'time',
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
							'prepend' => MultiPass::get_currency_symbol(),
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
							'prepend' => MultiPass::get_currency_symbol(),
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
							'min'  => 'any',
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
					'type'          => 'text',
					// 'min'           => 0,
					'step'          => 'any',
					'size'          => 10,
					'readonly'      => true,
					'admin_columns' => 'after deposit_amount',
				),
				array(
					'name'          => __( 'Balance', 'multipass' ),
					'id'            => $prefix . 'balance',
					'type'          => 'text',
					// 'min'           => 0,
					'step'          => 'any',
					'size'          => 10,
					'readonly'      => true,
					// 'save_field'	=> false,
					'admin_columns' => array(
						'position' => 'after paid',
						'sort'     => true,
					),
				),
				array(
					'name'          => __( 'Commission', 'multipass' ),
					'id'            => $prefix . 'commission',
					'type'          => 'text',
					// 'min'           => 0,
					'step'          => 'any',
					'size'          => 10,
					'readonly'      => true,
					// 'save_field'	=> false,
					'admin_columns' => array(
						'position' => 'after paid',
						'sort'     => true,
					),
				),
				// array(
				// 	'name'          => __( 'Status', 'multipass' ),
				// 	'id'            => $prefix . 'status',
				// 	'type'          => 'taxonomy',
				// 	'taxonomy'      => array( 'prestation-status' ),
				// 	'field_type'    => 'select',
				// 	'admin_columns' => array(
				// 		'position'   => 'before source',
				// 		'sort'       => true,
				// 		'filterable' => true,
				// 	),
				// ),
				// array(
				// 	'name'    => __( 'Notes', 'prestations' ),
				// 	'id'      => $prefix . 'notes',
				// 	'type'    => 'wysiwyg',
				// 	'raw'     => false,
				// 	'options' => array(
				// 		// 'textarea_rows' => 4,
				// 		'teeny'             => true,
				// 		'media_buttonsbool' => false,
				// 	),
				// ),
			),
		);

		return $meta_boxes;
	}

	static function add_custom_columns() {
		if ( class_exists( 'Mltp_Item_Admin_Columns' ) ) {
			new Mltp_Item_Admin_Columns( 'mltp_detail', array() );
		}
	}

	static function register_taxonomies() {
		$labels = array(
			'name'                       => esc_html__( 'External Sources', 'multipass' ),
			'singular_name'              => esc_html__( 'External Source', 'multipass' ),
			'menu_name'                  => esc_html__( 'External Sources', 'multipass' ),
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
			'filter_by_item'             => esc_html__( 'Filter by detail source', 'multipass' ),
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
			'show_in_menu'       => true,
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
		register_taxonomy( 'mltp_detail-source', array( 'mltp_detail' ), $args );

		MultiPass::register_terms( 'mltp_detail-source' );

		if ( MultiPass::debug() ) {
			add_submenu_page(
				'multipass', // string $parent_slug,
				$labels['name'], // string $page_title,
				'<span class="dashicons dashicons-admin-tools"></span> ' . $labels['menu_name'], // string $menu_title,
				'mltp_administrator', // string $capability,
				'edit-tags.php?taxonomy=mltp_detail-source&post_type=mltp_detail', // string $menu_slug,
			);
		}
		add_action( 'mltp_detail-source_pre_add_form', 'MultiPass::back_to_multipass_button' );

	}

	// public function rewrite_the_title( $post_title, $post_id ) {
	// if ( 'mltp_detail' != get_post_type($post_id) || ( ! is_single() &! is_archive() ) ) {
	// return $post_title;
	// }
	// $item = new Mltp_Item($post_id);
	// if( ! $item ) {
	// return $post_title;
	// }
	// $prestation = new Mltp_Prestation($post_id);
	// if( ! $prestation->is_prestation() ) return $post_title;
	// return 'item ' . $item->full_title($post_title);
	// }

	// public function full_title( $post_title = null ) {
	// if('Mltp_Item' != get_class($this)) {
	// if ( ! empty($post_title)) return $post_title;
	// if ( ! empty($this->post_title)) return $this->post_title;
	// return;
	// }
	//
	// $title = empty($this->name) ? $post_title : $this->name;
	// $title = preg_replace('/ *#.+/', '', $title );
	//
	// if($this->id == 14096) {
	// error_log(print_r($this, true));
	// }
	//
	//
	// return MultiPass::array_join( array(
	// $title,
	// MultiPass::format_date_range( $this->dates ),
	// array(
	// ( ( empty( $this->slug ) ) ? null : "#$this->slug" ),
	// ( empty ( $this->origin_id) ) ? null : $this->origin . ' ' . $this->origin_id,
	// ),
	// '<pre>' . print_r($this, true) . '</pre>',
	// ));
	//
	// return empty($title) ? $post_title : $title;
	// }

	static function insert_mltp_detail_data( $data, $postarr, $unsanitized_postarr, $update ) {
		if ( ! $update ) {
			return $data;
		}
		if ( $data['post_type'] !== 'mltp_detail' ) {
			return $data;
		}

		// $data = apply_filters( 'multipass_set_mltp_detail_title', $data );

		return $data;
	}

	static function set_mltp_detail_title( $data ) {
		// error_log(__CLASS__ . '::' . __FUNCTION__);
		// if(empty($_REQUEST['mltp_detail_page_id'])) return $data;
		//
		// if(empty($data['post_title'])) {
		// $data['post_title'] = get_the_title($_REQUEST['mltp_detail_page_id']);
		// $data['post_name'] = sanitize_title($data['post_title']);
		// }
		return $data;
	}

	static function save_post_action( $post_id, $post, $update ) {
		if ( ! $update ) {
			return;
		}
		if ( 'mltp_detail' !== $post->post_type ) {
			return;
		}
		if ( 'trash' == $post->post_status ) {
			return;
		}

		remove_action( current_action(), __CLASS__ . '::' . __FUNCTION__ );

		$prestation_id = get_post_meta( $post_id, 'prestation_id', true );
		$item_info     = get_post_meta( $post_id, 'customer', true );

		if ( ! empty( $prestation_id ) ) {
			$user_info = array_filter(
				array_merge(
					( empty( $item_info ) ) ? array() : $item_info,
					array(
						'name' => get_post_meta( $post_id, 'customer_name', true ),
					),
					array_filter(
						array(
							'user_id' => get_post_meta( $prestation_id, 'customer_id', true ),
							'name'    => get_post_meta( $prestation_id, 'attendee_name', true ),
							'email'   => get_post_meta( $prestation_id, 'attendee_email', true ),
							'phone'   => get_post_meta( $prestation_id, 'attendee_phone', true ),
						)
					),
					array_filter(
						array(
							'user_id' => get_post_meta( $prestation_id, 'customer_id', true ),
							'name'    => get_post_meta( $prestation_id, 'customer_name', true ),
							'email'   => get_post_meta( $prestation_id, 'customer_email', true ),
							'phone'   => get_post_meta( $prestation_id, 'customer_phone', true ),
						)
					),
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

		$updates['status'] = get_post_meta( $post_id, 'status', true );

		foreach ( array( 'source', 'origin' ) as $received_source ) {
			$source    = get_post_meta( $post_id, $received_source, true );
			$source_id = get_post_meta( $post_id, $received_source . '_id', true );
			if ( ! empty( $source_id ) ) {
				// error_log("$source id $source_id");
				if ( empty( get_post_meta( $post_id, $source . '_id', true ) ) ) {
					// error_log("updating " . $source . '_id'. " with" . $source_id);
					$updates[ $source . '_id' ] = $source_id;
					// } else {
					// error_log( $source . '_id'. " already stored " . get_post_meta( $post_id, $source . '_id', true ) );
				}
			}
		}

		foreach ( MultiPass::get_registered_sources() as $source => $source_name ) {
			$source_id                        = get_post_meta( $post_id, $source . '_id', true );
			$updates[ $source . '_uuid' ]     = MultiPass::hash_source_uuid( $source, $source_id );
			$updates[ $source . '_edit_url' ] = MultiPass::get_source_url( $source, $source_id );
		}

		$price = get_post_meta( $post_id, 'price', true );
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
				$paid = 0;
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
		$attendees = ( ! is_array( $attendees ) ) ? array( 'total' => $attendees ) : $attendees;
		$attendees = empty( $attendees ) ? array() : $attendees;
		if ( $attendees ) {
			$attendees = array_replace(
				array(
					'total' => null,
				),
				$attendees
			);
			$count     = array_replace(
				array(
					'adults'   => 0,
					'children' => 0,
					'babies'   => 0,
				),
				$attendees
			);
			unset( $count['total'] );
			$sum = array_sum( $count );
			if ( $sum == 0 ) {
				$sum = null;
			}
			if ( ! empty( $sum ) && $sum != $attendees['total'] ) {
				$attendees['total'] = $sum;
			}
			$updates['attendees'] = $attendees;
		}
		$dates = isset( $_REQUEST['dates'] ) ? $_REQUEST['dates'] : null; // get_post_meta( $post_id, 'dates', true );
		if ( empty( $dates ) ) {
			$dates = array(
				'from' => get_post_meta( $post_id, 'from', true ),
				'to'   => get_post_meta( $post_id, 'to', true ),
			);
		}
		foreach ( $dates as $key => $date ) {
			$dates[ $key ] = MultiPass::timestamp( $date );
		}
		if ( isset( $dates['to'] ) && $dates['to'] === $dates['from'] ) {
			$dates['to'] = null;
		}
		$updates['from']  = empty( $dates['from'] ) ? null : $dates['from'];
		$updates['to']    = empty( $dates['to'] ) ? null : $dates['to'];
		$updates['dates'] = array(
			'from' => $updates['from'],
			'to'   => $updates['to'],
		);

		if ( empty( $dates ) ) {
			$dates            = array(
				'from' => array( 'timestamp' => get_post_meta( $post_id, 'from', true ) ),
				'to'   => array( 'timestamp' => get_post_meta( $post_id, 'to', true ) ),
			);
			$updates['dates'] = $dates;
		}

		// $updates['dates']['checkin']   = get_post_meta( $post_id, 'checkin', true );
		// $updates['dates']['checkout']   = get_post_meta( $post_id, 'checkout', true );

		if ( ! empty( $updates ) ) {
			$updates['flags'] = MultiPass::set_flags(
				array_merge(
					array(
						'paid'      => get_post_meta( $post_id, 'paid', true ),
						'deposit'   => get_post_meta( $post_id, 'deposit', true ),
						'total'     => get_post_meta( $post_id, 'total', true ),
						'confirmed' => get_post_meta( $post_id, 'confirmed', true ),
						'external'  => get_post_meta( $post_id, 'external', true ),
					),
					$updates
				)
			);

			$updates['classes'] = MultiPass::get_flag_slugs( $updates['flags'] );

			$resource_id     = get_post_meta( $post_id, 'resource_id', true );
			$prestation_slug = get_post_field( 'post_name', $prestation_id );
			$title_parts     = array(
				array(
					get_the_title( $resource_id ),
				),
				array(
					( empty( $attendees['total'] ) ) ? null : $attendees['total'] . 'p',
					MultiPass::format_date_range( $dates ),
					// (empty($prestation_slug)) ? null : "#$prestation_slug",
				),
				// @$user_info['name'],
			);
			$post_title = html_entity_decode( MultiPass::array_join( $title_parts ) );

			$post_update = array(
				'ID'         => $post_id,
				'post_title' => $post_title,
				// 'post_status' => $post_status,
				'meta_input' => $updates,
				// 'tax_input' => array(
				// 'prestation-status' => $paid_status,
				// ),
			);

			wp_update_post( $post_update );
		}

		$prestation = new Mltp_Prestation( $prestation_id );
		if ( $prestation ) {
			$prestation->update();
		}

		add_action( current_action(), __CLASS__ . '::' . __FUNCTION__, 10, 3 );
	}

	static function sanitize_mltp_detail_meta( $meta_value, $meta_key, $object_type ) {
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
		// if(get_post_type($object_id) != 'mltp_detail') return $check;
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

	static function sanitize_sources( $args ) {
		if ( ! is_array( $args ) ) {
			return $args;
		}

		if ( ! empty( $args['source'] ) ) {
			$source    = $args['source'];
			$source_id = empty( $args[ $source . '_id' ] ) ? $args['source_id'] : $args[ $source . '_id' ];
			if ( empty( $source ) || empty( $source_id ) ) {
				return $args;
			}

			$args['source_id']       = $source_id;
			$args[ $source . '_id' ] = $source_id;
			$uuid_field              = $args['source'] . '_uuid';

			if ( empty( $args[ $uuid_field ] ) ) {
				$args[ $uuid_field ] = MultiPass::hash_source_uuid( $source, $source_id );
			}
			$uuid_value = $args[ $uuid_field ];

			if ( empty( $args[ $source . '_edit_url' ] ) ) {
				$args[ $source . '_edit_url' ] = MultiPass::get_source_url( $source, $source_id, $default = null );
			}
		}

		return $args;
	}

	function get_post( $args, $update = false ) {
		$post_id = null;
		$post    = null;

		switch ( gettype( $args ) ) {
			case 'object':
				$post = $args;
				if ( isset( $post->post_type ) && 'mltp_detail' === $post->post_type ) {
					$post = $args;
				}
				unset( $args );
				break;

			case 'integer':
				$post = get_post( $args );
				if ( isset( $post->post_type ) && 'mltp_detail' === $post->post_type ) {
					$post = $post;
				}
				unset( $args );
				break;

			case 'array':
				if ( empty( $args['source'] ) ) {
					error_log( __METHOD__ . ' source cannot be empty, abort' );
					return false;
				}
				$source_term_id = get_term_by( 'slug', $args['source'], 'mltp_detail-source' );
				if ( ! $source_term_id ) {
					// not sure about that
					// error_log( __METHOD__ . 'unknown source ' . $args['source'] . ', not sure it is an issue' );
					return;
				}

				$args = self::sanitize_sources( $args );
				if ( empty( $args['source_id'] ) ) {
					error_log( __METHOD__ . "source id cannot not be empty, abort (in $source detail)." );
					return;
				}

				$uuid_field = $args['source'] . '_uuid';
				$uuid_value = $args[ $uuid_field ];

				$d    = 86400; // one day
				$from = ( empty( $args['from'] ) ) ? null : round( $args['from'] / $d ) * $d;
				$to   = ( empty( $args['to'] ) ) ? null : round( $args['to'] / $d ) * $d;

				// error_log("looking by $uuid_field = $uuid_value");
				$query_args = array(
					'post_type'   => 'mltp_detail',
					'post_status' => array( 'publish', 'open', 'canceled' ),
					'numberposts' => 1,
					'orderby'     => 'post_date',
					'order'       => 'asc',
					// 'tax_query'   => array(
					// array(
					// 'taxonomy' => 'mltp_detail-source',
					// 'field'    => 'slug',
					// 'terms'    => array( $args['source'] ),
					// 'operator' => 'IN',
					// ),
					// ),
					'meta_query'  => array(
						'relation' => 'AND',
						array(
							'key'   => $uuid_field,
							'value' => $uuid_value,
						),
					),
				);
				$posts = get_posts( $query_args );

				if ( ! $posts ) {
					$debug_query = $query_args;
					$query_args  = null;
				}

				if ( ! $posts & ! empty( $from ) & ! empty( $to ) & ! empty( $args['resource_id'] ) ) {
					// error_log("trying with " . print_r($args, true));
					// error_log("looking by resource $args[resource_id] and dates from $from to $to");

					$query_args = array(
						'post_type'   => 'mltp_detail',
						'post_status' => array( 'publish', 'open', 'canceled' ),
						// 'numberposts' => 1,
						'orderby'     => 'post_date',
						'order'       => 'asc',
						'meta_query'  => array(
							'relation' => 'AND',
							// array(
							// 'key'   => 'dates',
							// 'value' => $args['dates'],
							// ),
							array(
								'key'   => 'from',
								'value' => $from,
							),
							array(
								'key'   => 'to',
								'value' => $to,
							),
							array(
								'key'   => 'resource_id',
								'value' => $args['resource_id'],
							),
						),
					);
					$posts = get_posts( $query_args );

				}

				if ( $posts ) {
					// error_log('not found, aborting for debug purpose');
					// return false;

					$post    = reset( $posts );
					$post_id = $post->ID;
				}
				break;

		}

		if ( $post ) {
			$this->id   = $post->ID;
			$this->name = html_entity_decode( $post->post_title );
			$this->post = $post;
			// $this->name = $this->post->post_title;
			$this->dates = get_post_meta( $this->id, 'dates', true );
			$this->from  = get_post_meta( $this->id, 'from', true );
			$this->to    = get_post_meta( $this->id, 'to', true );
			// $this->type = get_post_meta($this->id, 'type', true);
			$this->flags = (int) get_post_meta( $this->id, 'flags', true );
			// } else {
			// $this->id   = null;
			// $this->post = null;
		}

		if ( empty( $this->dates ) ) {
			$this->dates = array(
				'from' => $this->from,
				'to'   => $this->to,
			);
		}

		if ( ! empty( $args ) && is_array( $args ) && ( empty( $post_id ) || $update ) ) {
			// $create = (empty($post_id));
			$args['from']  = $from;
			$args['to']    = $to;
			$args['dates'] = $this->dates;

			$post = $this->update( $args );

			// if($create) {
			// error_log("nothing found with $uuid_field = $uuid_value, create new one $post->ID " . print_r(get_post_meta($post->ID), true));
			// }

		}

		return $post;
	}

	function update( $args = array() ) {
		$post_id = $this->id;

		// $debug['removed'] = array_diff($args, $debug['received']);
		// $debug['added'] = array_diff($debug['received'], $args);
		// $debug['kept'] = array_intersect($args, $debug['received']);

		$description = ( empty( $args['description'] ) ) ? $this->name : $args['description'];

		$prestation    = false;
		$prestation_id = get_post_meta( $this->id, 'prestation_id', true );
		if ( ! empty( $prestation_id ) ) {
			$prestation = new Mltp_Prestation( $prestation_id );
			if ( ! $prestation ) {
				error_log( 'could not find prestation by id ' . $prestation_id );
			}
		}
		if ( ! $prestation ) {
			$prestation = new Mltp_Prestation( $args );
			if ( ! $prestation ) {
				error_log( 'could not find prestation by args ' . json_encode( $args ) );
			}
		}
		if ( ! $prestation ) {
			$args = array_intersect(
				array(
					'prestation_id'  => null,
					'customer_id'    => null,
					'customer_name'  => null,
					'customer_email' => null,
					'from'           => null,
					'to'             => null,
				),
				$args
			);
			error_log( 'coult not find nor create prestation with ' . json_encode( $args ) );
			return false;
		}
		$args['prestation_id'] = ( $prestation ) ? $prestation->id : null;

		if ( empty( $args['description'] ) ) {
			$post_title = $this->name;
		} else {
			$post_title = ( empty( $args['description'] ) ) ? $this->name : $description;
			$post_title = preg_replace( '/(, | - ).*', '', $post_title );
			// $title = preg_replace('/,.*/', '', $title);
			// $post_title = "$description, ${guests_total}p $date_range";
			$dates      = array(
				'from' => ( ! empty( $args['from'] ) ) ? $args['from'] : null,
				'to'   => ( ! empty( $args['to'] ) ) ? $args['to'] : null,
			);
			$info       = array_filter(
				array(
					$post_title,
					( ! empty( $args['attendees'] ) && is_array( $args['attendees'] ) & ! empty( $args['attendees']['total'] ) ) ? $args['attendees']['total'] . 'p' : null,
					( ! empty( $dates ) ) ? MultiPass::format_date_range( $dates ) : null,
				)
			);
			$post_title = html_entity_decode( join( ', ', $info ) );
		}
		if ( empty( $args['notes'] ) ) {
			unset( $args['notes'] ); // Do not replace if not provided
		}

		switch ( @$args['status'] ) {
			case 'open':
				$post_status = 'open';
				break;

			case 'declined':
				$post_status = 'canceled';
				break;

			default:
				$post_status = 'publish';
		}

		$postarr = array_filter(
			array(
				'ID'          => $post_id,
				'post_author' => ( empty( $args['customer']['user_id'] ) ) ? null : $args['customer']['user_id'],
				'post_date'   => ( empty( $post_id ) && isset( $args['date'] ) ) ? $args['date'] : null,
				'post_title'  => $post_title,
				// '%s #%s-%s',
				// $args['description'],
				// $args['source_id'],
				// $args['source_item_id'],
				// ),
				// 'post_date_gmt' => esc_attr($args['date_gmt']),
				'post_type'   => 'mltp_detail',
				'post_status' => $post_status,
				'meta_input'  => $args,
			)
		);
		if ( ! empty( $args['source'] ) ) {
			$postarr['tax_input'] = array(
				'mltp_detail-source' => $args['source'],
			);
		}

		// error_log(print_r($postarr, true));

		$this->id = wp_insert_post( $postarr );
		if ( is_wp_error( $this->id ) ) {
			return $this->id;
		}

		if ( $prestation ) {
			$prestation->update();
		}

		$post = get_post( $this->id );
		// $this->id   = $post->ID;
		$this->name = html_entity_decode( $post->post_title );
		$this->post = $post;
		// $this->name = $this->post->post_title;
		// $this->dates = get_post_meta($this->id, 'dates', true);
		$this->from = get_post_meta( $this->id, 'from', true );
		$this->to   = get_post_meta( $this->id, 'to', true );
		// $this->type = get_post_meta($this->id, 'type', true);
		$this->flags = (int) get_post_meta( $this->id, 'flags', true );

		return $this->post;
	}

	public function get_source_url( $source = 'source', $source_id = null, $default = null, $args = array() ) {
		if ( $this->is_closed() ) {
			$args['status'] = 'closed-period';
		}
		return MultiPass::get_source_url( $source, $source_id, $default, $args );
	}

	public function get_origin_url() {
		return $this->get_source_url( 'origin' ) . '?' . __CLASS__ . '&' . __METHOD__;
	}

	public function is_closed() {
		return ( (int) $this->flags & MLTP_CLOSED_PERIOD ) ? true : false;
	}
}

$this->loaders[] = new Mltp_Item();

/**
 * This is a dirty fix. This class needs to be loaded, or the admin columns has
 * to be set in another way.
 */
if ( class_exists( '\MBAC\Post' ) ) {
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
					$from = get_post_meta( $post_id, 'from', true );
					$to   = get_post_meta( $post_id, 'to', true );
					echo MultiPass::format_date_range( array( $from, $to ) );
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
}
