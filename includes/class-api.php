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
class Mltp_API extends Mltp_Loader {

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

	/**
	 * Initialize the collections used to maintain the actions and filters.
	 *
	 * @since    0.1.0
	 */
	public function __construct() {
		$this->actions = array(
			// array(
			// 'hook' => 'rest_api_init',
			// 'callback' => 'register_api_callback_route',
			// ),
		);

		$this->filters = array();
	}

	function register_api_callback_route() {
		// error_log( __METHOD__ );
		// register_rest_route( 'multipass/v1', '/users/market=(?P<market>[a-zA-Z0-9-]+)/lat=(?P<lat>[a-z0-9 .\-]+)/long=(?P<long>[a-z0-9 .\-]+)', array(
		register_rest_route(
			'multipass/v1',
			'/callback',
			array(
				'methods'             => 'POST',
				'callback'            => array( $this, 'handle_api_callback' ),
				'permission_callback' => '__return_true',
			)
		);
	}

	function handle_api_callback( WP_REST_Request $request ) {
		// error_log(__METHOD__ . ' ' . print_r($request, true) );
		$callback_url = $request->get_param( 'callback_url' );
		$parameters   = $request->get_params();
		// Perform actions with the received callback URL, such as saving it to the database or triggering an event.
		return array(
			'message'      => 'Callback URL registered.',
			'callback_url' => $callback_url,
			'parameters'   => $parameters,
		);
	}

}

$this->loaders[] = new Mltp_API();
