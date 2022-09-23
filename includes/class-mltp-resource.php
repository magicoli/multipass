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
 * @author     Your Name <email@example.com>
 */
class Mltp_Resource {

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
	 * @param    int    $accepted_args    Optional. The number of arguments that should be passed to the $callback. Default is 1.
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
		);

		$filters = array(
			array(
				'hook'     => 'rwmb_meta_boxes',
				'callback' => 'register_fields',
			),

			array(
				'hook'     => 'manage_resource_posts_columns',
				'callback' => 'add_admin_columns',
			),
			array(
				'hook'          => 'term_link',
				'callback'      => 'term_link_filter',
				'accepted_args' => 3,
			),

			array(
				'hook'          => 'wp_insert_post_data',
				'callback'      => 'insert_resource_data',
				'accepted_args' => 4,
			),
			array(
				'hook'     => 'multipass_update_resource_title',
				'callback' => 'update_resource_title',
			),

		);

		foreach ( $filters as $hook ) {
			$hook = array_merge(
				array(
					'component'     => __CLASS__,
					'priority'      => 10,
					'accepted_args' => 1,
				),
				$hook
			);
			add_filter( $hook['hook'], array( $hook['component'], $hook['callback'] ), $hook['priority'], $hook['accepted_args'] );
		}

		foreach ( $actions as $hook ) {
			$hook = array_merge(
				array(
					'component'     => __CLASS__,
					'priority'      => 10,
					'accepted_args' => 1,
				),
				$hook
			);
			add_action( $hook['hook'], array( $hook['component'], $hook['callback'] ), $hook['priority'], $hook['accepted_args'] );
		}

	}

	/**
	 * Register Resource post type
	 *
	 * @return void
	 */
	public static function register_post_types() {
		$labels = array(
			'name'                     => esc_html__( 'Resources', 'multipass' ),
			'singular_name'            => esc_html__( 'Resource', 'multipass' ),
			'add_new'                  => esc_html__( 'Add New', 'multipass' ),
			'add_new_item'             => esc_html__( 'Add New Resource', 'multipass' ),
			'edit_item'                => esc_html__( 'Edit Resource', 'multipass' ),
			'new_item'                 => esc_html__( 'New Resource', 'multipass' ),
			'view_item'                => esc_html__( 'View Resource', 'multipass' ),
			'view_items'               => esc_html__( 'View Resources', 'multipass' ),
			'search_items'             => esc_html__( 'Search Resources', 'multipass' ),
			'not_found'                => esc_html__( 'No resources found.', 'multipass' ),
			'not_found_in_trash'       => esc_html__( 'No resources found in Trash.', 'multipass' ),
			'parent_item_colon'        => esc_html__( 'Parent Resource:', 'multipass' ),
			'all_items'                => esc_html__( 'Resources', 'multipass' ),
			'archives'                 => esc_html__( 'Resource Archives', 'multipass' ),
			'attributes'               => esc_html__( 'Resource Attributes', 'multipass' ),
			'insert_into_item'         => esc_html__( 'Insert into resource', 'multipass' ),
			'uploaded_to_this_item'    => esc_html__( 'Uploaded to this resource', 'multipass' ),
			'featured_image'           => esc_html__( 'Featured image', 'multipass' ),
			'set_featured_image'       => esc_html__( 'Set featured image', 'multipass' ),
			'remove_featured_image'    => esc_html__( 'Remove featured image', 'multipass' ),
			'use_featured_image'       => esc_html__( 'Use as featured image', 'multipass' ),
			'menu_name'                => esc_html__( 'Resources', 'multipass' ),
			'filter_items_list'        => esc_html__( 'Filter resources list', 'multipass' ),
			'filter_by_date'           => esc_html__( 'Filter by date', 'multipass' ),
			'items_list_navigation'    => esc_html__( 'Resources list navigation', 'multipass' ),
			'items_list'               => esc_html__( 'Resources list', 'multipass' ),
			'item_published'           => esc_html__( 'Resource published.', 'multipass' ),
			'item_published_privately' => esc_html__( 'Resource published privately.', 'multipass' ),
			'item_reverted_to_draft'   => esc_html__( 'Resource reverted to draft.', 'multipass' ),
			'item_scheduled'           => esc_html__( 'Resource scheduled.', 'multipass' ),
			'item_updated'             => esc_html__( 'Resource updated.', 'multipass' ),
			'text_domain'              => 'multipass',
		);
		$args   = array(
			'label'               => esc_html__( 'Resources', 'multipass' ),
			'labels'              => $labels,
			'description'         => '',
			'public'              => true,
			'hierarchical'        => false,
			'exclude_from_search' => false,
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
			'supports'            => array( 'title' ),
			'taxonomies'          => array(),
			'rewrite'             => array(
				'slug'       => 'mp_resource',
				'with_front' => false,
			),
		);

		register_post_type( 'mp_resource', $args );
	}

	/**
	 * Register Resources fields
	 *
	 * @param  array $meta_boxes    current metaboxes.
	 * @return array                updated metaboxes.
	 */
	public static function register_fields( $meta_boxes ) {
		$prefix = 'resource_';

		$meta_boxes['resources'] = array(
			'title'      => __( 'Resources', 'multipass' ),
			'post_types' => array( 'mp_resource' ),
			'autosave'   => true,
			'style'      => 'seamless',
			'fields'     => array(
				array(
					'name'          => __( 'Page', 'multipass' ),
					'id'            => 'resource_page_id',
					'type'          => 'post',
					'post_type'     => array( 'page' ),
					'field_type'    => 'select_advanced',
					'admin_columns' => array(
						'position'   => 'after title',
						'sort'       => true,
						'searchable' => true,
					),
					'columns'       => 3,
				),
			),
		);

		$meta_boxes['resources_settings'] = array(
			'title'      => __( 'Resource Settings', 'multipass' ),
			'id'         => 'resource-settings',
			'post_types' => array( 'mp_resource' ),
			'style'      => 'seamless',
			'fields'     => array(
				array(
					'name'       => __( 'Resource Type', 'multipass' ),
					'id'         => $prefix . 'resource_type',
					'type'       => 'taxonomy',
					'taxonomy'   => array( 'resource-type' ),
					'field_type' => 'select_advanced',
				),
				array(
					'name'        => __( 'Get rules from', 'multipass' ),
					'id'          => $prefix . 'get_rules_from',
					'type'        => 'select',
					'placeholder' => __( 'Custom Rules', 'multipass' ),
				),
				array(
					'name'        => __( 'Get prices from', 'multipass' ),
					'id'          => $prefix . 'get_prices_from',
					'type'        => 'select',
					'placeholder' => __( 'Custom Prices', 'multipass' ),
				),
			),
		);

		$meta_boxes['resource_type_settings'] = array(
			'title'      => __( 'Resource Type Settings', 'multipass' ),
			'id'         => 'resource-type-settings',
			'taxonomies' => array( 'resource-type' ),
			'fields'     => array(
				array(
					'name' => __( 'Get rules from Parent', 'multipass' ),
					'id'   => $prefix . 'get_rules_from',
					'type' => 'switch',
				),
				array(
					'name' => __( 'Get prices from Parent', 'multipass' ),
					'id'   => $prefix . 'get_prices_from',
					'type' => 'switch',
				),
			),
		);

		$settings_rules = array(
			'title'      => __( 'Resource Rules', 'multipass' ),
			'visible'    => array(
				'when'     => array( array( 'get_rules_from', '=', '' ), array( 'parent', '=', '' ) ),
				'relation' => 'or',
			),
			'fields'     => array(
				array(
					'name'   => __( 'Quantity', 'multipass' ),
					'id'     => $prefix . 'quantity',
					'type'   => 'group',
					'fields' => array(
						array(
							'id'    => $prefix . 'has_quantity',
							'type'  => 'switch',
							'style' => 'rounded',
						),
						array(
							'name'    => __( 'Min', 'multipass' ),
							'id'      => $prefix . 'min',
							'type'    => 'number',
							'min'     => 0,
							'size'    => 5,
							'visible' => array(
								'when'     => array( array( 'has_quantity', '=', 1 ) ),
								'relation' => 'or',
							),
						),
						array(
							'name'    => __( 'Max', 'multipass' ),
							'id'      => $prefix . 'max',
							'type'    => 'number',
							'min'     => 0,
							'size'    => 5,
							'visible' => array(
								'when'     => array( array( 'has_quantity', '=', 1 ) ),
								'relation' => 'or',
							),
						),
					),
				),
				array(
					'name'  => __( 'Guests', 'multipass' ),
					'id'    => $prefix . 'has_guests',
					'type'  => 'switch',
					'style' => 'rounded',
				),
				array(
					'name'    => __( 'Guests Rules', 'multipass' ),
					'id'      => $prefix . 'guests_rules',
					'type'    => 'group',
					'fields'  => array(
						array(
							'id'      => $prefix . 'total',
							'type'    => 'group',
							'fields'  => array(
								array(
									'name'        => __( 'Total', 'multipass' ),
									'id'          => $prefix . 'placeholder',
									'type'        => 'text',
									'placeholder' => __( 'Set total capacity', 'multipass' ),
									'size'        => 20,
									'disabled'    => true,
									'readonly'    => true,
								),
								array(
									'name' => __( 'Min', 'multipass' ),
									'id'   => $prefix . 'min',
									'type' => 'number',
									'min'  => 0,
									'size' => 5,
								),
								array(
									'name' => __( 'Max', 'multipass' ),
									'id'   => $prefix . 'max',
									'type' => 'number',
									'min'  => 0,
									'size' => 5,
								),
							),
							'visible' => array(
								'when'     => array( array( 'has_guests', '=', 1 ) ),
								'relation' => 'or',
							),
						),
						array(
							'id'            => $prefix . 'guest_types',
							'type'          => 'group',
							'clone'         => true,
							'clone_default' => true,
							'fields'        => array(
								array(
									'name'     => __( 'Guest Type', 'multipass' ),
									'id'       => $prefix . 'guest_type',
									'type'     => 'text',
									'size'     => 20,
									'datalist' => array(
										'id'      => '632e33c01ea75',
										'options' => array(
											'Adults
							',
											'Children
							',
											'Babies',
										),
									),
								),
								array(
									'name'  => __( 'Include in total', 'multipass' ),
									'id'    => $prefix . 'include',
									'type'  => 'switch',
									'desc'  => __( 'For min and max capacity', 'multipass' ),
									'style' => 'rounded',
									'std'   => true,
								),
								array(
									'name' => __( 'Number', 'multipass' ),
									'id'   => $prefix . 'number_k0fwejl49fg',
									'type' => 'number',
									'min'  => 0,
									'size' => 5,
								),
								array(
									'name' => __( 'Max', 'multipass' ),
									'id'   => $prefix . 'max',
									'type' => 'number',
									'min'  => 0,
									'size' => 5,
								),
							),
							'visible'       => array(
								'when'     => array( array( 'has_guests', '=', 1 ) ),
								'relation' => 'or',
							),
						),
					),
					'visible' => array(
						'when'     => array( array( 'has_guests', '=', 1 ) ),
						'relation' => 'or',
					),
				),
				array(
					'name'  => __( 'Booking', 'multipass' ),
					'id'    => $prefix . 'has_booking',
					'type'  => 'switch',
					'style' => 'rounded',
				),
				array(
					'name'    => __( 'Booking Rules', 'multipass' ),
					'id'      => $prefix . 'booking_rules',
					'type'    => 'group',
					'desc'    => __( 'Default, minimum and maximum durations are counted in hours when unit is "time", days for "Full day" or "Ovenight". Hours can be divided (1.5, 0.25...), days cannot (1, 2..). Set maximum to 0 or empty for unlimited duration.', 'multipass' ),
					'fields'  => array(
						array(
							'name'    => __( 'Unit', 'multipass' ),
							'id'      => $prefix . 'unit',
							'type'    => 'select',
							'options' => array(
								'time'      => __( 'Time', 'multipass' ),
								'fullday'   => __( 'Full Day', 'multipass' ),
								'overnight' => __( 'Overnight', 'multipass' ),
							),
							'std'     => 'overnight',
						),
						array(
							'type' => 'divider',
						),
						array(
							'name' => __( 'Default Duration', 'multipass' ),
							'id'   => $prefix . 'default_duration',
							'type' => 'number',
							'min'  => 1,
							'step' => 'any',
							'size' => 5,
						),
						array(
							'name' => __( 'Min Duration', 'multipass' ),
							'id'   => $prefix . 'min_duration',
							'type' => 'number',
							'min'  => 0,
							'step' => 'any',
							'size' => 5,
						),
						array(
							'name' => __( 'Max Duration', 'multipass' ),
							'id'   => $prefix . 'max_duration',
							'type' => 'number',
							'min'  => 0,
							'step' => 'any',
							'size' => 5,
						),
						array(
							'type' => 'divider',
						),
						array(
							'name'    => __( 'Min Time', 'multipass' ),
							'id'      => $prefix . 'min_time',
							'type'    => 'time',
							'size'    => 5,
							'visible' => array(
								'when'     => array( array( 'unit', '=', 'time' ) ),
								'relation' => 'or',
							),
						),
						array(
							'name'    => __( 'Max Time', 'multipass' ),
							'id'      => $prefix . 'max_time',
							'type'    => 'time',
							'size'    => 5,
							'visible' => array(
								'when'     => array( array( 'unit', '=', 'time' ) ),
								'relation' => 'or',
							),
						),
					),
					'visible' => array(
						'when'     => array( array( 'has_booking', '=', 1 ) ),
						'relation' => 'or',
					),
				),
			),
		);

		$settings_prices = array(
			'title'      => __( 'Resource Prices', 'multipass' ),
			'id'         => 'resource-prices',
			'visible'    => array(
				'when'     => array( array( 'get_prices_from', '=', '' ) ),
				'relation' => 'or',
			),
			'fields'     => array(
				array(
					'name'    => __( 'Fixed', 'multipass' ),
					'id'      => $prefix . 'fixed',
					'type'    => 'number',
					'min'     => 0,
					'step'    => 'any',
					'size'    => 10,
					'prepend' => MultiPass::get_currency_symbol(),
				),
				array(
					'name'    => __( 'Per Quantity', 'multipass' ),
					'id'      => $prefix . 'per_quantity',
					'type'    => 'number',
					'min'     => 0,
					'step'    => 'any',
					'size'    => 10,
					'prepend' => MultiPass::get_currency_symbol(),
					'visible' => array(
						'when'     => array( array( 'has_quantity', '=', 1 ) ),
						'relation' => 'or',
					),
				),
				array(
					'name'    => __( 'Per Booking unit', 'multipass' ),
					'id'      => $prefix . 'per_unit',
					'type'    => 'number',
					'min'     => 0,
					'step'    => 'any',
					'size'    => 10,
					'prepend' => MultiPass::get_currency_symbol(),
					'visible' => array(
						'when'     => array( array( 'has_booking', '=', 1 ) ),
						'relation' => 'or',
					),
				),
				array(
					'name'    => __( 'Per Guest', 'multipass' ),
					'id'      => $prefix . 'per_guest',
					'type'    => 'number',
					'min'     => 0,
					'step'    => 'any',
					'size'    => 10,
					'prepend' => MultiPass::get_currency_symbol(),
					'visible' => array(
						'when'     => array( array( 'has_guests', '=', 1 ) ),
						'relation' => 'or',
					),
				),
			),
		);

		$meta_boxes['resource_type_rules'] = array_merge($settings_rules, array(
			'id'         => 'resource-type-rules',
			'taxonomies' => array( 'resource-type' ),
		));
		$meta_boxes['resource_rules'] = array_merge($settings_rules, array(
			'id'         => 'resource-rules',
			'post_types' => array( 'mp_resource' ),
		));
		$meta_boxes['resource_type_prices'] = array_merge($settings_prices, array(
			'id'         => 'resource-type-prices',
			'taxonomies' => array( 'resource-type' ),
		));
		$meta_boxes['resource_prices'] = array_merge($settings_prices, array(
			'id'         => 'resource-prices',
			'post_types' => array( 'mp_resource' ),
		));

		return $meta_boxes;
	}

	/**
	 * Update Resource post filter. Define multipass_update_resource_title hook for
	 * use by other modules.
	 *
	 * @param array $data                 An array of slashed, sanitized, and processed post data.
	 * @param array $postarr              An array of sanitized (and slashed) but otherwise unmodified post data.
	 * @param array $unsanitized_postarr  An array of slashed yet *unsanitized* and unprocessed post data as originally passed to wp_insert_post().
	 * @param bool  $update               Whether this is an existing post being updated.
	 * @return array                      Modifield post data.
	 */
	public static function insert_resource_data( $data, $postarr, $unsanitized_postarr, $update ) {
		if ( $update && 'mp_resource' === $data['post_type'] ) {
			$data = apply_filters( 'multipass_update_resource_title', $data );
		}

		return $data;
	}

	/**
	 * Set resource title automatically, based on details from external resource or module.
	 *
	 * @param array $data                 An array of slashed, sanitized, and processed post data.
	 * @return array                      Modifield post data.
	 */
	public static function update_resource_title( $data ) {
		if ( empty( $_REQUEST['resource_page_id'] ) ) {
			return $data;
		}

		if ( empty( $data['post_title'] ) ) {
			$data['post_title'] = get_the_title( absint( $_REQUEST['resource_page_id'] ) );
			$data['post_name']  = sanitize_title( esc_attr( $data['post_title'] ) );
		}
		return $data;
	}

	/**
	 * Register resource-type taxonomy.
	 *
	 * @return void
	 */
	public static function register_taxonomies() {
		$labels = array(
			'name'                       => esc_html__( 'Resource Types', 'multipass' ),
			'singular_name'              => esc_html__( 'Resource Type', 'multipass' ),
			'menu_name'                  => esc_html__( 'Resource Types', 'multipass' ),
			'search_items'               => esc_html__( 'Search Resource Types', 'multipass' ),
			'popular_items'              => esc_html__( 'Popular Resource Types', 'multipass' ),
			'all_items'                  => esc_html__( 'All Resource Types', 'multipass' ),
			'parent_item'                => esc_html__( 'Parent Resource Type', 'multipass' ),
			'parent_item_colon'          => esc_html__( 'Parent Resource Type:', 'multipass' ),
			'edit_item'                  => esc_html__( 'Edit Resource Type', 'multipass' ),
			'view_item'                  => esc_html__( 'View Resource Type', 'multipass' ),
			'update_item'                => esc_html__( 'Update Resource Type', 'multipass' ),
			'add_new_item'               => esc_html__( 'Add New Resource Type', 'multipass' ),
			'new_item_name'              => esc_html__( 'New Resource Type Name', 'multipass' ),
			'separate_items_with_commas' => esc_html__( 'Separate resource types with commas', 'multipass' ),
			'add_or_remove_items'        => esc_html__( 'Add or remove resource types', 'multipass' ),
			'choose_from_most_used'      => esc_html__( 'Choose most used resource types', 'multipass' ),
			'not_found'                  => esc_html__( 'No resource types found.', 'multipass' ),
			'no_terms'                   => esc_html__( 'No resource types', 'multipass' ),
			'filter_by_item'             => esc_html__( 'Filter by resource type', 'multipass' ),
			'items_list_navigation'      => esc_html__( 'Resource Types list pagination', 'multipass' ),
			'items_list'                 => esc_html__( 'Resource Types list', 'multipass' ),
			'most_used'                  => esc_html__( 'Most Used', 'multipass' ),
			'back_to_items'              => esc_html__( '&larr; Go to Resource Types', 'multipass' ),
			'text_domain'                => esc_html__( 'multipass', 'multipass' ),
		);
		$args   = array(
			'label'              => esc_html__( 'Resource Types', 'multipass' ),
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
			'show_admin_column'  => false,
			'query_var'          => true,
			'sort'               => false,
			'meta_box_cb'        => 'post_categories_meta_box',
			'rest_base'          => '',
			'rewrite'            => array(
				'with_front'   => false,
				'hierarchical' => false,
			),
		);
		register_taxonomy( 'resource-type', array( 'prestation', 'product', 'mp_resource', 'prestation-item' ), $args );

		MultiPass::register_terms(
			'resource-type',
			array(
				'booking'  => __( 'Booking', 'multipass' ),
				'catering' => __( 'Catering', 'multipass' ),
				'service'  => __( 'Service', 'multipass' ),
				'product'  => __( 'Product', 'multipass' ),
			)
		);

	}

	/**
	 * Define additional columns for Resources admin list.
	 *
	 * @param array $columns Columns.
	 */
	public static function add_admin_columns( $columns ) {
		// $columns['taxonomy-resource-type'] = __( 'Resource Type', 'multipass' );
		return $columns;
	}

	/**
	 * Allow filter by term in Resources admin list.
	 *
	 * @param  string $termlink   Term link URL.
	 * @param  object $term       Term object.
	 * @param  string $taxonomy   Taxonomy slug.
	 * @return string             Term link URL.
	 */
	public static function term_link_filter( $termlink, $term, $taxonomy ) {
		// if ( 'resource-type' === $taxonomy ) {
		// return add_query_arg(
		// array(
		// 'resource-type' => $term->slug,
		// ),
		// admin_url( basename( $_SERVER['REQUEST_URI'] ) )
		// );
		// }
		return $termlink;
	}

}

$this->loaders[] = new Mltp_Resource();
