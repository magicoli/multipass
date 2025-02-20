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
class Mltp_HBook extends Mltp_Booking {
	private static $hbdb;
	private static $db;

	/**
	 * Initialize the collections used to maintain the actions and filters.
	 *
	 * @since    0.1.0
	 */
	public function __construct() {
		$this->module = 'hbook';
		global $wpdb;
		$this->db = $wpdb;
		$this->db = $wpdb;
		$this->prefix = $this->db->prefix . 'hb_';
		$this->resa_table = $this->prefix . 'resa';

		// register_activation_hook( MULTIPASS_FILE, __CLASS__ . '::activate' );
		// register_deactivation_hook( MULTIPASS_FILE, __CLASS__ . '::deactivate' );
	}
	
	/**
	 * Register the filters and actions with WordPress.
	 *
	 * @since    0.1.0
	 */
	public function init() {
		$this->hbdb = new HbDataBaseActions();

		add_filter( 'mb_settings_pages', array( $this, 'register_settings_pages' ) );
		add_filter( 'rwmb_meta_boxes', array( $this, 'register_settings_fields' ) );
		add_filter( 'rwmb_meta_boxes', array( $this, 'register_fields' ) );
		add_filter( 'multipass_register_terms_mltp_detail-source', array( $this, 'register_sources_filter' ) );
		
		add_action( 'hb_create_reservation', array( $this, 'create_reservation' ) );
		add_action( 'hb_reservation_updated', array( $this, 'reservation_updated' ), 10, 2 );
		add_action( 'hb_parent_reservation_updated', array( $this, 'parent_reservation_updated' ), 10, 2 );
	}

	function get_resa( $id ) {
		global $wpdb;
		$data = $this->db->get_row(
			$this->db->prepare(
				"SELECT * FROM $this->resa_table WHERE id = %d",
				$id
			)
		);
		// error_log( __METHOD__ . ' ' . print_r( $data, true ) );
		$booking = $this->format_booking( $data );
		return $booking;
	}

	// Hook on hb_create_reservation.
	// Example data received:
	// (
	// 	[check_in] => 2025-09-01
	// 	[check_out] => 2025-09-08
	// 	[lang] => fr_FR
	// 	[currency] => EUR
	// 	[origin] => website
	// 	[adults] => 1
	// 	[children] => 0
	// 	[accom_id] => 3539
	// 	[accom_num] => 2
	// 	[accom_price] => 700
	// 	[discount] => {"accom":[],"global":[]}
	// 	[price] => 704.2
	// 	[customer_id] => 32
	// 	[additional_info] => []
	// 	[options] => {"3":{"name":"Transfert a\\u00e9roport 1 \\u00e0 5 personnes","amount":"0.00","amount_children":"0.00","apply_to_type":"per-accom","chosen":"6","choice_name":"Aucun"},"4":{"name":"Transfert a\\u00e9roport 6 personnes ou plus","amount":"0.00","amount_children":"0.00","apply_to_type":"per-person","chosen":"2","choice_name":"Aucun"}}
	// 	[fees] => [{"id":"1","name":"Taxe de s\\u00e9jour ville de Sainte-Rose","amount":"0.60","amount_children":"0.00","apply_to_type":"per-person-per-day","accom_price_per_person_per_night":"0","include_in_price":"1","minimum_amount":"0.00","maximum_amount":"0.00","multiply_per":""}]
	// 	[coupon] => 
	// 	[coupon_value] => 0
	// 	[booking_form_num] => 0
	// 	[deposit] => 211.26
	// 	[payment_type] => 
	// 	[paid] => 0
	// 	[payment_token] => 
	// 	[payment_gateway] => 
	// 	[amount_to_pay] => 0
	// 	[payment_info] => 
	// 	[alphanum_id] => 67PCZNI5
	// 	[invoice_counter] => 145
	// 	[admin_comment] => 
	// 	[status] => new
	// 	[received_on] => 2025-02-13 04:33:42
	// 	[updated_on] => 2025-02-13 04:33:42
	// 	[uid] => D2025-02-13T04:33:42U67ad7626e1504@https://gites-mosaiques.com
	// )
	public function create_reservation( $args = array(), $atts = null ) {
		$data = $this->format_booking( $args );
		// error_log( __METHOD__ . ': ' . print_r( $args, true ) );
	}

	// Hook on hb_reservation_updated.
	// Accepts two parameters: action and resa_id.
	public function reservation_updated( $action = null, $resa_id = null ) {
		$resa = $this->get_resa($resa_id);
		// error_log( 
		// 	__METHOD__ 
		// 	. ' action ' . print_r( $action, true ) 
		// 	. ' resa_id ' . print_r( $resa_id, true )
		// 	. ' resa ' . print_r( $resa, true )
		// );
	}

