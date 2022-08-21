<?php

/**
 * Register all actions and filters for the plugin
 *
 * @link       http://example.com
 * @since      0.1.0
 *
 * @package    Prestations
 * @subpackage Prestations/includes
 */

/**
 * Register all actions and filters for the plugin.
 *
 * Maintain a list of all hooks that are registered throughout
 * the plugin, and register them with the WordPress API. Call the
 * run function to execute the list of actions and filters.
 *
 * @package    Prestations
 * @subpackage Prestations/includes
 * @author     Your Name <email@example.com>
 */
class Prestations_WooCommerce {

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
	public function run() {

		$this->actions = array(
			array(
				'hook' => 'wp_insert_post',
				'callback' => 'wp_insert_post_action',
				'accepted_args' => 3,
			),
		);

		$this->filters = array(
			array(
				'hook' => 'rwmb_meta_boxes',
				'callback' => 'register_fields'
			),
			array (
				'hook' => 'mb_settings_pages',
				'callback' => 'register_settings_pages',
			),
			array(
				'hook' => 'rwmb_meta_boxes',
				'callback' => 'register_settings_fields',
			),
			array(
				'hook' => 'manage_edit-shop_order_columns',
				'callback' => 'add_shop_order_columns',
			),

			array(
				'hook' => 'manage_prestation_posts_custom_column',
				'callback' => 'prestations_columns_display',
				'accepted_args' => 2,
			),
			array(
				'hook' => 'manage_shop_order_posts_custom_column',
				'callback' => 'shop_orders_columns_display',
				'accepted_args' => 2,
			),

			array(
				'hook' => 'woocommerce_order_data_store_cpt_get_orders_query',
				'callback' => 'wc_get_orders_handle_prestation_id',
				'accepted_args' => 2,
			),

			array(
				'hook' => 'get_managed_list',
				'callback' => 'get_managed_list_filter',
			)
		);

		$defaults = array( 'component' => __CLASS__, 'priority' => 10, 'accepted_args' => 1 );

		foreach ( $this->filters as $hook ) {
			$hook = array_merge($defaults, $hook);
			add_filter( $hook['hook'], array( $hook['component'], $hook['callback'] ), $hook['priority'], $hook['accepted_args'] );
		}

		foreach ( $this->actions as $hook ) {
			$hook = array_merge($defaults, $hook);
			add_action( $hook['hook'], array( $hook['component'], $hook['callback'] ), $hook['priority'], $hook['accepted_args'] );
		}

	}

	static function register_fields( $meta_boxes ) {
		// WooCommerce settings

		$prefix = 'woocommerce_';

		$meta_boxes[] = [
			'title'          => __( 'WooCommerce Settings', 'prestations' ),
			'id'             => 'prestations-woocommerce',
			'settings_pages' => ['prestations'],
			'tab'            => 'woocommerce',
			'fields'         => [
				[
					'name'              => __( 'Sync orders', 'prestations' ),
					'id'                => $prefix . 'sync_orders',
					'type'              => 'switch',
					'desc'              => __( 'Sync orders and prestations, create prestation if none exist. Only needed at plugin activation or if out of sync.', 'prestations' ),
					'style'             => 'rounded',
					'sanitize_callback' => 'Prestations_WooCommerce::sync_orders',
					'save_field' => false,
				],
				[
					'name'       => __( 'Payment products', 'prestations' ),
					'id'         => $prefix . 'payment_products',
					'type'       => 'post',
					'desc'       => __( 'Products to handle as payment only (price is used only for payment calculation, not for prestation cost)', 'prestations' ),
					'post_type'  => ['product'],
					'field_type' => 'select_advanced',
					'multiple'   => true,
				],
			],
		];

		// Prestation info on WC Orders
		$prefix = 'prestation_';
		$meta_boxes[] = [
			'title'      => __( 'Prestation', 'prestations' ),
			'id'         => 'prestation-woocommerce-order',
			'post_types' => ['shop_order'],
			'context'    => 'side',
			'fields'     => [
				[
					// 'name'       => __( 'Prestation', 'prestations' ),
					'id'         => $prefix . 'id',
					'type'       => 'post',
					'post_type'  => ['prestation'],
					'field_type' => 'select_advanced',
				],
				[
					'id' => $prefix . 'prestation_link',
					'type' => 'custom_html',
					'callback' => __CLASS__ . '::display_prestation_link',
				]
			],
		];

		// WC Orders on prestation
		$prefix = 'woocommerce_';
		$meta_boxes['prestations-extensions']['fields']['woocommerce'] = [
			'name'    => __( 'Woocommerce Orders', 'prestations' ),
			'id'      => 'orders',
			'type'    => 'custom_html',
			'callback' => __CLASS__ . '::get_order_details',
			// 'columns' => 6,

			// 'name' => 'WooCommerce',
			// 'id'     => $prefix . 'wc_order',
			// 'type'   => 'group',
			// 'clone'  => true,
			// 'fields' => [
			// 	[
			// 		'name'    => __( 'Order ID', 'prestations' ),
			// 		'id'      => 'id',
			// 		'type'    => 'text',
			// 		'post_type' => 'shop_order',
			// 		'callback' => __CLASS__ . '::get_order_details',
			// 		// 'std' => self::get_order_details(),
			// 		// 'readonly' => true,
			// 		'columns' => 3,
			// 		// 'options' => self::get_available_items(),
			// 	],
			// 	[
			// 		'name'    => __( 'Additional details', 'prestations' ),
			// 		'id'      => 'details',
			// 		'type'    => 'custom_html',
			// 		'callback' => __CLASS__ . '::get_order_details',
			// 		'columns' => 6,
			// 	],
			// ],
		];

		return $meta_boxes;
	}

