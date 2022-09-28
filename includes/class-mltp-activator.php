<?php
/**
 * Fired during plugin activation
 *
 * @since      0.1.0
 *
 * @package    MultiPass
 * @subpackage MultiPass/includes
 */

/**
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @link       https://github.com/magicoli/multipass
 * @since      0.1.0
 * @package    MultiPass
 * @subpackage MultiPass/includes
 * @author     Magiiic <info@magiiic.com>
 */
class Mltp_Activator {

	/**
	 * Activation actions.
	 *
	 * @since    0.1.0
	 */
	public static function activate() {
		flush_rewrite_rules();
	}

}
