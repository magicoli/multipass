<?php
/**
 * Register all actions and filters for the plugin
 *
 * @link       https://github.com/magicoli/multipass
 * @since      1.0.0
 *
 * @package    multipass
 * @subpackage multipass/includes
 */

/**
 * Register all actions and filters for the plugin.
 *
 * Maintain a list of all hooks that are registered throughout
 * the plugin, and register them with the WordPress API. Call the
 * run function to execute the list of actions and filters.
 *
 * @package    multipass
 * @subpackage multipass/includes
 * @author     Magiiic <info@magiiic.com>
 */
class Mltp_Settings {

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

		$this->sanitize_role('administrator', [ 'id' => 'mltp_administrator' ] );

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

		$actions = array();

		$filters = array(
			array(
				'hook'     => 'admin_menu',
				'callback' => 'admin_menu_action',
			),
			array(
				'hook'     => 'mb_settings_pages',
				'callback' => 'register_settings_pages',
				'priority' => 5,
			),
			array(
				'hook'     => 'plugin_action_links_' . basename( MULTIPASS_DIR ) . '/' . basename( MULTIPASS_FILE ),
				'callback' => 'plugin_action_links',
			),
			array(
				'hook'     => 'rwmb_meta_boxes',
				'callback' => 'register_settings_fields',
			),
		);

