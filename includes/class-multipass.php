<?php
/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://github.com/magicoli/multipass
 * @since      0.1.0
 *
 * @package    MultiPass
 * @subpackage MultiPass/includes
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
 * @package    MultiPass
 * @subpackage MultiPass/includes
 * @author     Your Name <email@example.com>
 */
class MultiPass {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    0.1.0
	 * @access   protected
	 * @var      Mltp_Loader    $loader    Maintains and registers all hooks for the plugin.
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
		$this->plugin_slug = 'multipass';
		$this->plugin_file = plugin_basename( MULTIPASS_FILE );

		$this->js_date_format_short = preg_match( '/^[Fm]/', get_option( 'date_format' ) ) ? 'mm-dd-yy' : 'dd-mm-yy';

		$flags = array(
			1 => 'MLTP_PAID_SOME',
			2 => 'MLTP_PAID_DEPOSIT',
			4 => 'MLTP_PAID_ALL',
			8 => 'MLTP_PAID_MORE',
			16 => 'MLTP_REFUNDED',
			32 => 'MLTP_CONFIRMED',
			64 => 'MLTP_STARTED',
			128 => 'MLTP_ENDED', // end date passed, but final invoicing not done
			256 => 'MLTP_CLOSED', // final invoicing done
		);
		foreach ($flags as $key => $flag) {
			if(!defined($flag)) define($flag, $key);
			$slugs[$key] = sanitize_title(preg_replace('/_/', '-', preg_replace('/^MLTP_/', '', $flag)));
		}
		define('MLTP_FLAGSLUGS', $slugs);

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
	 * - Mltp_Loader. Orchestrates the hooks of the plugin.
	 * - Mltp_I18n. Defines internationalization functionality.
	 * - Mltp_Admin. Defines all hooks for the admin area.
	 * - Mltp_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    0.1.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The standard plugin classes.
		 */
		require_once MULTIPASS_DIR . 'includes/class-mltp-loader.php';
		require_once MULTIPASS_DIR . 'includes/class-mltp-i18n.php';
		require_once MULTIPASS_DIR . 'admin/class-mltp-admin.php';
		require_once MULTIPASS_DIR . 'public/class-mltp-public.php';

		$this->loader = new Mltp_Loader();

		/**
		 * External libraries.
		 */
		require_once MULTIPASS_DIR . 'vendor/autoload.php';
		require_once MULTIPASS_DIR . 'includes/class-mltp-table.php';

		/**
		 * Post types.and specific plugin classes.
		 */
		require_once MULTIPASS_DIR . 'includes/class-mltp-prestation.php';
		require_once MULTIPASS_DIR . 'includes/class-mltp-item.php';
		require_once MULTIPASS_DIR . 'includes/class-mltp-resource.php';

		require_once MULTIPASS_DIR . 'includes/class-mltp-settings.php';
		require_once MULTIPASS_DIR . 'includes/class-mltp-plugininfo.php';

		require_once MULTIPASS_DIR . 'includes/modules/class-mltp-modules.php';

		// Make sure to load calendar after modules.
		require_once MULTIPASS_DIR . 'includes/class-mltp-calendar.php';

		// if(is_plugin_active('woocommerce/woocommerce.php')) {
		// require_once MULTIPASS_DIR . 'includes/modules/class-mltp-woocommerce.php';
		// $this->loaders[] = new Mltp_WooCommerce();
		//
		// require_once MULTIPASS_DIR . 'includes/modules/class-mltp-payment-product.php';
		// $this->loaders[] = new Mltp_Payment_Product();
		// }

		if ( get_transient( 'multipass_rewrite_flush' ) || get_transient( 'multipass_rewrite_version' ) != MULTIPASS_VERSION ) {
			wp_cache_flush();
			add_action( 'init', 'flush_rewrite_rules' );
			delete_transient( 'multipass_rewrite_flush' );
			set_transient( 'multipass_rewrite_version', MULTIPASS_VERSION );
			// admin_notice( 'Rewrite rules flushed' );
		}

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Mltp_I18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    0.1.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Mltp_I18n();

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

		$plugin_admin = new Mltp_Admin( $this->get_plugin_slug(), MULTIPASS_VERSION );

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