	// Hook on hb_parent_reservation_updated
	// do_action( 'hb_parent_reservation_updated', 'payment', $resa_id );
	public function parent_reservation_updated( $action = null, $resa_id = null ) {
		// error_log( __METHOD__ . ': action ' . print_r( $action, true ) . ' resa_id ' . print_r( $resa_id, true ) );
	}

	// [Mon Feb 17 13:43:01.406841 2025] [php:notice] [pid 2021488:tid 2021488] [client 2a09:bac2:347e:6e::b:1db:41576] Mltp_HBook::create_reservation: Array
	// (
	// 	[check_in] => 2025-02-22
	// 	[check_out] => 2025-02-25
	// 	[lang] => fr_FR
	// 	[currency] => EUR
	// 	[origin] => website
	// 	[adults] => 1
	// 	[children] => 0
	// 	[accom_id] => 3539
	// 	[accom_num] => 2
	// 	[accom_price] => 450
	// 	[discount] => {"accom":[],"global":[]}
	// 	[price] => 451.8
	// 	[customer_id] => 80
	// 	[additional_info] => []
	// 	[options] => {"3":{"name":"Transfert a\\u00e9roport 1 \\u00e0 5 personnes","amount":"0.00","amount_children":"0.00","apply_to_type":"per-accom","chosen":"6","choice_name":"Aucun"},"4":{"name":"Transfert a\\u00e9roport 6 personnes ou plus","amount":"0.00","amount_children":"0.00","apply_to_type":"per-person","chosen":"2","choice_name":"Aucun"}}
	// 	[fees] => [{"id":"1","name":"Taxe de s\\u00e9jour ville de Sainte-Rose","amount":"0.60","amount_children":"0.00","apply_to_type":"per-person-per-day","accom_price_per_person_per_night":"0","include_in_price":"1","minimum_amount":"0.00","maximum_amount":"0.00","multiply_per":""}]
	// 	[coupon] => 
	// 	[coupon_value] => 0
	// 	[booking_form_num] => 0
	// 	[deposit] => 451.8
	// 	[payment_type] => 
	// 	[paid] => 0
	// 	[payment_token] => 
	// 	[payment_gateway] => 
	// 	[amount_to_pay] => 0
	// 	[payment_info] => 
	// 	[alphanum_id] => RFRA7677
	// 	[invoice_counter] => 150
	// 	[admin_comment] => Ignore
	// 	[status] => new
	// 	[received_on] => 2025-02-17 13:43:01
	// 	[updated_on] => 2025-02-17 13:43:01
	// 	[uid] => D2025-02-17T13:43:01U67b33ce56297f@https://gites-mosaiques.com
	// )
	function format_booking( $hbook_data ) {
		if( ! is_array($hbook_data) ) {
			return false;
		}

		// error_log( __METHOD__ . ' data ' . print_r($hbook_data, true) );
		error_log( __METHOD__ . ' booking_data ' . print_r($hbook_data, true) );
		try {
			$hbook_id = $hbook_data['accom_id'] . ( empty( $hbook_data['accom_num'] ) ? '' : '-' . $hbook_data['accom_num'] );
			$resource_id = Mltp_Resource::get_resource_id( 'hbook', $hbook_id );
			if ( ! $resource_id ) {
				throw new Exception( 'no resource for property ' . $hbook_id );
			}
			$resource      = new Mltp_Resource( $resource_id );
			$resource_name = $resource->name;
		} catch ( Exception $e ) {
			error_log( __METHOD__ . ' ' . $e->getMessage() );
			return false;
		}
		error_log( __METHOD__ . ' resource ' . $resource_name );
		$status        = self::sanitize_status( $hbook_data['status'] );
		error_log( __METHOD__ . ' status ' . $status );

		if ( ! in_array( $status, array( 'new', 'booked', 'option', 'declined', 'open' ) ) ) {
			error_log( 'unmanaged status ' . $status );
			return false;
		}
		
		$hbook_admin_url = admin_url( 'admin.php?page=hb_reservations' );

		$from   = strtotime( $hbook_data['check_in'] );
		$to     = strtotime( $hbook_data['check_out'] );

		// Exemple discount data
		// $hbook_data[discount] => {"accom":[],"global":{"amount_type":"fixed","amount":"100"}}
		// Make sure $discount is formatted as array
		$discount_data = is_array($hbook_data['discount']) ? $hbook_data['discount'] : json_decode($hbook_data['discount'], true);
		error_log( __METHOD__ . ' discount data ' . print_r($discount_data, true) );
		$total    = $hbook_data['price'] ?? null;
		$discount = 0;
		$subtotal = $total;
		$discount_type = $discount_data['global']['amount_type'] ?? null;
		$discount_value = $discount_data['global']['amount'] ?? 0;
		switch ($discount_type) {
			case 'fixed':
				$discount = $discount_value;
				$subtotal = $total + $discount;
				error_log( __METHOD__ . ' fixed discount ' . $discount_value );
				break;
			case 'percent':
				$subtotal = round( $total / ( 1 - $discount_value / 100 ), 2 );
				$discount = $total - $subtotal;
				error_log( __METHOD__ . ' percent discount ' . $discount_value . ' % of ' . $total . ' = ' . $discount );
				break;
			default:
				break;
		}
		$deposit  = $hbook_data['deposit'] ?? null;
		$paid     = $hbook_data['paid'] ?? null;
		$balance  = $total - $paid;

		$confirmed = ( $paid >= $deposit ) ? true : false;
		// if ( isset( $hbook_data['canceled_at'] ) ) {
		// 	$canceled = strtotime( $hbook_data['canceled_at'] );
		// } elseif ( isset( $hbook_data['date_deleted'] ) ) {
		// 	$canceled = strtotime( $hbook_data['date_deleted'] );
		// } elseif ( 'declined' === $hbook_data['status'] ) {
		// 	$canceled = true;
		// } else {
			$canceled = null;
		// }

		$data = array(
			// 'id'      => null,
			// 'title'   => null,
			'status'  => $status,
			'guests'  => array(
				'adults' => $hbook_data['adults'] ?? null,
				'children' => $hbook_data['children'] ?? null,
			),
			'from'    => $from,
			'to'      => $to,
			'client' => array(
				'name' => 'hbook id ' . $hbook_data['customer_id'],
				// 'name'  => $data['customer_name'] ?? null,
				// 'email' => $data['customer_email'] ?? null,
				// 'phone' => $data['customer_phone'] ?? null,
			),
			'source'  => 'hbook', // channel
			'source_id' => $hbook_data['alphanum_id'],
			'source_url' => $hbook_admin_url,
			// 'ota' => empty( $data['origin'] ) ? array() : array(
			// 	'slug' => $data['origin'] ?? null,
			// 	'id' => $data['origin_id'] ?? null,
			// 	'url' => $data['origin_url'] ?? null,
			// ),
			'origin'  => 'hbook', // OTA
			'origin_id' => $hbook_data['alphanum_id'],
			'origin_url' => $hbook_admin_url,
			'resource_id' => $resource_id,
			'resource_name' => $resource_name,
			'confirmed' => $confirmed,
			'external' => false,
			'description' => null,
			'language' => null,
			'created' => strtotime( $hbook_data['received_on'] ),
			'updated' => time(),
			'canceled' => $canceled,
			'is_deleted' => $canceled,
			'subtotal' => $subtotal,
			'discount' => $discount,
			'total' => $total,
			'deposit' => $deposit,
			'deposit_due_date' => null,
			'paid' => $paid,
			'balance' => $balance,
			'type' => 'booking',
			'notes' => null,
		);
		error_log( __METHOD__ . ' formatted data ' . print_r($data, true));
		// $currency_code = $data['current_order']['currency_code'];

		// if ( isset( $data['guest']['id'] ) && 'AAAAAAAAAAAAAAAAAAAAAA' === $data['guest']['id'] ) {
		// 	// TODO: find closed period comment and use it as client name
		// 	$this->title    = sprintf( __( 'Closed in %s', 'multipass' ), 'Lodgify' );
		// 	$status         = 'closed-period';
		// 	$source_url     = MultiPass::get_source_url( 'lodgify', $data['id'], null, array( 'type' => $status ) );
		// 	$customer_name  = null;
		// 	$customer_email = null;
		// 	$customer_phone = null;
		// } else {
		// 	$customer       = $data['guest'];
		// 	$customer_name  = $customer['name'];
		// 	$customer_email = $customer['email'];
		// 	$customer_phone = $customer['phone_number'];
		// 	$customer       = array_filter( $customer );
		// 	$source_url     = MultiPass::get_source_url( 'lodgify', $data['id'] );
		// }

		// $this->title = join(
		// 	' - ',
		// 	array(
		// 		$customer_name,
		// 		join(
		// 			' ',
		// 			array_filter(
		// 				array(
		// 					$resource_name,
		// 					( ! empty( $guests ) ) ? $guests . 'p' : null,
		// 					MultiPass::format_date_range( array( $from, $to ) ),
		// 				)
		// 			)
		// 		),
		// 	)
		// );

		parent::format( $data );
	}

