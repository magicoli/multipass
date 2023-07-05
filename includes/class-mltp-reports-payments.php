<?php

class Mltp_Payments_Report {
	public function __construct() {
	}

	public function init() {
		add_action( 'admin_menu', array( $this, 'add_submenu_page' ) );
			add_action( 'admin_init', array( $this, 'process_action_request' ) );
	}

	public function add_submenu_page() {
		add_submenu_page(
			'multipass',             // parent slug
			'Payments',              // page title
			'Payments',              // menu title
			'manage_options',        // capability
			'multipass-payments',    // menu slug
			[ $this, 'display_multipass_payments_page' ], // callback function to display the page
		);
	}

	function get_payments() {
		global $wpdb;

		$prestations_query = "SELECT p.ID, p.post_title, p.post_date, m.meta_value AS payment_data, p.post_type
		FROM {$wpdb->posts} p
		INNER JOIN {$wpdb->postmeta} m ON p.ID = m.post_id
		WHERE p.post_type = 'mltp_prestation'
		AND m.meta_key = 'manual_items'"; // Replace 'manual_operations' with the actual meta_key for the group field in mltp_prestation post type

		// Retrieve payment data from mltp_prestation_detail post type
		$prestation_details_query = "SELECT p.ID, p.post_title, p.post_date, m.meta_value AS payment_data, p.post_type
		FROM {$wpdb->posts} p
		INNER JOIN {$wpdb->postmeta} m ON p.ID = m.post_id
		WHERE p.post_type = 'mltp_detail'
		AND m.meta_key = 'payment'"; // Replace 'payment' with the actual meta_key for the group field in mltp_detail post type

		// Combine and sort the payment data
		$items_query = "SELECT * FROM (($prestations_query) UNION ALL ($prestation_details_query)) AS payments
		ORDER BY payments.post_date";

		$items = $wpdb->get_results($items_query);

		$payments = [];
		foreach ($items as $item) {
			$item_data = unserialize($item->payment_data);

			$item_date = strtotime( $item->post_date );
			$amount = '';
			$itemMethodOrComment = '';
			$relatedPostID = $item->ID;
			$relatedPostTitle = $item->post_title;

			// If the post type is 'mltp_detail', get the related post ID and title from 'prestation_id' field
			if ($item->post_type === 'mltp_detail') {
				$relatedPostID = get_post_meta($relatedPostID, 'prestation_id', true);
				$relatedPostTitle = get_the_title($relatedPostID);
			}

			// Loop through the payment group to find the payment entry
			foreach ($item_data as $entry) {
				if ( ( isset($entry['type']) && $entry['type'] === 'payment' ) || !empty($entry['amount'])) {
					$from = get_post_meta($relatedPostID, 'from', true);
					$to = get_post_meta($relatedPostID, 'to', true);

					$entry = array_merge( array(
						'description' => null,
						'method' => null,
						'reference' => null,
					), $entry );
					if($item->post_type == 'mltp_detail') {
						$amount = $entry['amount'];
						$description = join(' / ', array_filter(array(
							$entry['method'],
							$entry['reference']
						)));
						$pay_date = (!empty($entry['date'])) ? MultiPass::timearray_to_time($entry['date']) : null;
					} else {
						$amount = $entry['paid'];
						$description = $entry['description'];
						$pay_date = (!empty($entry['from'])) ? MultiPass::timearray_to_time($entry['from']) : null;
					}
					$pay_date = empty( $pay_date ) ? $item_date : $pay_date;

					$payments[] = array(
						'date' => $pay_date,
						'description' => $description,
						'amount' => $amount,
						'prestation' => '<a href="' . get_permalink($relatedPostID) . '">' . $relatedPostTitle . '</a>',
						'from' => $from,
						'to' => $to,
					);
				}
			}
		}

		return $payments;
	}

	function display_multipass_payments_page() {
		global $wpdb;

		// Retrieve payment data from mltp_prestation post type
		$payments = self::get_payments();

		// Display the payment list as a table
		echo '<div class="wrap">';
		echo '<h1>Payments</h1>';

    echo '<a href="' . esc_url( add_query_arg( 'action', 'mltp_download_csv' ) ) . '" class="button">' . esc_html( 'Download CSV' ) . '</a>';
		
		echo '<table class="wp-list-table widefat fixed striped">';
		echo '<thead><tr>';
		echo '<th>' . __('Payment Date', 'multipass') . '</th>';
		echo '<th>' . __('Description', 'multipass') . '</th>';
		echo '<th>' . __('Amount', 'multipass') . '</th>';
		echo '<th>' . __('Prestation', 'multipass') . '</th>';
		echo '<th>' . __('Prestation Dates', 'multipass') . '</th>';
		echo '</tr></thead>';
		echo '<tbody>';

		foreach ($payments as $payment) {
			// list($date, $description, $amount, $prestation, $from, $to) = $payment;
			extract($payment);
			echo '<tr>';
			echo '<td>' . MultiPass::format_date( $date ) . '</td>';
			echo '<td>' . $description . '</td>';
			echo '<td>' . MultiPass::price($amount) . '</td>';
			echo '<td>' . $prestation . '</td>';
			echo '<td>' . MultiPass::format_date_range( array( 'from' => $from, 'to' => $to ) ) . '</td>';
			echo '</tr>';
		}

		echo '</tbody>';
		echo '</table>';
		echo '</div>';
	}

	public function process_action_request() {
		// if ( isset( $_GET['action'] ) && $_GET['action'] === 'mltp_download_csv' ) {
		// 	if ( ! current_user_can( 'mltp_manager' ) ) {
		// 		wp_die( 'You do not have permission to access this page.' );
		// 	}
		// 	if ( ! wp_verify_nonce( $_GET['_wpnonce'], 'mltp_download_csv' ) ) {
		// 		wp_die( 'Security check failed. Please try again.' );
		// 	}
		// 	$year = isset( $_GET['year'] ) ? intval( $_GET['year'] ) : null;
		// 	$this->download_csv( $year );
		// }
	}

}

$this->loaders[] = new Mltp_Payments_Report();
