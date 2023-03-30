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

		register_taxonomy( 'mltp_tax', array(), $args );

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
		global $pagenow;
		$prefix = 'mltp_';

		$is_not_default_tax = ( 'edit-tags.php' === $pagenow ) ?  true : [
			'when'     => [['taxes', '=', '']],
		];
		$tax_fields = [
			[
				'name'    => __( 'Amount', 'multipass' ),
				'id'      => 'amount',
				'type'    => 'number',
				// 'columns' => 2,
				'size' => 8,
				'visible'  => $is_not_default_tax,
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
				// 'columns' => 2,
				'size' => 3,
				'visible'  => $is_not_default_tax,
			],
			[
				'name'    => __( 'Included', 'multipass' ),
				'id'      => 'included',
				'type'    => 'button_group',
				'options' => [
					1 => __( 'Yes', 'multipass' ),
					''   => __( 'No', 'multipass' ),
				],
				'style'   => 'rounded',
				'std'     => true,
				// 'columns' => 2,
				'size' => 1,
				'visible'  => $is_not_default_tax,
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
				'visible'  => ( 'edit-tags.php' === $pagenow ) ? [
					'when'     => [ ['mltp_tax[type]', '=', 'fixed'] ]
				] : [
					'when'     => [ ['type', '=', 'fixed'], ['taxes', '=', ''] ],
					'relation' => 'and',
				],
			],
		];
		$meta_boxes[] = [
			'title'      => '',
			'id'         => 'taxes-fields',
			'taxonomies' => ['mltp_tax'],
			'fields' => [
				[
					'name'      => '',
					'id'     => $prefix . 'tax',
					'type'   => 'group',
					// 'clone'             => true,
					// 'clone_default'     => true,
					// 'clone_as_multiple' => true,
					// 'max_clones' => 0,
					// 'add_button'        => __( 'Add another tax', 'multipass' ),
					'fields' => array_merge(
						$tax_fields,
						array(
							[
								'name'        => '',
								'id'          => 'taxes',
								'type'        => 'hidden',
								'value' => '',
							],
						),
					),
					'class' => 'inline low-gap',
				]
			],
		];

		$tax_fields = array_merge( array(
			[
				'name'       => __( 'Tax', 'multipass' ),
				'id'         => 'taxes',
				'type'       => 'taxonomy',
				'taxonomy'   => ['mltp_tax'],
				'field_type' => 'select',
				// 'columns'    => 3,
				'size' => 3,
				'placeholder' => __('Select or set custom values', 'multipass'),
			],
			[
				'name'    => __( 'Description', 'multipass' ),
				'id'      => 'description',
				'type'    => 'text',
				// 'columns' => 3,
				'size' => 20,
				'visible'  => [
					'when'     => [['taxes', '=', '']],
				],
			] ),
			$tax_fields,
		);

		$meta_boxes[] = [
			'title'      => __( 'Taxes', 'multipass' ),
			'id'         => 'post-taxes',
			'post_types' => ['mltp_prestation', 'mltp_detail', 'mltp_resource'],
			// 'autosave'   => true,
			// 'context'    => 'after_title',
			'style'      => 'seamless',
			'fields' => [
				[
					'name'      => __( 'Applicable Taxes', 'multipass' ),
					'id'     => $prefix . 'tax',
					'type'   => 'group',
					'clone'             => true,
					'clone_default'     => true,
					'clone_as_multiple' => true,
					'add_button'        => __( 'Add another tax', 'multipass' ),
					'fields' => $tax_fields,
					'class' => 'inline low-gap',
				]
			],
		];

		return $meta_boxes;
	}
}

$this->loaders[] = new Mltp_Tax();
