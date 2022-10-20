<?php

/**
 * [Mltp_Payment description]
 */
class Mltp_Payment {

	/*
	* Bootstraps the class and hooks required actions & filters.
	*/

	public function __construct( $args = null ) {
	}

	public static function init() {
		add_action( 'init', __CLASS__ . '::rewrite_rules' );
	}

	static function rewrite_rules_filter( $rules ) {
		// return apply_filters('mltp_rewrite_rules', $rules);
		//
		return ( $rules );
	}

	static function rewrite_rules() {
		global $wp_query;

		$rules = apply_filters( 'mltp_rewrite_rules', array() );

		$pattern_ref   = '([^&/]+)';
		$pattern_price = '([^&/]+)';

		// add_rewrite_tag('%reference%', $pattern_ref, 'reference=');
		// add_rewrite_tag('%amount%', $pattern_price, 'amount=');

		$slugs[] = MultiPass::get_option( 'woocommerce_rewrite_slug' );
		$slugs[] = __( $slugs[0], 'multipass' );
		$slugs   = array_unique( $slugs );

		$default['after'] = null; // leave it to WordPress
		foreach ( $slugs as $slug ) {
			$override['payment_link']['regex']             = "^$slug(/$pattern_ref)?/?$";
			$override['payment_link_with_amount']['regex'] = "^$slug/$pattern_ref/$pattern_price/?$";

			foreach ( $rules as $key => $rule ) {
				$rule = array_merge( $default, $rule, $override[ $key ] );
				if ( empty( $rule['regex'] ) || empty( $rule['query'] ) ) {
					MultiPass::debug( 'rules', $rule );
				}
				add_rewrite_rule( $rule['regex'], $rule['query'], $rule['after'] );
			}
		}

	}

	// static function register_settings_fields( $meta_boxes ) {
	// }

	// static function register_fields( $meta_boxes ) {
	// }

	static function get_payment_reference() {
		$request = wp_unslash( $_REQUEST );
		$keys    = array( 'prpay_reference', 'reference', 'booking_id' );
		foreach ( $keys as $key ) {
			if ( ! empty( $request[ $key ] ) ) {
				return sanitize_text_field( $request[ $key ] );
			}
		}
	}

	static function get_payment_amount() {
		$amount  = null;
		$request = wp_unslash( $_REQUEST );
		$keys    = array( 'prpay_amount', 'amount', 'nyp' );
		foreach ( $keys as $key ) {
			if ( ! empty( $request[ $key ] ) ) {
				$amount = sanitize_text_field( preg_replace( '/,/', '.', $request[ $key ] ) );
				break;
			}
		}

		if ( is_numeric( $amount ) ) {
			return $amount;
		}
	}

	static function generate_payment_test_links() {
		if ( ! MultiPass::debug() ) {
			return;
		}

		$sources = MultiPass::get_registered_sources();
		// error_log('sources ' . print_r($sources, true));

		$links[]    = MultiPass::payment_url();
		$links[]    = MultiPass::payment_url( '123' );
		$links[]    = MultiPass::payment_url( '123', '45.6' );
		$links[]    = MultiPass::payment_url( '123', '45,6' );
		$links[]    = '';
		$query_args = array(
			'post_type'   => 'mltp_prestation',
			'post_status' => 'publish',
			// 'numberposts' => 1,
			// 'orderby'    => 'post_date',
			'metakey'     => 'from',
			'orderby'     => 'metavalue_num',
			'order'       => 'asc',
			'meta_query'  => array(
				'relation' => 'AND',
				array(
					'key'     => 'from',
					'compare' => '>=',
					'value'   => time(),
				),
				array(
					'key'     => 'balance',
					'compare' => '>',
					'value'   => 0,
				),
			),
		);
		$posts      = get_posts( $query_args );
		$post       = reset( $posts );

		if ( $post ) {
			// error_log('found ' . count($posts) . ' ' . print_r(reset($posts), true));
			$links[] = MultiPass::payment_url( $post->ID );
			$links[] = MultiPass::payment_url( $post->post_name );
			$links[] = MultiPass::payment_url( $post->post_name, get_post_meta( $post->ID, 'balance', true ) );
		}

		foreach ( $links as $link ) {
			$output[] = sprintf( '<a target="_blank" href="%1$s">%1$s</a>', $link );
			// code...
		}

		if ( ! empty( $output ) ) {
			return join( '<br/>', $output );
		}

	}

	static function get_payment_link() {
		global $post;

		// $product_id = MultiPass::get_option('woocommerce_default_product');
		$reference = $post->post_name;

		$balance       = (float) get_post_meta( $post->ID, 'balance', true );
		$paid          = (float) get_post_meta( $post->ID, 'paid', true );
		$deposit_array = get_post_meta( $post->ID, 'deposit', true );
		$deposit       = ( is_array( $deposit_array ) ) ? (float) get_post_meta( $post->ID, 'deposit', true )['total'] : null;

		$deposit = round( $deposit, 2 );
		$paid    = round( $paid, 2 );
		$balance = round( $balance, 2 );

		$links = array();
		if ( $deposit > $paid ) {
			$deposit_due = $deposit - $paid;
			$links[]     = sprintf(
				'<a class=button href="%2$s" target="blank">%1$s</a> ',
				sprintf( __( 'Pay deposit (%s)', 'multipass' ), MultiPass::price( $deposit_due ) ),
				MultiPass::payment_url( $reference, $deposit_due ),
			);
		}
		if ( $balance > 0 ) {
			$links[] = sprintf(
				'<a class=button href="%2$s" target="blank">%1$s</a> ',
				sprintf( __( 'Pay balance (%s)', 'multipass' ), MultiPass::price( $balance ) ),
				MultiPass::payment_url( $reference, $balance ),
			);
		}
		$output = join( ' ', $links );
		return $output;
	}
}

$this->loaders[] = new Mltp_Payment();
