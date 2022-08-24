<?php

/**
 * [Prestations_Payment_Product description]
 */
class Prestations_Payment_Product {

  /*
  * Bootstraps the class and hooks required actions & filters.
  */
  public static function run() {
		// Add Payments Only option to product edit page
    add_filter( 'product_type_options', __CLASS__ . '::add_product_prpay_options');
    add_action( 'save_post_product', __CLASS__ . '::save_product_prpay_options', 10, 3);

		// Add prestation id field to product page
    add_action( 'woocommerce_before_add_to_cart_button', __CLASS__ . '::add_to_cart_fields');

		// Update product name in cart
    add_filter( 'woocommerce_add_to_cart_validation', __CLASS__ . '::add_to_cart_validation', 10, 3 );
    add_filter( 'woocommerce_add_cart_item_data', __CLASS__ . '::add_cart_item_data', 10, 4 );
    add_filter( 'woocommerce_cart_item_name', __CLASS__ . '::cart_item_name', 1, 3 );
		add_filter( 'wc_add_to_cart_message', __CLASS__ . '::add_to_cart_message', 10, 2 );

		add_action( 'woocommerce_before_calculate_totals', __CLASS__ . '::before_calculate_totals', 10, 1 );
		add_filter( 'woocommerce_get_price_html', __CLASS__ . '::get_price_html', 10, 2 );

		add_action( 'woocommerce_checkout_create_order_line_item', __CLASS__ . '::add_custom_data_to_order', 10, 4 );

		// Set pay button text
		// add_filter( 'woocommerce_product_add_to_cart_text', __CLASS__ . '::add_to_card_button', 10, 2);
		// add_filter( 'woocommerce_product_single_add_to_cart_text', __CLASS__ . '::single_add_to_card_button', 10, 2);

		// add_action( 'plugins_loaded', __CLASS__ . '::load_plugin_textdomain' );
  }

  static function add_to_card_button( $text, $product ) {
    if($product->get_meta( '_prpay' ) == 'yes') $text = __('Pay prestation', 'prestations');
  	return $text;
  }

  static function single_add_to_card_button( $text, $product ) {
    if($product->get_meta( '_prpay' ) == 'yes') $text = __('Pay prestation', 'prestations');
  	return $text;
  }

  static function add_to_cart_message( $message, $product_id ) {
      // make filter magic happen here...
      if(!empty($_POST['prpay_product_prestation_id'])) $message = $_POST['prpay_product_prestation_id'] . ": $message";
      return $message;
  }

  static function add_product_prpay_options($product_type_options) {
    $product_type_options['prpay'] = array(
      "id"            => "_prpay",
      "wrapper_class" => "show_if_simple show_if_variable",
      "label"         => __('Payments Only', 'prestations'),
      "description"   => __('Check to use product as custom payments only.', 'prestations'),
      "default"       => "no",
    );
    return $product_type_options;
  }

  public static function save_product_prpay_options($post_ID, $product, $update) {
    update_post_meta($product->ID, "_prpay", isset($_POST["_prpay"]) ? "yes" : "no");
  }

  /**
  * Display custom field on the front end
  * @since 1.0.0
  */
  static function add_to_cart_fields() {
    global $post;
		if(!self::is_payment_product( wc_get_product( $post->ID ) )) return;

    $prestation_id = (isset($_REQUEST['prestation_id'])) ? esc_attr($_REQUEST['prestation_id']) : NULL;
		$amount = (isset($_REQUEST['amount'])) ? esc_attr($_REQUEST['amount']) : ((isset($_REQUEST['nyp'])) ? esc_attr($_REQUEST['nyp']) : NULL);

    // $prestation_id = isset( $_POST['prpay_product_prestation_id'] ) ? sanitize_text_field( $_POST['prpay_product_prestation_id'] ) : '';
		printf(
		  '<div class="prpay-field prpay-field-amount">
		    <p class="form-row form-row-wide">
		      <label for="prpay_product_amount" class="required">%s%s</label>
		      <input type="number" class="input-text" name="prpay_product_amount" value="%s" placeholder="%s" required>
		    </p>
		  </div>',
		  __('Amount', 'prestations'),
		  ' <abbr class="required" title="required">*</abbr>',
		  $amount,
		  __("Amount to pay", 'prestations'),
		  '',
		);
		printf(
      '<div class="prpay-field prpay-field-prestation-id">
				<p class="form-row form-row-wide">
					<label for="prpay_product_prestation_id" class="required">%s%s</label>
					<input type="%s" class="input-text" name="prpay_product_prestation_id" value="%s" placeholder="%s" class=width:auto required>
					%s
        </p>
      </div>',
      __('Prestation reference', 'prestations'),
      (empty($prestation_id)) ? ' <abbr class="required" title="required">*</abbr>' : ': <span class=prestation_id>' . $prestation_id . '</span>',
      (empty($prestation_id)) ? 'text' : 'hidden',
      $prestation_id,
      __("Enter a prestation id", 'prestations'),
      (empty($prestation_id)) ? __('User the reference number received during reservation.', 'prestations') : '',
    );
  }

