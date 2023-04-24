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

class Mltp_Rates extends Mltp_Loader {

	protected $actions;
	protected $filters;

	public function __construct() {
		$this->multiply_options = array(
			'quantity'   => __( 'quantity', 'multipass' ),
			'nights'   => __( 'night', 'multipass' ),
			'guests'   => __( 'guest', 'multipass' ),
			// 'adults'   => __( 'adult', 'multipass' ),
			// 'children' => __( 'child', 'multipass' ),
			// 'babies'   => __( 'baby', 'multipass' ),
		);
		$this->guest_types = array(
			'adults'   => __( 'adult', 'multipass' ),
			'children' => __( 'child', 'multipass' ),
			'babies'   => __( 'baby', 'multipass' ),
		);
	}

	public function init() {

		$this->actions = array(
			array(
				'hook'     => 'init',
				'callback' => 'register_post_types',
			),
			array(
				'hook'          => 'save_post', // use save_post because save_post_{$post_type} is fired before meta values are saved.
				'callback'      => 'save_post_action',
				'accepted_args' => 3,
			),
			array(
				'hook'          => 'manage_posts_custom_column',
				'callback'      => 'populate_admin_columns',
				'accepted_args' => 2,
			),
		);

		$this->filters = array(
			array(
				'hook'     => 'rwmb_meta_boxes',
				'callback' => 'register_fields',
			),
			array(
				'hook'     => 'manage_mltp_rate_posts_columns',
				'callback' => 'add_admin_columns',
			),
		);

		// add_action( 'quick_edit_custom_box',  'quick_edit_fields', 10, 2 );
		// add_action( 'save_post', 'quick_edit_save' );

		$this->register_hooks();
	}

	function register_post_types() {
		$labels = array(
			'name'                     => esc_html__( 'Rates', 'multipass' ),
			'singular_name'            => esc_html__( 'Rate', 'multipass' ),
			'add_new'                  => esc_html__( 'Add New', 'multipass' ),
			'add_new_item'             => esc_html__( 'Add New Rate', 'multipass' ),
			'edit_item'                => esc_html__( 'Edit Rate', 'multipass' ),
			'new_item'                 => esc_html__( 'New Rate', 'multipass' ),
			'view_item'                => esc_html__( 'View Rate', 'multipass' ),
			'view_items'               => esc_html__( 'View Rates', 'multipass' ),
			'search_items'             => esc_html__( 'Search Rates', 'multipass' ),
			'not_found'                => esc_html__( 'No rates found.', 'multipass' ),
			'not_found_in_trash'       => esc_html__( 'No rates found in Trash.', 'multipass' ),
			'parent_item_colon'        => esc_html__( 'Parent Rate:', 'multipass' ),
			'all_items'                => esc_html__( 'Rates and Taxes', 'multipass' ),
			'archives'                 => esc_html__( 'Rate Archives', 'multipass' ),
			'attributes'               => esc_html__( 'Rate Attributes', 'multipass' ),
			'insert_into_item'         => esc_html__( 'Insert into rate', 'multipass' ),
			'uploaded_to_this_item'    => esc_html__( 'Uploaded to this rate', 'multipass' ),
			'featured_image'           => esc_html__( 'Featured image', 'multipass' ),
			'set_featured_image'       => esc_html__( 'Set featured image', 'multipass' ),
			'remove_featured_image'    => esc_html__( 'Remove featured image', 'multipass' ),
			'use_featured_image'       => esc_html__( 'Use as featured image', 'multipass' ),
			'menu_name'                => esc_html__( 'Rates and Taxes', 'multipass' ),
			'filter_items_list'        => esc_html__( 'Filter rates list', 'multipass' ),
			'filter_by_date'           => esc_html__( 'Filter by date', 'multipass' ),
			'items_list_navigation'    => esc_html__( 'Rates list navigation', 'multipass' ),
			'items_list'               => esc_html__( 'Rates list', 'multipass' ),
			'item_published'           => esc_html__( 'Rate published.', 'multipass' ),
			'item_published_privately' => esc_html__( 'Rate published privately.', 'multipass' ),
			'item_reverted_to_draft'   => esc_html__( 'Rate reverted to draft.', 'multipass' ),
			'item_scheduled'           => esc_html__( 'Rate scheduled.', 'multipass' ),
			'item_updated'             => esc_html__( 'Rate updated.', 'multipass' ),
			'text_domain'              => esc_html__( 'multipass', 'multipass' ),
		);
		$args   = array(
			'label'               => esc_html__( 'Rates', 'multipass' ),
			'labels'              => $labels,
			'description'         => '',
			'public'              => false,
			'hierarchical'        => false,
			'exclude_from_search' => true,
			'publicly_queryable'  => false,
			'show_ui'             => true,
			'show_in_nav_menus'   => true,
			'show_in_admin_bar'   => true,
			'show_in_rest'        => true,
			'query_var'           => true,
			'can_export'          => true,
			'delete_with_user'    => true,
			'has_archive'         => false,
			'rest_base'           => '',
			'show_in_menu'        => 'multipass',
			'menu_icon'           => 'dashicons-money-alt',
			'capability_type'     => 'page',
			'supports'            => array( 'title' ),
			'taxonomies'          => array(),
			'rewrite'             => array(
				'slug'       => 'rates',
				'with_front' => false,
			),
		);

		register_post_type( 'mltp_rate', $args );

		register_post_status(
			'expired',
			array(
				'label'                     => __( 'expired', 'multipass' ),
				'label_count'               => _n_noop(
					'Expired <span class="count">(%s)</span>',
					'Expired <span class="count">(%s)</span>',
				),
				// 'public' => true,
				'show_in_admin_status_list' => true,
			)
		);
	}

