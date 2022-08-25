<?php

/**
 * [Prestations_Payment_Product description]
 */
class Prestations_Payment_Product {

  /*
  * Bootstraps the class and hooks required actions & filters.
  */
  public static function run() {
		// Add Prestation Payment option to product edit page
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

    add_action( 'init',  __CLASS__ . '::rewrite_rules');
    add_filter( 'query_vars', __CLASS__ . '::query_vars');
    add_action( 'template_include', __CLASS__ . '::template_include');

		// Set pay button text
		// add_filter( 'woocommerce_product_add_to_cart_text', __CLASS__ . '::add_to_cart_button', 10, 2);
		// add_filter( 'woocommerce_product_single_add_to_cart_text', __CLASS__ . '::single_add_to_cart_button', 10, 2);

		// Settings page
		add_filter( 'rwmb_meta_boxes', __CLASS__ . '::register_fields' );

  }

	static function register_fields( $meta_boxes ) {
		$prefix = 'woocommerce_';

		$pp = self::get_payment_products();
		$pp_count = count($pp);

		// $meta_boxes['woocommerce_settings']['fields'][] =  [
		$meta_boxes[] =  [
			'title'          => __( 'Payment Products', 'prestations' ),
			'id'             => 'prestations-payments',
			'settings_pages' => ['prestations'],
			'tab'            => 'woocommerce',
			'fields'         => [
				[
					'name'       => __( 'Payment products', 'prestations' ),
					'id' => 'products',
					'type' => 'custom_html',
					'callback' => __CLASS__ . '::payment_products_list',
					'desc' => sprintf(
						'<p>%s</p><p>%s</p>',
						__('Payment products are used to provide a payment gateway for prestation not handled by WooCommerce (like deposits, custom items or services handled by an external website).', 'prestations'),
						join(
							'<br/>', array(
								__('To enable a product as payment, check the "Payment Only" option on product edit page and set its price to 0 (zero).', 'prestations'),
								__('Enabling Payment Only will disable fixed product price and add amount and reference fields to product page.', 'prestations'),
								__('Only one Payment Only product is needed by Prestations plugin.', 'prestations'),
							),
						),
					),
				],
        [
					'name' => __('Default product', 'prestations'),
					'id' => $prefix . 'default_product',
					'type' => ($pp_count > 0) ? 'select' : 'custom_html',
					'std' => ($pp_count > 0) ? array_key_first($pp) : __('Create a payment product first', 'prestations'),
					'options' => $pp,
          'placeholder' => __('Select a product', 'prestations'),
					'desc' => __('Used to generate payment links.', 'prestations'),
          'sanitize_callback' => __CLASS__ . '::rewrite_slug_validation',
				],
        [
					'name' => __('Payment link slug', 'prestations'),
					'id' => $prefix . 'rewrite_slug',
					'type' => 'text',
          'size' => 10,
          // Translators: slug used to generate payment links
          'std' => __('pay', 'prestations'),
					// 'desc' => __('Used to generate payment links.', 'prestations'),
          'sanitize_callback' => __CLASS__ . '::rewrite_slug_validation',
				],
			],
		];

    $meta_boxes['prestation-cpt']['fields'][] = [
      'name'          => __( 'Payment link', 'prestations' ),
      'id'            => $prefix . 'payment_link',
      'type'          => 'custom_html',
      'class' => 'payment-link',
      'callback'      => 'Prestations_Payment_Product::get_payment_link',
      // 'admin_columns' => 'after paid',
    ];

		return $meta_boxes;
	}

	static function get_payment_products() {
		$args = array(
			'status' => 'publish',
			'meta_key' => '_prpay',
			'meta_value' => 'yes',
		);
		$products = wc_get_products( $args );
		$payment_products = [];
		if($products) {
			foreach($products as $product) {
				$product_id = $product->get_id();
				$payment_products[$product_id] = sprintf(
					'%s (#%s)',
					$product->get_title(),
					$product_id,
				);
			}
		}
		return $payment_products;
	}

	static function payment_products_list() {
		$html = '';
		$payment_products = self::get_payment_products();
		foreach($payment_products as $product_id => $product_title) {
			$payment_products[$product_id] = sprintf(
				'<a href="%s">%s</a>',
				get_edit_post_link($product_id),
				$product_title,
			);
		}

		$count = count($payment_products);
		$html = sprintf(
			_n(  '%s product enabled: %s', '%s products enabled: %s', $count, 'text-domain' ),
			number_format_i18n( $count ),
			join(', ', $payment_products),
		);
		return $html;
	}

  static function add_to_cart_button( $text, $product ) {
    if($product->get_meta( '_prpay' ) == 'yes') $text = __('Pay prestation', 'prestations');
  	return $text;
  }

