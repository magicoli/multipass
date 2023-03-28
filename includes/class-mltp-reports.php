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
						'mltp_administrator',
            'multipass-reports', // menu slug
            array( $this, 'render_page' ) // callback function
        );
    }

    public function render_page() {
			if ( ! current_user_can('manage_options') ) {
				wp_die( __('You do not have sufficient permissions to access this page.') );
			}

	    if ( isset( $_GET['action'] ) ) {
				$args = $_GET;
				if ( isset($_GET['nonce']) && wp_verify_nonce( $_GET['nonce'], 'multipass_export_csv' . $_GET['year'] ) ) {
					$args['result'] = "do it";
					do_action('mltp_download_csv', ( isset($_GET['year']) ? $_GET['year'] : null));
				} else {
					$args['result'] = "don't it";
				}
				error_log('got ' . print_r($args, true));
				wp_redirect( admin_url( 'admin.php?page=mltp_prestation_report' ) );
				exit;
			}

			$args = array(
				'post_type' => 'mltp_prestation',
				'posts_per_page' => -1,
			);

			$prestations = new WP_Query($args);

			if ($prestations->have_posts()) {
				$prestations_by_year = array();
				while ($prestations->have_posts()) {
					$prestations->the_post();
					// $dates = get_post_meta(get_the_ID(), 'dates', true);
					// $date_from = MultiPass::get_date_from( get_the_ID() );
					$date_from = get_post_meta(get_the_ID(), 'from', true);
					if( $date_from && is_numeric($date_from) ) {
						$year = date('Y', $date_from);

						if (!array_key_exists($year, $prestations_by_year)) {
							$prestations_by_year[$year] = array(
								'total' => 0,
								'discount' => 0,
								'paid' => 0,
								'due' => 0,
								'prestations' => array()
							);
						}
						// $prestations_by_year[$year][] = get_the_title();

						$discount = get_post_meta(get_the_ID(), 'discount', true);
						if( is_array($discount) ) {
							$discount = isset($discount['total']) ? $discount['total'] : null;
						}
						// if( is_array($deposit) {
						// 	error_log('deposit ' . print_r($deposit, true));
						// }
						$prestation = array(
							'title' => get_the_title(),
							'discount' => $discount,
							'total' => get_post_meta(get_the_ID(), 'total', true),
							// 'deposit' => get_post_meta(get_the_ID(), 'deposit', true),
							'paid' => get_post_meta(get_the_ID(), 'paid', true),
							'due' => (int)get_post_meta(get_the_ID(), 'due', true),
						);
						if(!is_numeric($prestation['due'])) {
							error_log('due ' . print_r($prestation['due'], true));
						}
						array_push($prestations_by_year[$year]['prestations'], $prestation);
						$prestations_by_year[$year]['discount'] += $prestation['discount'];
						$prestations_by_year[$year]['total'] += $prestation['total'];
						// $prestations_by_year[$year]['deposit'] += $prestation['deposit'];
						$prestations_by_year[$year]['paid'] += $prestation['paid'];
						$prestations_by_year[$year]['due'] += $prestation['due'];
					}
				}
				wp_reset_postdata();
			}
			krsort($prestations_by_year);

			wp_enqueue_style( 'mltp-report-styles', plugins_url( 'css/mltp-report-styles.css', __FILE__, [], time() ) );

			printf( '<h1>%s</h1>', __('Reports', 'multipass') );
		  echo '<table class="mltp-report-table">';
		  echo sprintf(
				'<tr><th>%s</th><th>%s</th><th>%s</th><th>%s</th><th class="actions">%s</th></tr>',
				__('Year', 'multipass'),
				__('Count', 'multipass'),
				__('Total', 'multipass'),
				// __('Discount', 'multipass'),
				__('Paid', 'multipass'),
				// __('Due', 'multipass'),
				'', // __('Download', 'multipass'),
			);


			$current_year = date('Y');

			foreach ( $prestations_by_year as $year => $prestations ) {
				echo '<tr' . (($year == $current_year) ? ' class="mltp-report-current-year"' : (($year > $current_year) ? ' class="mltp-report-future-year"' : '')) . '>';
				echo '<td>' . $year . '</td>';
				echo '<td class=number>' . count($prestations['prestations']) . '</td>';
				echo '<td class=number>' . ($prestations['total'] ? MultiPass::price($prestations['total']) : '') . '</td>';
				// echo '<td class=number>' . ($prestations['discount'] ? MultiPass::price($prestations['discount'], 2) : '') . '</td>';
				echo '<td class=number>' . ($prestations['paid'] ? MultiPass::price($prestations['paid']) : '') . '</td>';
				// echo '<td class=number>' . ($prestations['due'] ? MultiPass::price($prestations['due']) : '') . '</td>';
				printf(
					'<td class=actions><a href="%s" class=""><i class="dashicons dashicons-download"></i>%s</a></td></tr>',
					wp_nonce_url(
						add_query_arg( array(
							'action' => 'mltp_download_csv',
							'year'   => $year,
						)),
						'mltp_download_csv',
					),
					__('CSV', 'multipass'),
				);
			}

			echo '</table>';
		}

		public function process_action_request() {
			if ( isset( $_GET['action'] ) && $_GET['action'] === 'mltp_download_csv' ) {
				if ( ! current_user_can( 'mltp_administrator' ) ) {
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
			$args = array(
				'post_type'      => 'mltp_prestation',
				'post_status'    => 'publish',
				'posts_per_page' => -1,
				'meta_query'     => array(
					array(
						'key'     => 'from',
						'value'   => array(strtotime($year . '-01-01'), strtotime($year . '-12-31')),
						'compare' => 'BETWEEN',
						'type'    => 'NUMERIC',
					),
				),
			);

			$prestations = get_posts($args);
			if (!$prestations) {
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

			$output = fopen('php://output', 'w');

			fputcsv($output, array(
				__('Id', 'multipass'),
				__('Customer Name', 'multipass'),
				__('From', 'multipass'),
				__('To', 'multipass'),
				__('Subtotal', 'multipass'),
				__('Total', 'multipass'),
				__('Paid', 'multipass'),
				__('Due', 'multipass'),
				__('Status', 'multipass'),
			));

			// Add the prestation data to the CSV
			foreach ($prestations as $prestation) {
				$meta = get_post_meta($prestation->ID);

				$page_slug = get_permalink($meta['page_id'][0]);
				$customer_name = $meta['customer_name'][0];
				// $date_from = date_i18n(get_option('date_format'), $meta['from'][0]['from']);
				// $date_to = date_i18n(get_option('date_format'), $meta['from'][0]['to']);
				$subtotal = $meta['subtotal'][0];
				$total = $meta['total'][0];
				$paid = $meta['paid'][0];
				$due = $meta['due'][0];
				$status = $meta['status'][0];

				fputcsv($output, array(
					$page_slug,
					$customer_name,
					// $date_from,
					// $date_to,
					$subtotal,
					$total,
					$paid,
					$due,
					$status,
				));
			}

			// Close the output stream
			fclose($output);

			exit;
    }
}

$this->loaders[] = new Mltp_Report();
