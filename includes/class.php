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
 * @package    MultiServices
 * @subpackage MultiServices/includes
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
 * @package    MultiServices
 * @subpackage MultiServices/includes
 * @author     Your Name <email@example.com>
 */
class MultiServices {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    0.1.0
	 * @access   protected
	 * @var      MultiServices_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    0.1.0
	 * @access   protected
	 * @var      string    $plugin_slug    The string used to uniquely identify this plugin.
	 */
	protected $plugin_slug;

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
		if ( defined( 'MULTISERVICES_VERSION' ) ) {
			$this->version = MULTISERVICES_VERSION;
		} else {
			$this->version = '1.0.0';
		}
		$this->plugin_slug = 'prestations';

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
	 * - MultiServices_Loader. Orchestrates the hooks of the plugin.
	 * - MultiServices_i18n. Defines internationalization functionality.
	 * - MultiServices_Admin. Defines all hooks for the admin area.
	 * - MultiServices_Public. Defines all hooks for the public side of the site.
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
		require_once MULTISERVICES_DIR . 'includes/class-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once MULTISERVICES_DIR . 'includes/class-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once MULTISERVICES_DIR . 'admin/class-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once MULTISERVICES_DIR . 'public/class-public.php';

		$this->loader = new MultiServices_Loader();

		require_once MULTISERVICES_DIR . 'vendor/autoload.php';
		require_once MULTISERVICES_DIR . 'includes/class-list-table.php';

		require_once MULTISERVICES_DIR . 'includes/class-cpt-prestation.php';
		$this->loaders[] = new MultiServices_Prestation();
		require_once MULTISERVICES_DIR . 'includes/class-cpt-service.php';
		$this->loaders[] = new MultiServices_Service();
		require_once MULTISERVICES_DIR . 'includes/class-cpt-association.php';
		$this->loaders[] = new MultiServices_Association();
		require_once MULTISERVICES_DIR . 'includes/class-settings.php';
		$this->loaders[] = new MultiServices_Settings();

		require_once MULTISERVICES_DIR . 'includes/modules/load-modules.php';
		$this->loaders[] = new MultiServices_Modules();
		// if(is_plugin_active('woocommerce/woocommerce.php')) {
		// 	require_once MULTISERVICES_DIR . 'includes/modules/class-woocommerce.php';
		// 	$this->loaders[] = new MultiServices_WooCommerce();
		//
		// 	require_once MULTISERVICES_DIR . 'includes/modules/class-woocommerce-payment-product.php';
		// 	$this->loaders[] = new MultiServices_Payment_Product();
		// }

		if(get_transient('prestations_rewrite_flush') || get_transient('prestations_rewrite_version') != MULTISERVICES_VERSION) {
		  wp_cache_flush();
		  add_action('init', 'flush_rewrite_rules');
			delete_transient('prestations_rewrite_flush');
		  set_transient('prestations_rewrite_version', MULTISERVICES_VERSION);
		  // admin_notice( 'Rewrite rules flushed' );
		}

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the MultiServices_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    0.1.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new MultiServices_i18n();

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

		$plugin_admin = new MultiServices_Admin( $this->get_plugin_slug(), $this->get_version() );

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

		$plugin_public = new MultiServices_Public( $this->get_plugin_slug(), $this->get_version() );

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

		add_action('admin_head', __CLASS__ . '::get_admin_notices_queue');
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     0.1.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_slug() {
		return $this->plugin_slug;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     0.1.0
	 * @return    MultiServices_Loader    Orchestrates the hooks of the plugin.
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
		} else {
			$settings_page = 'prestations';
		}

		$settings = get_option($settings_page);
		if($settings && isset($settings[$option])) {
			$result = $settings[$option];
		}

		// } else {
		// 	$result = get_option($option, $default);
		// }
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

		if(empty($slug_length)) $slug_length = MultiServices::get_option('slug_length', 4);

