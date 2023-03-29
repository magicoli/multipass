<?php

class Mltp_Tax extends Mltp_Loader {

	public function __construct() {
	}

	public function init() {
		$this->actions = array(
			array(
				'hook' => 'init',
				'callback' => 'register_taxonomy',
			),
		);
		$this->filters = array(
			array(
				'hook' => 'rwmb_meta_boxes',
				'callback' => 'mltp_register_meta_boxes',
			 ),
		);

		$this->register_hooks();

	}

	public function register_taxonomy() {
		$labels = array(
			'name' => __( 'Taxes', 'multipass' ),
			'singular_name' => __( 'Tax', 'multipass' ),
			'search_items' => __( 'Search Tax', 'multipass' ),
			'all_items' => __( 'All Tax', 'multipass' ),
			'parent_item' => __( 'Parent Tax', 'multipass' ),
			'parent_item_colon' => __( 'Parent Tax:', 'multipass' ),
			'edit_item' => __( 'Edit Tax', 'multipass' ),
			'update_item' => __( 'Update Tax', 'multipass' ),
			'add_new_item' => __( 'Add New Tax', 'multipass' ),
			'new_item_name' => __( 'New Tax Name', 'multipass' ),
			'menu_name' => __( 'Taxes', 'multipass' ),
		);

		$args = array(
			'labels' => $labels,
			'hierarchical' => true,
			'show_ui' => true,
			'show_admin_column' => true,
			'query_var' => true,
			'rewrite' => array( 'slug' => 'tax' ),
			'public' => true,
			'publicly_queryable' => true,
			'show_in_nav_menus' => true,
			'show_tagcloud' => true,
			'show_in_rest' => true,
			'rest_base' => 'tax',
			'rest_controller_class' => 'WP_REST_Terms_Controller',
		);

		register_taxonomy( 'mltp_tax', array( 'mltp_prestation', 'mltp_detail', 'mltp_resource' ), $args );

		if ( MultiPass::debug() ) {
			add_submenu_page(
				'multipass', // string $parent_slug,
				$labels['name'], // string $page_title,
				$labels['menu_name'], // string $menu_title,
				'mltp_administrator', // string $capability,
				'edit-tags.php?taxonomy=mltp_tax&post_type=mltp_prestation', // string $menu_slug,
			);
		}
		add_action( 'resource-type_pre_add_form', 'MultiPass::back_to_multipass_button' );
	}

	function mltp_register_meta_boxes( $meta_boxes ) {
		$prefix = 'mltp_';

		$meta_boxes[] = [
			'title'      => '',
			'id'         => 'taxes-fields',
			// 'post_types' => ['mltp_resource', 'mltp_prestation', 'mltp_detail'],
			'taxonomies' => ['mltp_tax'],
			'fields'     => [
				[
					'name'   => '',
					'id'     => $prefix . 'tax',
					'type'   => 'group',
					'clone'             => true,
					// 'clone_default'     => true,
					'clone_as_multiple' => true,
					'admin_columns'     => 'after name',
					'fields' => [
						[
							'name'    => __( 'Amount', 'multipass' ),
							'id'      => 'amount',
							'type'    => 'number',
							'columns' => 3,
						],
						[
							'name'    => __( 'Type', 'multipass' ),
							'id'      => 'type',
							'type'    => 'button_group',
							'options' => [
								'fixed'   => MultiPass::get_currency_symbol(),
								'percent' => __( '%', 'multipass' ),
							],
							'std'     => 'fixed',
							'columns' => 2,
						],
						[
							'name'    => __( 'Included', 'multipass' ),
							'id'      => 'included',
							'type'    => 'switch',
							'style'   => 'rounded',
							'std'     => true,
							'columns' => 2,
						],
						[
							'name'    => __( 'Label', 'multipass' ),
							'id'      => 'label',
							'type'    => 'text',
							'columns' => 5,
						],
						[
							'name'     => __( 'Multiply by', 'multipass' ),
							'id'       => 'multiply',
							'type'     => 'button_group',
							'options'  => [
								'Guests'   => __( 'Guests', 'multipass' ),
								'Adults'   => __( 'Adults', 'multipass' ),
								'Children' => __( 'Children', 'multipass' ),
								'Babies'   => __( 'Babies', 'multipass' ),
								'Quantity' => __( 'Quantity', 'multipass' ),
								'Nights'   => __( 'Nights', 'multipass' ),
							],
							'multiple' => true,
							'visible'  => [
								'when'     => [['type', '=', 'fixed']],
								// 'relation' => 'or',
							],
						],
					],
				],
			],
		];

		return $meta_boxes;
	}
}

$this->loaders[] = new Mltp_Tax();
?>