	static function wc_get_orders_handle_prestation_id( $query, $query_vars ) {
		if ( ! empty( $query_vars['prestation_id'] ) ) {
			$query['meta_query'][] = array(
				'key' => 'prestation_id',
				'value' => esc_attr( $query_vars['prestation_id'] ),
			);
		}

		return $query;
	}

	static function display_prestation_link($arg = NULL, $field = NULL) {
		global $post;
		$prestation_id = get_post_meta($post->ID, 'prestation_id', true);
		$link = get_edit_post_link($prestation_id);

		if(!empty($link)) echo sprintf(
			'<a href="%s">%s</a>', $link, __('View prestation', 'prestations'),
		);
	}

	static function get_order_details($arg = NULL, $field = NULL) {
		global $post;
		$orders = wc_get_orders([ 'prestation_id' => $post->ID ]);
		$rows = [];
		foreach ($orders as $key => $order) {
			// error_log(print_r($order, true));
			$row = sprintf(
				'<div class="prestation-order">
				<a href="%s">%s</a>
				%s - <strong>%s</strong> - %s
				</div>',
				get_edit_post_link($order->ID),
				"#$order->ID",
				$order->get_date_created()->date(get_option('date_format')),
				wc_price($order->get_remaining_refund_amount()),
				$order->get_status(),
				// $order->get_date_paid()->date(get_option('date_format')),
			);
			$items = [];
			foreach ( $order->get_items() as $item_id => $item ) {
				$product_id = $item->get_product_id();
				$variation_id = $item->get_variation_id();
				$product = $item->get_product(); // see link above to get $product info
				$product_name = $item->get_name();
				$quantity = $item->get_quantity();
				$subtotal = $item->get_subtotal();
				$total = $item->get_total();
				$tax = $item->get_subtotal_tax();
				$tax_class = $item->get_tax_class();
				$tax_status = $item->get_tax_status();
				$allmeta = $item->get_meta_data();
				$somemeta = $item->get_meta( );
				$item_type = $item->get_type(); // e.g. "line_item"
				$items[] = '<li>' . "$product_name $quantity x $subtotal = $total " . '</li>';
			}
			if(!empty($items)) $row .= '<ol>' . implode($items) . '</ol>';

			$rows[] = $row;
		}
		return implode($rows);
	}

	static function register_settings_pages( $settings_pages ) {
		$settings_pages['prestations']['tabs']['woocommerce'] = 'WooCommerce';

		return $settings_pages;
	}

	static function register_settings_fields( $meta_boxes ) {
		$prefix = 'woocommerce_';

		$meta_boxes['prestations-woocommerce-settings'] = [
			'title'          => __( 'WooCommerce Settings', 'prestations' ),
			'id'             => 'prestations-woocommerce-settings',
			'settings_pages' => ['prestations'],
			'tab'            => 'woocommerce',
			'fields'         => [
			],
		];

		return $meta_boxes;
	}

