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
 * @author     Magiiic <info@magiiic.com>
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
			1     => 'MLTP_PAID_SOME',
			2     => 'MLTP_PAID_DEPOSIT',
			4     => 'MLTP_PAID_ALL',
			8     => 'MLTP_OVERPAID',
			16    => 'MLTP_REFUNDED',
			32    => 'MLTP_CONFIRMED',
			64    => 'MLTP_STARTED',
			128   => 'MLTP_ENDED', // end date passed, but final invoicing not done
			256   => 'MLTP_COMPLETED', // all paid, final invoicing done
			512   => 'MLTP_AVAILABLE',
			1024  => 'MLTP_CLOSED_PERIOD',
			2048  => 'MLTP_CANCELED',
			4096  => 'MLTP_DUE',
			8192  => 'MLTP_OVERDUE',
			16384 => 'MLTP_EXTERNAL',
		);
		foreach ( $flags as $key => $flag ) {
			if ( ! defined( $flag ) ) {
				define( $flag, $key );
			}
			$slugs[ $key ] = sanitize_title( preg_replace( '/_/', '-', preg_replace( '/^MLTP_/', '', $flag ) ) );
		}
		define( 'MLTP_FLAGSLUGS', $slugs );

		if ( ! defined( 'RELATIVE_MEDIUM' ) ) {
			define( 'RELATIVE_MEDIUM', 130 );
		}

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();

		add_action('init', array($this, 'register_session'));
	}

	function register_session()
	{
		if (preg_match('/^\/multipass(\/)?$/', $_SERVER['REQUEST_URI'])) {
			wp_redirect(admin_url('admin.php?page=multipass'));
			exit;
		}

	  if( !session_id() )
	  {
	    session_start();
	  }

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
		 * External libraries.
		 */
		require_once MULTIPASS_DIR . 'vendor/autoload.php';

		/**
		 * Template overrides
		 */
		require_once MULTIPASS_DIR . 'templates/templates.php';

		/**
		 * The standard plugin classes.
		 */
		require_once MULTIPASS_DIR . 'includes/class-mltp-loader.php';
		require_once MULTIPASS_DIR . 'includes/class-mltp-i18n.php';
		require_once MULTIPASS_DIR . 'admin/class-mltp-admin.php';
		require_once MULTIPASS_DIR . 'public/class-mltp-public.php';

		$this->loader = new Mltp_Loader();

		/**
		 * Post types.and specific plugin classes.
		 */
		require_once MULTIPASS_DIR . 'includes/class-mltp-background.php';
		require_once MULTIPASS_DIR . 'includes/class-mltp-table.php';
		require_once MULTIPASS_DIR . 'includes/class-mltp-prestation.php';
		require_once MULTIPASS_DIR . 'includes/class-mltp-prestation-detail.php';
		require_once MULTIPASS_DIR . 'includes/class-mltp-resource.php';
		require_once MULTIPASS_DIR . 'includes/class-mltp-rates-and-taxes.php';
		require_once MULTIPASS_DIR . 'includes/class-mltp-payment.php';
		require_once MULTIPASS_DIR . 'includes/class-mltp-pdf.php';
		require_once MULTIPASS_DIR . 'includes/class-mltp-text-templates.php';

		require_once MULTIPASS_DIR . 'includes/class-mltp-settings.php';
		require_once MULTIPASS_DIR . 'includes/class-mltp-plugininfo.php';

		/**
		 * Modules
		 */
		require_once MULTIPASS_DIR . 'includes/modules/class-mltp-modules.php';

		/**
		 * Calendar
		 *
		 * Make sure to load all modules before calendar
		 */
		require_once MULTIPASS_DIR . 'includes/class-mltp-calendar.php';
		require_once MULTIPASS_DIR . 'includes/class-mltp-api.php';
		require_once MULTIPASS_DIR . 'includes/class-mltp-reports.php';

		/**
		 * Database updates
		 */

		require_once MULTIPASS_DIR . 'includes/updates.php';

		// if(is_plugin_active('woocommerce/woocommerce.php')) {
		// require_once MULTIPASS_DIR . 'includes/modules/class-mltp-woocommerce.php';
		// $this->loaders[] = new Mltp_WooCommerce();
		//
		// require_once MULTIPASS_DIR . 'includes/modules/class-mltp-woocommerce-payment.php';
		// $this->loaders[] = new Mltp_WooCommerce_Payment();
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
	public function init() {
		$this->loader->init();
		if ( ! empty( $this->loaders ) && is_array( $this->loaders ) ) {
			foreach ( $this->loaders as $key => $loader ) {
				$this->loaders[ $key ]->init();
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
			if ( empty( $search_currency ) ) {
				$symbol = null;
			} else {
				$symbols = Currency\Util\CurrencySymbolMapping::values();
				$symbol  = ( ! empty( $symbols[ $search_currency ] ) ) ? $symbols[ $search_currency ] : $currency;
			}
		}

		wp_cache_set( 'get_currency_symbol-' . $currency, $symbol );
		return $symbol;
	}

	static function price_with_links( $prestation, $amount, $args = array(), $attr = array() ) {
		if ( empty( $amount ) || $amount < 0 ) {
			return;
		}

		$output = self::price( $amount, $args );
		$links  = array(
			self::payment_link( $prestation->slug, $amount, array( 'icon' => 'admin-links' ), array( 'tabindex' => -1 ) ),
			self::payment_mail_link( $prestation, $amount, array( 'icon' => 'email' ), array( 'tabindex' => -1 ) ),
		);
		if ( ! empty( $links ) ) {
			$output .= ' <span class="actions price-actions">' . join( ' ', $links ) . '</span>';
		}
		return $output;
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

	// static function timestamp( $date ) {
	// 	$timestamp = (is_array($date) && isset($date['timestamp'])) ? $date['timestamp'] : $date;
	// 	return empty($timestamp) ? null : intval($timestamp);
	// 	// return ( is_integer( $timestamp) &! empty($timestamp)) ? $timestamp : null;
	// }

	static function timestamp( $timestamp ) {
		if ( is_array( $timestamp ) && isset( $timestamp['timestamp'] ) ) {
			$timestamp = $timestamp['timestamp'];
		}
		if ( is_numeric( $timestamp ) & ! empty( $timestamp ) ) {
			return $timestamp;
		}

		return null;
	}

	static function IntlDateConstant( $constant, $default = null ) {
		if ( defined( "IntlDateFormatter::$constant" ) ) {
			return constant( "IntlDateFormatter::$constant" );
		}

		if ( defined( $constant ) ) {
			return constant( $constant );
		}

		return null;
	}

	static function array_join( $array, $sep = ', ') {
		if(!is_array($array)) return $array;
		$rows = array();
		foreach ($array as $row) {
			if(is_array($row)) {
				$row = self::array_join($row, ' ');
			}
			$rows[] = $row;
		}
		return str_replace("$sep#", ' #', join($sep, array_filter($rows) ) );
	}

	static function format_date( $timestamp, $datetype_str = 'RELATIVE_MEDIUM', $timetype_str = 'NONE' ) {
		$datetype = self::IntlDateConstant( $datetype_str );
		$timetype = self::IntlDateConstant( $timetype_str );

		if ( empty( $timestamp ) ) {
			return null;
		}
		$formatter = new IntlDateFormatter( get_locale(), $datetype, $timetype );
		$formatted = $formatter->format( $timestamp );
		return $formatted;
	}

	static function format_date_iso( $timestamp ) {
		$timestamp = self::timestamp( $timestamp );
		if ( empty( $timestamp ) ) {
			return;
		}

		// error_log(date('Y-m-d\TH:i:s', $timestamp ));
		// return date('Y-m-d\T12:00:00', $timestamp );
		return date( 'Y-m-d\TH:i:s', round( $timestamp / 3600 ) * 3600 );
	}

	static function format_date_range( $dates = array(), $datetype_str = 'RELATIVE_MEDIUM', $timetype_str = 'NONE' ) {
		if ( empty( $dates ) ) {
			return;
		}
		if ( ! is_array( $dates ) ) {
			$dates = array( $dates );
		}
		$dates_debug = $dates;
		$dates = array_filter( $dates );
		if ( count( $dates ) == 2 || isset($dates['from'])) {
			if ( ! isset( $dates['from'] ) ) {
				$dates = array(
					'from' => $dates[0],
					'to'   => $dates[1],
				);
			}
			if(empty($dates['to'])) {
				return self::format_date($dates['from']);
			}
			$datetype = constant( 'IntlDateFormatter::' . preg_replace( '/RELATIVE_/', '', $datetype_str ) );
			$timetype = constant( 'IntlDateFormatter::' . preg_replace( '/RELATIVE_/', '', $timetype_str ) );
			$ranger   = new OpenPsa\Ranger\Ranger( get_locale() );
			$ranger->setDateType( $datetype )->setTimeType( $timetype );
			$from   = ( isset( $dates['from'] ) ) ? MultiPass::timestamp($dates['from']) : null;
			$to   = ( isset( $dates['to'] ) ) ? MultiPass::timestamp($dates['to']) : null;
			return $ranger->format(
				$from,
				$to,
			);
		}

		$datetype  = constant( "IntlDateFormatter::$datetype_str" );
		$timetype  = constant( "IntlDateFormatter::$timetype_str" );
		$formatted = array();
		foreach ( $dates as $key => $date ) {
			$formatter   = new IntlDateFormatter( get_locale(), $datetype, $timetype );
			if( is_array($date) &! empty($date['timestamp']) ) {
				$formatted[] = $formatter->format( $date['timestamp'] );
			}
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
		// add_filter( $taxonomy_slug . '_row_actions', 'MultiPass::unset_taxonomy_row_actions', 10, 2 );
		// add_action( $taxonomy_slug . '_edit_form', 'MultiPass::remove_delete_edit_term_form', 10, 2 );
		// add_action( 'pre_delete_term', 'MultiPass::taxonomy_delete_protection', 10, 1 );
	}

	// static function unset_taxonomy_row_actions( $actions, $term ) {
	// $delete_protected = get_term_meta( $term->term_id, 'multipass_generated', true );
	// if ( $delete_protected ) {
	// unset( $actions['delete'] );
	// }
	//
	// return $actions;
	// }
	//
	// static function remove_delete_edit_term_form( $term, $taxonomy ) {
	// $delete_protected = get_term_meta( $term->term_id, 'multipass_generated', true );
	// if ( $delete_protected ) {
	// echo '<style type="text/css">#delete-link {display: none !important;}</style>';
	// }
	// }
	//
	// static function taxonomy_delete_protection( $term_id ) {
	// $delete_protected = get_term_meta( $term_id, 'multipass_generated', true );
	//
	// if ( $delete_protected ) {
	// $term    = get_term( $term_id );
	// $message = sprintf( __( '%1$s is required by %2$s, it cannot be deleted' ), $term->name, MULTIPASS_PLUGIN_NAME );
	//
	// $error = new WP_Error();
	// $error->add( 1, $message );
	//
	// if ( is_ajax() ) {
	// wp_die( -1 );
	// } else {
	// wp_die( $message );
	// }
	// }
	// }

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

	public static function get_the_flag_slugs( $post_id = null, $prefix = '' ) {
		if ( empty( $post_id ) ) {
			$post_id = get_the_ID();
		}
		$flags = (int) get_post_meta( get_the_ID(), 'flags', true );
		if ( $flags ) {
			return self::get_flag_slugs( $flags, $prefix );
		}
	}

	public static function get_flag_slugs( $flags, $prefix = '' ) {
		$flags = empty( $flags ) ? 0 : $flags;
		$array = array();
		$slugs = MLTP_FLAGSLUGS;
		foreach ( $slugs as $flag => $slug ) {
			if ( empty( $flag ) ) {
				continue;
			}
			$array[ $flag ] = ( $flags & $flag ) ? "$prefix$slug" : null;
		}

		return array_filter( $array );
	}

	public static function set_flags( $args ) {
		$paid          = isset( $args['paid'] ) ? $args['paid'] : 0;
		$deposit       = isset( $args['deposit']['amount'] ) ? $args['deposit']['amount'] : 0;
		$total         = isset( $args['total'] ) ? $args['total'] : 0;
		$confirmed     = isset( $args['confirmed'] ) ? $args['confirmed'] : false;
		$closed_period = ( isset( $args['status'] ) && 'closed-period' === $args['status'] ) ? true : false;

		$flags = 0;
		if ( $closed_period ) {
			$flags = $flags | MLTP_CLOSED_PERIOD;
		} else {
			if ( $paid > 0 && $total > 0 ) {
				if ( ( $paid >= $deposit && $deposit > 0 ) || 0 === $deposit ) {
					$flags = $flags | MLTP_PAID_DEPOSIT | MLTP_CONFIRMED;
				} else {
					$flags = $flags | MLTP_PAID_SOME | MLTP_DUE;
				}
				if ( $paid >= $total ) {
					$flags = $flags | MLTP_PAID_ALL;
				}
			}

			if ( $paid > $total ) {
				$flags = $flags | MLTP_OVERPAID;
			}
		}

		if ( $confirmed ) {
			$flags = $flags | MLTP_CONFIRMED;
		}
		if ( isset( $args['external'] ) && $args['external'] ) {
			$flags = $flags | MLTP_EXTERNAL;
		}

		return $flags;
	}

	public static function is_external( $url ) {
		$urlparts = parse_url( home_url() );
		$domain   = $urlparts['host'];
		// if(!preg_match('/^https?:/', $url )) return $url;
		$components = parse_url( $url );

		return ! empty( $components['host'] ) && strcasecmp( $components['host'], $domain ); // empty host will indicate url like '/relative.php'
	}

	public static function get_editable_roles() {
		global $wp_roles;

		$all_roles      = $wp_roles->roles;
		$editable_roles = apply_filters( 'editable_roles', $all_roles );

		return $editable_roles;
	}

	public static function get_source_url( $source, $source_id, $default = null, $args = array() ) {
		if ( empty( $source ) || empty( $source_id ) ) {
			return $default;
		}

		switch ( $source ) {
			case 'airbnb':
				$source_url = 'https://www.airbnb.fr/hosting/reservations/details/' . $source_id;
				break;

			case 'booking': // deprecated, use 'bookingcom' instead
			case 'bookingcom':
				$source_url = 'https://admin.booking.com/hotel/hoteladmin/extranet_ng/manage/booking.html?res_id=' . $source_id;
				break;

			case 'expedia':
				$source_url = 'https://apps.expediapartnercentral.com/lodging/bookings?bookingItemId=' . $source_id;
				break;

			case 'lodgify':
				if ( ! empty( $args['status'] ) && 'closed-period' === $args['status'] ) {
					$source_url = 'https://app.lodgify.com/#/reservation/calendar/multi/closed-period/' . $source_id;
				} else {
					$source_url = 'https://app.lodgify.com/#/reservation/inbox/B' . $source_id;
				}
				break;

			case 'woocommerce':
				// if(current_user_can( 'edit_post', $source_id )) {
					$order_id = preg_replace( ':/.*:', '', $source_id );
					$order    = wc_get_order( $order_id );
				if ( $order ) {
					$source_url = $order->get_edit_order_url();
				}
				// }
				break;

			default:
				$source_url = $default;
		}

		// $source_url = apply_filters('multipass_source_url', $source_url, $source, $source_id, $default);
		return $source_url;
	}

	public static function sanitize_email( $email ) {
		if ( empty( $email ) ) {
			return null;
		}

		$email = html_entity_decode( $email );
		$email = preg_replace( '/,.*/', '', $email );
		$email = preg_replace( '/mailto:/', '', $email );
		$email = preg_replace( '/.*<(.*)>.*/', '$1', $email );
		$email = preg_replace( '/\'/', '', $email );
		$email = preg_replace( '/"/', '', $email );
		$email = sanitize_email( $email );

		return $email;
	}

	public static function back_to_multipass_button( $taxonomy ) {
		echo sprintf(
			'<a href="%1$s"><button>%2$s</button></a>',
			admin_url( 'admin.php?page=multipass' ),
			__( 'Back to MultiPass' ),
		);
	}

	public static function get_registered_sources() {
		$sources = array();
		$terms   = get_terms( 'mltp_detail-source' );
		foreach ( $terms as $term ) {
			if(! empty($term->slug) &! empty($term->name) ) {
				$sources[ $term->slug ] = $term->name;
			}
		}

		$sources = apply_filters( 'multipass_register_terms_mltp_detail-source', $sources );

		return $sources;
	}

	/**
	 * Create an uuid from souce and source id. Optional disambiguation data can
	 * be provided with $extra argument. All arguments must be persistent, i.e.
	 * they cannot change in the future, whatever modification is made to the
	 * source.
	 *
	 * @param  string $source       source slug.
	 * @param  string $id           source id (as provided by the source).
	 * @param  string $extra        optional disambiguation info.
	 * @return string               hashed data.
	 */
	static function hash_source_uuid( $source, $id, $extra = null ) {
		if ( empty( $source ) || empty( $id ) ) {
			return false;
		}

		$hash = md5( json_encode( array_filter( array( $source, $id, $extra ) ) ) );

		return $hash;
	}

	static function debug() {
		$args       = func_get_args();
		$backtrace  = empty( debug_backtrace()[1]['class'] ) ? '' : debug_backtrace()[1]['class'] . '::';
		$backtrace .= debug_backtrace()[1]['function']; // . ' (' . debug_backtrace()[1]['line'] . ') ';

		if ( ! current_user_can( 'mltp_administrator' ) ) {
			// error_log($backtrace . ' not an administrator' );
			return false;
		}
		$multipass_debug = get_option( 'multipass_debug' );
		if ( empty( $args ) ) {
			// error_log($backtrace . ' empty args');
			return $multipass_debug;
		}
		if ( ! $multipass_debug ) {
			// error_log($backtrace . ' multipass_debug disabled ' . $multipass_debug );
			return false;
		}

		foreach ( $args as $key => $arg ) {
			if ( ! is_string( $arg ) ) {
				$args[ $key ] = print_r( $arg, true );
			}
		}

		error_log( $backtrace . ' ' . join( ' ', $args ) );

		return true;
	}
	// static function debug( $string = null ) {
	// if ( ! current_user_can( 'mltp_administrator' ) ) {
	// return false;
	// }
	//
	// if ( ! empty( $string ) ) {
	// error_log( $string );
	// }
	//
	// return get_option( 'multipass_debug' );
	// }

	static function role( $role ) {
		return ( preg_match( '/^mltp_/', $role ) ) ? self::get_option( $role, $role ) : $role;
	}

	static function payment_url( $reference = null, $amount = null, $args = array() ) {
		$args['from_class'] = __CLASS__;
		$amount             = self::round_amount( $amount );

		return apply_filters( 'mltp_payment_url', $reference, $amount, $args );
	}

	static function payment_mail_link( $prestation, $amount = null, $args = array(), $attr = array() ) {
		$payment_url = self::payment_url( $prestation->slug, $amount, $args );

		$parts          = array_filter(
			array(
				$prestation->name,
				$prestation->guests,
				self::format_date_range( $prestation->dates, 'RELATIVE_SHORT' ),
			)
		);
		$customer_name  = get_post_meta( $prestation->id, 'customer_name', true );
		$customer_email = get_post_meta( $prestation->id, 'customer_email', true );
		$contact        = self::get_option( 'mail_contact', __( 'Do not hesitate to reach us by mail or phone with any question.', 'multipass' ) );
		$regards        = self::get_option( 'mail_regards', __( 'Best regards,', 'multipass' ) . "\n" . wp_get_current_user()->user_firstname );

		$subject = sprintf(
			'Re: %s (%s)',
			join( ', ', $parts ),
			__( 'Payment link', 'multipass' )
		);
		$body    = sprintf(
			__( "Hello\n\nHere is the payment link for the service under reference #%1\$s (%2\$s):\n\n%3\$s\n\nYou can pay by card, Paypal, or bank transfer. For wire transfers, please take into account a bank processing time of 2 to 3 business days.", 'multipass' ),
			$prestation->slug,
			self::format_date_range( $prestation->dates, 'RELATIVE_LONG' ),
			'<ul><li>' . self::link( $payment_url ) . '</li></ul>',
		)
		. "\n\n$contact\n\n$regards";

		$mail_args = array(
			'subject'   => rawurlencode( $subject ),
			'body'      => rawurlencode( wp_strip_all_tags( $body ) ),
			'html-body' => rawurlencode( preg_replace( ':[\s\n\r\p{Z}]*(</?ul>)[\s\n\r\p{Z}]*:', '$1', $body ) ),
		);

		$mailto = ( ! empty( $customer_email ) ) ? rawurlencode( $customer_name . "<$customer_email>" ) : null;
		$url    = add_query_arg( $mail_args, 'mailto:' . rawurlencode( $mailto ) );

		if ( empty( $args['text'] ) ) {
			$args['text'] = __( 'Send payment link by mail', 'multipass' );
		}
		return self::link( $url, $args, $attr );
	}


	// static function payment_link( $reference = null, $amount = null, $language = null, $format = null, $string = null ) {
	static function payment_link( $reference = null, $amount = null, $args = array(), $attr = array() ) {
		$url = self::payment_url( $reference, $amount, $args );

		if ( empty( $args['text'] ) ) {
			$args['text'] = __( 'Payment link', 'multipass' );
		}

		return self::link( $url, $args, $attr );
	}

	static function insert_attr( $html, $attr = array() ) {
		if ( empty( $html ) ) {
			return $html;
		}

		$split     = explode( '>', $html );
		$split[0] .= ' ' . implode(
			' ',
			array_map(
				function ( $k, $v ) {
					return $k . '="' . htmlspecialchars( $v ) . '"';
				},
				array_keys( $attr ),
				$attr
			)
		);
		return join( '>', $split );
	}

	static function is_phone( $string ) {
		return preg_match( '/^\+[0-9 ()\.-]+$/', $string );
		// $phoneNumberUtil = \libphonenumber\PhoneNumberUtil::getInstance();
		// $phoneNumberObject = $phoneNumberUtil->parse($string, 'FR');
		// return $phoneNumberUtil->isValidNumber($phoneNumberObject);
	}

	static function format_phone( $string, $format = 'intl' ) {
		if ( class_exists( '\libphonenumber\PhoneNumberUtil' ) ) {
			$phoneNumberUtil   = \libphonenumber\PhoneNumberUtil::getInstance();
			$phoneNumberObject = $phoneNumberUtil->parse( $string, 'FR' );
			if ( $format = 'intl' ) {
				return $phoneNumberUtil->format( $phoneNumberObject, \libphonenumber\PhoneNumberFormat::INTERNATIONAL );
			} else {
				return $phoneNumberUtil->format( $phoneNumberObject, \libphonenumber\PhoneNumberFormat::RFC3966 );
			}
		} else {
			return $string;
		}
	}

	static function link( $url, $args = array(), $attr = array() ) {
		if ( empty( $url ) ) {
			return;
		}

		$text = empty( $args['text'] ) ? null : $args['text'];
		$icon = empty( $args['icon'] ) ? null : $args['icon'];
		if ( is_email( $url ) ) {
			$text = ( empty( $args['text'] ) ) ? $url : $args['text'];
			$url  = "mailto:$url";
		} elseif ( self::is_phone( $url ) ) {
			if ( empty( $args['text'] ) ) {
				$text = self::format_phone( $url );
			} else {
				$text = $args['text'];
			}
			$url = self::format_phone( $url, 'link' );
		}

		$attr = array_merge(
			array(
				'href' => $url,
			// 'tabindex' => -1,
			),
			$attr
		);

		if ( self::is_external( $url ) ) {
			$attr['target'] = '_blank';
		}

		if ( ! empty( $icon ) ) {
			$attr['title'] = $text;
			$html          = sprintf(
				'<a><span class="dashicons dashicons-%s"></span></a>',
				$icon,
			);
			return self::insert_attr( $html, $attr );
		}

		$html = sprintf(
			'<a>%s</a>',
			( empty( $text ) ) ? $url : $text,
		);
		return self::insert_attr( $html, $attr );
	}

	/**
	 * Placeholder. Will be used to get meta value from update request if any, or
	 * from current saved meta if no request.
	 *
	 * @param  integer $post_id                Post id.
	 * @param  string  $meta_key               Meta Key.
	 * @param  boolean $update                 Update value passed from callback. Probably not used.
	 * @return mixed            Meta value.
	 */
	static function get_post_or_update_meta( $post_id, $meta_key, $update = true ) {
		return get_post_meta( $post_id, $meta_key, $update );
	}

	static function round_amount( $amount, $precision = 2 ) {
		$rounding = apply_filters( 'mltp_rounding', $precision );
		$rounded  = ( is_numeric( $rounding ) && is_numeric( $amount ) ) ? round( $amount, $rounding ) : $amount;
		return $rounded;
	}

	static function n_label( $label, $count, $domain = 'multipass' ) {
		$labels = array(
			'adults'   => _n_noop( 'adult', 'adults', 'multipass' ),
			'children' => _n_noop( 'child', 'children', 'multipass' ),
			'babies'   => _n_noop( 'baby', 'babies', 'multipass' ),
			'baby'     => _n_noop( 'baby', 'babies', 'multipass' ),
			'double'   => _n_noop( 'double bed', 'double beds', 'multipass' ),
			'single'   => _n_noop( 'single bed', 'single beds', 'multipass' ),
			'baby'     => _n_noop( 'baby bed', 'baby beds', 'multipass' ),
		);

		return ( empty( $labels[ $label ] ) ) ? __( $label, $domain ) : translate_nooped_plural( $labels[ $label ], $count, $domain );
	}

	/**
	 * Format an array of numbers as a comprehensive string.
	 *
	 * @param  array  $data              count data as 'label' => count,
	 * @param  string $format       output format ('long', 'long_with_total, 'total')
	 * @return string               n label 1, n label 2...
	 */
	static function format_count( $data, $format = 'long' ) {
		if ( empty( $data ) ) {
			return null;
		}

		$total = empty( $data['total'] ) ? '' : $data['total'];
		unset( $data['total'] );
		if ( 'total' === $format ) {
			return $total;
		}
		$output_array = array();
		foreach ( $data as $type => $count ) {
			$output_array[] = $count . ' ' . self::n_label( $type, $count );
		}
		if ( ! empty( $output_array ) ) {
			if ( count( $output_array ) > 1 && 'long_with_total' === $format ) {
				$output = sprintf(
					'%s (%s)',
					( empty( $total ) ) ? array_sum( $data ) : $total,
					implode( ', ', $output_array ),
				);
			} else {
				$output = implode( ', ', $output_array );
			}
		} else {
			$output = $total;
		}

		return $output;
	}

}
