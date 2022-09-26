<?php
/**
 * Plugin Name:       MultiPass (dev)
 * Plugin URI:        https://magiiic.com/wordpress/plugins/multipass/
 * Description:       Manage bookings and other services from different sources (WooCommerce, Lodgify, HBook, OTA, PMS, booking engines...).
 * Version:           0.1.2.x-dev
 * Author:            Magiiic
 * Author URI:        https://magiiic.com/
 * GitHubURL:         https://github.com/magicoli/multipass/
 * License:           AGPLv3
 * License URI:       http://www.gnu.org/licenses/agpl-3.0.txt
 * Text Domain:       multipass
 * Domain Path:       /languages
 * Requires at least: 5.9.0
 * Tested up to:      6.0.2
 * Requires PHP:      7.4
 *
 * @link              https://github.com/magicoli/multipass
 * @since             0.1.0
 * @package           MultiPass
 *
 * @wordpress-plugin
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'MULTIPASS_VERSION', '0.1.2.x-dev' . time() );
define( 'MULTIPASS_FILE', __FILE__ );
define( 'MULTIPASS_DIR', plugin_dir_path( __FILE__ ) );
define( 'MULTIPASS_PLUGIN_NAME', 'MultiPass' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-mltp-activator.php
 */
function activate_multipass() {
	require_once MULTIPASS_DIR . 'includes/class-mltp-activator.php';
	Mltp_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-mltp-deactivator.php
 */
function deactivate_multipass() {
	require_once MULTIPASS_DIR . 'includes/class-mltp-deactivator.php';
	Mltp_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_multipass' );
register_deactivation_hook( __FILE__, 'deactivate_multipass' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require MULTIPASS_DIR . 'includes/class-multipass.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    0.1.0
 */
function run_multipass() {

	$plugin = new MultiPass();
	$plugin->run();

}
run_multipass();
