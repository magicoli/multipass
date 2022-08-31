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
class MultiServices_Association {

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
			// array(
			// 	'hook' => 'init',
			// 	'callback' => 'register_taxonomies',
			// ),

			array (
				'hook' => 'save_post_association',
				'callback' => 'save_post',
				'accepted_args' => 3,
			),

			// array(
			// 	'hook' => 'pre_get_posts',
			// 	'callback' => 'sortable_columns_order',
			// ),

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
			// 	'hook' => 'updated_pr_association_meta',
			// 	'callback' => 'updated_meta',
			// )
			array(
				'hook' => 'wp_insert_post_data',
				'callback' => 'insert_association_data',
				'accepted_args' => 4,
			),
			array(
				'hook' => 'prestations_set_association_title',
				'callback' => 'set_association_title',
			),

			// array(
			// 	'hook' => 'term_link',
			// 	'callback' => 'term_link_filter',
			// 	'accepted_args' => 3,
			// ),
			//
			// array(
			// 	'hook' => 'manage_association_posts_columns',
			// 	'callback' => 'add_admin_columns',
			// ),
			// array(
			// 	'hook' => 'manage_association_posts_custom_column',
			// 	'callback' => 'admin_columns_display',
			// 	'priority' => 99,
			// 	'accepted_args' => 2,
			// ),
			// array(
			// 	'hook' => 'manage_edit-association_sortable_columns',
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
			'name'                     => esc_html__( 'Associations', 'prestations' ),
			'singular_name'            => esc_html__( 'Association', 'prestations' ),
			'add_new'                  => esc_html__( 'Add New', 'prestations' ),
			'add_new_item'             => esc_html__( 'Add New Association', 'prestations' ),
			'edit_item'                => esc_html__( 'Edit Association', 'prestations' ),
			'new_item'                 => esc_html__( 'New Association', 'prestations' ),
			'view_item'                => esc_html__( 'View Association', 'prestations' ),
			'view_items'               => esc_html__( 'View Associations', 'prestations' ),
			'search_items'             => esc_html__( 'Search Associations', 'prestations' ),
			'not_found'                => esc_html__( 'No associations found.', 'prestations' ),
			'not_found_in_trash'       => esc_html__( 'No associations found in Trash.', 'prestations' ),
			'parent_item_colon'        => esc_html__( 'Parent Association:', 'prestations' ),
			'all_items'                => esc_html__( 'Associations', 'prestations' ),
			'archives'                 => esc_html__( 'Association Archives', 'prestations' ),
			'attributes'               => esc_html__( 'Association Attributes', 'prestations' ),
			'insert_into_item'         => esc_html__( 'Insert into association', 'prestations' ),
			'uploaded_to_this_item'    => esc_html__( 'Uploaded to this association', 'prestations' ),
			'featured_image'           => esc_html__( 'Featured image', 'prestations' ),
			'set_featured_image'       => esc_html__( 'Set featured image', 'prestations' ),
			'remove_featured_image'    => esc_html__( 'Remove featured image', 'prestations' ),
			'use_featured_image'       => esc_html__( 'Use as featured image', 'prestations' ),
			'menu_name'                => esc_html__( 'Associations', 'prestations' ),
			'filter_items_list'        => esc_html__( 'Filter associations list', 'prestations' ),
			'filter_by_date'           => esc_html__( '', 'prestations' ),
			'items_list_navigation'    => esc_html__( 'Associations list navigation', 'prestations' ),
			'items_list'               => esc_html__( 'Associations list', 'prestations' ),
			'item_published'           => esc_html__( 'Association published.', 'prestations' ),
			'item_published_privately' => esc_html__( 'Association published privately.', 'prestations' ),
			'item_reverted_to_draft'   => esc_html__( 'Association reverted to draft.', 'prestations' ),
			'item_scheduled'           => esc_html__( 'Association scheduled.', 'prestations' ),
			'item_updated'             => esc_html__( 'Association updated.', 'prestations' ),
			'text_domain'              => esc_html__( 'prestations', 'prestations' ),
		];
		$args = [
			'label'               => esc_html__( 'Associations', 'prestations' ),
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
				'slug'       => 'association',
				'with_front' => false,
			],
		];

		register_post_type( 'pr_association', $args );
	}

	static function register_fields( $meta_boxes ) {
		$prefix = 'association_';

    $meta_boxes['associations'] = [
        'title'      => __( 'Associations', 'prestations' ),
        'post_types' => ['pr_association'],
        'autosave'   => true,
				'style' => 'seamless',
        'fields'     => [
            [
                'name'          => __( 'Page', 'prestations' ),
                'id'         => 'association_page_id',
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

	static function insert_association_data ($data, $postarr, $unsanitized_postarr, $update ) {
		if(!$update) return $data;
		if($data['post_type'] !== 'pr_association') return $data;

		$data = apply_filters('prestations_set_association_title', $data);

		return $data;
	}

	static function set_association_title ($data ) {
		// error_log(__CLASS__ . '::' . __FUNCTION__);
		if(empty($_REQUEST['association_page_id'])) return $data;

		if(empty($data['post_title'])) {
			$data['post_title'] = get_the_title($_REQUEST['association_page_id']);
			$data['post_name'] = sanitize_title($data['post_title']);
		}
		return $data;
	}

	static function register_taxonomies() {

	}

}
