<?php
/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://github.com/magicoli/multipass
 * @since      0.1.0
 *
 * @package    MultiPass
 * @subpackage MultiPass/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    MultiPass
 * @subpackage MultiPass/public
 * @author     Magiiic <info@magiiic.com>
 */
class Mltp_Public {

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
	 * @param      string $plugin_slug       The name of the plugin.
	 * @param      string $version    The version of this plugin.
	 */
	public function __construct( $plugin_slug, $version ) {
		$this->plugin_slug = $plugin_slug;
	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    0.1.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the init() function
		 * defined in Mltp_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Mltp_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_slug, plugin_dir_url( __FILE__ ) . 'js/public.css', array(), MULTIPASS_VERSION, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    0.1.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the init() function
		 * defined in Mltp_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Mltp_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_slug, plugin_dir_url( __FILE__ ) . 'js/public.js', array( 'jquery' ), MULTIPASS_VERSION, false );

	}

}
