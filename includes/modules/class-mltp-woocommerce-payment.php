<?php

/**
 * [Mltp_WooCommerce_Payment description]
 */
class Mltp_WooCommerce_Payment extends Mltp_Payment {

	/*
	* Bootstraps the class and hooks required actions & filters.
	*/
	public static function init() {
		// Add Prestation Payment option to product edit page
		add_filter( 'product_type_options', __CLASS__ . '::add_product_prpay_options' );
		add_action( 'save_post_product', __CLASS__ . '::save_product_prpay_options', 10, 3 );

		// Add prestation id field to product page
		add_action( 'woocommerce_before_add_to_cart_button', __CLASS__ . '::add_to_cart_fields' );

		// Update product name in cart
		add_filter( 'woocommerce_add_to_cart_validation', __CLASS__ . '::add_to_cart_validation', 10, 3 );
		add_filter( 'woocommerce_add_cart_item_data', __CLASS__ . '::add_cart_item_data', 10, 4 );
		add_filter( 'woocommerce_cart_item_name', __CLASS__ . '::cart_item_name', 1, 3 );
		add_filter( 'wc_add_to_cart_message', __CLASS__ . '::add_to_cart_message', 10, 2 );

		add_action( 'woocommerce_before_calculate_totals', __CLASS__ . '::before_calculate_totals', 10, 1 );
		add_filter( 'woocommerce_get_price_html', __CLASS__ . '::get_price_html', 10, 2 );

		add_action( 'woocommerce_checkout_create_order_line_item', __CLASS__ . '::add_custom_data_to_order', 10, 4 );

		add_filter( 'mltp_rewrite_rules', __CLASS__ . '::rewrite_rules_filter' );
		add_filter( 'query_vars', __CLASS__ . '::wc_query_vars_filter' );
		add_action( 'template_include', __CLASS__ . '::template_include' );
		add_filter( 'mltp_payment_url', __CLASS__ . '::payment_url', null, 3 );
		add_filter( 'mltp_rounding', __CLASS__ . '::rounding');

		// Set pay button text
		// add_filter( 'woocommerce_product_add_to_cart_text', __CLASS__ . '::add_to_cart_button', 10, 2);
		// add_filter( 'woocommerce_product_single_add_to_cart_text', __CLASS__ . '::single_add_to_cart_button', 10, 2);

		// Settings page
		add_filter( 'rwmb_meta_boxes', __CLASS__ . '::register_settings_fields' );
		add_filter( 'rwmb_meta_boxes', __CLASS__ . '::register_fields' );

	}

	static function register_settings_fields( $meta_boxes ) {
		$prefix = 'woocommerce_';

		$pp       = self::get_payment_products();
		$pp_count = count( $pp );

		// $meta_boxes['woocommerce_settings']['fields'][] =  [
		$meta_boxes['multipass-woocommerce']['fields'] += array(
			array(
				'name'     => __( 'Payment products', 'multipass' ),
				'id'       => 'products',
				'type'     => 'custom_html',
				'callback' => __CLASS__ . '::payment_products_list',
				'desc'     => sprintf(
					'<p>%s</p><p>%s</p>',
					__( 'Payment products are used to provide a payment gateway for prestation not handled by WooCommerce (like deposits, custom items or prestation items handled by an external website).', 'multipass' ),
					join(
						'<br/>',
						array(
							__( 'To enable a product as payment, check the "Payment Only" option on product edit page and set its price to 0 (zero).', 'multipass' ),
							__( 'Enabling Payment Only will disable fixed product price and add amount and reference fields to product page.', 'multipass' ),
							__( 'Only one Payment Only product is needed by MultiPass plugin.', 'multipass' ),
						),
					),
				),
			),
			array(
				'name'              => __( 'Default product', 'multipass' ),
				'id'                => $prefix . 'default_product',
				'type'              => ( $pp_count > 0 ) ? 'select' : 'custom_html',
				'std'               => ( $pp_count > 0 ) ? array_key_first( $pp ) : __( 'Create a payment product first', 'multipass' ),
				'options'           => $pp,
				'placeholder'       => __( 'Select a product', 'multipass' ),
				'desc'              => __( 'Used to generate payment links.', 'multipass' ),
				'sanitize_callback' => __CLASS__ . '::wc_settings_validation_callback',
			),
			array(
				'name'              => __( 'Link prefix', 'multipass' ),
				'id'                => $prefix . 'rewrite_slug',
				'type'              => 'text',
				'size'              => 10,
				// TRANSLATORS: slug used to generate payment links
				'std'               => __( 'pay', 'multipass' ),
				'desc'              => sprintf(
					__( 'Generated payment URLs will folllow the form %s.', 'multipass' ),
					sprintf(
						'<nobr><code>%s</code></nobr>',
						// get_home_url(null, 'prefix/booking_id/amount'),
						self::payment_url( 'booking_id', 'amount' ),
					)
				),
				'sanitize_callback' => __CLASS__ . '::wc_settings_validation_callback',
			),
		);

		if ( MultiPass::debug() ) {
			$meta_boxes['multipass-woocommerce']['fields'][] = array(
				'name' => __( 'Payments test', 'multipass' ),
				'id'   => $prefix . 'multipass-woocommerce-debug',
				'type' => 'custom_html',
				'std'  => self::generate_payment_test_links(),
			);
		}

		return $meta_boxes;
	}