		$plugin_public = new Mltp_Public( $this->get_plugin_slug(), MULTIPASS_VERSION );

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
		if ( ! empty( $this->loaders ) && is_array( $this->loaders ) ) {
			foreach ( $this->loaders as $key => $loader ) {
				$this->loaders[ $key ]->run();
			}
		}

		add_action( 'admin_head', __CLASS__ . '::get_admin_notices_queue' );
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
	 * @return    Mltp_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	static function get_option( $option, $default = false ) {
		$settings_page = null;
		$result        = $default;
		if ( preg_match( '/:/', $option ) ) {
			$settings_page = strstr( $option, ':', true );
			$option        = trim( strstr( $option, ':' ), ':' );
		} else {
			$settings_page = 'multipass';
		}

		$settings = get_option( $settings_page );
		if ( $settings && isset( $settings[ $option ] ) ) {
			$result = $settings[ $option ];
		}

		// } else {
		// $result = get_option($option, $default);
		// }
		return $result;
	}

	static function update_option( $option, $value, $autoload = null ) {
		$settings_page = null;
		if ( preg_match( '/:/', $option ) ) {
			$settings_page       = strstr( $option, ':', true );
			$option              = trim( strstr( $option, ':' ), ':' );
			$settings            = get_option( $settings_page );
			$settings[ $option ] = $value;
			$result              = update_option( $settings_page, $settings, $autoload );
		} else {
			$result = update_option( $option, $value, $autoload );
		}
		return $result;
	}

	static function is_new_post( $args = null ) {
		global $pagenow;
		return ( is_admin() && in_array( $pagenow, array( 'post-new.php' ) ) );
	}

	static function unique_random_slug( $slug_size = null ) {
		global $wpdb;

		if ( empty( $slug_length ) ) {
			$slug_length = self::get_option( 'slug_length', 4 );
		}

		$i = 0; do {
			$i++;
			if ( $i > 5 ) { // failed several times to find a unique slug, increase length
				$slug_length++;
				$i = 0;
				self::update_option( 'multipass:slug_length', $slug_length );
			}

			$chars = implode( range( 'a', 'z' ) );
			// $chars = implode('', range('a', 'z')) . implode('', range('A', 'Z')) . implode('', range('0', '9')); // more characters allowed

			// Basic method: does not allow duplicate characters, less enthropy, slug length limited to $chars length
			$slug = substr( str_shuffle( $chars ), 0, $slug_length );

			// Alternative: more enthropy, length not limited, might be slower
			// $chars_length = strlen($chars);
			// $slug = '';
			// for($i = 0; $i < $slug_length; $i++) {
			// $random_character = $chars[mt_rand(0, $chars_length - 1)];
			// $slug .= $random_character;
			// }

			// hexadecimal alternative
			// $slug = bin2hex(random_bytes( $slug_length / 2));

			// Check uniqueness.
			$result = $wpdb->get_var( $wpdb->prepare( "SELECT post_name FROM $wpdb->posts WHERE post_name = %s LIMIT 1", $slug ) );
		} while ( $result );

		return $slug;
	}

	static function currency_options() {
		$options = wp_cache_get( 'multipass-currencies' );
		if ( $options ) {
			return $options;
		}

		$options = array();
		$symbols = Currency\Util\CurrencySymbolMapping::values();
		foreach ( $symbols as $code => $symbol ) {
			$options[ $code ] = "$code ($symbol)";
		}

		wp_cache_set( 'multipass-currencies', $options );
		return $options;
	}

	static function get_currency_symbol( $currency = '' ) {
		$symbol = wp_cache_get( 'get_currency_symbol-' . $currency );
		if ( $symbol ) {
			return $symbol;
		}

		if ( function_exists( 'get_woocommerce_currency_symbol' ) ) {
			$symbol = get_woocommerce_currency_symbol( $currency );
		} else {
			if ( empty( $currency ) ) {
				$options = self::get_option( 'currency' );
				if ( isset( $options['code'] ) ) {
					$search_currency = $options['code'];
				}
			} else {
				$search_currency = $currency;
			}

			$symbols = Currency\Util\CurrencySymbolMapping::values();
			$symbol  = ( ! empty( $symbols[ $search_currency ] ) ) ? $symbols[ $search_currency ] : $currency;
		}

		wp_cache_set( 'get_currency_symbol-' . $currency, $symbol );
		return $symbol;
	}