		$i = 0; do {
			$i++;
			if($i > 5) { // failed several times to find a unique slug, increase length
				$slug_length++;
				$i = 0;
				MultiServices::update_option('prestations:slug_length', $slug_length);
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

	static function currency_options() {
		$options = wp_cache_get('prestations-currencies');
		if($options) return $options;

		$options = [];
		$symbols = Currency\Util\CurrencySymbolMapping::values();
		foreach($symbols as $code => $symbol) {
			$options[$code] = "$code ($symbol)";
		}

		wp_cache_set('prestations-currencies', $options);
		return $options;
	}

	static function get_currency_symbol($currency = '') {
		$symbol = wp_cache_get('get_currency_symbol-' . $currency);
		if($symbol) return $symbol;

		if(function_exists('get_woocommerce_currency_symbol')) {
			$symbol = get_woocommerce_currency_symbol($currency);
		} else {
			if(empty($currency)) {
				$options = MultiServices::get_option('currency');
				if(isset($options['code'])) {
					$search_currency = $options['code'];
				}
			} else {
				$search_currency = $currency;
			}

			$symbols = Currency\Util\CurrencySymbolMapping::values();
			$symbol = (!empty($symbols[$search_currency])) ? $symbols[$search_currency] : $currency;
		}

		wp_cache_set('get_currency_symbol-' . $currency, $symbol);
		return $symbol;
	}

	static function price($price, $args = []) {
		if(empty($price)&& $price !== 0) return;
		if(function_exists('wc_price')) return wc_price($price, $args);

		$before = '';
		$after = '';

		$options = wp_parse_args(
			MultiServices::get_option('currency'),
			array(
				'code'   => null,
				'pos' => null,
				'thousand_sep'     => null,
				'decimal_sep'   => null,
				'num_decimals'   => null,
			)
		);
		$args = wp_parse_args($args, $options);

		if(!empty($args['code'])) {
			$currency = $args['code'];
			$symbol = MultiServices::get_currency_symbol();
			switch($args['pos']) {
				case 'left': $before = $symbol; break;
				case 'left_space': $before = "$symbol "; break;
				case 'right': $after = $symbol; break;
				case 'right_space':
				default: $after = " $symbol"; break;
			}
		}

		if(isset($args['num_decimals']) &! empty($price)) {
			$price = number_format_i18n($price, $args['num_decimals']);
		} else {
			$price = number_format_i18n($price);
		}
		$price = $before . $price . $after;

		return $price;
	}

	static function admin_notice($notice, $class='info', $dismissible=true ) {
		if(empty($notice)) return;
		if($dismissible) $is_dismissible = 'is-dismissible';
		if(is_admin()) {
			add_action( 'admin_notices', function() use ($notice, $class, $is_dismissible) {
				?>
				<div class="notice notice-<?=$class?> <?=$is_dismissible?>">
					<p><strong><?php echo MULTISERVICES_PLUGIN_NAME; ?></strong>: <?php _e( $notice, 'band-tools' ); ?></p>
				</div>
				<?php
			} );
		} else {
			delay_admin_notice($notice, $class, $dismissible, __FUNCTION__);
		}
	}

	static function delay_admin_notice( $notice, $class='info', $dismissible=true, $key = NULL ) {
		$transient_key = sanitize_title(__CLASS__ . '-admin_notices_queue');

		$queue = get_transient( $transient_key );
		if(!is_array($queue)) $queue = array($queue);

		$hash = hash('md5', $notice);
		$queue[$hash] = array('notice' => $notice, 'class' => $class, 'dismissible' => $dismissible);
		set_transient( $transient_key, $queue );
	}

	static function get_admin_notices_queue() {
		if(!is_admin()) return;
		$transient_key = sanitize_title(__CLASS__ . '-admin_notices_queue');

		$queue = get_transient( $transient_key );
		if(!is_array($queue)) $queue = array($queue);
		foreach($queue as $key => $notice) {
			if(!is_array($notice)) continue;
			admin_notice($notice['notice'], $notice['class'], $notice['dismissible'] );
		}
		delete_transient( $transient_key );
	}

	static function format_date_range($dates = [], $long = false) {
		if(empty($dates)) return;
		if(!is_array($dates)) $dates = [ $dates ];
		$dates = array_filter($dates);

		$formatted = [];
		foreach($dates as $date) {
			$formatted[] = date_i18n(get_option( 'date_format' ), $date);
		}
		if(count($formatted) == 2) {
			return sprintf(
				// TRANSLATORS: [start date] to [end date] (without time)
				($long) ? __('from %s to %s', 'prestations') : __('%s to %s', 'prestations'),
				$formatted[0],
				$formatted[1],
			);
		} else {
			return join(', ', $formatted);
		}
	}


	static function title_html() {
		return preg_replace('/(#[[:alnum:]]+)/', '<code>$1</code>', the_title('<h1>', '</h1>', false));
	}

	static function get_user_by_info($info) {
		if(!is_array($info)) {
			error_log("info $info is not an array");
			return $info;
		}
		$user = NULL;
		if(isset($info['user_id'])) {
			$user = get_user_by('id', $info['user_id']);
		} else if(isset($info['id'])) {
			$user = get_user_by('id', $info['id']);
		} else if(isset($info['email'])) {
			$user = get_user_by('email', $info['email']);
		} else if(isset($info['name'])) {
			// $user = get_user_by('name', $info['name']);
			$users = get_users(array('search' => $info['name']));
			if (!empty($users)) $user = $users[0];
		}
		return $user;
	}

	static function get_user_info_by_info($info) {
		if(!is_array($info)) {
			error_log("info $info is not an array");
			return $info;
		}
		$user = self::get_user_by_info($info);
		$info = array_replace($info, array_filter(array(
			'user_id' => $user->ID,
			'name' => trim($user->first_name) . ' ' . $user->last_name,
			'email' => $user->user_email,
			'phone' => join(', ', array_filter(array(
				get_user_meta($user->ID, 'billing_phone', true),
				get_user_meta($user->ID, 'shipping_phone', true),
			))),
		)));
		return $info;
	}

}
