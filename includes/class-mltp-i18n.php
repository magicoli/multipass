<?php
/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://github.com/magicoli/multipass
 * @since      0.1.0
 *
 * @package    MultiPass
 * @subpackage MultiPass/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      0.1.0
 * @package    MultiPass
 * @subpackage MultiPass/includes
 * @author     Magiiic <info@magiiic.com>
 */
class Mltp_I18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    0.1.0
	 */
	public function load_plugin_textdomain() {

		$trigger_translate = array(
			__( 'Select a lodging', 'multipass' ),
			__( 'Select a room', 'multipass' ),
			__( 'Select an appartment', 'multipass' ),
			__( 'Do not import', 'multipass' ),
		);

		load_plugin_textdomain(
			'multipass',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

		$filters = array(
			array(
				'hook'          => 'wp_dropdown_cats',
				'callback'      => 'fix_mb_show_option_all',
				'accepted_args' => 2,
			),
			// array(
			// 'hook' => 'list_cats',
			// 'callback' => 'list_cats_filter',
			// 'accepted_args' => 2,
			// ),
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

	}

	/**
	 * Workaround to fix localisation bug in mb-admin-columns module.
	 * Set placeholder to $taxonomy->labels->all_items instead of _('All %s').
	 *
	 * @param string $output        Html for filter taxonomy dropdown menu.
	 * @param array  $parsed_args   Context elements.
	 * @return string               Fixed html.
	 */
	public function fix_mb_show_option_all( $output, $parsed_args ) {
		$taxonomy = get_taxonomy( $parsed_args['taxonomy'] );
		if ( ! $taxonomy ) {
			return $output;
		}

		$show_option_all = ( empty( $taxonomy->labels->show_option_all ) ) ? $taxonomy->labels->all_items : $taxonomy->labels->show_option_all;
		if ( empty( $show_option_all ) ) {
			return $output;
		}

		return preg_replace( ":<option value='0'>.*</option>:", "<option value='0'>$show_option_all</option>", $output );
	}

}