	static function price( $price, $args = array() ) {
		if ( empty( $price ) && $price !== 0 ) {
			return;
		}
		if ( function_exists( 'wc_price' ) ) {
			return wc_price( $price, $args );
		}

		$before = '';
		$after  = '';

		$options = wp_parse_args(
			self::get_option( 'currency' ),
			array(
				'code'         => null,
				'pos'          => null,
				'thousand_sep' => null,
				'decimal_sep'  => null,
				'num_decimals' => null,
			)
		);
		$args    = wp_parse_args( $args, $options );

		if ( ! empty( $args['code'] ) ) {
			$currency = $args['code'];
			$symbol   = self::get_currency_symbol();
			switch ( $args['pos'] ) {
				case 'left':
					$before = $symbol;
					break;
				case 'left_space':
					$before = "$symbol ";
					break;
				case 'right':
					$after = $symbol;
					break;
				case 'right_space':
				default:
					$after = " $symbol";
					break;
			}
		}

		if ( isset( $args['num_decimals'] ) & ! empty( $price ) ) {
			$price = number_format_i18n( $price, $args['num_decimals'] );
		} else {
			$price = number_format_i18n( $price );
		}
		$price = $before . $price . $after;

		return $price;
	}

	static function admin_notice( $notice, $class = 'info', $dismissible = true ) {
		if ( empty( $notice ) ) {
			return;
		}
		if ( $dismissible ) {
			$is_dismissible = 'is-dismissible';
		}
		if ( is_admin() ) {
			add_action(
				'admin_notices',
				function() use ( $notice, $class, $is_dismissible ) {
					?>
				<div class="notice notice-<?php echo $class; ?> <?php echo $is_dismissible; ?>">
					<p><strong><?php echo MULTIPASS_PLUGIN_NAME; ?></strong>: <?php _e( $notice, 'band-tools' ); ?></p>
				</div>
					<?php
				}
			);
		} else {
			self::delay_admin_notice( $notice, $class, $dismissible, __FUNCTION__ );
		}
	}

	static function delay_admin_notice( $notice, $class = 'info', $dismissible = true, $key = null ) {
		$transient_key = sanitize_title( __CLASS__ . '-admin_notices_queue' );

		$queue = get_transient( $transient_key );
		if ( ! is_array( $queue ) ) {
			$queue = array( $queue );
		}

		$hash           = hash( 'md5', $notice );
		$queue[ $hash ] = array(
			'notice'      => $notice,
			'class'       => $class,
			'dismissible' => $dismissible,
		);
		set_transient( $transient_key, $queue );
	}

	static function get_admin_notices_queue() {
		if ( ! is_admin() ) {
			return;
		}
		$transient_key = sanitize_title( __CLASS__ . '-admin_notices_queue' );

		$queue = get_transient( $transient_key );
		if ( ! is_array( $queue ) ) {
			$queue = array( $queue );
		}
		foreach ( $queue as $key => $notice ) {
			if ( ! is_array( $notice ) ) {
				continue;
			}
			self::admin_notice( $notice['notice'], $notice['class'], $notice['dismissible'] );
		}
		delete_transient( $transient_key );
	}

	static function format_date( $timestamp, $datetype = 'RELATIVE_MEDIUM', $timetype = 'NONE' ) {
		$DateType  = constant( "IntlDateFormatter::$datetype" );
		$TimeType  = constant( "IntlDateFormatter::$timetype" );
		if(empty($timestamp)) return null;
		$formatter   = new IntlDateFormatter( get_locale() , $DateType, $TimeType );
		$formatted = $formatter->format( $timestamp );
		return $formatted;
	}

	static function format_date_iso( $timestamp ) {
		// error_log(date('Y-m-d\TH:i:s', $timestamp ));
		// return date('Y-m-d\T12:00:00', $timestamp );
		return date( 'Y-m-d\TH:i:s', round( $timestamp / 3600 ) * 3600 );
	}

