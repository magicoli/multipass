<?php
/**
 * Register all actions and filters for the plugin
 *
 * @link       https://github.com/magicoli/multipass
 * @since      0.1.0
 *
 * @package    MultiPass
 * @subpackage MultiPass/includes
 */

/**
 * Register all actions and filters for the plugin.
 *
 * Maintain a list of all hooks that are registered throughout
 * the plugin, and register them with the WordPress API. Call the
 * run function to execute the list of actions and filters.
 *
 * @package    MultiPass
 * @subpackage MultiPass/includes
 * @author     Magiiic <info@magiiic.com>
 */
class Mltp_PDF extends Mltp_Loader {

	protected $actions;
	protected $filters;

	public function __construct() {
	}

	public function init() {

		$this->actions = array(
			array(
				'hook' => 'wp',
				'callback' => 'remove_post_meta',
			),
			array(
				'hook' => 'template_redirect',
				'callback' => 'view_mltp_prestation_as_pdf',
			),
			array(
				'hook' => 'manage_mltp_prestation_posts_custom_column',
				'callback' => 'display_pdf_link_in_mltp_prestation_column',
				'accepted_args' => 2,
			),
			array(
				'hook' => 'wp_enqueue_scripts',
				'callback' => 'load_font_awesome',
			),
		);

		$this->filters = array(
			array(
				'hook' => 'manage_mltp_prestation_posts_columns',
				'callback' => 'add_pdf_column_to_mltp_prestation',
			),

			array(
				'hook' => 'query_vars',
				'callback' => 'register_view_query_arg',
			),
		);

		$this->register_hooks();
	}

	function remove_post_meta() {
	    if ( 'mltp_prestation' === get_post_type() ) {
	        remove_action( 'entry_meta', 'entry_date', 12 );
	        remove_action( 'entry_meta', 'entry_author', 20 );
	    }
	}

	function load_font_awesome() {
		wp_enqueue_script( 'font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js', array(), '5.15.3' );
	}

	function register_view_query_arg( $vars ) {
		$vars[] = 'view';
		return $vars;
	}

	function add_pdf_link_to_mltp_prestation( $permalink, $post ) {
		if ( 'mltp_prestation' === $post->post_type ) {
			$pdf_link = add_query_arg( array( 'view' => 'pdf' ), $permalink );
			// $icon = '<i class="fa-regular fa-file-pdf"></i>';
			$icon = '<span class="dashicons dashicons-pdf"></span>';
			$link_text = $icon;

			return sprintf(
				'<a href="%s" title="%s" target="_blank">%s</a>',
				esc_url( $pdf_link ),
				'PDF',
				$link_text,
			);
		}

		return $permalink;
	}

	function add_pdf_column_to_mltp_prestation( $columns ) {
		$columns['pdf_link'] = 'View';
		return $columns;
	}

	function display_pdf_link_in_mltp_prestation_column( $column_name, $post_id ) {
	    if ( 'pdf_link' === $column_name ) {
	        $permalink = get_permalink( $post_id );
	        echo $this->add_pdf_link_to_mltp_prestation( $permalink, get_post( $post_id ) );
	    }
	}


	// function add_pdf_link_to_mltp_prestation( $actions, $post ) {
	//
	// 	if ($post->post_type == 'mltp_prestation') {
	// 		if ( ! class_exists( 'Mpdf\Mpdf' ) ) {
	// 			error_log("class not loaded");
	// 			return $actions;
	// 		}
	//
	// 		$pdf_url = add_query_arg( array( 'view' => 'pdf' ), get_post_permalink($post) );
	// 		$pdf_link = '<a href="' . $pdf_url . '" target="_blank">View as PDF</a>';
	//
	// 		$actions['view_as_pdf'] = $pdf_link;
	// 	}
	// 	return $actions;
	// }

	function view_mltp_prestation_as_pdf() {
	    global $wp_query;

			if ( isset( $wp_query->query_vars['view'] ) && 'pdf' === $wp_query->query_vars['view'] ) {
				$post = get_post();

				$mpdf = new \Mpdf\Mpdf();

				// Generate the PDF content
				$html = '<h1>' . get_the_title() . '</h1>';
				$html .= '<div>' . get_the_content() . '</div>';

				$mpdf->WriteHTML( $html );
				$mpdf->Output( $post->post_name . '.pdf', 'D' );
				exit;
			}
		}
	}

	$this->loaders[] = new Mltp_PDF();
