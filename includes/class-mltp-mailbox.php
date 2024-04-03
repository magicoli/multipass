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
class Mltp_Mailbox {

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
		// error_log(__FUNCTION__);
		//
	}

	/**
	 * Register the filters and actions with WordPress.
	 *
	 * @since    0.1.0
	 */
	public function init() {

		$this->actions = array(
			array(
				'hook'     => 'init',
				'callback' => 'self::background_process',
			),
		);

		$this->filters = array(
			array(
				'hook'     => 'mb_settings_pages',
				'callback' => 'register_settings_pages',
			),
			array(
				'hook'     => 'rwmb_meta_boxes',
				'callback' => 'register_settings_fields',
			),
		);

		$defaults = array(
			'component'     => __CLASS__,
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

	static function register_settings_pages( $settings_pages ) {
		$settings_pages['multipass-settings']['tabs']['imap'] = 'IMAP';

		return $settings_pages;
	}

	static function register_settings_fields( $meta_boxes ) {
		$prefix = 'imap_';

		$meta_boxes[] = array(
			'title'          => __( 'IMAP Settings', 'multipass' ),
			'id'             => 'multipass-mail-settings',
			'settings_pages' => array( 'multipass-settings' ),
			'tab'            => 'imap',
			'fields'         => array(
				array(
					'name'        => __( 'IMAP Server', 'multipass' ),
					'id'          => $prefix . 'server',
					'type'        => 'text',
					'placeholder' => __( 'mail.example.org', 'multipass' ),
					'size'        => 40,
					'required'    => false,
				),
				array(
					'name'     => __( 'Port', 'multipass' ),
					'id'       => $prefix . 'port',
					'type'     => 'button_group',
					'options'  => array(
						143 => '143',
						993 => '993',
					),
					'std'      => 993,
					'required' => false,
				),
				array(
					'name'     => __( 'Encryption', 'multipass' ),
					'id'       => $prefix . 'encryption',
					'type'     => 'button_group',
					'options'  => array(
						'TLS/SSL' => __( 'TLS/SSL', 'multipass' ),
					),
					'std'      => 'TLS/SSL',
					'required' => false,
				),
				array(
					'name'     => __( 'Username', 'multipass' ),
					'id'       => $prefix . 'username',
					'type'     => 'text',
					'size'     => 40,
					'required' => false,
				),
				array(
					'name'     => __( 'Password', 'multipass' ),
					'id'       => $prefix . 'password',
					'type'     => 'text',
					'size'     => 40,
					'required' => false,
				),
				array(
					'name' => __( 'Save Attachments', 'multipass' ),
					'id'   => $prefix . 'attachments',
					'type' => 'switch',
				),
			),
		);

		return $meta_boxes;
	}

	/**
	 * Fetch mail from IMAP server
	 *
	 * TODO: make this as a background task. ASAP. I mean it!
	 *
	 * @return [type] [description]
	 */
	static function fetch_mails() {
		error_log( __CLASS__ . ' ' . __FUNCTION__ . '()' );
		// $transient_key = sanitize_title(__CLASS__ . ' ' . __FUNCTION__);
		// if(get_transient($transient_key)) return;
		// set_transient($transient_key, 'processing', get_option('imap_interval', 300));

		// $server = MultiPass::get_option(__CLASS__ . '::)
		$server   = MultiPass::get_option( 'imap_server' );
		$username = MultiPass::get_option( 'imap_username' );
		$port     = MultiPass::get_option( 'imap_port' );
		$enc      = 'ssl'; // MultiPass::get_option('imap_encryption');
		$protocol = 'imap';
		$password = MultiPass::get_option( 'imap_password' );
		$folder   = ''; // INBOX

		// TODO: better sanitization, as PhpImap\Mailbox is not forgiving
		if ( empty( $server ) ) {
			return;
		}
		if ( empty( $username ) ) {
			return;
		}
		if ( empty( $password ) ) {
			return;
		}

		$mailbox = new PhpImap\Mailbox(
			"{{$server}:$port/$protocol/$enc}$folder", // IMAP server and mailbox folder
			$username, // Username for the before configured mailbox
			$password, // Password for the before configured username
			null, // Directory, where attachments will be saved (optional)
			'UTF-8', // Server encoding (optional)
			true, // Trim leading/ending whitespaces of IMAP path (optional)
			false // Attachment filename mode (optional; false = random filename; true = original filename)
		);

		// set some connection arguments (if appropriate)
		$mailbox->setConnectionArgs(
			CL_EXPUNGE // expunge deleted mails upon mailbox close
			// | OP_SECURE // don't do non-secure authentication
		);

		try {
			// Get all emails (messages)
			// PHP.net imap_search criteria: http://php.net/manual/en/function.imap-search.php

			// After activation, we should at least once read them all
			// $mail_ids = $mailbox->searchMailbox('ALL');

			// On a regular basis, we only check unseen mails
			$mail_ids = $mailbox->searchMailbox( 'UNSEEN' );

			// $mail_ids = $mailbox->searchMailbox('SUBJECT "part of the subject"');
			//
		} catch ( PhpImap\Exceptions\ConnectionException $ex ) {
			error_log( 'IMAP connection failed: ' . $ex->getMessage() );
			return;
		} catch ( PhpImap\Exceptions\Exception $ex ) {
			error_log( 'An error occured: ' . $ex->getMessage() );
			return;
		} catch ( Exception $ex ) {
			error_log( 'An error occured, not cached by PhpImap: ' . $ex->getMessage() );
			return;
		}

		$message = sprintf(
			'Mailbox connected (%d mails)',
			count( $mail_ids ),
		) . "\n";
		// If $mail_ids is empty, no emails could be found
		if ( $mail_ids ) {
			// Get the first message
			// If '__DIR__' was defined in the first line, it will automatically
			// save all attachments to the specified directory
			foreach ( $mail_ids as $mail_id ) {
				$mail = $mailbox->getMail( $mail_id );

				if ( ! empty( $email->autoSubmitted ) ) {
					// Mark email as "read" / "seen"
					$mailbox->markMailAsRead( $mail_id );
					echo "+------ IGNORING: Auto-Reply ------+\n";
						continue;
				}

				if ( ! empty( $email_content->precedence ) ) {
					// Mark email as "read" / "seen"
					$mailbox->markMailAsRead( $mail_id );
					echo "+------ IGNORING: Non-Delivery Report/Receipt ------+\n";
						continue;
				}

				// Show, if $mail has one or more attachments
				// $message =  "\nMail has attachments? ";
				// if($mail->hasAttachments()) {
				// $message .= "Yes\n";
				// } else {
				// $message .= "No\n";
				// }
				//
				// // Print all information of $mail
				// $message .= print_r($mail->headers, true);
				$message .= $mail_id . ' ' . $mail->headers->date . ' ' . $mail->headers->fromaddress . ' ' . $mail->headers->subject . "\n";
				//
				// // Print all attachements of $mail
				// $message .= "\n\nAttachments:\n";
				// $message .= print_r($mail->getAttachments(), true);
				//
			}
			error_log( $message );
		}

	}

	function background_process() {
		$this->background_queue = new Mltp_Mailbox_Process();

		$action = __CLASS__ . '::fetch_mails';
		if ( get_transient( 'Mltp_Mailbox_wait' ) ) {
			return;
		}
		set_transient( 'Mltp_Mailbox_wait', true, 30 );

		if ( MultiPass::get_option( 'email_processing', false ) ) {
			$this->background_queue->push_to_queue( __CLASS__ . '::fetch_mails' );
		}

		$this->background_queue->save()->dispatch();

		// One-off task:
		//
		// $this->background_request = new Mltp_Mailbox_Request();
		// $this->background_request->data( array( 'value1' => $value1, 'value2' => $value2 ) );
		// $this->background_request->dispatch();
	}

}

class Mltp_Mailbox_Request extends WP_Async_Request {

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
		// Actions to perform
	}

}

class Mltp_Mailbox_Process extends WP_Background_Process {

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
		set_transient( 'Mltp_Mailbox_wait', true, 0 );

		// error_log( __CLASS__ . ' ' . __FUNCTION__ . "($item)" );
		call_user_func( $item );

		set_transient( 'Mltp_Mailbox_wait', true, 30 );

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

		error_log( __CLASS__ . ' ' . __FUNCTION__ . '() ' . print_r( $this, true ) );
		// Show notice to user or perform some other arbitrary task...
	}

}

$this->modules[] = new Mltp_Mailbox();