	static function format_date_range( $dates = array(), $datetype = 'RELATIVE_MEDIUM', $timetype = 'NONE' ) {
		if ( empty( $dates ) ) {
			return;
		}
		if ( ! is_array( $dates ) ) {
			$dates = array( $dates );
		}
		$dates = array_filter( $dates );

		if ( count( $dates ) == 2 ) {
			$DateType = constant( 'IntlDateFormatter::' . preg_replace( '/RELATIVE_/', '', $datetype ) );
			$TimeType = constant( 'IntlDateFormatter::' . preg_replace( '/RELATIVE_/', '', $timetype ) );
			$ranger   = new OpenPsa\Ranger\Ranger( get_locale() );
			$ranger->setDateType( $DateType )->setTimeType( $TimeType );
			$from = ( is_array( $dates['from'] ) ) ? $dates['from']['timestamp'] : $dates['from'];
			$to   = ( is_array( $dates['to'] ) ) ? $dates['to']['timestamp'] : $dates['to'];
			$string = $ranger->format(
				intval( $from ),
				intval( $to ),
			);
			return $string;
		}

		$DateType  = constant( "IntlDateFormatter::$datetype" );
		$TimeType  = constant( "IntlDateFormatter::$timetype" );
		$formatted = array();
		foreach ( $dates as $date ) {
			$formatter   = new IntlDateFormatter( get_locale(), $DateType, $TimeType );
			$formatted[] = $formatter->format( $date['timestamp'] );
		}
		return join( ', ', $formatted );
	}



	static function title_html() {
		return preg_replace( '/(#[[:alnum:]_-]+)/', '<code>$1</code>', the_title( '<h1>', '</h1>', false ) );
	}

	static function get_user_by_info( $info ) {
		if ( ! is_array( $info ) ) {
			error_log( "info $info is not an array" );
			return $info;
		}
		$user = null;
		if ( isset( $info['user_id'] ) ) {
			$user = get_user_by( 'id', $info['user_id'] );
		} elseif ( isset( $info['id'] ) ) {
			$user = get_user_by( 'id', $info['id'] );
		} elseif ( isset( $info['email'] ) ) {
			$user = get_user_by( 'email', $info['email'] );
		} elseif ( isset( $info['name'] ) ) {
			// $user = get_user_by('name', $info['name']);
			$users = get_users( array( 'search' => $info['name'] ) );
			if ( ! empty( $users ) ) {
				$user = $users[0];
			}
		}
		return $user;
	}

	static function get_user_info_by_info( $info ) {
		if ( ! is_array( $info ) ) {
			error_log( "info $info is not an array" );
			return $info;
		}
		$user = self::get_user_by_info( $info );
		if ( $user ) {
			$info = array(
				'user_id' => $user->ID,
				'name'    => trim( $user->first_name ) . ' ' . $user->last_name,
				'email'   => $user->user_email,
				'phone'   => join(
					', ',
					array_filter(
						array(
							get_user_meta( $user->ID, 'billing_phone', true ),
							get_user_meta( $user->ID, 'shipping_phone', true ),
						)
					)
				),
			);
		}
		// $info = array_replace($info, array_filter(array(
		// 'user_id' => $user->ID,
		// 'name' => trim($user->first_name) . ' ' . $user->last_name,
		// 'email' => $user->user_email,
		// 'phone' => join(', ', array_filter(array(
		// get_user_meta($user->ID, 'billing_phone', true),
		// get_user_meta($user->ID, 'shipping_phone', true),
		// ))),
		// )));
		return $info;
	}