  static function single_add_to_cart_button( $text, $product ) {
    if($product->get_meta( '_prpay' ) == 'yes') $text = __('Pay prestation', 'prestations');
  	return $text;
  }

  static function add_to_cart_message( $message, $product_id ) {
      // make filter magic happen here...
      if(!empty($_POST['prpay_reference'])) $message = $_POST['prpay_reference'] . ": $message";
      return $message;
  }

  static function add_product_prpay_options($product_type_options) {
    $product_type_options['prpay'] = array(
      "id"            => "_prpay",
      "wrapper_class" => "show_if_simple show_if_variable",
      "label"         => __('Prestation Payment', 'prestations'),
      "description"   => __('Check to use product as custom Prestation Payment.', 'prestations'),
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

    $reference = (isset($_REQUEST['reference'])) ? esc_attr($_REQUEST['reference']) : NULL;
		$amount = (isset($_REQUEST['amount'])) ? esc_attr($_REQUEST['amount']) : ((isset($_REQUEST['nyp'])) ? esc_attr($_REQUEST['nyp']) : NULL);

    // $reference = isset( $_POST['prpay_product_reference'] ) ? sanitize_text_field( $_POST['prpay_product_reference'] ) : '';
		printf(
		  '<div class="prpay-field prpay-field-amount">
		    <p class="form-row form-row-wide">
		      <label for="prpay_amount" class="required">%s%s</label>
		      <input type="number" class="input-text" name="prpay_amount" value="%s" placeholder="%s" required>
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
					<label for="prpay_reference" class="required">%s%s</label>
					<input type="%s" class="input-text" name="prpay_reference" value="%s" placeholder="%s" class=width:auto required>
					%s
        </p>
      </div>',
      __('Prestation reference', 'prestations'),
      (empty($reference)) ? ' <abbr class="required" title="required">*</abbr>' : ': <span class=reference>' . $reference . '</span>',
      (empty($reference)) ? 'text' : 'hidden',
      $reference,
      __("Enter a prestation id", 'prestations'),
      (empty($reference)) ? __('Use the reference number received during order.', 'prestations') : '',
    );
  }

  static function get_payment_reference() {
    if(!empty($_POST['prpay_reference'])) $reference = sanitize_text_field($_POST['prpay_reference']);
    else if(!empty($_REQUEST['reference'])) $reference = sanitize_text_field($_REQUEST['reference']);
    else $reference = NULL;
    return $reference;
  }

  static function get_payment_amount() {
    if(!empty($_POST['prpay_amount'])) $amount = sanitize_text_field($_POST['prpay_amount']);
    else if(!empty($_REQUEST['amount'])) $amount = sanitize_text_field($_REQUEST['amount']);
    else $amount = NULL;
    if(!is_numeric($amount)) $amount = NULL;
    return $amount;
  }

  static function add_to_cart_validation( $passed, $product_id, $quantity ) {
    if($passed && self::is_payment_product( $product_id )) {
      $reference = self::get_payment_reference();
      $amount = self::get_payment_amount();

			if( $amount <= 0 ) {
				$product_title = wc_get_product( $product_id )->get_title();
				wc_add_notice( sprintf(
          __('"%s" could not be added to the cart. Please provide a valid amount to pay.', 'prestations'),
          sprintf('<a href="%s">%s</a>', get_permalink($product_id), $product_title),
        ), 'error' );
        return false;
			}
			if( empty( $reference ) ) {
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
    $reference = self::get_payment_reference();
    $amount = self::get_payment_amount();

    if(!empty($reference)) $cart_item_data['prpay_reference'] = $reference;
		if(!empty($amount)) $cart_item_data['prpay_amount'] = $amount;

    return $cart_item_data;
  }

  /**
  * Display the custom field value in the cart
  * @since 1.0.0
  */
  static function cart_item_name( $name, $cart_item, $cart_item_key ) {
    if( isset( $cart_item['prpay_reference'] ) ) {
      $reference = sanitize_text_field($cart_item['prpay_reference']);

      $prestation = get_page_by_path( $reference, OBJECT, 'prestation');
      if($prestation) {
        $dates = get_post_meta($prestation->ID, 'dates', true);
        $from = date_i18n(get_option( 'date_format' ), $dates['from']);
        $to = date_i18n(get_option( 'date_format' ), $dates['to']);

        $cart_item_name = sprintf(
          '%s<p>%s<p>',
          $prestation->post_title,
          sprintf(
            // Translators: from [start date] to [end date] (without time)
            __('from %s to %s', 'prestations'),
            $from,
            $to,
          ),
        );
        return $cart_item_name;
      }

      return sprintf(
				'<span class=prpay-prestation-id>%s%s</span>',
				sprintf(
          __('Reference #%s', 'prestations'),
          $reference,
        ),
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
    if($product->get_meta( '_prpay' ) == 'yes') {
      $price = max($product->get_price(), Prestations::get_option('woocommerce_payment_minimum_price', 0));
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
        $added = (isset($cart_item['prpay_amount_added'])) ? $cart_item['prpay_amount_added'] : false;
        if( is_numeric( $cart_item['prpay_amount']) &! $added) {
					// $cart_item['data']->adjust_price( $cart_item['prpay_amount'] );
          $price = (float)$cart_item['data']->get_price( 'edit' );
          $total = $price + $cart_item['prpay_amount'];
          $cart_item['data']->set_price( ( $total ) );
          $cart_item['prpay_amount_added'] = true;
        }
        wp_cache_set('prpay_product_cart_item_processed_' . $cart_key, true, 'prestations');
      }
    }
  }

	static function is_payment_product($product_id) {
	  // return true; // let's handle this later
		return (wc_get_product( $product_id )->get_meta( '_prpay' ) == 'yes');
	}

  static function rewrite_slug_validation($value, $field, $oldvalue) {
    switch($field['id']) {
      case 'woocommerce_rewrite_slug':
      $value = sanitize_title($value);
      break;

      case 'woocommerce_default_product':
      $pp = self::get_payment_products();
      if(empty($value) && count($pp)==1) $value = array_key_first($pp);
      $value = (get_post_status ( $value )) ? $value : NULL;
      break;
    }

    if($value != $oldvalue) set_transient('prestations_rewrite_flush', true);

    return $value;
  }

  static function get_payment_link() {
    global $post;

    // $product_id = Prestations::get_option('woocommerce_default_product');
    $reference = $post->post_name;
    $balance = get_post_meta($post->ID, 'balance', true);
    $paid = (float)get_post_meta($post->ID, 'paid', true);
    $deposit = (float)get_post_meta($post->ID, 'deposit', true)['total'];

    $slug = __(Prestations::get_option('woocommerce_rewrite_slug'), 'prestations');

    if($deposit > $paid) {
      $deposit_due = $deposit - $paid;
      $links[__('Deposit', 'prestations')] = get_home_url(NULL, "$slug/$reference/" . $deposit_due);
    }
    $links[__('Balance', 'prestations')] = get_home_url(NULL, "$slug/$reference/$balance");
    foreach($links as $key=>$link) {
      $html .= sprintf(
        '<li>%1$s: <a href="%2$s" target="blank">%2$s</a></li>',
        $key,
        $link,
      );
    }
    return (!empty($html)) ? '<ul>' . $html . '</ul>' : NULL;
  }

  static function rewrite_rules() {
    global $wp_query;
    $pattern_ref = '([^&/]+)';
    $pattern_price = '([^&/]+)';

    $product_id = Prestations::get_option('woocommerce_default_product');
    $cart_id = wc_get_page_id('cart');

    // add_rewrite_tag('%reference%', $pattern_ref, 'reference=');
    // add_rewrite_tag('%amount%', $pattern_price, 'amount=');

    $slugs[] = Prestations::get_option('woocommerce_rewrite_slug');
    $slugs[] = __($slugs[0], 'prestations');
    $slugs = array_unique($slugs);
    foreach($slugs as $slug) {
      add_rewrite_rule(
        "^$slug/$pattern_ref/$pattern_price/?$",
        sprintf(
          'index.php?page_id=%s&add-to-cart=%s&action=prestation_pay&reference=$matches[1]&amount=$matches[2]',
          $cart_id,
          $product_id,
        ),
        'top',
      );
      add_rewrite_rule(
        "^$slug(/$pattern_ref)?/?$",
        sprintf(
          'index.php?destination=%s&action=prestation_pay&reference=$matches[2]',
          $product_id,
        ),
        'top',
      );
    }

	}

  static function query_vars ( $query_vars ) {
    $query_vars[] = 'add-to-cart';
    $query_vars[] = 'action';
    $query_vars[] = 'reference';
    $query_vars[] = 'amount';
    $query_vars[] = 'destination';
    return $query_vars;
  }

  static function template_include( $template ) {
    global $wp_query;

    $args = array_filter($wp_query->query);
    if(isset($args['action']) && $args['action'] == 'prestation_pay') {
      if(isset($args['add-to-cart']) && isset($args['reference']) && isset($args['amount']) && is_numeric($args['amount'])) {
        $url = wc_get_cart_url();
      } else {
        $url = get_permalink($args['destination']);
      }
      unset($args['action']);
      unset($args['destination']);
      if(!empty($url)) {
        $location = add_query_arg( $args, $url );
        wp_redirect($location);
        die();
      }
    }

    // return get_template_directory() . '/template-name.php';
    return $template;
  }
}