	static function register_fields( $meta_boxes ) {
		$prefix = 'woocommerce_';

		$meta_boxes['prestation-cpt']['fields'][] = array(
			'name'     => __( 'Payment link', 'multipass' ),
			'id'       => $prefix . 'payment_link',
			'type'     => 'custom_html',
			'class'    => 'payment-link',
			'callback' => 'Mltp_WooCommerce_Payment::get_payment_link',
		// 'visible' => [
		// 'when'     => [['balance', '>', 0]],
		// 'relation' => 'or',
		// ],
		);

		return $meta_boxes;
	}

	static function get_payment_products() {
		$args             = array(
			'status'     => 'publish',
			'meta_key'   => '_prpay',
			'meta_value' => 'yes',
		);
		$products         = wc_get_products( $args );
		$payment_products = array();
		if ( $products ) {
			foreach ( $products as $product ) {
				$product_id                      = $product->get_id();
				$payment_products[ $product_id ] = sprintf(
					'%s (#%s)',
					$product->get_title(),
					$product_id,
				);
			}
		}
		return $payment_products;
	}

	static function payment_products_list() {
		$output           = '';
		$payment_products = self::get_payment_products();
		foreach ( $payment_products as $product_id => $product_title ) {
			$payment_products[ $product_id ] = sprintf(
				'<a href="%s">%s</a>',
				get_edit_post_link( $product_id ),
				$product_title,
			);
		}

		$count  = count( $payment_products );
		$output = sprintf(
			_n( '%1$s product enabled: %2$s', '%1$s products enabled: %2$s', $count, 'text-domain' ),
			number_format_i18n( $count ),
			join( ', ', $payment_products ),
		);
		return $output;
	}

	static function add_to_cart_button( $text, $product ) {
		if ( $product->get_meta( '_prpay' ) == 'yes' ) {
			$text = __( 'Pay prestation', 'multipass' );
		}
		return $text;
	}

	static function single_add_to_cart_button( $text, $product ) {
		if ( $product->get_meta( '_prpay' ) == 'yes' ) {
			$text = __( 'Pay prestation', 'multipass' );
		}
		return $text;
	}

	static function add_to_cart_message( $message, $product_id ) {
		// make filter magic happen here...
		if ( ! empty( $_POST['prpay_reference'] ) ) {
			$message = $_POST['prpay_reference'] . ": $message";
		}
		return $message;
	}

	static function add_product_prpay_options( $product_type_options ) {
		$product_type_options['prpay'] = array(
			'id'            => '_prpay',
			'wrapper_class' => 'show_if_simple show_if_variable',
			'label'         => sprintf( __( '%s payment', 'multipass' ), 'MultiPass' ),
			'description'   => __( 'Check to use product as MultiPass payment.', 'multipass' ),
			'default'       => 'no',
		);
		return $product_type_options;
	}

	public static function save_product_prpay_options( $post_ID, $product, $update ) {
		update_post_meta( $product->ID, '_prpay', isset( $_POST['_prpay'] ) ? 'yes' : 'no' );
	}