	function register_settings_pages( $settings_pages ) {

		$settings_pages[] = array(
			'menu_title' => __( 'HBook', 'multipass' ),
			'id'         => 'multipass-hbook',
			'position'   => 25,
			'parent'     => 'multipass',
			'capability' => 'mltp_administrator',
			'style'      => 'no-boxes',
			'icon_url'   => 'dashicons-admin-generic',
			// 'columns' => 1,
		);

		// $settings_pages['multipass-settings']['tabs']['hbook'] = 'HBook';
		// error_log(__CLASS__ . ' tabs ' . print_r($settings_pages['multipass-settings']['tabs'], true));

		return $settings_pages;
	}

	function register_settings_fields( $meta_boxes ) {
		$prefix = 'hbook_';

		$meta_boxes[] = array(
			'title'          => __( 'HBook Settings', 'multipass' ),
			'id'             => 'hbook-settings',
			'settings_pages' => 'multipass-hbook',
			// 'tab'            => 'hbook',
			'fields'         => array(
				array(
					'name'              => __( 'Synchronize now', 'multipass' ),
					'id'                => $prefix . 'sync_bookings',
					'type'              => 'switch',
					'disabled'		  => true,
					'desc' => '<p class="error">' . __('This feature is temporarily disabled, until I find out why the portion of code that should sync bookings has vanished.', 'multipass') . '</p>' 
					. __( 'Sync HBook bookings with prestations, create prestation if none exist. Only useful after plugin activation or if out of sync.', 'multipass' ),
					'style'             => 'rounded',
					'sanitize_callback' => 'Mltp_HBook::sync_bookings',
					'save_field'        => false,
				),
			),
		);

		return $meta_boxes;
	}

