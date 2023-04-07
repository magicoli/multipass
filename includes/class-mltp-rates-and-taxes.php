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
	}

	public function init() {

		$this->actions = array(
			array(
				'hook' => 'init',
				'callback' => 'register_post_types',
			),
			array(
				'hook'          => 'save_post', // use save_post because save_post_{$post_type} is fired before meta values are saved.
				'callback'      => 'save_post_action',
				'accepted_args' => 3,
			),
		);

		$this->filters = array(
			array(
				'hook' => 'rwmb_meta_boxes',
				'callback' => 'register_fields',
			),
		);

		$this->register_hooks();
	}

	function register_post_types() {
		$labels = [
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
		];
		$args = [
			'label'               => esc_html__( 'Rates', 'multipass' ),
			'labels'              => $labels,
			'description'         => '',
			'public'              => true,
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
			'supports'            => ['title'],
			'taxonomies'          => [],
			'rewrite'             => [
				'slug'       => 'rates',
				'with_front' => false,
			],
		];

		register_post_type( 'mltp_rate', $args );

		register_post_status(
			'expired',
			array(
				'label'                     => __( 'expired', 'multipass' ),
				'label_count'               => _n_noop(
					'Expired <span class="count">(%s)</span>',
					'Expired <span class="count">(%s)</span>',
				),
				'public' => true,
				'show_in_admin_status_list' => true,
			)
		);
	}

	public static function save_post_action( $post_id, $post, $update ) {
		if( 'mltp_rate' !== $post->post_type ) return;

		if( get_post_meta($post_id, 'repeat', true) ) return;
		// $post = get_post($post_id);
		$dates = get_post_meta( $post_id, 'dates' );
		if(empty($dates)) return;


		$to = [];
		foreach ($dates as $key => $date) {
			if(isset($date['to'])) $to[] = MultiPass::timestamp($date['to']);
		}
		$expired = ( max($to) + 86400 <= current_time('timestamp') );
		$post_status = ( $expired ) ? 'expired' : 'publish';
		if( $post_status === $post->post_status )  return;

		remove_action( current_action(), __CLASS__ . '::' . __FUNCTION__);

		wp_update_post(array(
			'ID' => $post_id,
			'post_status' => $post_status,
		));

		add_action( current_action(), __CLASS__ . '::' . __FUNCTION__, 10, 3 );
	 }

	function register_fields( $meta_boxes ) {
		$prefix = '';

		$meta_boxes[] = [
			'title'      => __( 'Rates', 'multipass' ),
			'id'         => 'rates',
			'post_types' => ['mltp_rate'],
			'style'      => 'seamless',
			'fields'     => [
				[
					'name'          => __( 'Type', 'multipass' ),
					'id'            => $prefix . 'type',
					'type'          => 'button_group',
					'options'       => [
						'rate'     => __( 'Rate', 'multipass' ),
						'discount' => __( 'Discount', 'multipass' ),
						'extra'    => __( 'Extra', 'multipass' ),
						'tax'      => __( 'Tax', 'multipass' ),
					],
					'std'           => 'rate',
					'required'      => true,
					// 'admin_columns' => [
					// 	'position'   => 'after title',
					// 	'sort'       => true,
					// 	'searchable' => true,
					// 	'filterable' => true,
					// 	'link'       => 'view',
					// ],
				],
				[
					'name'     => __( 'Unit', 'multipass' ),
					'id'       => $prefix . 'unit',
					'type'     => 'button_group',
					'options'  => [
						'percent'  => __( '%', 'multipass' ),
						'currency' => __( '€', 'multipass' ),
					],
					'required' => true,
				],
				[
					'name'        => __( 'Percent of', 'multipass' ),
					'id'          => $prefix . 'percent_of',
					'type'        => 'post',
					'post_type'   => ['mltp_rate'],
					'field_type'  => 'select_advanced',
					'placeholder' => __( 'Total price', 'multipass' ),
					'visible'     => [
						'when'     => [['unit', '=', 'percent']],
						'relation' => 'or',
					],
				],
				[
					'name'              => __( 'Dates', 'multipass' ),
					'id'                => $prefix . 'dates',
					'type'              => 'group',
					'clone'             => true,
					'clone_as_multiple' => true,
					'class'             => 'inline',
					'fields'            => [
						[
							'name' => __( 'From', 'multipass' ),
							'id'   => $prefix . 'from',
							'type' => 'date',
							'timestamp' => true,
						],
						[
							'name' => __( 'To', 'multipass' ),
							'id'   => $prefix . 'to',
							'type' => 'date',
							'timestamp' => true,
						],
					],
				],
				[
					'name'      => __( 'Repeat', 'multipass' ),
					'id'        => $prefix . 'repeat',
					'type'      => 'switch',
					'style'     => 'rounded',
					'on_label'  => 'Yes',
					'off_label' => 'No',
				],
				[
					'name'              => __( 'Rules', 'multipass' ),
					'id'                => $prefix . 'rules',
					'type'              => 'group',
					'clone'             => true,
					'clone_default'     => true,
					'clone_as_multiple' => true,
					// 'admin_columns'     => 'after type',
					'class'             => 'inline',
					'fields'            => [
						[
							'name'       => __( 'Category', 'multipass' ),
							'id'         => $prefix . 'category',
							'type'       => 'taxonomy',
							'taxonomy'   => ['resource-type'],
							'field_type' => 'select_advanced',
							'multiple'   => true,
						],
						[
							'name'       => __( 'Resource', 'multipass' ),
							'id'         => $prefix . 'resource',
							'type'       => 'post',
							'field_type' => 'select_advanced',
							'visible'    => [
								'when'     => [['category', '=', '']],
								'relation' => 'or',
							],
						],
						[
							'name' => __( 'Amount', 'multipass' ),
							'id'   => $prefix . 'amount',
							'type' => 'number',
							'step' => 'any',
						],
						[
							'name'    => __( 'Multiply by', 'multipass' ),
							'id'      => $prefix . 'multiply_by',
							'type'    => 'button_group',
							'options' => [
								'quantity' => __( 'Quantity', 'multipass' ),
								'nights'   => __( 'Nights', 'multipass' ),
								'guests'   => __( 'Guests total', 'multipass' ),
								'adults'   => __( 'Adults', 'multipass' ),
								'children' => __( 'Children', 'multipass' ),
								'babies'   => __( 'Babies', 'multipass' ),
							],
							'std'     => 'nights',
						],
					],
				],
			],
		];

		return $meta_boxes;
	}

}

$this->loaders[] = new Mltp_Rates();