	/**
	 * Display custom field on the front end
	 *
	 * @since 1.0.0
	 */
	static function add_to_cart_fields() {
		global $post;
		if ( ! self::is_payment_product( wc_get_product( $post->ID ) ) ) {
			return;
		}

		$reference = self::get_payment_reference();
		$amount    = self::get_payment_amount();
		$details   = null;

		if ( ! empty( $reference ) ) {
			$prestation = new Mltp_Prestation( $reference );
			if ( $prestation->is_prestation() ) {
				$details = $prestation->summary();
			} else {
				$details = __( 'Payment reference: ', 'multipass' ) . $reference;
			}
		}

		printf(
			'<div class="prpay-field prpay-field-prestation-id">
				<p class="form-row form-row-wide">
					%s
					%s
        </p>
      </div>',
			( empty( $reference ) ) ? sprintf(
				'<label for="prpay_reference" class="required"><abbr class="required" title="required">*</abbr>%s</label>
				<input type="text" class="input-text" name="prpay_reference" placeholder="%s" class=width:auto required>',
				__( 'Payment reference:', 'multipass' ),
				__( 'Enter a payment id', 'multipass' ),
			) : sprintf(
				'<input type="hidden" class="input-text" name="prpay_reference" value="%s" class=width:auto required>',
				$reference,
			),
			$details,
		);
		printf(
			'<div class="prpay-field prpay-field-amount">
		    <p class="form-row form-row-wide">
		      <label for="prpay_amount" class="required">%s%s</label>
		      <input type="number" class="input-text" name="prpay_amount" value="%s" placeholder="%s" required>
		    </p>
		  </div>',
			__( 'Amount to pay', 'multipass' ),
			' <abbr class="required" title="required">*</abbr>',
			$amount,
			__( 'Amount to pay', 'multipass' ),
			'',
		);
		printf( '<div style="height:0.5em;"></div>' );
	}

	static function add_to_cart_validation( $passed, $product_id, $quantity ) {
		if ( $passed && self::is_payment_product( $product_id ) ) {
			$reference = self::get_payment_reference();
			$amount    = self::get_payment_amount();

			if ( $amount <= 0 ) {
				$product_title = wc_get_product( $product_id )->get_title();
				wc_add_notice(
					sprintf(
						__( '"%s" could not be added to the cart. Please provide a valid amount to pay.', 'multipass' ),
						sprintf( '<a href="%s">%s</a>', get_permalink( $product_id ), $product_title ),
					),
					'error'
				);
				return false;
			}
			if ( empty( $reference ) ) {
				$product_title = wc_get_product( $product_id )->get_title();

				wc_add_notice(
					sprintf(
						__( '"%s" could not be added to the cart. Please provide a prestation id.', 'multipass' ),
						sprintf( '<a href="%s">%s</a>', get_permalink( $product_id ), $product_title ),
					),
					'error'
				);
				return false;
			}
		}
		return $passed;
	}

	/**
	 * Add the text field as item data to the cart object
	 *
	 * @since 1.0.0
	 * @param Array   $cart_item_data Cart item meta data.
	 * @param Integer $product_id Product ID.
	 * @param Integer $variation_id Variation ID.
	 * @param Boolean $quantity Quantity
	 */
	static function add_cart_item_data( $cart_item_data, $product_id, $variation_id, $quantity ) {
		$reference = self::get_payment_reference();
		$amount    = self::get_payment_amount();

		if ( ! empty( $reference ) ) {
			$cart_item_data['prpay_reference'] = $reference;
		}
		if ( ! empty( $amount ) ) {
			$cart_item_data['prpay_amount'] = $amount;
		}
		$prestation = get_page_by_path( $reference, OBJECT, 'mltp_prestation' );
		if ( $prestation ) {
			$cart_item_data['title'] = self::prestation_cart_name( $prestation );
		}

		return $cart_item_data;
	}

	static function prestation_cart_name( $prestation ) {
		if ( is_numeric( $prestation ) ) {
			$prestation = get_post( $prestation );
		}
		if(! $prestation) return __('Prestation payment', 'multipass');

		$prestation        = new Mltp_Prestation( $prestation );

		$cart_item_name = sprintf(
			'%s <p class="prestation-details description">%s</p>',
			$prestation->name,
			MultiPass::format_date_range( $prestation->dates ),
		);
		return $cart_item_name;
	}

