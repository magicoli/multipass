<?php

/**
 * Plugin Name:       Prestations (dev)
 * Plugin URI:        https://magiiic.com/wordpress/plugins/prestations/
 * Description:       Group orders from different sources (WooCommerce, OTA, booking engines...) to get the global picture of a set of services.
 * Version:           0.1.1.x-dev
 * Author:            Magiiic
 * Author URI:        https://magiiic.com/
 * License:           AGPLv3
 * License URI:       http://www.gnu.org/licenses/agpl-3.0.txt
 * Text Domain:       prestations
 * Domain Path:       /languages
 *
 * @link              http://example.com
 * @since             0.1.0
 * @package           Prestations
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
define( 'PRESTATIONS_VERSION', '0.1.1.x-dev' . '-' . time() );
define( 'PRESTATIONS_FILE', __FILE__ );
define( 'PRESTATIONS_DIR', plugin_dir_path(__FILE__) );
define( 'PRESTATIONS_PLUGIN_NAME', 'Prestations' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-activator.php
 */
function activate_prestations() {
	require_once PRESTATIONS_DIR . 'includes/class-activator.php';
	Prestations_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-deactivator.php
 */
function deactivate_prestations() {
	require_once PRESTATIONS_DIR . 'includes/class-deactivator.php';
	Prestations_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_prestations' );
register_deactivation_hook( __FILE__, 'deactivate_prestations' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require PRESTATIONS_DIR . 'includes/class.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    0.1.0
 */
function run_prestations() {

	$plugin = new Prestations();
	$plugin->run();

}
run_prestations();