	function options_percent_of() {
		$options    = array();
		$query_args = array(
			'post_type'   => 'mltp_rate',
			'numberposts' => -1,
			'orderby'     => 'post_date',
			'order'       => 'asc',
			'meta_query'  => array(
				'relation' => 'AND',
				array(
					'key'   => 'type',
					'value' => array( 'rate' ),
				),
				array(
					'key'   => 'unit',
					'value' => 'currency',
				),
			),
		);
		$posts      = get_posts( $query_args );
		foreach ( $posts as $post ) {
			$options[ $post->ID ] = get_the_title( $post->ID );
		}
		return $options;
	}

	public static function save_post_action( $post_id, $post, $update ) {
		if ( 'mltp_rate' !== $post->post_type ) {
			return;
		}

		if ( get_post_meta( $post_id, 'repeat', true ) ) {
			return;
		}
		// $post = get_post($post_id);
		$dates = get_post_meta( $post_id, 'dates' );
		if ( empty( $dates ) ) {
			if ( 'expired' === $post_status ) {
				$post_status = 'publish';
			} else {
				return;
			}
		} else {
			$to = array();
			foreach ( $dates as $key => $date ) {
				if ( isset( $date['to'] ) ) {
					$to[] = MultiPass::timestamp( $date['to'] );
				}
			}
			$to = array_filter( $to );

			$expired     = ( empty( $to ) ) ? false : ( max( $to ) + 86400 <= current_time( 'timestamp' ) );
			$post_status = ( $expired ) ? 'expired' : 'publish';
		}

		if ( $post_status === $post->post_status ) {
			return;
		}

		remove_action( current_action(), __CLASS__ . '::' . __FUNCTION__ );

		wp_update_post(
			array(
				'ID'          => $post_id,
				'post_status' => $post_status,
			)
		);

		add_action( current_action(), __CLASS__ . '::' . __FUNCTION__, 10, 3 );
	}