  static function add_to_cart_validation( $passed, $product_id, $quantity ) {
    if($passed && self::is_payment_product( $product_id )) {
      if(!empty($_POST['prpay_product_prestation_id'])) $prestation_id = sanitize_text_field($_POST['prpay_product_prestation_id']);
      else if(!empty($_REQUEST['prestation_id'])) $prestation_id = sanitize_text_field($_REQUEST['prestation_id']);
      else $prestation_id = NULL;

			if(!empty($_POST['prpay_product_amount'])) $amount = sanitize_text_field($_POST['prpay_product_amount']);
      else if(!empty($_REQUEST['amount'])) $amount = sanitize_text_field($_REQUEST['amount']);
      else $amount = NULL;

			if(!is_numeric($amount) || $amount <= 0) {
				$product_title = wc_get_product( $product_id )->get_title();
				wc_add_notice( sprintf(
          __('"%s" could not be added to the cart. Please provide a valid amount to pay.', 'prestations'),
          sprintf('<a href="%s">%s</a>', get_permalink($product_id), $product_title),
        ), 'error' );
        return false;
			}
			if( empty( $prestation_id ) ) {
        $product_title = wc_get_product( $product_id )->get_title();

        wc_add_notice( sprintf(
          __('"%s" could not be added to the cart. Please provide a prestation id.', 'prestations'),
          sprintf('<a href="%s">%s</a>', get_permalink($product_id), $product_title),
        ), 'error' );
        return false;
      }
    }
    return $passed;
  }

  /**
  * Add the text field as item data to the cart object
  * @since 1.0.0
  * @param Array $cart_item_data Cart item meta data.
  * @param Integer $product_id Product ID.
  * @param Integer $variation_id Variation ID.
  * @param Boolean $quantity Quantity
  */
  static function add_cart_item_data( $cart_item_data, $product_id, $variation_id, $quantity ) {
    if(!empty($_POST['prpay_product_prestation_id'])) $cart_item_data['prpay_product_prestation_id'] = sanitize_text_field($_POST['prpay_product_prestation_id']);
    else if(!empty($_REQUEST['prestation_id'])) $cart_item_data['prpay_product_prestation_id'] = sanitize_text_field($_REQUEST['prestation_id']);

		if(!empty($_POST['prpay_product_amount'])) $cart_item_data['prpay_product_amount'] = sanitize_text_field($_POST['prpay_product_amount']);
    else if(!empty($_REQUEST['amount'])) $cart_item_data['prpay_product_amount'] = sanitize_text_field($_REQUEST['amount']);
		else if(!empty($_REQUEST['nyp'])) $cart_item_data['prpay_product_amount'] = sanitize_text_field($_REQUEST['nyp']);

    return $cart_item_data;
  }

  /**
  * Display the custom field value in the cart
  * @since 1.0.0
  */
  static function cart_item_name( $name, $cart_item, $cart_item_key ) {
    if( isset( $cart_item['prpay_product_prestation_id'] ) ) {
      $name = sprintf(
				'<span class=prpay-prestation-id>%s%s</span>',
				__('Payment for prestation #', 'prestations'),
				esc_html( $cart_item['prpay_product_prestation_id'] ),
      );
    }
    return $name;
  }

  /**
  * Add custom field to order object
  */
  static function add_custom_data_to_order( $item, $cart_item_key, $values, $order ) {
    foreach( $item as $cart_item_key=>$values ) {
      if( isset( $values['prpay_product_project_name'] ) ) {
        $item->add_meta_data( __( 'Prestation', 'prestations' ), $values['prpay_product_project_name'], true );
      }
    }
  }

	static function get_price_html( $price_html, $product ) {
    if($product->get_meta( '_linkproject' ) == 'yes') {
      $price = max($product->get_price(), get_option('prpay_product_project_minimum_price', 0));
      if( $price == 0 ) {
        $price_html = apply_filters( 'woocommerce_empty_price_html', '', $product );
      } else {
        if ( $product->is_on_sale() && $product->get_price() >= $price ) {
          $price = wc_format_sale_price( wc_get_price_to_display( $product, array( 'price' => $product->get_regular_price() ) ),
          wc_get_price_to_display( $product ) ) . $product->get_price_suffix();
        } else {
          $price = wc_price( $price ) . $product->get_price_suffix();
        }
        $price_html = sprintf('<span class="from">%s </span>', __('From', 'prestations')) . $price;
      }
    }
    return $price_html;
  }

	/**
  * Update the price in the cart
  * @since 1.0.0
  */
  static function before_calculate_totals( $cart ) {
    if ( is_admin() && ! defined( 'DOING_AJAX' ) ) {
      return;
    }
    // Iterate through each cart item
    foreach( $cart->get_cart() as $cart_key => $cart_item ) {
      $cached = wp_cache_get('prpay_product_cart_item_processed_' . $cart_key, 'prestations');
      if(!$cached) {
        if( is_numeric( $cart_item['prpay_product_amount'] &! $cart_item['prpay_product_amount_added']) ) {
					// $cart_item['data']->adjust_price( $cart_item['prpay_product_amount'] );
          $price = (float)$cart_item['data']->get_price( 'edit' );
          $total = $price + $cart_item['prpay_product_amount'];
          $cart_item['data']->set_price( ( $total ) );
          $cart_item['prpay_product_amount_added'] = true;
        }
        wp_cache_set('prpay_product_cart_item_processed_' . $cart_key, true, 'prestations');
      }
    }
  }

	static function is_payment_product($product_id) {
	  // return true; // let's handle this later
		return (wc_get_product( $product_id )->get_meta( '_prpay' ) == 'yes');
	}

}

Prestations_Payment_Product::run();