	static function cart_item_name( $name, $cart_item, $cart_item_key ) {
		if ( isset( $cart_item['prpay_reference'] ) ) {
			$reference = sanitize_text_field( $cart_item['prpay_reference'] );

			$prestation = get_page_by_path( $reference, OBJECT, 'mltp_prestation' );
			if ( $prestation ) {
				return self::prestation_cart_name( $prestation );
			}

			return sprintf(
				'<span class=prpay-prestation-id>%s</span>',
				sprintf(
					__( 'Reference # %s', 'multipass' ),
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
		if ( isset( $values['title'] ) ) {
			$item->set_name( $values['title'] );
			// $item->set_meta_data(array(
			// 'title' => $values['title'],
			// ));
		}
	}

	static function get_price_html( $price_html, $product ) {
		if ( $product->get_meta( '_prpay' ) == 'yes' ) {
			$price = max( $product->get_price(), MultiPass::get_option( 'woocommerce_payment_minimum_price', 0 ) );
			if ( $price == 0 ) {
				$price_html = apply_filters( 'woocommerce_empty_price_html', '', $product );
			} else {
				if ( $product->is_on_sale() && $product->get_price() >= $price ) {
					$price = wc_format_sale_price(
						wc_get_price_to_display( $product, array( 'price' => $product->get_regular_price() ) ),
						wc_get_price_to_display( $product )
					) . $product->get_price_suffix();
				} else {
					$price = wc_price( $price ) . $product->get_price_suffix();
				}
				$price_html = sprintf( '<span class="from">%s </span>', __( 'From', 'multipass' ) ) . $price;
			}
		}
		return $price_html;
	}

	/**
	 * Update the price in the cart
	 *
	 * @since 1.0.0
	 */
	static function before_calculate_totals( $cart ) {
		if ( is_admin() && ! defined( 'DOING_AJAX' ) ) {
			return;
		}
		// Iterate through each cart item
		foreach ( $cart->get_cart() as $cart_key => $cart_item ) {
			$cached = wp_cache_get( 'prpay_product_cart_item_processed_' . $cart_key, 'multipass' );
			if ( ! $cached ) {
				$added = ( isset( $cart_item['prpay_amount_added'] ) ) ? $cart_item['prpay_amount_added'] : false;
				if ( isset( $cart_item['prpay_amount'] ) && is_numeric( $cart_item['prpay_amount'] ) & ! $added ) {
					// $cart_item['data']->adjust_price( $cart_item['prpay_amount'] );
					$price = (float) $cart_item['data']->get_price( 'edit' );
					$total = $price + $cart_item['prpay_amount'];
					$cart_item['data']->set_price( ( $total ) );
					$cart_item['prpay_amount_added'] = true;
				}
				wp_cache_set( 'prpay_product_cart_item_processed_' . $cart_key, true, 'multipass' );
			}
		}
	}

	static function is_payment_product( $product ) {
		// return true; // let's handle this later
		if ( is_numeric( $product ) ) {
			$product = wc_get_product( $product );
		}
		if ( ! $product ) {
			return false;
		}

		return ( $product->get_meta( '_prpay' ) == 'yes' ) ? true : false;
	}

	static function rounding($precision) {
		$rounding = get_option('woocommerce_price_num_decimals', $precision);
		return (is_numeric($rounding)) ? $rounding : $precision;
	}

	static function payment_url( $reference = null, $amount = null, $args = array() ) {
		$slug     = Mltp_WooCommerce::get_option( 'woocommerce_rewrite_slug', __( 'pay', 'multipass' ) );
		$language = ( ! empty( $args['language'] ) ) ? $args['language'] : '';

		if ( empty( $reference ) ) {
			return get_home_url( null, "$slug/" );
		} else {
			return preg_replace( ':/*$:', '', get_home_url( null, "$language/$slug/$reference/" . $amount ) );
		}
	}

	static function rewrite_rules_filter( $rules ) {
		$product_id = MultiPass::get_option( 'woocommerce_default_product' );

		$cart_id = wc_get_page_id( 'cart' );

		if ( empty( $product_id ) || empty( $cart_id ) ) {
			return $rules;
		}

		$rules['payment_link_with_amount'] = array(
			'query' => sprintf(
				'index.php?page_id=%s&add-to-cart=%s&action=prestation_pay&reference=$matches[1]&amount=$matches[2]',
				$cart_id,
				$product_id,
			),
			'after' => 'top',
		);
		$rules['payment_link']             = array(
			'query' => sprintf(
				'index.php?destination=%s&action=prestation_pay&reference=$matches[2]',
				$product_id,
			),
			'after' => 'top',
		);

		return $rules;
	}

	static function wc_query_vars_filter( $query_vars ) {
		$query_vars[] = 'add-to-cart';
		$query_vars[] = 'action';
		$query_vars[] = 'reference';
		$query_vars[] = 'amount';
		$query_vars[] = 'destination';
		return $query_vars;
	}

	static function template_include( $template ) {
		global $wp_query;

		$args = array_filter( $wp_query->query );
		if ( isset( $args['action'] ) && $args['action'] == 'prestation_pay' ) {
			if ( isset( $args['add-to-cart'] ) && isset( $args['reference'] ) && isset( $args['amount'] ) && is_numeric( $args['amount'] ) ) {
				$url = wc_get_cart_url();
			} else {
				$url = get_permalink( $args['destination'] );
			}
			unset( $args['action'] );
			unset( $args['destination'] );
			if ( ! empty( $url ) ) {
				$location = add_query_arg( $args, $url );
				wp_redirect( $location );
				die();
			}
		}

		// return get_template_directory() . '/template-name.php';
		return $template;
	}
}

$this->modules[] = new Mltp_WooCommerce_Payment();