	function register_fields( $meta_boxes ) {
		$prefix = '';

		$meta_boxes[] = array(
			'title'      => __( 'Rates', 'multipass' ),
			'id'         => 'rates',
			'post_types' => array( 'mltp_rate' ),
			'style'      => 'seamless',
			'fields'     => array(
				array(
					'name'     => __( 'Type', 'multipass' ),
					'id'       => $prefix . 'type',
					'type'     => 'button_group',
					'options'  => array(
						'rate'     => __( 'Rate', 'multipass' ),
						'discount' => __( 'Discount', 'multipass' ),
						'extra'    => __( 'Extra', 'multipass' ),
						'tax'      => __( 'Tax', 'multipass' ),
					),
					'std'      => 'rate',
					'required' => true,
					// 'admin_columns' => [
					// 'position'   => 'after title',
					// 'sort'       => true,
					// 'searchable' => true,
					// 'filterable' => true,
					// 'link'       => 'view',
					// ],
				),
				array(
					'name'              => __( 'Stay dates', 'multipass' ),
					'id'                => $prefix . 'dates',
					'type'              => 'group',
					'clone'             => true,
					'clone_as_multiple' => true,
					'class'             => 'inline',
					'fields'            => array(
						array(
							'name'      => __( 'From', 'multipass' ),
							'id'        => $prefix . 'from',
							'type'      => 'date',
							'timestamp' => true,
						),
						array(
							'name'      => __( 'To', 'multipass' ),
							'id'        => $prefix . 'to',
							'type'      => 'date',
							'timestamp' => true,
						),
						array(
							'name'      => __( 'Repeat', 'multipass' ),
							'id'        => $prefix . 'repeat',
							'type'      => 'switch',
							'style'     => 'rounded',
							'on_label'  => 'Yes',
							'off_label' => 'No',
						),
					),
				),
				[
						'name'   => __( 'Booking time', 'multipass' ),
						'id'     => $prefix . 'booking_time',
						'type'   => 'group',
						'class'  => 'inline',
						'fields' => [
								[
										'name'   => __( 'Maximum', 'multipass' ),
										'id'     => $prefix . 'max',
										'type'   => 'number',
										'size'   => 5,
										'append' => 'days before stay',
								],
								[
										'name'    => __( 'From (date)', 'multipass' ),
										'id'      => $prefix . 'from_date',
										'type'    => 'date',
										'visible' => [
												'when'     => [['max', '=', ''], ['from_date', '!=', '']],
												'relation' => 'or',
										],
								],
								[
										'type'       => 'divider',
										'save_field' => false,
								],
								[
										'name'   => __( 'Minimum', 'multipass' ),
										'id'     => $prefix . 'min',
										'type'   => 'number',
										'size'   => 5,
										'append' => 'days before stay',
								],
								[
										'name'    => __( 'To (date)', 'multipass' ),
										'id'      => $prefix . 'to_date',
										'type'    => 'date',
										'visible' => [
												'when'     => [['booking_time_min', '=', '']],
												'relation' => 'or',
										],
								],
						],
				],
				array(
					'name'              => __( 'Rules', 'multipass' ),
					'id'                => $prefix . 'rules',
					'type'              => 'group',
					'clone'             => true,
					'clone_default'     => true,
					'clone_as_multiple' => true,
					// 'admin_columns'     => 'after type',
					'class'             => 'inline',
					'fields'            => array(
						array(
							'name' => __( 'Amount', 'multipass' ),
							'id'   => $prefix . 'amount',
							'type' => 'number',
							'step' => 'any',
						),
						array(
							'name'     => __( 'Unit', 'multipass' ),
							'id'       => $prefix . 'unit',
							'type'     => 'button_group',
							'sdt' => 'currency',
							'options'  => array(
								'percent'  => __( '%', 'multipass' ),
								'currency' => MultiPass::get_currency_symbol(),
							),
							'required' => true,
						),
						array(
							'name'        => __( 'Percent of', 'multipass' ),
							'id'          => $prefix . 'percent_of',
							'type'        => 'select',
							// 'type'        => 'post',
							// 'post_type'   => ['mltp_rate'],
							// 'field_type'  => 'select_advanced',
							'options'     => $this->options_percent_of(),

							'placeholder' => __( 'Total price', 'multipass' ),
							'visible'     => array(
								'when'     => array( array( 'unit', '=', 'percent' ) ),
								'relation' => 'or',
							),
						),
						array(
							'name'     => __( 'Multiply by', 'multipass' ),
							'id'       => $prefix . 'multiply_by',
							'type'     => 'button_group',
							'options'  => array(
								'guests'   => __( 'guests', 'multipass' ),
								'nights'   => __( 'nights', 'multipass' ),
								// 'quantity' => __( 'quantity', 'multipass' ),
							),
							// 'std'     => 'nights',
							'multiple' => true,
							'visible'  => array(
								'when'     => array( array( 'unit', '=', 'currency' ) ),
							),
						),
						array(
							'name'     => __( 'Restrict guests to', 'multipass' ),
							'id'       => $prefix . 'multiply_restrict',
							'type'     => 'button_group',
							'options'  => $this->guest_types,
							// 'std'     => 'nights',
							'multiple' => true,
							'visible'  => array(
								'when'     => array( array( 'multiply_by', 'match', 'guests' ) ),
							),
						),
						array(
							'name'       => __( 'Apply to', 'multipass' ),
							'id'         => $prefix . 'category',
							'type'       => 'taxonomy_advanced',
							'taxonomy'   => array( 'resource-type' ),
							'field_type' => 'select_advanced',
							'multiple'   => true,
						),
						array(
							'name'       => __( 'Resource', 'multipass' ),
							'id'         => $prefix . 'resource',
							'type'       => 'post',
							'field_type' => 'select_advanced',
							'visible'    => array(
								'when'     => array( array( 'category', '=', '' ) ),
								'relation' => 'or',
							),
						),
					),
				),
			),
		);

		return $meta_boxes;
	}

	// add new columns
	function add_admin_columns( $column_array ) {
		$i               = array_search( 'title', array_keys( $column_array ) ) + 1;
		$columns         = array_merge(
			array_slice( $column_array, 0, $i ),
			array(
				// 'type' => __('Type', 'multipass'),
				'dates' => __( 'Dates of stay', 'multipass' ),
				// 'dates' => __('Dates of stay', 'multipass'),
				'rules' => __( 'Rules', 'multipass' ),
			),
			array_slice( $column_array, $i ),
		);
		$columns['date'] = __( 'Publication', 'multipass' );

		// $columns[] = array_shift($column_array);
		// $columns[] = array_shift($column_array);
		// $columns = array_merge($columns, $column_array);
		// error_log(print_r($columns, true));

		return $columns;
	}

