<?php

class Mltp_Report {
	public function __construct() {
	}

	public function init() {
			add_action( 'admin_menu', array( $this, 'add_submenu_page' ) );
			add_action( 'admin_init', array( $this, 'process_action_request' ) );
	}

	public function add_submenu_page() {
		add_submenu_page(
			'multipass',
			__( 'Reports', 'multipass' ), // page title
			__( 'Reports', 'multipass' ), // menu title
			'mltp_manager',
			'multipass-reports', // menu slug
			array( $this, 'render_page' ) // callback function
		);
	}

	public function render_page() {
		if ( ! current_user_can( 'mltp_manager' ) ) {
			wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
		}

		if ( isset( $_GET['action'] ) ) {
				$args = $_GET;
			if ( isset( $_GET['nonce'] ) && wp_verify_nonce( $_GET['nonce'], 'multipass_export_csv' . $_GET['year'] ) ) {
				$args['result'] = 'do it';
				do_action( 'mltp_download_csv', ( isset( $_GET['year'] ) ? $_GET['year'] : null ) );
			} else {
				$args['result'] = "don't it";
			}
				// error_log( 'got ' . print_r( $args, true ) );
				wp_redirect( admin_url( 'admin.php?page=mltp_prestation_report' ) );
				exit;
		}

			$args = array(
				'post_type'      => 'mltp_prestation',
				'posts_per_page' => -1,
			);

			$prestations = new WP_Query( $args );

			if ( $prestations->have_posts() ) {
				$prestations_by_year = array();
				while ( $prestations->have_posts() ) {
					$prestations->the_post();
					// $dates = get_post_meta(get_the_ID(), 'dates', true);
					// $date_from = MultiPass::get_date_from( get_the_ID() );
					$date_from = get_post_meta( get_the_ID(), 'from', true );
					if ( $date_from && is_numeric( $date_from ) ) {
						$year = date( 'Y', $date_from );

						if ( ! array_key_exists( $year, $prestations_by_year ) ) {
							$prestations_by_year[ $year ] = array(
								'total'       => 0,
								'discount'    => 0,
								'paid'        => 0,
								'due'         => 0,
								'prestations' => array(),
							);
						}
						// $prestations_by_year[$year][] = get_the_title();

						$discount = get_post_meta( get_the_ID(), 'discount', true );
						if ( is_array( $discount ) ) {
							$discount = isset( $discount['total'] ) ? $discount['total'] : null;
						}
						// if( is_array($deposit) {
						// error_log('deposit ' . print_r($deposit, true));
						// }
						$prestation = array(
							'title'    => get_the_title(),
							'discount' => $discount,
							'total'    => get_post_meta( get_the_ID(), 'total', true ),
							// 'deposit' => get_post_meta(get_the_ID(), 'deposit', true),
							'paid'     => get_post_meta( get_the_ID(), 'paid', true ),
							'due'      => (int) get_post_meta( get_the_ID(), 'due', true ),
						);
						if ( ! is_numeric( $prestation['due'] ) ) {
							error_log( 'due ' . print_r( $prestation['due'], true ) );
						}
						array_push( $prestations_by_year[ $year ]['prestations'], $prestation );
						$prestations_by_year[ $year ]['discount'] += $prestation['discount'];
						$prestations_by_year[ $year ]['total']    += $prestation['total'];
						// $prestations_by_year[$year]['deposit'] += $prestation['deposit'];
						$prestations_by_year[ $year ]['paid'] += $prestation['paid'];
						$prestations_by_year[ $year ]['due']  += $prestation['due'];
					}
				}
				wp_reset_postdata();
			}
			krsort( $prestations_by_year );

			wp_enqueue_style( 'mltp-report-styles', plugins_url( 'css/mltp-report-styles.css', __FILE__, array(), time() ) );

			printf( '<h1>%s</h1>', __( 'Reports', 'multipass' ) );
			echo '<table class="mltp-report-table">';
			echo sprintf(
				'<tr><th>%s</th><th>%s</th><th>%s</th><th>%s</th><th class="actions">%s</th></tr>',
				__( 'Year', 'multipass' ),
				__( 'Count', 'multipass' ),
				__( 'Total', 'multipass' ),
				// __('Discount', 'multipass'),
				__( 'Paid', 'multipass' ),
				// __('Due', 'multipass'),
				'', // __('Download', 'multipass'),
			);

			$current_year = date( 'Y' );

		foreach ( $prestations_by_year as $year => $prestations ) {
			$link = add_query_arg(
				array(
					'post_type' => 'mltp_prestation',
					'year'      => $year,
				),
				admin_url( 'edit.php' )
			);
			echo '<tr' . ( ( $year == $current_year ) ? ' class="mltp-report-current-year"' : ( ( $year > $current_year ) ? ' class="mltp-report-future-year"' : '' ) ) . '>';
			echo '<td><a href="' . $link . '">' . $year . '</a></td>';
			echo '<td class=number>' . count( $prestations['prestations'] ) . '</td>';
			echo '<td class=number>' . ( $prestations['total'] ? MultiPass::price( $prestations['total'] ) : '' ) . '</td>';
			// echo '<td class=number>' . ($prestations['discount'] ? MultiPass::price($prestations['discount'], 2) : '') . '</td>';
			echo '<td class=number>' . ( $prestations['paid'] ? MultiPass::price( $prestations['paid'] ) : '' ) . '</td>';
			// echo '<td class=number>' . ($prestations['due'] ? MultiPass::price($prestations['due']) : '') . '</td>';
			printf(
				'<td class=actions><a href="%s" class=""><i class="dashicons dashicons-download"></i>%s</a></td></tr>',
				wp_nonce_url(
					add_query_arg(
						array(
							'action' => 'mltp_download_csv',
							'year'   => $year,
						)
					),
					'mltp_download_csv',
				),
				__( 'CSV', 'multipass' ),
			);
		}

			echo '</table>';
	}

