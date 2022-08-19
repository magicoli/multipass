<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       http://example.com
 * @since      0.1.0
 *
 * @package    Prestations
 * @subpackage Prestations/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      0.1.0
 * @package    Prestations
 * @subpackage Prestations/includes
 * @author     Your Name <email@example.com>
 */
class Prestations {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    0.1.0
	 * @access   protected
	 * @var      Prestations_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    0.1.0
	 * @access   protected
	 * @var      string    $prestations    The string used to uniquely identify this plugin.
	 */
	protected $prestations;

	/**
	 * The current version of the plugin.
	 *
	 * @since    0.1.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    0.1.0
	 */
	public function __construct() {
		if ( defined( 'PRESTATIONS_VERSION' ) ) {
			$this->version = PRESTATIONS_VERSION;
		} else {
			$this->version = '1.0.0';
		}
		$this->prestations = 'prestations';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Prestations_Loader. Orchestrates the hooks of the plugin.
	 * - Prestations_i18n. Defines internationalization functionality.
	 * - Prestations_Admin. Defines all hooks for the admin area.
	 * - Prestations_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    0.1.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-public.php';

		$this->loader = new Prestations_Loader();

		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'vendor/autoload.php';

		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-cpt-prestation.php';
		$this->loaders[] = new Prestations_Prestation();
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-settings.php';
		$this->loaders[] = new Prestations_Settings();

		if( Prestations::get_option('prestations:enable_email_processing') == true) {
			require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-mailbox.php';
			$this->loaders[] = new Prestations_Mailbox();
		}

		if(is_plugin_active('woocommerce/woocommerce.php')) {
			require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/third-party/class-woocommerce.php';
			$this->loaders[] = new Prestations_WooCommerce();
		}

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Prestations_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    0.1.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Prestations_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    0.1.0
	 * @access   private
	 */
	private function define_admin_hooks() {

		$plugin_admin = new Prestations_Admin( $this->get_prestations(), $this->get_version() );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );

	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    0.1.0
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new Prestations_Public( $this->get_prestations(), $this->get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );

	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    0.1.0
	 */
	public function run() {
		$this->loader->run();
		if(!empty($this->loaders) && is_array($this->loaders)) {
			foreach($this->loaders as $key => $loader) {
				$this->loaders[$key]->run();
			}
		}
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     0.1.0
	 * @return    string    The name of the plugin.
	 */
	public function get_prestations() {
		return $this->prestations;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     0.1.0
	 * @return    Prestations_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     0.1.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

	static function get_option($option, $default = false) {
		$settings_page = NULL;
		$result = $default;
		if(preg_match('/:/', $option)) {
			$settings_page = strstr($option, ':', true);
			$option = trim(strstr($option, ':'), ':');
			$settings = get_option($settings_page);
			if($settings && isset($settings[$option])) {
				$result = $settings[$option];
			}
		} else {
			$result = get_option($option, $default);
		}
		return $result;
	}

	static function update_option($option, $value, $autoload = null) {
		$settings_page = NULL;
		if(preg_match('/:/', $option)) {
			$settings_page = strstr($option, ':', true);
			$option = trim(strstr($option, ':'), ':');
			$settings = get_option($settings_page);
			$settings[$option] = $value;
			$result = update_option($settings_page, $settings, $autoload);
		} else {
			$result = update_option($option, $value, $autoload);
		}
		return $result;
	}

	static function is_new_post($args = null){
	    global $pagenow;
	    return ( is_admin() && in_array( $pagenow, array( 'post-new.php' ) ));
	}

	static function unique_random_slug($slug_size = NULL) {
		global $wpdb;

		if(empty($slug_length)) $slug_length = Prestations::get_option('prestations:slug_length', 4);

		$i = 0; do {
			$i++;
			if($i > 5) { // failed several times to find a unique slug, increase length
				$slug_length++;
				$i = 0;
				Prestations::update_option('prestations:slug_length', $slug_length);
			}

			$chars = implode(range('a', 'z'));
			// $chars = implode('', range('a', 'z')) . implode('', range('A', 'Z')) . implode('', range('0', '9')); // more characters allowed

			# Basic method: does not allow duplicate characters, less enthropy, slug length limited to $chars length
			$slug = substr(str_shuffle($chars), 0, $slug_length);

			# Alternative: more enthropy, length not limited, might be slower
			// $chars_length = strlen($chars);
			// $slug = '';
			// for($i = 0; $i < $slug_length; $i++) {
			// 	$random_character = $chars[mt_rand(0, $chars_length - 1)];
			// 	$slug .= $random_character;
			// }

			# hexadecimal alternative
			// $slug = bin2hex(random_bytes( $slug_length / 2));

			// Check uniqueness.
			$result = $wpdb->get_var( $wpdb->prepare( "SELECT post_name FROM $wpdb->posts WHERE post_name = %s LIMIT 1", $slug ) );
		} while ( $result );

		return $slug;
	}

}