	/**
	 * Tweak to force add shop order columns, which should be added by mb_relationships_init but aren't
	 */
	static function add_shop_order_columns( $columns ){
		foreach($columns as $key => $value) {
			$updated_columns[$key] = $value;
			if($key == 'order_number') {
				$updated_columns['prestation'] = __('Prestation', 'prestations');
			}
		}
		if(isset($updated_columns)) $columns = $updated_columns;
		return $columns;
	}

	static function get_related_links($post_id, $relation_id, $direction) {
		if( empty($post_id) || empty($relation_id) ) return [];
		$related = [];

		return $related;
	}

	static function prestations_columns_display( $column, $post_id ) {
		switch($column) {
			case 'wc-order-prestation_to':
			$related = self::get_related_links($post_id, 'wc-order-prestation', 'from');
			echo 'O ' . join(' ', $related);
			break;
		}
	}

	static function shop_orders_columns_display( $column, $post_id ) {
		switch($column) {
			case 'prestation':
			$prestation_id = get_post_meta($post_id, 'prestation_id', true);
			if(!empty($prestation_id)) {
				echo sprintf(
					'<a href="%s">#%s</a>',
					get_edit_post_link($prestation_id),
					get_post_field( 'post_name', $prestation_id),
				);
			}
			break;
		}
	}

	function background_process() {
		$this->background_queue = new Prestations_WooCommerce_Process();

 		// $action = __CLASS__ . '::fetch_mails';
		// if(get_transient('Prestations_WooCommerce_wait')) return;
		// set_transient('Prestations_WooCommerce_wait', true, 30);
		//
		// if(Prestations::get_option('prestations:email_processing', false))
		// $this->background_queue->push_to_queue(__CLASS__ . '::fetch_mails');
		//
		// $this->background_queue->save()->dispatch();

		// One-off task:
		//
		// $this->background_request = new Prestations_WooCommerce_Request();
		// $this->background_request->data( array( 'value1' => $value1, 'value2' => $value2 ) );
		// $this->background_request->dispatch();
	}

	static function wp_insert_post_action($post_id, $post, $update ) {
		if( !$update ) return;
		if( Prestations::is_new_post() ) return; // new posts are empty

		remove_action(current_action(), __CLASS__ . '::' . __FUNCTION__);
		switch($post->post_type) {
			case 'shop_order':
			self::update_order_prestation($post_id, $post, $update );
			break;

			case 'prestation':
			self::update_prestation_orders($post_id, $post, $update );
			break;
		}
		add_action(current_action(), __CLASS__ . '::' . __FUNCTION__, 10, 3);
	}

