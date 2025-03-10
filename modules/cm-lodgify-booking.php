<?php

class Mltp_Lodgify_Booking extends Mltp_Booking {

	function format( $data = array() ) {
		if ( ! empty( $data['booking'] ) ) {
			return $this->format_api_data( $data );
		}

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
		if ( isset( $data['canceled_at'] ) ) {
			$canceled = strtotime( $data['canceled_at'] );
		} elseif ( isset( $data['date_deleted'] ) ) {
			$canceled = strtotime( $data['date_deleted'] );
		} elseif ( 'declined' === $booking_data['status'] ) {
			$canceled = true;
		} else {
			$canceled = null;
		}

		$from   = strtotime( $data['arrival'] );
		$to     = strtotime( $data['departure'] );
		$guests = ( isset( $data['people'] ) ) ? $data['people'] : $data['rooms'][0]['people'];

		$deposit          = null;
		$deposit_due_date = null;
		if ( isset( $data['quote']['scheduled_transactions'] ) ) {
			foreach ( $data['quote']['scheduled_transactions'] as $key => $scheduled ) {
				if ( 'PrePayment' === $scheduled['type'] ) {
					$deposit         += $scheduled['amount'];
					$deposit_due_date = strtotime( $scheduled['due_at'] );
				}
			}
		}

		$subtotals = array_merge(
			array(
				'promotions' => null,
				'stay'       => null,
				'fees'       => null,
				'addons'     => null,
			),
			( isset( $data['subtotals'] ) ) ? $data['subtotals'] : array()
		);
		$subtotal  = $subtotals['stay'] + $subtotals['fees'] + $subtotals['addons'];
		$discount  = ( empty( $subtotals['promotions'] ) ) ? null : -$subtotals['promotions'];

		$language = isset( $data['language'] ) ? isset( $data['language'] ) : $data['guest']['locale'];
		$paid     = isset( $data['total_paid'] ) ? $data['total_paid'] : $data['amount_paid'];

		if ( empty( $subtotal ) ) {
			$subtotal = $data['total_amount'] - $discount;
		}
		if ( ! empty( $data['amount_due'] ) ) {
			$balance = $data['amount_due'];
		} elseif ( ! empty( $data['amount_to_pay'] ) ) {
			$balance = $data['amount_to_pay'];
		} else {
			$balance = $data['total_amount'] - $paid;
		}

		$total         = $data['total_amount'];
		$currency_code = isset( $data['currency']['code'] ) ? $data['currency']['code'] : null;

		if ( isset( $data['guest']['id'] ) && 'AAAAAAAAAAAAAAAAAAAAAA' === $data['guest']['id'] ) {
			// TODO: find closed period comment and use it as client name
			$title    = sprintf( __( 'Closed in %s', 'multipass' ), 'Lodgify' );
			$status         = 'closed-period';
			$source_url     = MultiPass::get_source_url( 'lodgify', $data['id'], null, array( 'type' => $status ) );
			$customer_name  = null;
			$customer_email = null;
			$customer_phone = null;
		} else {
			$customer       = $data['guest'];
			$customer_name  = $customer['name'];
			$customer_email = $customer['email'];
			$customer_phone = $customer['phone'];
			$customer       = array_filter( $customer );
			$source_url     = MultiPass::get_source_url( 'lodgify', $data['id'] );
		}

		$source    = 'lodgify';
		$source_id = $data['id'];
		$origin    = self::sanitize_origin( $data['source'] );
		$external  = false;
		switch ( $origin ) {
			case 'airbnb':
				$origin_details = json_decode( $data['source_text'] );
				$origin_id      = $origin_details->confirmationCode;
				$confirmed      = true;
				$external       = true;
				// $this->sources['airbnb_id'] = $origin_id;
				break;

			case 'bookingcom':
				$origin_details = explode( '|', $data['source_text'] );
				$origin_id      = $origin_details[0];
				$confirmed      = true;
				$external       = true;
				// $this->sources['bookingcom_id'] = $origin_id;
				break;

			// default:
			// $origin     = null;
			// $origin_id  = null;
			// $origin_url = null;
		}

		$title = join(
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

		$data = array(
			'status' 		 => $status,
			'guests' 		 => $guests,
			'from' 			 => $from,
			'to' 			 => $to,
			'dates'            => array(
				'from' => $from,
				'to'   => $to,
			),
			'title' 		 => $title,
			'customer_name'    => $customer_name,
			'customer_email'   => $customer_email,
			'customer_phone'   => $customer_phone,
			'source'           => $source,
			'source_id'        => $source_id,
			'source_url'       => ( ! empty( $source_id ) ) ? MultiPass::get_source_url( $source, $source_id, $source_url ) : null,
			'origin'           => $origin,
			'origin_id'        => ( ! empty( $origin_id ) ) ? $origin_id : null,
			'origin_url'       => ( ! empty( $origin_id ) ) ? MultiPass::get_source_url( $origin, $origin_id, $source_url ) : null,
			'lodgify_id'       => $data['id'],
			// 'lodgify_uuid'        => join( '-', array( $data['id'], $data['user_id'], $data['property_id'] ) ),
			// 'lodgify_edit_url'    => $source_url,
			// 'lodgify_property_id' => $data['property_id'],

			'resource_id'      => $resource_id,
			'resource_name'    => $resource_name,
			'status'           => $status,
			'confirmed'        => $confirmed,
			'external'         => $external,
			'description'      => $this->title,

			'language'         => $language,
			'customer'         => array(
				// TODO: try to get WP user if exists
				// 'user_id' => $customer_id,
				// 'name'  => $data['guest']['name'],
				// 'email' => $data['guest']['email'],
				// 'phone' => $data['guest']['phone'],
			),
			// 'source_details' => array(
			// 'rooms'         => $data['rooms'],
				'created'      => strtotime( $data['created_at'] ),
			'updated'          => strtotime( $data['updated_at'] ),
			'canceled'         => $canceled,
			'is_deleted'       => $data['is_deleted'],
			// 'currency_code' => $data['currency_code'],
			// 'quote'         => $data['quote'],
			// ),
			// 'price'               => array(
			// 'quantity'  => 1,
			// 'unit'      => $subtotal,
			// 'sub_total' => $subtotal,
			// ),

			'attendees'        => $guests,
			// 'beds' => $beds,

			'subtotal'         => $subtotal,
			'discount'         => $discount,
			'total'            => $total,
			'deposit'          => $deposit,
			'deposit_due_date' => $deposit_due_date,
			'paid'             => $paid,
			'balance'          => $balance,
			'type'             => 'booking',
			'notes'            => ( isset( $data['notes'] ) ) ? $data['notes'] : null,
		);

		parent::format( $data );
	}

	function format_api_data( $data = array() ) {
		$booking_data = $data['booking'];

		$resource_id = Mltp_Resource::get_resource_id( 'lodgify', $booking_data['property_id'] );
		if ( ! $resource_id ) {
			MultiPass::debug( 'no resource for property ', $booking_data['property_id'] );
			return false;
		}
		$resource      = new Mltp_Resource( $resource_id );
		$resource_name = $resource->name;
		$status        = self::sanitize_status( $booking_data['status'] );

		if ( ! in_array( $status, array( 'booked', 'option', 'declined', 'open' ) ) ) {
			error_log( 'unmanaged status ' . $status );
			return false;
		}

		$confirmed = ( in_array( $status, array( 'booked' ) ) ) ? true : false;
		if ( isset( $data['canceled_at'] ) ) {
			$canceled = strtotime( $data['canceled_at'] );
		} elseif ( isset( $data['date_deleted'] ) ) {
			$canceled = strtotime( $data['date_deleted'] );
		} elseif ( 'declined' === $booking_data['status'] ) {
			$canceled = true;
		} else {
			$canceled = null;
		}

		$from   = strtotime( $booking_data['date_arrival'] );
		$to     = strtotime( $booking_data['date_departure'] );
		$guests = $booking_data['room_types'][0]['people'];

		$deposit          = null;
		$deposit_due_date = null;
		if ( isset( $data['quote']['scheduled_transactions'] ) ) {
			foreach ( $data['quote']['scheduled_transactions'] as $key => $scheduled ) {
				if ( 'PrePayment' === $scheduled['type'] ) {
					$deposit         += $scheduled['amount'];
					$deposit_due_date = strtotime( $scheduled['due_at'] );
				}
			}
		}

		$amount_gross = $data['current_order']['amount_gross'] ?? null;
		if( is_array( $amount_gross ) ) {
			$subtotals    = array(
				'stay'       => $amount_gross['total_room_rate_amount'],
				'fees'       => $amount_gross['total_fees_amount'],
				'taxes'      => $amount_gross['total_taxes_amount'],
				'promotions' => $amount_gross['total_promotions_amount'],
			);
			$subtotal     = $subtotals['stay'] + $subtotals['fees'] + $subtotals['taxes'];
			$discount     = ( empty( $subtotals['promotions'] ) ) ? null : -$subtotals['promotions'];
			$total   = array_sum( $subtotals );
		} else {
			$subtotal = null;
			$discount = null;
			$total = null;
			$amount_gross = array();
		}

		$language = $booking_data['language'] ?? $data['guest']['locale'] ?? 'en';

		$paid    = array_sum( $data['total_transactions'] );
		$balance = $data['balance_due'];

		$currency_code = $data['current_order']['currency_code'] ?? $booking_data['currency_code'];

		if ( isset( $data['guest']['id'] ) && 'AAAAAAAAAAAAAAAAAAAAAA' === $data['guest']['id'] ) {
			// TODO: find closed period comment and use it as client name
			$this->title    = sprintf( __( 'Closed in %s', 'multipass' ), 'Lodgify' );
			$status         = 'closed-period';
			$source_url     = MultiPass::get_source_url( 'lodgify', $booking_data['id'], null, array( 'type' => $status ) );
			$customer_name  = null;
			$customer_email = null;
			$customer_phone = null;
		} else {
			$customer       = $data['guest'];
			$customer_name  = $customer['name'];
			$customer_email = $customer['email'];
			$customer_phone = $customer['phone_number'];
			$customer       = array_filter( $customer );
			$source_url     = MultiPass::get_source_url( 'lodgify', $booking_data['id'] );
		}

		$source    = 'lodgify';
		$source_id = $booking_data['id'];
		$origin    = self::sanitize_origin( $booking_data['source'] );
		$external  = false;
		switch ( $origin ) {
			case 'airbnb':
				$origin_details = json_decode( $booking_data['source_text'] );
				$origin_id      = $origin_details->confirmationCode;
				$confirmed      = true;
				$external       = true;
				// $this->sources['airbnb_id'] = $origin_id;
				break;

			case 'bookingcom':
				$origin_details = explode( '|', $booking_data['source_text'] );
				$origin_id      = $origin_details[0];
				$confirmed      = true;
				$external       = true;
				// $this->sources['bookingcom_id'] = $origin_id;
				break;

			// default:
			// $origin     = null;
			// $origin_id  = null;
			// $origin_url = null;
		}

		$title = join(
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

		$data = array(
			'status'		   => $status,
			'guests'		   => $guests,
			'from'			   => $from,
			'to'			   => $to,
			'dates'            => array(
				'from' => $from,
				'to'   => $to,
			),
			'title'			   => $title,
			'customer_name'    => $customer_name,
			'customer_email'   => $customer_email,
			'customer_phone'   => $customer_phone,
			'source'           => $source,
			'source_id'        => $source_id,
			'source_url'       => ( ! empty( $source_id ) ) ? MultiPass::get_source_url( $source, $source_id, $source_url ) : null,
			'origin'           => $origin,
			'origin_id'        => ( ! empty( $origin_id ) ) ? $origin_id : null,
			'origin_url'       => ( ! empty( $origin_id ) ) ? MultiPass::get_source_url( $origin, $origin_id, $source_url ) : null,
			'lodgify_id'       => $data['id'],
			// 'lodgify_uuid'        => join( '-', array( $data['id'], $data['user_id'], $data['property_id'] ) ),
			// 'lodgify_edit_url'    => $source_url,
			// 'lodgify_property_id' => $data['property_id'],

			'resource_id'      => $resource_id,
			'resource_name'    => $resource_name,
			'status'           => $status,
			'confirmed'        => $confirmed,
			'external'         => $external,
			'description'      => $this->title,

			'language'         => $language,
			'customer'         => array(
				// TODO: try to get WP user if exists
				// 'user_id' => $customer_id,
				// 'name'  => $data['guest']['name'],
				// 'email' => $data['guest']['email'],
				// 'phone' => $data['guest']['phone'],
			),
			// 'source_details' => array(
			// 'rooms'         => $data['rooms'],
			'created'      => strtotime( $booking_data['date_created'] ),
			'updated'          => time(),
			'canceled'         => $canceled,
			'is_deleted'       => isset( $data['is_deleted'] ) ? $data['is_deleted'] : null,
			// 'currency_code' => $data['currency_code'],
			// 'quote'         => $data['quote'],
			// ),
			// 'price'               => array(
			// 'quantity'  => 1,
			// 'unit'      => $subtotal,
			// 'sub_total' => $subtotal,
			// ),

			// 'attendees'        => $guests,
			// 'beds' => $beds,

			'subtotal'         => $subtotal,
			'discount'         => $discount,
			'total'            => $total,
			'deposit'          => $deposit,
			'deposit_due_date' => $deposit_due_date,
			'paid'             => $paid,
			'balance'          => $balance,
			'type'             => 'booking',
			'notes'            => ( isset( $booking_data['notes'] ) ) ? $booking_data['notes'] : null,
		);

		if ( empty( $attendees ) ) {
			$this->data['guests'] = $guests;
		} else {
			$this->data['guests'] = array_merge( $attendees, array( 'total' => $guests ) );
		}

		parent::format( $data );

		$mltp_detail = new Mltp_Item( $this->data, true );
		if ( $mltp_detail ) {
			$this->id  = $mltp_detail->id;
			$attendees = get_post_meta( $mltp_detail->id, 'attendees', true );
			if ( empty( $attendees ) ) {
				$this->data['guests'] = $guests;
			} else {
				$this->data['guests'] = array_merge( $attendees, array( 'total' => $guests ) );
			}
		}

	}

	static function sanitize_origin( $string ) {
		$p_replace = array(
			'/AirbnbIntegration/' => 'airbnb',
			'/BookingCom/'        => 'bookingcom',
			// '/Manual/'            => 'lodgify',
		);
		$p_keys = array_keys( $p_replace );

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