	function register_fields( $meta_boxes ) {
		$prefix = 'hbook_';
		// $hbook  = new Mltp_HBook();

		$meta_boxes['resources']['fields'][] = array(
			'name'          => __( 'HBook Accommodations', 'multipass' ),
			'id'            => 'resource_hbook_id',
			'type'          => 'select_advanced',
			'options'       => $this->get_property_options(),
			'placeholder'   => __( 'Select an accommodation', 'multipass' ),
			'admin_columns' => array(
				'position'   => 'before date',
				'sort'       => true,
				'searchable' => true,
			),
			'columns'       => 3,
		);

		return $meta_boxes;
	}

	static function register_sources_filter( $sources ) {
		$sources['hbook'] = 'HBook';
		return $sources;
	}

	function get_properties() {
		$transient_key = sanitize_title( __CLASS__ . '-' . __FUNCTION__ );
		$properties    = get_transient( $transient_key );
		if ( $properties ) {
			return $properties;
		}

		$properties = wp_cache_get( $transient_key );
		if ( $properties ) {
			return $properties;
		}

		global $wpdb;

		$posts      = get_posts(
			array(
				'numberposts' => -1,
				'post_type'   => 'hb_accommodation',
				'post_status' => 'publish',
				'orderby'     => 'name',
			)
		);
		$properties = array();
		foreach ( $posts as $key => $post ) {
			if ( preg_match( '/"translated/', $post->post_content ) ) {
				continue;
			}
			// error_log("property $post->ID $post->post_title");

			$table   = $wpdb->prefix . 'hb_accom_num_name';
			$sql     = "SELECT * FROM $table WHERE accom_id = $post->ID AND num_name != '1' AND num_name != ''";
			$results = $wpdb->get_results( $sql );
			if ( $results ) {
				// error_log("$sql result " . print_r($results, true));
				foreach ( $results as $result ) {
					$key                = $result->accom_id . '-' . $result->accom_num;
					$properties[ $key ] = $result;
				}
			}

			// $properties[$post->ID] = $post;
		}
		// error_log('fetching properties ' . print_r($properties, true));

		wp_cache_set( $transient_key, $properties );
		// set_transient($transient_key, $properties, 3600);
		return $properties;
	}

	function get_property_options() {
		$options    = array();
		$properties = $this->get_properties();
		if ( $properties ) {
			foreach ( $properties as $id => $property ) {
				$options[ $id ] = $property->num_name;
			}
		}
		return $options;
	}

	// static function sanitize_status( $string ) {
	// 	$p_replace = array(
	// 		// '/Tentative/' => 'option', // Specific to Lodgify
	// 	);
	// 	$p_keys    = array_keys( $p_replace );

	// 	return sanitize_title( preg_replace( $p_keys, $p_replace, $string ) );
	// }
}

$this->modules[] = new Mltp_HBook();
