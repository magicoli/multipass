<?php

/**
 * Plugin Name:       MultiPass (dev)
 * Plugin URI:        https://magiiic.com/wordpress/plugins/multiservices/
 * Description:       Group prestation items from different sources (WooCommerce, OTA, booking engines...) and manage them as a whole.
 * Version:           0.1.1.x-dev
 * Author:            Magiiic
 * Author URI:        https://magiiic.com/
 * GitHubURL:					https://github.com/magicoli/multiservices/
 * License:           AGPLv3
 * License URI:       http://www.gnu.org/licenses/agpl-3.0.txt
 * Text Domain:       multiservices
 * Domain Path:       /languages
 * Requires at least: 3.0.1
 * Tested up to:			6.0.2
 * Requires PHP:			7.0
 *
 * @link              http://example.com
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
define( 'MULTISERVICES_VERSION', '0.1.1.x-dev' . '-' . time() );
define( 'MULTISERVICES_FILE', __FILE__ );
define( 'MULTISERVICES_DIR', plugin_dir_path(__FILE__) );
define( 'MULTISERVICES_PLUGIN_NAME', 'MultiPass' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-activator.php
 */
function activate_multiservices() {
	require_once MULTISERVICES_DIR . 'includes/class-activator.php';
	Mltp_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-deactivator.php
 */
function deactivate_multiservices() {
	require_once MULTISERVICES_DIR . 'includes/class-deactivator.php';
	Mltp_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_multiservices' );
register_deactivation_hook( __FILE__, 'deactivate_multiservices' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require MULTISERVICES_DIR . 'includes/class.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    0.1.0
 */
function run_multiservices() {

	$plugin = new MultiPass();
	$plugin->run();

}
run_multiservices();