	public function process_action_request() {
		if ( isset( $_GET['action'] ) && $_GET['action'] === 'mltp_download_csv' ) {
			if ( ! current_user_can( 'mltp_manager' ) ) {
				wp_die( 'You do not have permission to access this page.' );
			}
			if ( ! wp_verify_nonce( $_GET['_wpnonce'], 'mltp_download_csv' ) ) {
				wp_die( 'Security check failed. Please try again.' );
			}
			$year = isset( $_GET['year'] ) ? intval( $_GET['year'] ) : null;
			$this->download_csv( $year );
		}
	}

	private function download_csv( $year ) {

		$date_format_short = preg_match( '/^[Fm]/', get_option( 'date_format' ) ) ? 'm/d/Y' : 'd/m/Y';

			$args = array(
				'post_type'      => 'mltp_prestation',
				'post_status'    => 'publish',
				'posts_per_page' => -1,
				'order'          => 'ASC',
				'orderby'        => 'meta_value',
				'meta_key'       => 'from',
				'meta_query'     => array(
					array(
						'key'     => 'from',
						'value'   => array( strtotime( $year . '-01-01' ), strtotime( $year . '-12-31' ) ),
						'compare' => 'BETWEEN',
						'type'    => 'NUMERIC',
					),
				),
			);

			$prestations = get_posts( $args );
			if ( ! $prestations ) {
				MultiPass::delay_admin_notice(
					sprintf(
						__(
							'Nothing to export for year %s',
							'multipass',
						),
						$year,
					),
					'error',
				);
				exit( wp_redirect( remove_query_arg( array( 'action', 'year', '_wpnonce' ) ) ) );
			}

			$filename = 'prestations-' . $year . '.csv';
			header( 'Content-Type: text/csv' );
			header( 'Content-Disposition: attachment; filename="' . $filename . '"' );
			header( 'Pragma: no-cache' );
			header( 'Expires: 0' );

			$output = fopen( 'php://output', 'w' );

			$columns = array(
				'from'        => __( 'From', 'multipass' ),
				'to'          => __( 'To', 'multipass' ),
				'code'        => __( 'Booking code', 'multipass' ),
				'part_id'     => __( 'Part ID', 'multipass' ),
				'origin'      => __( 'Origin', 'multipass' ),
				'name'        => __( 'Name', 'multipass' ),
				'description' => __( 'Description', 'multipass' ),
				'guests'      => __( 'Guests', 'multipass' ),
				'adults'      => __( 'Adults', 'multipass' ),
				'children'    => __( 'Children', 'multipass' ),
				'subtotal'    => __( 'Subtotal', 'multipass' ),
				'part_paid'   => __( 'Part paid', 'multipass' ),
				'commission'  => __( 'Comm.', 'multipass' ),
				'total'       => __( 'Total', 'multipass' ),
				'paid'        => __( 'Paid', 'multipass' ),
				// 'refunded' => __('Refunded', 'multipass'),
				'balance'     => __( 'Balance', 'multipass' ),
				// 'status' => __('Status', 'multipass'),
			);
			fputcsv( $output, $columns );

			$sum_total   = 0;
			$sum_paid    = 0;
			$sum_balance = 0;

			// Add the prestation data to the CSV
			foreach ( $prestations as $prestation ) {
				$meta         = get_post_meta( $prestation->ID );
				$total        = empty( $meta['total'][0] ) ? 0 : $meta['total'][0];
				$paid         = empty( $meta['paid'][0] ) ? 0 : $meta['paid'][0];
				$balance      = empty( $meta['balance'][0] ) ? 0 : $meta['balance'][0];
				$sum_total   += $total;
				$sum_paid    += $paid;
				$sum_balance += $balance;

				$row = array_merge(
					array_fill_keys( array_keys( $columns ), null ),
					array(
						'code'    => $prestation->post_name, // get_permalink($meta['page_id'][0]);
						'name'    => array_shift(
							array_filter(
								array(
									$meta['contact_name'][0],
									$meta['customer_name'][0],
									$meta['display_name'][0],
								)
							)
						),
						'from'    => empty( $meta['from'][0] ) ? null : date_i18n( 'Y-m-d', MultiPass::timestamp( $meta['from'][0] ) ),
						'to'      => empty( $meta['to'][0] ) ? null : date_i18n( 'Y-m-d', MultiPass::timestamp( $meta['to'][0] ) ),
						// 'discount' => empty($discount) ? null : number_format_i18n($discount),
						'total'   => empty( $total ) ? null : number_format_i18n( $total, 2 ),
						'paid'    => empty( $paid ) ? null : number_format_i18n( $paid, 2 ),
						// 'refunded' => number_format_i18n($meta['refunded'][0], 2),
						'balance' => empty( $balance ) ? null : number_format_i18n( $balance, 2 ),
					)
				);
				// $status = $prestation->post_status;

				fputcsv( $output, $row );

				$elements = get_posts(
					array(
						'post_type'      => 'mltp_detail',
						'post_status'    => 'publish',
						'posts_per_page' => -1,
						'meta_key'       => 'from',
						'meta_type'      => 'NUMERIC',
						'order_by'       => 'meta_value_num',
						'order'          => 'ASC',
						'meta_query'     => array(
							array(
								'key'   => 'prestation_id',
								'value' => $prestation->ID,
							),
						),
					)
				);
				foreach ( $elements as $element ) {
					$e_meta    = get_post_meta( $element->ID );
					$attendees = isset( $e_meta['attendees'][0] ) ? $e_meta['attendees'][0] : array();
					if ( is_string( $attendees ) ) {
						if ( is_array( unserialize( $attendees ) ) ) {
								$attendees = unserialize( $attendees );
						}
					}
					$attendees           = array_merge(
						array(
							'total'    => null,
							'adults'   => null,
							'children' => null,
						),
						$attendees
					);
					$attendees['adults'] = preg_replace( '/^([0-9]+)<.*/', '\\1', $attendees['adults'] );
					$commission          = isset( $e_meta['commission'][0] ) ? $e_meta['commission'][0] : 0;
					if ( empty( $commission ) ) {
						$commission = 0;
						$payments   = isset( $e_meta['payment'][0] ) ? $e_meta['payment'][0] : array();
						if ( is_string( $payments ) ) {
							$payments = unserialize( $payments );
						}
						foreach ( $payments as $payment ) {
							if ( isset( $payment['method'] ) && preg_match( '/commission/', $payment['method'] ) ) {
								$commission += $payment['amount'];
							}
						}
					}
					$e_row = array_merge(
						array_fill_keys( array_keys( $columns ), null ),
						array(
							'code'        => $prestation->post_name,
							'part_id'     => $element->ID,
							'origin'      => ( isset( $e_meta['origin'][0] ) && in_array( $e_meta['origin'][0], array( 'airbnb', 'booking', 'bookingcom' ) ) ) ? $e_meta['origin'][0] : '',
							'description' => empty( $e_meta['description'][0] ) ? $element->post_title : $e_meta['description'][0],
							'from'        => empty( $e_meta['from'][0] ) ? null : date_i18n( 'Y-m-d', MultiPass::timestamp( $e_meta['from'][0] ) ),
							'to'          => empty( $e_meta['to'][0] ) ? null : date_i18n( 'Y-m-d', MultiPass::timestamp( $e_meta['to'][0] ) ),
							'subtotal'    => empty( $e_meta['total'][0] ) ? null : number_format_i18n( $e_meta['total'][0], 2 ),
							'commission'  => empty( $commission ) ? null : number_format_i18n( (float) $commission, 2 ),
							'guests'      => empty( $attendees['total'] ) ? null : $attendees['total'],
							'adults'      => empty( $attendees['adults'] ) ? null : $attendees['adults'],
							'children'    => empty( $attendees['children'] ) ? null : $attendees['children'],
							'part_paid'   => empty( $e_meta['paid'][0] ) ? null : number_format_i18n( $e_meta['paid'][0], 2 ),
						// 'refunded' => number_format_i18n($e_meta['refunded'][0], 2),
						// 'balance' => number_format_i18n($e_meta['balance'][0], 2),
						)
					);
					fputcsv( $output, $e_row );
				}
			}

			$t_row = array_merge(
				array_fill_keys( array_keys( $columns ), null ),
				array(
					'from'    => '               ', // avoid truncated date on csv import
					'to'      => '               ', // avoid truncated date on csv import
					'name'    => __( 'Grand total', 'multipass' ),
					// 'subtotal' => number_format_i18n($meta['subtotal'][0], 2),
					'total'   => number_format_i18n( $sum_total, 2 ),
					'paid'    => number_format_i18n( $sum_paid, 2 ),
					// 'refunded' => number_format_i18n($meta['refunded'][0], 2),
					'balance' => number_format_i18n( $sum_balance, 2 ),
				)
			);
		fputcsv( $output, $t_row );

			// Close the output stream
			fclose( $output );

			exit;
	}
}

$this->loaders[] = new Mltp_Report();
