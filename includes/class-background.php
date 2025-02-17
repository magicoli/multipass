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
class Mltp_Background extends Mltp_Loader {

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
			array(
				'hook'     => 'init',
				'callback' => 'background_process',
			),
		);
		$this->filters = array();
	}

	function background_request( $data = array() ) {
		// Instantiate your request:
		$this->example_request = new WP_Example_Request();

		// Add data to the request if required:
		$this->example_request->data( $data );

		// Fire off the request:
		$this->example_request->dispatch();
	}

	function background_queue( $action ) {
		$this->background_process = new Mltp_Background_Process();

	}

	static function test_background_task() {
		$key = __CLASS__ . '::' . __METHOD__;
	}

	function background_process() {
		$this->background_queue = new Mltp_Background_Process();
		$key                    = __CLASS__ . '::' . __METHOD__;

		if ( get_transient( 'Mltp_Background_wait' ) ) {
			return;
		}
		set_transient( 'Mltp_Background_wait', true, 30 );

		// if ( MultiPass::get_option( 'email_processing', false ) ) {
		// $this->background_queue->push_to_queue( __CLASS__ . '::fetch_mails' );
		// }

		$this->background_queue->save()->dispatch();

		// One-off task:
		//
		// $this->background_request = new Mltp_Background_Request();
		// $this->background_request->data( array( 'value1' => $value1, 'value2' => $value2 ) );
		// $this->background_request->dispatch();
	}

}

class Mltp_Async_Request extends WP_Async_Request {

	/**
	 * @var string
	 */
	protected $action = 'background_request';

	/**
	 * Handle
	 *
	 * Override this method to perform any actions required
	 * during the async request.
	 */
	protected function handle() {
		MultiPass::debug( __CLASS__, __METHOD__, $this );

		// Actions to perform
	}

}

class Mltp_Background_Process extends WP_Background_Process {

	/**
	 * @var string
	 */
	protected $action = 'background_process';

	/**
	 * Task
	 *
	 * Override this method to perform any actions required on each
	 * queue item. Return the modified item for further processing
	 * in the next pass through. Or, return false to remove the
	 * item from the queue.
	 *
	 * @param mixed $item Queue item to iterate over
	 *
	 * @return mixed
	 */
	protected function task( $item ) {
		MultiPass::debug( __CLASS__, __METHOD__, $this, $item );

		// Actions to perform

		return false; // Don't change this, false prevents running it forever
	}

	/**
	 * Complete
	 *
	 * Override if applicable, but ensure that the below actions are
	 * performed, or, call parent::complete().
	 */
	protected function complete() {
		parent::complete();

		// error_log( __CLASS__ . ' ' . __FUNCTION__ . '() ' . print_r( $this, true ) );
		// Show notice to user or perform some other arbitrary task...
	}

}

$this->modules[] = new Mltp_Background();
