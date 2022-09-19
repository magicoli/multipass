<?php
/**
 * Register all actions and filters for the plugin
 *
 * @link  https://github.com/magicoli/multipass
 * @since 1.0.0
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
class Mltp_Calendar {


	/**
	 * The array of actions registered with WordPress.
	 *
	 * @since  1.0.0
	 * @access protected
	 * @var    array    $actions    The actions registered with WordPress to fire when the plugin loads.
	 */
	protected $actions;

	/**
	 * The array of filters registered with WordPress.
	 *
	 * @since  1.0.0
	 * @access protected
	 * @var    array    $filters    The filters registered with WordPress to fire when the plugin loads.
	 */
	protected $filters;

	/**
	 * Initialize the collections used to maintain the actions and filters.
	 *
	 * @since 1.0.0
	 */
	public function __construct() {
	}

	/**
	 * Register the filters and actions with WordPress.
	 *
	 * @since 1.0.0
	 */
	public function run() {

		$actions = array(
			// array(
			// 'hook'     => 'init',
			// 'callback' => 'register_post_types',
			// ),
			array(
				'hook'     => 'init',
				'callback' => 'register_taxonomies',
			),
		// array(
		// 'hook'     => 'admin_menu',
		// 'callback' => 'admin_menu_action',
		// ),
		);

		$filters = array(
			array(
				'hook'     => 'mb_settings_pages',
				'callback' => 'register_settings_pages',
			),

			array(
				'hook'     => 'rwmb_meta_boxes',
				'callback' => 'register_fields',
			),

			// array(
			// 'hook'     => 'manage_calendar_posts_columns',
			// 'callback' => 'add_admin_columns',
			// ),
			array(
				'hook'          => 'term_link',
				'callback'      => 'term_link_filter',
				'accepted_args' => 3,
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
	 * Register Calendar post type
	 *
	 * @return void
	 */
	public static function register_post_types() {
	}

	/**
	 * Register Calendars fields
	 *
	 * @param  array $meta_boxes current metaboxes.
	 * @return array                updated metaboxes.
	 */
	public static function register_fields( $meta_boxes ) {
		$prefix = '';

		$meta_boxes[] = array(
			'title'      => __( 'Calendar', 'prestations' ),
			'id'         => 'calendar',
			'post_types' => array( 'service' ),
			'context'    => 'side',
			'priority'   => 'low',
			'autosave'   => true,
			'fields'     => array(
				array(
					// 'name'           => __( 'Calendar Section', 'prestations' ),
					'id'             => $prefix . 'calendar_section',
					'type'           => 'taxonomy',
					'taxonomy'       => array( 'calendar-section' ),
					'field_type'     => 'select',
					'remove_default' => true,
					'placeholder'    => _x( 'None', 'Calendar section', 'multipass' ),
					'admin_columns'  => array(
						'position'   => 'after title',
						'title'      => 'Calendar',
						'sort'       => true,
						'filterable' => true,
					),
				),
			),
		);

		return $meta_boxes;
	}

	/**
	 * Register calendar-section taxonomy.
	 *
	 * @return void
	 */
	public static function register_taxonomies() {
		$labels = array(
			'name'                       => esc_html__( 'Calendar Sections', 'multipass' ),
			'singular_name'              => esc_html__( 'Calendar Section', 'multipass' ),
			'menu_name'                  => esc_html__( 'Calendar Sections', 'multipass' ),
			'search_items'               => esc_html__( 'Search Calendar Sections', 'multipass' ),
			'popular_items'              => esc_html__( 'Popular Calendar Sections', 'multipass' ),
			'all_items'                  => esc_html__( 'All Calendar Sections', 'multipass' ),
			'parent_item'                => esc_html__( 'Parent Calendar Section', 'multipass' ),
			'parent_item_colon'          => esc_html__( 'Parent Calendar Section:', 'multipass' ),
			'edit_item'                  => esc_html__( 'Edit Calendar Section', 'multipass' ),
			'view_item'                  => esc_html__( 'View Calendar Section', 'multipass' ),
			'update_item'                => esc_html__( 'Update Calendar Section', 'multipass' ),
			'add_new_item'               => esc_html__( 'Add New Calendar Section', 'multipass' ),
			'new_item_name'              => esc_html__( 'New Calendar Section Name', 'multipass' ),
			'separate_items_with_commas' => esc_html__( 'Separate calendar sections with commas', 'multipass' ),
			'add_or_remove_items'        => esc_html__( 'Add or remove calendar sections', 'multipass' ),
			'choose_from_most_used'      => esc_html__( 'Choose most used calendar sections', 'multipass' ),
			'not_found'                  => esc_html__( 'No calendar sections found.', 'multipass' ),
			'no_terms'                   => esc_html__( 'No calendar sections', 'multipass' ),
			'filter_by_item'             => esc_html__( 'Filter by calendar section', 'multipass' ),
			'items_list_navigation'      => esc_html__( 'Calendar Sections list pagination', 'multipass' ),
			'items_list'                 => esc_html__( 'Calendar Sections list', 'multipass' ),
			'most_used'                  => esc_html__( 'Most Used', 'multipass' ),
			'back_to_items'              => esc_html__( '&larr; Go to Calendar Sections', 'multipass' ),
			'text_domain'                => esc_html__( 'multipass', 'multipass' ),
		);
		$args   = array(
			'label'              => esc_html__( 'Calendar Sections', 'multipass' ),
			'labels'             => $labels,
			'description'        => '',
			'public'             => true,
			'publicly_queryable' => true,
			'hierarchical'       => false,
			'show_ui'            => true,
			'show_in_menu'       => false,
			'show_in_nav_menus'  => true,
			'show_in_rest'       => true,
			'show_tagcloud'      => true,
			'show_in_quick_edit' => true,
			'show_admin_column'  => false,
			'query_var'          => true,
			'sort'               => false,
			'meta_box_cb'        => 'post_tags_meta_box',
			'rest_base'          => '',
			'rewrite'            => array(
				'with_front'   => false,
				'hierarchical' => false,
			),
		);
		register_taxonomy( 'calendar-section', array( 'service' ), $args );

		MultiPass::register_terms(
			'calendar-section',
			array(
				// 'none'   => _x( 'None', 'Calendar section', 'multipass' ),
				'main'    => __( 'Main', 'multipass' ),
				'options' => __( 'Options', 'multipass' ),
			)
		);

	}

	/**
	 * Define additional columns for Calendars admin list.
	 *
	 * @param array $columns Columns.
	 */
	public static function add_admin_columns( $columns ) {
		// $columns['taxonomy-calendar-section'] = __( 'Calendar Type', 'multipass' );
		return $columns;
	}

	/**
	 * Allow filter by term in Calendars admin list.
	 *
	 * @param  string $termlink Term link URL.
	 * @param  object $term     Term object.
	 * @param  string $taxonomy Taxonomy slug.
	 * @return string             Term link URL.
	 */
	public static function term_link_filter( $termlink, $term, $taxonomy ) {
		if ( 'calendar-section' === $taxonomy ) {
			return add_query_arg(
				array(
					'calendar-section' => $term->slug,
				),
				admin_url( basename( $_SERVER['REQUEST_URI'] ) )
			);
		}
		return $termlink;
	}

	public static function register_settings_pages( $settings_pages ) {
		$settings_pages[] = array(
			'position'   => 25,
			'parent'     => 'edit.php?post_type=prestation',
			'capability' => 'manage_options',
			'style'      => 'no-boxes',
			'columns'    => 1,
			'icon_url'   => 'dashicons-admin-generic',
		);

		return $settings_pages;
	}
}

$this->loaders[] = new Mltp_Calendar();
