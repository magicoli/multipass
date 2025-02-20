<?php

class Mltp_Booking {

	public $id;
	public $title;
	public $status;
	public $guests;
	public $from;
	public $to;

	public function __construct( $data = array() ) {
		if( ! empty( $data ) ) {
			// Polymorphism: Calls the child's format() if available.
			$this->format( $data );
		}
	}

	/**
	 * Register filters and actions
	 */
	public function init() {
	}

	public function format( $data ) {
		$data = wp_parse_args( $data, array(
			'id'      => null,
			'title'   => null,
			'status'  => null,
			'guests'  => null,
			'from'    => null,
			'to'      => null,
			'client' => array(
				'name'  => $data['customer_name'] ?? null,
				'email' => $data['customer_email'] ?? null,
				'phone' => $data['customer_phone'] ?? null,
			),
			'source'  => null, // channel
			'source_id' => null, // channel booking id
			'source_url' => null, // channel booking url
			// 'ota' => empty( $data['origin'] ) ? array() : array(
			// 	'slug' => $data['origin'] ?? null,
			// 	'id' => $data['origin_id'] ?? null,
			// 	'url' => $data['origin_url'] ?? null,
			// ),
			'origin'  => null, // OTA
			'origin_id' => null,
			'origin_url' => null,
			'resource_id' => null,
			'resource_name' => null,
			'confirmed' => null,
			'external' => null,
			'description' => null,
			'language' => null,
			'created' => null,
			'updated' => null,
			'canceled' => null,
			'is_deleted' => null,
			'subtotal' => null,
			'discount' => null,
			'total' => null,
			'deposit' => null,
			'deposit_due_date' => null,
			'paid' => null,
			'balance' => null,
			'type' => 'booking',
			'notes' => null,
		) );
		$this->id = $data['id'];
		$this->title = $data['title'];
		$this->status = $data['status'];
		$this->guests = $data['guests'];
		$this->from = $data['from'];
		$this->to = $data['to'];
		$this->data = $data;

		$this->save();
	}

	static function sanitize_origin( $string ) {
		// Specific to OTA or Channel manager
		// $p_replace = array(
		// 	'/AirbnbIntegration/' => 'airbnb',
		// 	'/BookingCom/'        => 'bookingcom',
		// 	// '/Manual/'            => 'lodgify',
		// );
		// $p_keys = array_keys( $p_replace );

		return sanitize_title( preg_replace( $p_keys, $p_replace, $string ) );
	}

	static function sanitize_status( $string ) {
		$p_replace = array(
			// '/Tentative/' => 'option', // Specific to Lodgify
		);
		$p_keys    = array_keys( $p_replace );

		return sanitize_title( preg_replace( $p_keys, $p_replace, $string ) );
	}

	// Is this really used?
	function save() {
		if ( is_array( $this->data ) ) {
			$mltp_detail = new Mltp_Item( $this->data, true );
			if ( $mltp_detail ) {
				$this->id = $mltp_detail->id;
				// $this->mltp_detail = $mltp_detail;
				return $mltp_detail;
			}
		}

		// MultiPass::debug( 'no data', $this );
		return false;
	}

}

$this->loaders[] = new Mltp_Booking();