	// Populate our new columns with data
	function populate_admin_columns( $column_name, $post_id ) {

		// if you have to populate more that one columns, use switch()
		switch ( $column_name ) {
			case 'dates': {
				$dates  = get_post_meta( $post_id, 'dates' );
				$output = '';
				foreach ( $dates as $key => $date ) {
					if ( ! empty($date['from']) && ! empty( MultiPass::timestamp( $date['from'] ) ) ) {
						$output .= '<li>' . MultiPass::format_date_range( $date ) . '</li>';
					}
				}
				if ( ! empty( $output ) ) {
					echo '<ul>' . $output . '</ul>';
				}
				break;
			}

			case 'rules': {
				$unit       = rwmb_meta( 'unit' );
				$percent_of = rwmb_meta( 'percent_of' );
				$rules      = rwmb_meta( 'rules' );
				foreach ( $rules as $rule ) {

					// Field category:
					$term_ids = $rule['category'] ?? array();
					$terms    = array();
					foreach ( $term_ids as $term_id ) {
						$term = get_term( $term_id );
						if ( $term && ! is_wp_error( $term ) ) {
							$terms[] = sprintf(
								'<a href="%s">%s</a>',
								get_term_link( $term ),
								$term->name,
							);
						}
					}
					$resource = empty( $rule['resource'] ) ? '' : get_the_title( $rule['resource'] );

					if ( 'percent' === $unit ) {
						if ( empty( $percent_of ) ) {
							$amount = sprintf(
								__( '%s%% of price', 'multipass' ),
								$rule['amount'],
							);
						} else {
							$amount = sprintf(
								__( '%1$s%% of %2$s rate', 'multipass' ),
								$rule['amount'],
								get_the_title( $percent_of ),
							);
						}
					} else {
						$amount = MultiPass::price( $rule['amount'] );
					}
					// $amount = ('percent' === $unit) ? sprintf(
					// __('%s%% of %s', 'multipass'),
					// $rule[ 'amount' ],
					// (empty($percent_of) ? __('price', 'multipass') : get_the_title( $percent_of ) ),
					// ) : MultiPass::price( $rule[ 'amount' ] );

					$multiply = array();
					if ( ! empty( $rule['multiply_by'] ) ) {
						$guests = array();
						foreach ( $rule['multiply_by'] as $value ) {
							$multiply[$value] = empty($this->multiply_options[$value]) ? $value : $this->multiply_options[$value];
						}
						if( ! empty($multiply['guests']) ) {
							foreach ( $rule['multiply_restrict'] as $value ) {
									$guests[ $value ] = isset($this->guest_types[ $value ]) ? $this->guest_types[ $value ] : $value;
							}
							if ( ! empty( $guests ) ) {
								$multiply['guests'] = join( ' ' . __( 'or', 'multipass' ) . ' ', $guests );
								// $guests = array( $multiply['guests'] );
							}
						}
						$multiply           = array_filter( $multiply );
					}
					$rules_output[] = sprintf(
						'<strong>%s %s</strong>%s%s',
						join( ', ', $terms ),
						$resource,
						$amount,
						( ! empty( $multiply ) ? ' / ' . join( ' / ', $multiply ) : '' ),
					);
				}
				echo empty( $rules_output ) ? '' : '<ul><li>' . join( '</li><li>', $rules_output ) . '</li></ul>';
				break;
			}
		}
	}

	// quick_edit_custom_box allows to add HTML in Quick Edit
	function quick_edit_fields( $column_name, $post_type ) {

		switch ( $column_name ) {
			case 'price': {
				?>
				<fieldset class="inline-edit-col-left">
					<div class="inline-edit-col">
						<label>
							<span class="title">Price</span>
							<input type="text" name="price">
						</label>
					</div>
					<?php
					break;
			}
			case 'featured': {
				?>
					<div class="inline-edit-col">
						<label>
							<input type="checkbox" name="featured"> Featured product
						</label>
					</div>
				</fieldset>
				<?php
				break;
			}
		}
	}

	// save fields after quick edit
	function quick_edit_save( $post_id ) {

		// check inlint edit nonce
		if ( ! wp_verify_nonce( $_POST['_inline_edit'], 'inlineeditnonce' ) ) {
			return;
		}

		// update the price
		$price = ! empty( $_POST['price'] ) ? absint( $_POST['price'] ) : 0;
		update_post_meta( $post_id, 'product_price', $price );

		// update checkbox
		$featured = ( isset( $_POST['featured'] ) && 'on' == $_POST['featured'] ) ? 'yes' : 'no';
		update_post_meta( $post_id, 'product_featured', $featured );

	}
}

$this->loaders[] = new Mltp_Rates();