	static function update_prestation_orders($prestation_id, $prestation, $update ) {
		if( wp_cache_get(__CLASS__ . '-' . __FUNCTION__ . '-' . $prestation_id) ) return;
		if( $prestation->post_type != 'prestation' ) return;
		if( $prestation->post_status == 'trash' ) return; // TODO: remove prestation reference from orders

		$orders = wc_get_orders( array(
			'limit'        => -1, // Query all orders
			'orderby'      => 'date',
			'order'        => 'ASC',
			'meta_key'     => 'prestation_id',
			'meta_value' => $prestation_id,
		) );

		$p_orders_total = 0;
		$p_orders_paid = 0;
		$p_orders_discount = 0;
		$p_orders_refunded = 0;
		$p_orders_subtotal = 0;

		$lines = [];
		foreach ($orders as $key => $order) {
			$tax = ($order->prices_include_tax == true) ? false : true;
			$payment_products = Prestations::get_option('prestations:woocommerce_payment_products');
			if(!is_array($payment_products)) $payment_products = [ $payment_products ];

			$p_order = array(
				'id' => $order->id,
				'source' => 'WooCommerce',
				'object' => __CLASS__,
				'created' => $order->get_date_created(),
				'subtotal' => ($tax == true) ? $order->get_subtotal() : (float)wp_strip_all_tags(preg_replace('/"woocommerce-Price-currencySymbol">[^<]*</', '><', $order->get_subtotal_to_display())),
				'discount' => $order->get_total_discount($tax),
				'refunded' => $order->get_total_refunded(),
				'total' => $order->get_total() - $order->get_total_refunded(),
				'paid' => NULL,
				'status' =>  $order->status,
				'view_url' => $order->get_view_order_url(),
				'edit_url' => $order->get_edit_order_url(),
			);
			$p_order['paid'] = ($order->get_date_paid()) ? $p_order['total'] : 0;

			foreach ( $order->get_items() as $item_id => $item ) {
				 $p_order['items'][] = array(
					 'product_id' => $item->get_product_id(),
					 'variation_id' => $item->get_variation_id(),
					 // 'product' => $item->get_product(), // see link above to get $product info
					 'product_name' => $item->get_name(),
					 // 'quantity' => $item->get_quantity(),
					 'subtotal' => $item->get_subtotal(),
					 'total' => $item->get_total(),
					 'tax' => $item->get_subtotal_tax(),
					 'tax_class' => $item->get_tax_class(),
					 'tax_status' => $item->get_tax_status(),
					 // 'allmeta' => $item->get_meta_data(),
					 // 'somemeta' => $item->get_meta( '_whatever', true ),
					 'item_type' => $item->get_type(), // e.g. "line_item"
				 );

				 if(in_array($item->get_product_id(), $payment_products)) {
					 $p_order['subtotal'] -= $item->get_subtotal();
					 $p_order['refunded'] -= $order->get_total_refunded_for_item($item_id);
					 $p_order['total'] = $p_order['total'] - $item->get_total() + $order->get_total_refunded_for_item($item_id);
				 }
			}

			$p_order['description'] = $p_order['items'][0]['product_name']
			. ( (count($p_order['items']) > 1) ? sprintf( __(' + %s items', 'prestations'), count($p_order['items']) - 1 ) : '' );

			$lines[] = $p_order;
			$p_orders[$order->id] = $p_order;

			$p_orders_subtotal += $p_order['subtotal'];
			$p_orders_discount += $p_order['discount'];
			$p_orders_refunded += $p_order['refunded'];
			$p_orders_total += $p_order['total'];
			$p_orders_paid += $p_order['paid'];
		}

		update_post_meta( $prestation_id, 'managed-woocommerce', array(
			'subtotal' => $p_orders_subtotal,
			'discount' => $p_orders_discount,
			'refunded' => $p_orders_refunded,
			'total' => $p_orders_total,
			'paid' => $p_orders_paid,
			// 'orders' => $p_orders,
			'rows' => $lines,
		) );

		$metas = get_post_meta($prestation_id, 'managed-woocommerce');
		// error_log(print_r($metas, true));
		// $metas['woocommerce'] = $lines;
		// foreach($metas as $key => $meta) {
		// 	if(!isset($meta['source']) || $meta['source'] == 'woocommerce') {
		// 		unset($meta[$key]);
		// 	}
		// }
		// // $metas = array_merge($metas, $p_orders);
		// $metas = $lines;

		// update_post_meta($prestation_id, 'managed', $metas);

		wp_cache_set(__CLASS__ . '-' . __FUNCTION__ . '-' . $prestation_id, true);
	}