	static function register_terms( $taxonomy_slug, $terms = array(), $args = array() ) {
		$terms = apply_filters( 'multipass_register_terms_' . $taxonomy_slug, $terms );
		if ( empty( $terms ) ) {
			return;
		}

		$desc_required = sprintf( __( '(generated by %s)', 'multipass' ), MULTIPASS_PLUGIN_NAME );
		foreach ( $terms as $slug => $term ) {
			if ( empty( $slug ) ) {
				continue;
			}
			if ( is_string( $term ) ) {
				$term = array( 'name' => $term );
			}
			$term = array_replace(
				array(
					'slug'        => $slug,
					'name'        => $slug,
					'description' => $desc_required,
				),
				$args,
				$term
			);

			if ( ! empty( $term['parent'] ) ) {
				$parent = term_exists( $term['parent'], 'prestation-status' );
				if ( $parent && isset( $parent['term_id'] ) ) {
					$term['parent'] = $parent['term_id'];
				} else {
					unset( $term['parent'] );
				}
			}

			$name = $term['name'];
			unset( $term['name'] );
			if ( get_term_by( 'slug', $slug, $taxonomy_slug ) ) {
				continue;
			}
			$term_id = wp_insert_term( $name, $taxonomy_slug, $term )['term_id'];
			add_term_meta( $term_id, 'multipass_generated', true, true );
		}
		add_filter( $taxonomy_slug . '_row_actions', 'MultiPass::unset_taxonomy_row_actions', 10, 2 );
		add_action( $taxonomy_slug . '_edit_form', 'MultiPass::remove_delete_edit_term_form', 10, 2 );
		add_action( 'pre_delete_term', 'MultiPass::taxonomy_delete_protection', 10, 1 );
	}

	static function unset_taxonomy_row_actions( $actions, $term ) {
		$delete_protected = get_term_meta( $term->term_id, 'multipass_generated', true );
		if ( $delete_protected ) {
			unset( $actions['delete'] );
		}

		return $actions;
	}

	static function remove_delete_edit_term_form( $term, $taxonomy ) {
		$delete_protected = get_term_meta( $term->term_id, 'multipass_generated', true );
		if ( $delete_protected ) {
			echo '<style type="text/css">#delete-link {display: none !important;}</style>';
		}
	}

	static function taxonomy_delete_protection( $term_id ) {
		$delete_protected = get_term_meta( $term_id, 'multipass_generated', true );

		if ( $delete_protected ) {
			$term    = get_term( $term_id );
			$message = sprintf( __( '%1$s is required by %2$s, it cannot be deleted' ), $term->name, MULTIPASS_PLUGIN_NAME );

			$error = new WP_Error();
			$error->add( 1, $message );

			if ( is_ajax() ) {
				wp_die( -1 );
			} else {
				wp_die( $message );
			}
		}
	}

	/**
	 * Return 2-letters locale.
	 *
	 * @return string Current locale.
	 */
	public static function get_locale() {
		// if ( ! empty( $this->locale ) ) {
		// return $this->locale;
		// }

		$locale = preg_replace( '/_.*/', '', get_locale() );
		if ( empty( $locale ) ) {
			$locale = 'en';
		}

		return $locale;
	}

	public static function get_the_flags($post_id = null) {
		if(empty($post_id)) $post_id = get_the_ID();
		$flags = get_post_meta( get_the_ID(), 'flags', true );
		if($flags) {
			return self::get_flag_slugs($flags);
		}
	}

	public static function get_flag_slugs($flags, $format = 'array') {
		$array = [];
		$slugs = MLTP_FLAGSLUGS;
		foreach($slugs as $flag => $slug) {
			$array[$flag] = ($flags & $flag) ? $slug : null;
		}

		return array_filter($array);
	}

	public static function set_flags($args) {
		$paid = isset($args['paid']) ? $args['paid'] : 0;
		$deposit = isset($args['deposit']['amount']) ? $args['deposit']['amount'] : 0;
		$total = isset($args['total']) ? $args['total'] : 0;
		$confirmed = isset($args['confirmed']) ? $args['confirmed'] : false;
		$flags = 0;

		if ( $paid > 0 ) {
			$flags = $flags | MLTP_PAID_SOME;
			if ( $deposit > 0 && $paid >= $deposit ) {
				$flags = $flags | MLTP_PAID_DEPOSIT;
				$confirmed = true;
			}
		}
		if ( $confirmed ) {
			$flags = $flags | MLTP_CONFIRMED;
		}
		if ( $paid >= $total ) {
			$flags = $flags | MLTP_PAID_ALL;
			if( $paid > $total ) {
				$flags = $flags | MLTP_PAID_MORE;
			}
		}

		return $flags;
	}
}
