<?php

/**
 * Register all actions and filters for the plugin
 *
 * @link       https://github.com/magicoli/multipass
 * @since      0.1.0
 *
 * @package    MultiPass
 * @subpackage MultiPass/includes
 */

/**
 * Register all actions and filters for the plugin.
 *
 * Maintain a list of all hooks that are registered throughout
 * the plugin, and register them with the WordPress API. Call the
 * run function to execute the list of actions and filters.
 *
 * @package    MultiPass
 * @subpackage MultiPass/includes
 * @author     Magiiic <info@magiiic.com>
 */
class Mltp_Modules {

	/**
	 * The array of actions registered with WordPress.
	 *
	 * @since    0.1.0
	 * @access   protected
	 * @var      array    $actions    The actions registered with WordPress to fire when the plugin loads.
	 */
	protected $actions;

	/**
	 * The array of filters registered with WordPress.
	 *
	 * @since    0.1.0
	 * @access   protected
	 * @var      array    $filters    The filters registered with WordPress to fire when the plugin loads.
	 */
	protected $filters;

	public $locale;

	/**
	 * Initialize the collections used to maintain the actions and filters.
	 *
	 * @since    0.1.0
	 */
	public function __construct() {
		$this->plugin_slug = 'multipass';

		$this->locale = MultiPass::get_locale();

		$this->load_dependencies();
		// $this->define_admin_hooks();
		// $this->define_public_hooks();

		// register_activation_hook( MULTIPASS_FILE, __CLASS__ . '::activate' );
		// register_deactivation_hook( MULTIPASS_FILE, __CLASS__ . '::deactivate' );
	}

	private function load_dependencies() {
		if ( isset( $_REQUEST['submit'] ) && isset( $_REQUEST['page'] ) && $_REQUEST['page'] == 'multipass' ) {
			$enabled = ( isset( $_REQUEST['modules_enable'] ) ) ? $_REQUEST['modules_enable'] : array();
		} else {
			$enabled = MultiPass::get_option( 'modules_enable', array() );
		}

		$this->modules = array();

		if ( is_plugin_active( 'woocommerce/woocommerce.php' ) ) {
			require_once MULTIPASS_DIR . 'includes/modules/class-mltp-woocommerce.php';
			require_once MULTIPASS_DIR . 'includes/modules/class-mltp-payment-product.php';
		}

		if ( in_array( 'imap', $enabled ) ) {
			require_once MULTIPASS_DIR . 'includes/class-mltp-mailbox.php';
		}

		if ( in_array( 'lodgify', $enabled ) ) {
			require_once MULTIPASS_DIR . 'includes/modules/class-mltp-lodgify.php';
		}

		if ( in_array( 'hbook', $enabled ) ) {
			require_once MULTIPASS_DIR . 'includes/modules/class-mltp-hbook.php';
		}

	}

	/**
	 * Register the filters and actions with WordPress.
	 *
	 * @since    0.1.0
	 */
	public function run() {
		if ( ! empty( $this->modules ) && is_array( $this->modules ) ) {
			foreach ( $this->modules as $key => $loader ) {
				$this->modules[ $key ]->run();
			}
		}

		$this->actions = array();

		$this->filters = array(
			// array (
			// 'hook' => 'mb_settings_pages',
			// 'callback' => 'register_settings_pages',
			// ),
			array(
				'hook'     => 'rwmb_meta_boxes',
				'callback' => 'register_settings_fields',
			),
			// array(
			// 	'hook'     => 'multipass_managed_list',
			// 	'callback' => 'managed_list_filter',
			// ),
		);

		$defaults = array(
			// 'component'     => __CLASS__,
			'component'     => $this,
			'priority'      => 10,
			'accepted_args' => 1,
		);

		foreach ( $this->filters as $hook ) {
			$hook = array_merge( $defaults, $hook );
			add_filter( $hook['hook'], array( $hook['component'], $hook['callback'] ), $hook['priority'], $hook['accepted_args'] );
		}

		foreach ( $this->actions as $hook ) {
			$hook = array_merge( $defaults, $hook );
			add_action( $hook['hook'], array( $hook['component'], $hook['callback'] ), $hook['priority'], $hook['accepted_args'] );
		}

	}

	function register_settings_fields( $meta_boxes ) {
		$prefix = 'modules_';

		// Modules settings in General tab
		$meta_boxes[] = array(
			'title'          => __( 'MultiPass Modules', 'multipass' ),
			'id'             => 'multipass-modules',
			'settings_pages' => array( 'multipass' ),
			'tab'            => 'general',
			'fields'         => array(
				array(
					'name'    => __( 'Modules', 'multipass' ),
					'id'      => $prefix . 'enable',
					'type'    => 'checkbox_list',
					'options' => array(
						'imap'    => __( 'Mail Processing', 'multipass' ),
						'lodgify' => __( 'Lodgify', 'multipass' ),
						'hbook'   => __( 'HBook Plugin', 'multipass' ),
					),
				),
			),
		);

		return $meta_boxes;
	}

	static function managed_list_filter( $html = '' ) {
		$title = __( 'External', 'multipass' );
		if ( empty( $list ) ) {
			$list = __( 'Empty list', 'multipass' );
		}

		global $post;
		$data = get_post_meta( $post->ID, 'modules-data', true );

		if ( empty( $data ) ) {
			$data = array();
		}
		// if(is_array($data)) {
			$data['columns'] = array(
				'id'          => __( 'ID', 'multipass' ),
				'created'     => __( 'Created', 'multipass' ),
				'source'      => __( 'Source', 'multipass' ),
				'description' => __( 'Description', 'multipass' ),
				'from'        => __( 'From', 'multipass' ),
				'to'          => __( 'To', 'multipass' ),
				'subtotal'    => __( 'Subtotal', 'multipass' ),
				'discount'    => __( 'Discount', 'multipass' ),
				'refunded'    => __( 'Refunded', 'multipass' ),
				'total'       => __( 'Total', 'multipass' ),
				'paid'        => __( 'Paid', 'multipass' ),
				'status'      => __( 'Status', 'multipass' ),
				'actions'     => '',
			);
			$data['format']  = array(
				'created'  => 'date_time',
				'from'     => 'date',
				'to'       => 'date',
				'subtotal' => 'price',
				'discount' => 'price',
				'refunded' => 'price',
				'total'    => 'price',
				'paid'     => 'price',
				'status'   => 'status',
			);

			$list = new Mltp_Table( $data );

			$html .= sprintf(
				'<div class="managed-list managed-list-external">
				<h3>%s</h3>
				%s
				</div>',
				$title,
				$list->render(),
			);
		// }

		return $html;
	}

}

$this->loaders[] = new Mltp_Modules();