	static function update_order_prestation($order_id, $order, $update ) {
		if( $order->post_type != 'shop_order' ) return;
		if( $order->post_status == 'trash' ) return; // TODO: update previously linked prestation

		remove_action(current_action(), __CLASS__ . '::wp_insert_post_action');

		$prestation_id = get_post_meta($order_id, 'prestation_id', true);
		$prestation = get_post($prestation_id);
		$customer_id = get_post_meta($order_id, '_customer_user', true);
		$customer = get_user_by('id', $customer_id);
		if($customer) {
			$customer_name = $customer->display_name;
			$customer_email = $customer->user_email;
			// error_log("customer " . print_r($customer, true));
		} else {
			$customer_name = trim(get_post_meta($order_id, '_billing_first_name', true) . ' ' . get_post_meta($order_id, '_billing_last_name', true));
			$customer_email = get_post_meta($order_id, '_billing_email', true);
		}

		if(empty($prestation_id) || ! $prestation) {
			$args = array(
				'post_type' => 'prestation',
				'post_status__in' => [ 'pending', 'on-hold', 'deposit', 'partial', 'unpaid', 'processing' ],
				'orderby' => 'post_date',
				'order' => 'desc',
			);
			if($customer) {
				$args['meta_query'] = array(
					array(
						'key' => 'customer_id',
						'value' => $customer_id,
					)
				);
			} else if (!empty($customer_email)) {
				$args['meta_query'] = array(
					'relation' => 'OR',
					array(
						'key' => 'customer_email',
						'value' => $customer_email,
					),
					array(
						'key' => 'guest_email',
						'value' => $customer_email,
					),
				);
			} else if (!empty($customer_name)) {
				$args['meta_query'] = array(
					'relation' => 'OR',
					array(
						'key' => 'customer_name',
						'value' => $customer_name,
					),
					array(
						'key' => 'guest_name',
						'value' => $customer_name,
					),
				);
			}
			$prestations = get_posts($args);
			if($prestations) {
				$prestation = $prestations[0];
				$prestation_id = $prestation->ID;
				// error_log("$prestation->ID $prestation->post_title " . print_r($prestation, true));
				// update_post_meta( $order_id, 'prestation_id', $prestation_id );
			}
		}

		if(empty($prestation_id) || ! $prestation) {
			$postarr = array(
				'post_author' => $order->post_author,
				'post_date' => $order->post_date,
				'post_date_gmt' => $order->post_date_gmt,
				'post_type' => 'prestation',
				'post_status' => 'publish',
				'meta_input' => array(
					'prestation_id' => $prestation_id,
					'customer_id' => $customer_id,
					'customer_name' => $customer_name,
					'customer_email' => $customer_email,
				),
			);
			$prestation_id = wp_insert_post($postarr);
			// update_post_meta( $order_id, 'prestation_id', $prestation_id );
			// foreach ($postarr['meta_input'] as $key => $value) update_post_meta( $order_id, $key, $value );
		}

		if(!empty($prestation_id)) {
			$meta = array(
				'prestation_id' => $prestation_id,
				'customer_id' => $customer_id,
				'customer_name' => $customer_name,
				'customer_email' => $customer_email,
			);
			foreach ($meta as $key => $value) update_post_meta( $order_id, $key, $value );
			Prestations_Prestation::update_prestation_amounts($prestation_id, get_post($prestation_id), true );
		}

		add_action(current_action(), __CLASS__ . '::wp_insert_post_action', 10, 3);
		return;
	}

	static function sync_orders($one = NULL, $two = NULL, $three = NULL) {
		if(isset($_REQUEST['woocommerce_sync_orders']) && $_REQUEST['woocommerce_sync_orders'] == true) {
			$orders = wc_get_orders( array(
				'limit'        => -1, // Query all orders
				'orderby'      => 'date',
				'order'        => 'ASC',
				// 'meta_key'     => 'prestation_id', // The postmeta key field
				// 'meta_compare' => 'NOT EXISTS', // The comparison argument
			));
			// error_log("found " . count($orders) . " order(s) without prestation");
			foreach ($orders as $key => $order) {
				$order_post = get_post($order->id);
				self::update_order_prestation($order_post->ID, $order_post, true);
			}
		}
	}

	static function get_managed_list_filter($html = '') {
		$title = __('WooCommerce', 'prestations');
		if(empty($list)) $list = __('Empty list', 'prestations');

		global $post;

		$data = get_post_meta($post->ID, 'managed-woocommerce', true);
		$data['columns'] = array(
			'id' => __('ID', 'prestations'),
			'description' => __('Description', 'prestations'),
			'created' => __('Date', 'prestations'),
			'subtotal' => __('Subtotal', 'prestations'),
			'discount' => __('Discount', 'prestations'),
			'refunded' => __('Refunded', 'prestations'),
			'total' => __('Total', 'prestations'),
			'paid' => __('Paid', 'prestations'),
			'status' => __('Status', 'prestations'),
			'actions' => '',
		);
		$data['format'] = array(
			'created' => 'date',
			'subtotal' => 'price',
			'discount' => 'price',
			'refunded' => 'price',
			'total' => 'price',
			'paid' => 'price',
			'status' => 'status',
		);

		$list = new Prestations_Table($data);

		$html .= sprintf('
		<div class="managed-list managed-list-woocommerce">
			<h3>%s</h3>
			%s
		</div>',
			$title,
			$list->render(),
		);
		return $html;
	}
}
