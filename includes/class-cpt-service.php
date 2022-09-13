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

			// array (
			// 	'hook' => 'save_post_service',
			// 	'callback' => 'save_post',
			// 	'accepted_args' => 3,
			// ),

			// array(
			// 	'hook' => 'pre_get_posts',
			// 	'callback' => 'sortable_columns_order',
			// ),
			//

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
			// array(
			// 	'hook' => 'updated_service_meta',
			// 	'callback' => 'updated_meta',
			// )
			array(
				'hook' => 'manage_service_posts_columns',
				'callback' => 'add_admin_columns',
			),
			array(
				'hook' => 'term_link',
				'callback' => 'term_link_filter',
				'accepted_args' => 3,
			),

			array(
				'hook' => 'wp_insert_post_data',
				'callback' => 'insert_service_data',
				'accepted_args' => 4,
			),
			array(
				'hook' => 'multiservices_update_service_title',
				'callback' => 'update_service_title',
			),

			// array(
			// 	'hook' => 'term_link',
			// 	'callback' => 'term_link_filter',
			// 	'accepted_args' => 3,
			// ),
			//
			// array(
			// 	'hook' => 'manage_service_posts_columns',
			// 	'callback' => 'add_admin_columns',
			// ),
			// array(
			// 	'hook' => 'manage_service_posts_custom_column',
			// 	'callback' => 'admin_columns_display',
			// 	'priority' => 99,
			// 	'accepted_args' => 2,
			// ),
			// array(
			// 	'hook' => 'manage_edit-service_sortable_columns',
			// 	'callback' => 'sortable_columns',
			// ),
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
			'supports'            => [ 'title' ],
			'taxonomies'          => [],
			'rewrite'             => [
				'slug'       => 'service',
				'with_front' => false,
			],
		];

		register_post_type( 'service', $args );
	}

	static function register_fields( $meta_boxes ) {
		$prefix = 'service_';

    $meta_boxes['services'] = [
        'title'      => __('Services', 'multiservices' ),
        'post_types' => ['service'],
        'autosave'   => true,
				'style' => 'seamless',
        'fields'     => [
            [
                'name'          => __('Page', 'multiservices' ),
                'id'         => 'service_page_id',
                'type'          => 'post',
                'post_type'     => ['page'],
                'field_type'    => 'select_advanced',
								'admin_columns' => [
										'position'   => 'after title',
										'sort'       => true,
										'searchable' => true,
								],
								'columns' => 3,
            ],
        ],
    ];

    return $meta_boxes;
	}

	// static function updated_meta($meta_id, $object_id, $meta_key, $_meta_value ) {
	// 	error_log(__FUNCTION__ . " meta_id $meta_id object_id $object_id key $meta_key value $meta_value");
	//
	// }

	static function insert_service_data ($data, $postarr, $unsanitized_postarr, $update ) {
		if(!$update) return $data;
		if($data['post_type'] !== 'service') return $data;

		$data = apply_filters('multiservices_update_service_title', $data);

		return $data;
	}

	static function update_service_title ($data ) {
		// error_log(__CLASS__ . '::' . __FUNCTION__);
		if(empty($_REQUEST['service_page_id'])) return $data;

		if(empty($data['post_title'])) {
			$data['post_title'] = get_the_title($_REQUEST['service_page_id']);
			$data['post_name'] = sanitize_title($data['post_title']);
		}
		return $data;
	}

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
		register_taxonomy( 'service-type', ['prestation', 'product', 'service', 'prestation-item'], $args );

		MultiServices::register_terms('service-type', array(
			'booking' => __('Booking', 'multiservices'),
		));

	}

	static function add_admin_columns( $columns ) {
		$columns['taxonomy-service-type'] = __('Service Type', 'multiservices');
		return $columns;
	}

	static function term_link_filter ( $termlink, $term, $taxonomy ) {
		if ( 'service-type' === $taxonomy ) {
			return add_query_arg( array(
				'service-type' => $term->slug,
			), admin_url(basename($_SERVER['REQUEST_URI'])) );
		}
		return $termlink;
	}

}
