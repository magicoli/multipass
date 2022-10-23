<?php

class Mltp_Lodgify_Booking {

  public $id;
  public $title;
  public $status;
  public $resource_id = false;
  public $resource_name;
  public $guests;
  public $from;
  public $to;

  function __construct( $data = array() ) {
    if( ! $this->format( $data ) ) return false;

    MultiPass::debug($resource_name);
  }

  function format( $data = array() ) {
    MultiPass::debug($data);
    $resource_id = Mltp_Resource::get_resource_id( 'lodgify', $data['property_id'] );
    if ( ! $resource_id ) {
      // $resource_id = 'not found';
      // $resource_name = 'not found';
      return false;
    }
    $resource = new Mltp_Resource( $resource_id );
    $resource_name     = $resource->name;
    $this->status = $data['status'];

    if ( ! in_array( $this->status, array( 'Booked', 'Tentative' ) ) ) {
      // TODO: ensure already imported booking status is set accordingly
      return false;
    }

    $confirmed = ( in_array( $this->status, array( 'Booked' ) ) ) ? true : false;
    $this->from        = strtotime( $data['arrival'] );
    $this->to          = strtotime( $data['departure'] );
    $this->guests = $data['people'];
    $this->title = sprintf(
      '%s (%sp, %s)',
      $resource_name,
      $this->guests,
      MultiPass::format_date_range( array( $this->from, $this->to ) ),
    );

    $subtotals = array_merge(
      array(
        'promotions' => null,
        'stay'       => null,
        'fees'       => null,
        'addons'     => null,
      ),
      (is_array($data['subtotals'])) ? $data['subtotals'] : array()
    );
    $subtotal    = $subtotals['stay'] + $subtotals['fees'] + $subtotals['addons'];
    $discount    = ( empty( $subtotals['promotions'] ) ) ? null : $subtotals['promotions'];

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

    $total = $data['total_amount'];
    $paid = $data['total_paid'];
    $currency_code = $data['currency']['code'];

    if ( isset($data['guest']['id']) && 'AAAAAAAAAAAAAAAAAAAAAA' === $data['guest']['id'] ) {
      // TODO: find closed period comment and use it as client name
      $this->title = sprintf( __( 'Closed in %s', 'multipass' ), 'Lodgify' );
      $this->status = 'closed-period';
      $source_url = MultiPass::get_source_url( 'lodgify', $data['id'], null, array( 'type' => $status ) );
    } else {
      $customer = array_filter($data['guest']);
      $customer_name = $customer['name'];
      $this->language = $customer['locale'];
      $source_url = MultiPass::get_source_url( 'lodgify', $data['id'] );
    }
    $this->origin    = self::sanitize_origin( $data['source'] );
    switch ( $this->origin ) {
      case 'airbnb':
        $origin_details       = json_decode( $data['source_text'] );
        $this->origin_id            = $origin_details->confirmationCode;
        // $this->sources['airbnb_id'] = $origin_id;
        break;

      case 'bookingcom':
        $origin_details             = explode( '|', $data['source_text'] );
        $this->origin_id                  = $origin_details[0];
        // $this->sources['bookingcom_id'] = $origin_id;
        break;

      // default:
      // $origin_url = $source_url;
    }

    $this->resource_id = $resource_id;
    $this->subtotal = $subtotal;
    $this->total = $total;
    $this->paid = $currency_code;
    $this->balance = $balance;
    $this->currency_code = $balance;
    $this->customer_name = $customer_name;
    $this->data = array(
      'resource_name' => $resource_name,
      'customer' => $customer,
      'origin_url' => MultiPass::get_source_url( $this->origin, $this->origin_id, $source_url ),
    );

    MultiPass::debug($data);
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

}
