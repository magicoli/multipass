<?php
/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://github.com/magicoli/multipass
 * @since      0.1.0
 *
 * @package    MultiPass
 * @subpackage MultiPass/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    MultiPass
 * @subpackage MultiPass/admin
 * @author     Magiiic <info@magiiic.com>
 */
class Mltp_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    0.1.0
	 * @access   private
	 * @var      string    $plugin_slug    The ID of this plugin.
	 */
	private $plugin_slug;

	/**
	 * The version of this plugin.
	 *
	 * @since    0.1.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    0.1.0
	 * @param      string $plugin_slug       The name of this plugin.
	 * @param      string $version    The version of this plugin.
	 */
	public function __construct() {
		$this->plugin_slug = basename( MULTIPASS_DIR );
		$this->version     = MULTIPASS_VERSION;
	}

	public function init() {
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_styles' ) );
		// $this->enqueue_styles();
		// $this->enqueue_scripts();
	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    0.1.0
	 */
	public function enqueue_styles() {
		wp_enqueue_style( $this->plugin_slug . '-admin-built', plugin_dir_url( __FILE__ ) . 'js/admin.css', array(), MULTIPASS_VERSION, 'all' );
	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    0.1.0
	 */
	public function enqueue_scripts() {
		wp_enqueue_script( $this->plugin_slug . '-admin', plugin_dir_url( __FILE__ ) . 'js/admin.js', array( 'jquery' ), MULTIPASS_VERSION, false );
	}

}

$mltp_admin = new Mltp_Admin();
$mltp_admin->init();