		foreach ( $filters as $hook ) {
			$hook = array_merge(
				array(
					'component'     => $this,
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
					'component'     => $this,
					'priority'      => 10,
					'accepted_args' => 1,
				),
				$hook
			);
			add_action( $hook['hook'], array( $hook['component'], $hook['callback'] ), $hook['priority'], $hook['accepted_args'] );
		}

	}

	function admin_menu_action( ) {
		// $cap = (current_user_can('manage_options')) ? 'manage_options' : 'view_mltp_dashboard';
		add_menu_page(
			'MultiPass', // string $page_title,
			'MultiPass', // string $menu_title,
			'view_mltp_dashboard', // string $capability,
			'multipass', // string $menu_slug,
			null, // [ $this, 'dashboard_callback' ], // callable $callback = '',
			'dashicons-excerpt-view', // string $icon_url = '',
			MultiPass::get_option('menu_position', 20), // int|float $position = null,
		);
		// add_submenu_page(
		// 	'multipass', // string $parent_slug,
		// 	__( 'Dashboard', 'multipass' ), // string $page_title,
		// 	__( 'Dashboard', 'multipass' ), // string $menu_title,
		// 	'read', // string $capability,
		// 	'multipass', // string $menu_slug,
		// 	[ $this, 'render_dashboard' ], // callable $callback = '',
		// 	1, // int|float $position = null
		// );

	}
	function render_dashboard() {
		$actions = '';
		$content = '';
		printf(
			'<div class="wrap">
				<div id="mltp-placeholder">
					<h1 class="wp-heading-inline">%s %s</h1>

				</div>
				<div id="calendar"></div>
      </div>',
			get_admin_page_title(),
			$actions,
			$content,
		);
		return;
	}
	function register_settings_pages( $settings_pages ) {
		// $settings_pages[] = [
		// 	'id'          => 'multipass',
		// 	'option_name' => 'MultiPass Option',
		// 	'menu_title'    => __('MultiPass Menu', 'multipass' ),
		// 	'position'    => 15,
		// 	'submenu_title' => 'Calendar',
		// 	'style'       => 'no-boxes',
		// 	'columns'     => 1,
		// 	'icon_url'    => 'dashicons-excerpt-view',
		// 	'capability'    => 'manage_options',
		// ];
		// $settings_pages[] = [
		// ];

		$settings_pages['multipass-settings'] = array(
			'menu_title'    => __( 'Settings', 'multipass' ),
			'page_title'    => __( 'MultiPass Settings', 'multipass' ),
			'id'            => 'multipass-settings',
			'option_name'   => 'multipass',
			// 'position'      => 23,
			'parent'        => 'multipass',
			'capability'    => 'manage_options',
			'style'         => 'no-boxes',
			'columns'       => 1,
			'tabs'          => array(
				'general' => __( 'General', 'multipass' ),
				'roles' => __( 'Roles', 'multipass' ),
				// 'tos'     => __( 'Terms of Service', 'multipass' ),
			),
			'icon_url'      => 'dashicons-book',
		);
		return $settings_pages;
	}

	function register_settings_fields( $meta_boxes ) {
		$prefix = '';

		$meta_boxes['multipass-settings'] = array(
			'title'          => __( 'General', 'multipass' ),
			'id'             => 'multipass-settings-fields',
			'settings_pages' => array( 'multipass-settings' ),
			'tab'            => 'general',
			'fields'         => array(
				'currency_options' => array(
					'name'   => __( 'Currency Options', 'multipass' ),
					'id'     => $prefix . 'currency',
					'type'   => 'group',
					'class'  => 'inline',
					'fields' => array(
						array(
							'name'    => __( 'Code', 'multipass' ),
							'id'      => $prefix . 'code',
							'type'    => 'select_advanced',
							'size'    => 3,
							'options' => MultiPass::currency_options(),
						),
						array(
							'name'    => __( 'Position', 'multipass' ),
							'id'      => $prefix . 'pos',
							'type'    => 'select',
							'size'    => 5,
							'options' => array(
								'left'        => __( 'Left', 'multipass' ),
								'right'       => __( 'Right', 'multipass' ),
								'left_space'  => __( 'Left with space', 'multipass' ),
								'right_spâce' => __( 'Right with space', 'multipass' ),
							),
							'std'     => 'right_space',
						),
						array(
							'name' => __( 'Decimals', 'multipass' ),
							'id'   => $prefix . 'num_decimals',
							'type' => 'number',
							'min'  => 0,
							'step' => 1,
							'std'  => 2,
							'size' => 3,
						),
					),
				),
			),
		);

		$meta_boxes['roles-settings'] = [
			'title'          => __( 'Roles Settings', 'multipass' ),
			'id'             => 'roles-settings',
			'settings_pages' => array( 'multipass-settings' ),
			'tab'            => 'roles',
			'fields'         => [
				[
					'name'              => __( 'MultiPass Reader', 'multipass' ),
					'id'                => $prefix . 'mltp_reader',
					'type'              => 'select',
					'options'           => MultiPass::get_roles(),
					'default'		=> 'contributor',
					'placeholder'       => __( 'Select a role', 'multipass' ),
					'sanitize_callback' => array($this, 'sanitize_role'),
				],
				[
					'name'              => __( 'MultiPass Manager', 'multipass' ),
					'id'                => $prefix . 'mltp_manager',
					'type'              => 'select',
					'options'           => MultiPass::get_roles(),
					'default'		=> 'editor',
					'placeholder'       => __( 'Select a role', 'multipass' ),
					'sanitize_callback' => array($this, 'sanitize_role'),
				],
				[
					'name'              => __( 'MultiPass Administrator', 'multipass' ),
					'id'                => $prefix . 'mltp_administrator',
					'type'              => 'select',
					'options'           => MultiPass::get_roles(),
					'default'		=> 'administrator',
					'placeholder'       => __( 'Select a role', 'multipass' ),
					'sanitize_callback' => array($this, 'sanitize_role'),
				],
			],
		];

		return $meta_boxes;
	}

	function plugin_action_links( $links ) {
		$url   = esc_url( add_query_arg( 'page', 'multipass', get_admin_url() . 'admin.php' ) );
		$links = array( 'settings' => "<a href='$url'>" . __( 'Settings', 'multipass' ) . '</a>' ) + $links;

		return $links;
	}

	function sanitize_role($role_name, $field, $old_value = null) {
		$cap = $field['id'];

		$all_caps['mltp_reader'] = array(
			'view_mltp_dashboard',
			'view_mltp_calendar',
			// 'delete_mltp_prestations',
			// 'edit_mltp_prestations',
			// 'edit_others_mltp_prestations',
			// 'publish_mltp_prestations',
			// 'read_private_mltp_prestations',
		);
		$all_caps['mltp_manager'] = array_merge($all_caps['mltp_reader'], array(
			'edit_mltp_prestations',
			'delete_mltp_prestations',
			'publish_mltp_prestations',
			'edit_others_mltp_prestations',
			'delete_others_mltp_prestations',
			'read_private_mltp_prestations',
			'edit_private_mltp_prestations',
			'delete_private_mltp_prestations',
			'edit_published_mltp_prestations',
			'delete_published_mltp_prestations',
		));
		$all_caps['mltp_administrator'] = array_merge($all_caps['mltp_manager'], array(
			'edit_mltp_resources',
			'delete_mltp_resources',
			'publish_mltp_resources',
			'edit_others_mltp_resources',
			'delete_others_mltp_resources',
			'read_private_mltp_resources',
			'edit_private_mltp_resources',
			'delete_private_mltp_resources',
			'edit_published_mltp_resources',
			'delete_published_mltp_resources',
		));
		$caps = $all_caps[$cap];

		if($old_value !== $role_name &! empty($old_value) && $old_value != 'administrator' ) {
			$role = get_role( $old_value );
			error_log("$old_value remove " . print_r($caps, true));
			foreach ($caps as $cap) {
				$role->remove_cap( $cap, true );
			}
		}

		// $caps[] = 'view_admin_dashboard';
		if( ! empty($role_name)) {
			$role = get_role( $role_name );
			if($role_name !== 'administrator')
			error_log("$role_name add " . print_r($caps, true));
			foreach ($caps as $cap) {
				$role->add_cap( $cap, true );
			}
		}

		return $role_name;
	}
}

$this->loaders[] = new Mltp_Settings();
