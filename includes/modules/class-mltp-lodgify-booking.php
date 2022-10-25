<?php

class Mltp_Lodgify_Booking {

	public $id;
	public $title;
	public $status;
	public $guests;
	public $from;
	public $to;

	protected $data = array();

	function __construct( $data = array() ) {
		if ( ! $this->format( $data ) ) {
			return false;
		}

		MultiPass::debug( $resource_name );
	}

	function format( $data = array() ) {
		// MultiPass::debug( $data );
		$resource_id = Mltp_Resource::get_resource_id( 'lodgify', $data['property_id'] );
		if ( ! $resource_id ) {
			return false;
		}
		$resource      = new Mltp_Resource( $resource_id );
		$resource_name = $resource->name;
		$status        = self::sanitize_status( $data['status'] );

		if ( ! in_array( $status, array( 'booked', 'option' ) ) ) {
			return false;
		}

		$confirmed = ( in_array( $status, array( 'booked' ) ) ) ? true : false;
		$from      = strtotime( $data['arrival'] );
		$to        = strtotime( $data['departure'] );
		$guests    = $data['people'];

		$subtotals = array_merge(
			array(
				'promotions' => null,
				'stay'       => null,
				'fees'       => null,
				'addons'     => null,
			),
			( is_array( $data['subtotals'] ) ) ? $data['subtotals'] : array()
		);
		$subtotal  = $subtotals['stay'] + $subtotals['fees'] + $subtotals['addons'];
		$discount  = ( empty( $subtotals['promotions'] ) ) ? null : $subtotals['promotions'];

		if ( empty( $subtotal ) ) {
			$subtotal = $data['total_amount'] - $discount;
		}
		if ( ! empty( $data['amount_due'] ) ) {
			$balance = $data['amount_due'];
		} elseif ( ! empty( $data['amount_to_pay'] ) ) {
			$balance = $data['amount_to_pay'];
		} else {
			$balance = $data['total_amount'] - $data['total_paid'];
		}

		$total         = $data['total_amount'];
		$paid          = $data['total_paid'];
		$currency_code = $data['currency']['code'];

		if ( isset( $data['guest']['id'] ) && 'AAAAAAAAAAAAAAAAAAAAAA' === $data['guest']['id'] ) {
			// TODO: find closed period comment and use it as client name
			$this->title = sprintf( __( 'Closed in %s', 'multipass' ), 'Lodgify' );
			$status      = 'closed-period';
			$source_url  = MultiPass::get_source_url( 'lodgify', $data['id'], null, array( 'type' => $status ) );
		} else {
			$customer      = array_filter( $data['guest'] );
			$customer_name = $customer['name'];
			$language      = $customer['locale'];
			$source_url    = MultiPass::get_source_url( 'lodgify', $data['id'] );
		}

		$source    = 'lodgify';
		$source_id = $data['id'];
		$origin    = self::sanitize_origin( $data['source'] );
		switch ( $origin ) {
			case 'lodgify':
				$origin    = null;
				$origin_id = null;
				break;

			case 'airbnb':
				$origin_details = json_decode( $data['source_text'] );
				$origin_id      = $origin_details->confirmationCode;
				// $this->sources['airbnb_id'] = $origin_id;
				break;

			case 'bookingcom':
				$origin_details = explode( '|', $data['source_text'] );
				$origin_id      = $origin_details[0];
				// $this->sources['bookingcom_id'] = $origin_id;
				break;

			// default:
			// $origin_url = $source_url;
		}

		$this->title = join(
			' - ',
			array(
				$customer_name,
				join(
					' ',
					array_filter(
						array(
							$resource_name,
							( ! empty( $guests ) ) ? $guests . 'p' : null,
							MultiPass::format_date_range( array( $from, $to ) ),
						)
					)
				),
			)
		);

		$this->status = $status;
		$this->guests = $guests;
		$this->from   = $from;
		$this->to     = $to;

		$this->data = array(
			'customer_name'  => $customer_name,
			'customer_email' => $customer_email,
			'customer_phone' => $customer_phone,
			'from'           => $from,
			'to'             => $to,
			// 'dates'               => array('from'=>$from,'to'=>$to),
			'source'         => $source,
			'source_id'      => $source_id,
			'source_url'     => ( ! empty( $source_id ) ) ? MultiPass::get_source_url( $source, $source_id, $source_url ) : null,
			'origin'         => $origin,
			'origin_id'      => $origin_id,
			'origin_url'     => ( ! empty( $origin_id ) ) ? MultiPass::get_source_url( $origin, $origin_id, $source_url ) : null,
			'lodgify_id'     => $data['id'],
			// 'lodgify_uuid'        => join( '-', array( $data['id'], $data['user_id'], $data['property_id'] ) ),
			// 'lodgify_edit_url'    => $source_url,
			// 'lodgify_property_id' => $data['property_id'],

			'resource_id'    => $resource_id,
			'resource_name'  => $resource_name,
			'status'         => $status,
			'confirmed'      => $confirmed,
			'confirmed'      => $confirmed,
			'description'    => $this->title,

			'customer'       => array(
				'language' => $data['language'],
				// TODO: try to get WP user if exists
				// 'user_id' => $customer_id,
				// 'name'  => $data['guest']['name'],
				// 'email' => $data['guest']['email'],
				// 'phone' => $data['guest']['phone'],
			),
			'source_details' => array(
				'rooms'         => $data['rooms'],
				'created'       => strtotime( $data['created_at'] ),
				'updated'       => strtotime( $data['updated_at'] ),
				'canceled'      => strtotime( $data['canceled_at'] ),
				'is_deleted'    => $data['is_deleted'],
				'currency_code' => $data['currency_code'],
				'quote'         => $data['quote'],
			),
			// 'price'               => array(
			// 'quantity'  => 1,
			// 'unit'      => $subtotal,
			// 'sub_total' => $subtotal,
			// ),

			'attendees'      => $data['rooms'][0]['people'],
			// 'beds' => $beds,

			'subtotal'       => $subtotal,
			'discount'       => $discout,
			'total'          => $total,
			'deposit'        => null, // TODO
			'paid'           => $paid,
			'balance'        => $balance,
			'type'           => 'booking',
			'notes'          => $data['notes'],
		);

	}

	static function sanitize_origin( $string ) {
		$p_replace = array(
			'/AirbnbIntegration/' => 'airbnb',
			'/BookingCom/'        => 'bookingcom',
			'/Manual/'            => 'lodgify',
		);
		$p_keys    = array_keys( $p_replace );

		return sanitize_title( preg_replace( $p_keys, $p_replace, $string ) );
	}

	static function sanitize_status( $string ) {
		$p_replace = array(
			'/Tentative/' => 'option',
		);
		$p_keys    = array_keys( $p_replace );

		return sanitize_title( preg_replace( $p_keys, $p_replace, $string ) );
	}

}
