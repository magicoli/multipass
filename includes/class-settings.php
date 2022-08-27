<?php

/**
 * Register all actions and filters for the plugin
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    prestations
 * @subpackage prestations/includes
 */

/**
 * Register all actions and filters for the plugin.
 *
 * Maintain a list of all hooks that are registered throughout
 * the plugin, and register them with the WordPress API. Call the
 * run function to execute the list of actions and filters.
 *
 * @package    prestations
 * @subpackage prestations/includes
 * @author     Your Name <email@example.com>
 */
class Prestations_Settings {

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
		);

		$filters = array(
			array (
				'hook' => 'mb_settings_pages',
				'callback' => 'register_settings_pages',
			),
			array(
				'hook' => 'plugin_action_links_prestations/prestations.php',
				'callback' => 'plugin_action_links',
			),
			array (
				'hook' => 'rwmb_meta_boxes',
				'callback' => 'register_settings_fields'
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

	static function register_settings_pages( $settings_pages ) {
		// $settings_pages[] = [
		// 	'menu_title'    => __( 'Prestations', 'prestations' ),
		// 	'id'            => 'prestations',
		// 	'position'      => 15,
		// 	'submenu_title' => 'Settings',
		// 	'capability'    => 'manage_options',
		// 	'style'         => 'no-boxes',
		// 	'columns'       => 1,
		// 	'icon_url'      => 'dashicons-book',
		// ];

		$settings_pages['prestations'] = [
			'menu_title'    => __( 'Settings', 'prestations' ),
			'id'            => 'prestations',
			'option_name'   => 'prestations',
			// 'position'      => 23,
			'submenu_title' => 'Settings',
			'parent'        => 'edit.php?post_type=prestation',
			'capability'    => 'manage_options',
			'style'         => 'no-boxes',
			'columns'       => 2,
			'tabs'          => [
				'general' => __('General', 'prestations'),
			],
			'icon_url'      => 'dashicons-book',
		];
		return $settings_pages;
	}

	static function register_settings_fields( $meta_boxes ) {
		$prefix = '';

		$meta_boxes['prestations-settings'] = [
			'title'          => __( 'General', 'prestations' ),
			'id'             => 'prestations-settings-fields',
			'settings_pages' => ['prestations'],
			'tab'            => 'general',
			'fields'         => [
				'currency_options' => [
						'name'   => __( 'Currency Options', 'prestations' ),
						'id'     => $prefix . 'currency',
						'type'   => 'group',
						'class' => 'inline',
						'fields' => [
								[
										'name'     => __( 'Code', 'prestations' ),
										'id'       => $prefix . 'code',
										'type'     => 'select_advanced',
										'size'     => 3,
										'options' => Prestations::currency_options(),
// 										'datalist' => [
// 												'id'      => '630532931670c',
// 												'options' => [
// 														'EUR
// ',
// 														'USD
// ',
// 														'GBP',
// 												],
// 										],
								],
								[
										'name'    => __( 'Position', 'prestations' ),
										'id'      => $prefix . 'pos',
										'type'    => 'select',
										'size' => 5,
										'options' => [
												'left'         => __( 'Left', 'prestations' ),
												'right'        => __( 'Right', 'prestations' ),
												'left_space'    => __( 'Left with space', 'prestations' ),
												'right_spâce' => __( 'Right with space', 'prestations' ),
										],
										'std'     => 'right_space',
								],
								// [
								// 		'name' => __( 'Thousand separator', 'prestations' ),
								// 		'id'   => $prefix . 'thousand_sep',
								// 		'type' => 'text',
								// 		'size' => 3,
								// ],
								// [
								// 		'name' => __( 'Decimal Separator', 'prestations' ),
								// 		'id'   => $prefix . 'decimal_sep',
								// 		'type' => 'text',
								// 		'size' => 3,
								// ],
								[
										'name' => __( 'Decimals', 'prestations' ),
										'id'   => $prefix . 'num_decimals',
										'type' => 'number',
										'min'  => 0,
										'step' => 1,
										'std'  => 2,
										'size' => 3,
								],
						],
				],
				// [
				// 	'name'  => __( 'Enable Email Processing', 'prestations' ),
				// 	'id'    => $prefix . 'enable_email_processing',
				// 	'type'  => 'switch',
				// 	'desc_tip'  => __( 'Use IMAP to collect emails and attach them to prestations', 'prestations' ),
				// 	'style' => 'rounded',
				// ],
			],
		];

		return $meta_boxes;
	}

	static function plugin_action_links( $links ) {
		$url = esc_url( add_query_arg( 'page', 'prestations', get_admin_url() . 'admin.php' ) );
		$links = [ 'settings' => "<a href='$url'>" . __('Settings', 'prestations') . "</a>" ] + $links;

		return $links;
	}

}
