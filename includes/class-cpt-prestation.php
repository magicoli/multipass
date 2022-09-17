<?php

/**
 * Register all actions and filters for the plugin
 *
 * @link       https://github.com/magicoli/multipass
 * @since      1.0.0
 *
 * @package    W4OS
 * @subpackage W4OS/includes
 */

/**
 * Register all actions and filters for the plugin.
 *
 * Maintain a list of all hooks that are registered throughout
 * the plugin, and register them with the WordPress API. Call the
 * run function to execute the list of actions and filters.
 *
 * @package    W4OS
 * @subpackage W4OS/includes
 * @author     Your Name <email@example.com>
 */
class Mltp_Prestation {

	/**
	 * The array of actions registered with WordPress.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      array    $actions    The actions registered with WordPress to fire when the plugin loads.
	 */
	protected $actions;

	/**
	 * The array of filters registered with WordPress.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      array    $filters    The filters registered with WordPress to fire when the plugin loads.
	 */
	protected $filters;

	/**
	 * Initialize the collections used to maintain the actions and filters.
	 *
	 * @since    1.0.0
	 */
	public function __construct( $args = null ) {
		$this->post = $this->get( $args );
		$this->ID   = ( $this->post ) ? $this->post->ID : false;

		$this->actions = array();
		$this->filters = array();

	}

	/**
	 * Add a new action to the collection to be registered with WordPress.
	 *
	 * @since    1.0.0
	 * @param    string $hook             The name of the WordPress action that is being registered.
	 * @param    object $component        A reference to the instance of the object on which the action is defined.
	 * @param    string $callback         The name of the function definition on the $component.
	 * @param    int    $priority         Optional. The priority at which the function should be fired. Default is 10.
	 * @param    int    $accepted_args    Optional. The number of arguments that should be passed to the $callback. Default is 1.
	 */
	public function add_action( $hook, $component, $callback, $priority = 10, $accepted_args = 1 ) {
		$this->actions = $this->add( $this->actions, $hook, $component, $callback, $priority, $accepted_args );
	}

	/**
	 * Add a new filter to the collection to be registered with WordPress.
	 *
	 * @since    1.0.0
	 * @param    string $hook             The name of the WordPress filter that is being registered.
	 * @param    object $component        A reference to the instance of the object on which the filter is defined.
	 * @param    string $callback         The name of the function definition on the $component.
	 * @param    int    $priority         Optional. The priority at which the function should be fired. Default is 10.
	 * @param    int    $accepted_args    Optional. The number of arguments that should be passed to the $callback. Default is 1
	 */
	public function add_filter( $hook, $component, $callback, $priority = 10, $accepted_args = 1 ) {
		$this->filters = $this->add( $this->filters, $hook, $component, $callback, $priority, $accepted_args );
	}

	/**
	 * A utility function that is used to register the actions and hooks into a single
	 * collection.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @param    array  $hooks            The collection of hooks that is being registered (that is, actions or filters).
	 * @param    string $hook             The name of the WordPress filter that is being registered.
	 * @param    object $component        A reference to the instance of the object on which the filter is defined.
	 * @param    string $callback         The name of the function definition on the $component.
	 * @param    int    $priority         The priority at which the function should be fired.
	 * @param    int    $accepted_args    The number of arguments that should be passed to the $callback.
	 * @return   array                                  The collection of actions and filters registered with WordPress.
	 */
	private function add( $hooks, $hook, $component, $callback, $priority, $accepted_args ) {

		$hooks[] = array(
			'hook'          => $hook,
			'component'     => $component,
			'callback'      => $callback,
			'priority'      => $priority,
			'accepted_args' => $accepted_args,
		);

		return $hooks;

	}

	/**
	 * Register the filters and actions with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {

		$actions = array(
			array(
				'hook'     => 'init',
				'callback' => 'register_post_types',
			),
			array(
				'hook'     => 'init',
				'callback' => 'register_taxonomies',
			),

			array(
				'hook'          => 'save_post', // use save_post because save_post_prestation_item is fired before actual save and meta values are not yet updated
				'callback'      => 'save_post_action',
				'accepted_args' => 3,
			),

			array(
				'hook'     => 'pre_get_posts',
				'callback' => 'sortable_columns_order',
			),

			// array(
			// 'hook' => 'mb_relationships_init',
			// 'callback' => 'register_relationships',
			// 'priority' => 20,
			// ),
		);

		$filters = array(
			array(
				'hook'     => 'rwmb_meta_boxes',
				'callback' => 'register_fields',
			),
			array(
				'hook'          => 'wp_insert_post_data',
				'callback'      => 'new_post_random_slug',
				'accepted_args' => 2,
			),

			array(
				'hook'          => 'term_link',
				'callback'      => 'term_link_filter',
				'accepted_args' => 3,
			),

			array(
				'hook'     => 'manage_prestation_posts_columns',
				'callback' => 'add_admin_columns',
			),
			array(
				'hook'          => 'manage_prestation_posts_custom_column',
				'callback'      => 'admin_columns_display',
				'priority'      => 99,
				'accepted_args' => 2,
			),
			array(
				'hook'     => 'manage_edit-prestation_sortable_columns',
				'callback' => 'sortable_columns',
			),
		);

		foreach ( $filters as $hook ) {
			( empty( $hook['component'] ) ) && $hook['component']         = __CLASS__;
			( empty( $hook['priority'] ) ) && $hook['priority']           = 10;
			( empty( $hook['accepted_args'] ) ) && $hook['accepted_args'] = 1;
			add_filter( $hook['hook'], array( $hook['component'], $hook['callback'] ), $hook['priority'], $hook['accepted_args'] );
		}

		foreach ( $actions as $hook ) {
			( empty( $hook['component'] ) ) && $hook['component']         = __CLASS__;
			( empty( $hook['priority'] ) ) && $hook['priority']           = 10;
			( empty( $hook['accepted_args'] ) ) && $hook['accepted_args'] = 1;
			add_action( $hook['hook'], array( $hook['component'], $hook['callback'] ), $hook['priority'], $hook['accepted_args'] );
		}

	}

	static function register_post_types() {
		$labels = array(
			'name'                     => esc_html__( 'Prestations', 'multipass' ),
			'singular_name'            => esc_html__( 'Prestation', 'multipass' ),
			'add_new'                  => esc_html__( 'Add New', 'multipass' ),
			'add_new_item'             => esc_html__( 'Add new prestation', 'multipass' ),
			'edit_item'                => esc_html__( 'Edit Prestation', 'multipass' ),
			'new_item'                 => esc_html__( 'New Prestation', 'multipass' ),
			'view_item'                => esc_html__( 'View Prestation', 'multipass' ),
			'view_items'               => esc_html__( 'View Prestations', 'multipass' ),
			'search_items'             => esc_html__( 'Search Prestations', 'multipass' ),
			'not_found'                => esc_html__( 'No prestations found', 'multipass' ),
			'not_found_in_trash'       => esc_html__( 'No prestations found in Trash', 'multipass' ),
			'parent_item_colon'        => esc_html__( 'Parent Prestation:', 'multipass' ),
			'all_items'                => esc_html__( 'All Prestations', 'multipass' ),
			'archives'                 => esc_html__( 'Prestation Archives', 'multipass' ),
			'attributes'               => esc_html__( 'Prestation Attributes', 'multipass' ),
			'insert_into_item'         => esc_html__( 'Insert into prestation', 'multipass' ),
			'uploaded_to_this_item'    => esc_html__( 'Uploaded to this prestation', 'multipass' ),
			'featured_image'           => esc_html__( 'Featured image', 'multipass' ),
			'set_featured_image'       => esc_html__( 'Set featured image', 'multipass' ),
			'remove_featured_image'    => esc_html__( 'Remove featured image', 'multipass' ),
			'use_featured_image'       => esc_html__( 'Use as featured image', 'multipass' ),
			'menu_name'                => esc_html__( 'MultiPass', 'multipass' ),
			'filter_items_list'        => esc_html__( 'Filter prestations list', 'multipass' ),
			'filter_by_date'           => esc_html__( '', 'multipass' ),
			'items_list_navigation'    => esc_html__( 'Prestations list navigation', 'multipass' ),
			'items_list'               => esc_html__( 'Prestations list', 'multipass' ),
			'item_published'           => esc_html__( 'Prestation published', 'multipass' ),
			'item_published_privately' => esc_html__( 'Prestation published privately', 'multipass' ),
			'item_reverted_to_draft'   => esc_html__( 'Prestation reverted to draft', 'multipass' ),
			'item_scheduled'           => esc_html__( 'Prestation scheduled', 'multipass' ),
			'item_updated'             => esc_html__( 'Prestation updated', 'multipass' ),
			'text_domain'              => 'multipass',
		);
		$args   = array(
			'label'               => esc_html__( 'Prestations', 'multipass' ),
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
			'has_archive'         => true,
			'rest_base'           => '',
			'show_in_menu'        => true,
			'menu_position'       => null,
			'menu_icon'           => 'dashicons-book-alt',
			'capability_type'     => 'post',
			'supports'            => array( 'revisions' ),
			'taxonomies'          => array(),
			'rewrite'             => array(
				'with_front' => false,
			),
		);

		register_post_type( 'prestation', $args );
	}

	static function register_fields( $meta_boxes ) {
		$js_date_format_short = preg_match( '/^[Fm]/', get_option( 'date_format' ) ) ? 'mm-dd-yy' : 'dd-mm-yy';

		$prefix                       = '';
		$meta_boxes['prestation-cpt'] = array(
			'title'      => __( 'Prestations', 'multipass' ),
			'id'         => 'prestation-fields',
			'post_types' => array( 'prestation' ),
			'context'    => 'after_title',
			'style'      => 'seamless',
			'autosave'   => true,
			'fields'     => array(
				array(
					'id'       => $prefix . 'title_html',
					'type'     => 'custom_html',
					'callback' => 'MultiPass::title_html',
				),
				array(
					'name'       => __( 'Customer', 'multipass' ),
					'id'         => $prefix . 'customer_id',
					'type'       => 'user',
					'field_type' => 'select_advanced',
				),
				array(
					'name'        => __( 'Contact name', 'multipass' ),
					'id'          => $prefix . 'contact_name',
					'type'        => 'text',
					'description' => __( 'Leave empty if same as customer name', 'multipass' ),
				),
				array(
					'name' => __( 'Contact', 'multipass' ),
					'id'   => $prefix . 'display_name',
					'type' => 'hidden',
				),
				array(
					'name' => __( 'Contact Email', 'multipass' ),
					'id'   => $prefix . 'contact_email',
					'type' => 'email',
				),
				array(
					'name' => __( 'Contact Phone', 'multipass' ),
					'id'   => $prefix . 'contact_phone',
					'type' => 'text',
				),
				array(
					'name'   => __( 'Dates', 'multipass' ),
					'id'     => $prefix . 'dates',
					'type'   => 'group',
					'class'  => 'inline',
					'fields' => array(
						array(
							'prepend'    => __( 'From', 'multipass' ),
							'id'         => $prefix . 'from',
							'readonly'   => true,
							'size'       => 10,
							'type'       => 'date',
							'timestamp'  => true,
							'js_options' => array(
								'dateFormat' => $js_date_format_short,
							),
						),
						array(
							'prepend'    => __( 'To', 'multipass' ),
							'id'         => $prefix . 'to',
							'type'       => 'date',
							'timestamp'  => true,
							'readonly'   => true,
							'size'       => 10,
							'js_options' => array(
								'dateFormat' => $js_date_format_short,
							),
						),
					),
				),
				array(
					'name'   => __( 'Discount', 'multipass' ),
					'id'     => $prefix . 'discount',
					'type'   => 'group',
					'class'  => 'inline',
					'fields' => array(
						array(
							'id'      => $prefix . 'percent',
							'type'    => 'number',
							'min'     => 0,
							'max'     => 100,
							'size'    => 5,
							'prepend' => '%',
						),
						array(
							'id'      => $prefix . 'amount',
							'type'    => 'text',
							'pattern' => '[0-9]+([,\.][0-9]+)?',
							'min'     => 0,
							'size'    => 10,
							'prepend' => MultiPass::get_currency_symbol(),
							'visible' => array(
								'when'     => array( array( 'discount_percent', '=', '' ) ),
								'relation' => 'or',
							),
						),
					),
				),
				array(
					'name'   => __( 'Deposit', 'multipass' ),
					'id'     => $prefix . 'deposit',
					'type'   => 'group',
					'class'  => 'inline',
					'fields' => array(
						array(
							'id'      => $prefix . 'percent',
							'type'    => 'number',
							'min'     => 0,
							'max'     => 100,
							'size'    => 5,
							'prepend' => '%',
							'class'   => 'percent class',
						),
						array(
							'id'      => $prefix . 'amount',
							'type'    => 'text',
							'pattern' => '[0-9]+([,\.][0-9]+)?',
							'min'     => 0,
							'step'    => 'any',
							'size'    => 10,
							'prepend' => MultiPass::get_currency_symbol(),
							'class'   => 'amount class',
							'visible' => array(
								'when'     => array( array( 'deposit_percent', '=', '' ) ),
								'relation' => 'or',
							),
						),
						array(
							'prepend' => __( 'Before', 'multipass' ),
							'id'      => $prefix . 'deposit_before',
							'type'    => 'date',
							'visible' => array(
								'when'     => array(
									array( 'deposit_percent', '!=', '' ),
									array( 'deposit_amount', '!=', '' ),
								),
								'relation' => 'or',
							),
						),
					),
				),
			),
		);

		$prefix                = 'managed_';
		$meta_boxes['managed'] = array(
			'id'         => 'prestation-managed',
			'post_types' => array( 'prestation' ),
			'style'      => 'seamless',
			'readonly'   => true,
			'fields'     => array(
				array(
					'name'     => __( 'Items', 'multipass' ),
					'id'       => $prefix . 'items',
					'type'     => 'custom_html',
					'callback' => __CLASS__ . '::items_list',
					'columns'  => 12,
				),
			),
		);

		$prefix       = '';
		$meta_boxes[] = array(
			'id'         => 'prestation-items',
			'post_types' => array( 'prestation' ),
			'style'      => 'seamless',

			'fields'     => array(
				'items' => array(
					'name'              => __( 'Manual operations', 'multipass' ),
					'id'                => $prefix . 'manual_items',
					'type'              => 'group',
					'clone'             => true,
					'readonly'          => false,
					'class'             => 'low-gap',
					'label_description' => '<p>' . __( 'Use manual operations only for items not managed by modules.', 'multipass' ) . '</p>',
					'fields'            => array(
						array(
							'name'        => __( 'Type', 'multipass' ),
							'id'          => $prefix . 'type',
							'type'        => 'select',
							'options'     => array(
								'product' => __( 'Product', 'multipass' ),
								'service' => __( 'Service', 'multipass' ),
								'booking' => __( 'Booking', 'multipass' ),
								'payment' => __( 'Payment', 'multipass' ),
							),
							'placeholder' => __( 'Select a type', 'multipass' ),
							'columns'     => 2,
						),
						array(
							'name'    => __( 'Description', 'multipass' ),
							'id'      => $prefix . 'description',
							'type'    => 'text',
							'columns' => 3,
						),
						array(
							'name'       => __( 'Date', 'multipass' ),
							'id'         => $prefix . 'from',
							'type'       => 'date',
							'type'       => 'date',
							'timestamp'  => true,
							'js_options' => array(
								'dateFormat' => $js_date_format_short,
							),
							'columns'    => 1,
							'required'   => true,
							'visible'    => array(
								'when'     => array(
									array( 'type', '=', 'booking' ),
									array( 'type', '=', 'payment' ),
								),
								'relation' => 'or',
							),
						),
						array(
							'name'       => __( 'To', 'multipass' ),
							'id'         => $prefix . 'to',
							'type'       => 'date',
							'type'       => 'date',
							'timestamp'  => true,
							'js_options' => array(
								'dateFormat' => $js_date_format_short,
							),
							'columns'    => 1,
							'visible'    => array(
								'when'     => array(
									array( 'type', '=', 'booking' ),
									array( 'from', '!=', '' ),
								),
								'relation' => 'and',
							),
						),
						array(
							'name'    => __( 'Quantity', 'multipass' ),
							'id'      => $prefix . 'quantity',
							'type'    => 'number',
							'class'   => 'item_quantity',
							'step'    => 'any',
							'columns' => 1,
							'visible' => array(
								'when'     => array(
									array( 'type', '!=', '' ),
									array( 'type', '!=', 'payment' ),
								),
								'relation' => 'and',
							),
						),
						array(
							'name'    => __( 'Unit Price', 'multipass' ),
							'id'      => $prefix . 'unit_price',
							'class'   => 'item_unit_price',
							'type'    => 'text',
							'pattern' => '[0-9]+([,\.][0-9]+)?',
							'columns' => 1,
							'visible' => array(
								'when'     => array(
									array( 'type', '!=', '' ),
									array( 'type', '!=', 'payment' ),
								),
								'relation' => 'and',
							),
						),
						array(
							'name'    => __( 'Discount', 'multipass' ),
							'id'      => $prefix . 'discount',
							'type'    => 'text',
							'class'   => 'item_discount',
							'pattern' => '[0-9]+([,\.][0-9]+)?',
							'columns' => 1,
							'visible' => array(
								'when'     => array(
									array( 'type', '!=', '' ),
									array( 'type', '!=', 'payment' ),
								),
								'relation' => 'and',
							),
						),
						array(
							'name'     => __( 'Price', 'multipass' ),
							'id'       => $prefix . 'price',
							'class'    => 'item_price',
							'type'     => 'text',
							'readonly' => true,
							// 'pattern'  => '[0-9]+([,\.][0-9]+)?',
							'columns'  => 1,
							'visible'  => array(
								'when'     => array(
									array( 'type', '!=', '' ),
									array( 'type', '!=', 'payment' ),
								),
								'relation' => 'and',
							),
						),
						array(
							'name'    => __( 'Paid', 'multipass' ),
							'id'      => $prefix . 'paid',
							'class'   => 'item_paid',
							'type'    => 'text',
							'step'    => 'any',
							'columns' => 1,
							'visible' => array(
								'when' => array(
									array( 'type', '!=', '' ),
								),
							),
							'pattern' => '[0-9]+([,\.][0-9]+)?',
						),
					),
				),
			),
		);

		$meta_boxes['prestation-summary'] = array(
			'title'      => __( 'Summary', 'multipass' ),
			'id'         => 'prestation-summary',
			'post_types' => array( 'prestation' ),
			'context'    => 'side',
			'fields'     => array(
				array(
					'name'     => __( 'Regular Price', 'multipass' ),
					'id'       => $prefix . 'price_html',
					'type'     => 'custom_html',
					'callback' => 'Mltp_Prestation::get_summary_price',
				),
				array(
					'name'     => __( 'Discount', 'multipass' ),
					'id'       => $prefix . 'discount_html',
					'type'     => 'custom_html',
					'callback' => 'Mltp_Prestation::get_summary_discount',
				),
				array(
					'name'     => __( 'Total', 'multipass' ),
					'id'       => $prefix . 'total_html',
					'type'     => 'custom_html',
					'class'    => 'total',
					'callback' => 'Mltp_Prestation::get_summary_total',
				),
				array(
					'name'     => __( 'Deposit', 'multipass' ),
					'id'       => $prefix . 'deposit_amount_html',
					'type'     => 'custom_html',
					'callback' => 'Mltp_Prestation::get_summary_deposit',
				),
				array(
					'name'     => __( 'Paid', 'multipass' ),
					'id'       => $prefix . 'paid_html',
					'type'     => 'custom_html',
					'callback' => 'Mltp_Prestation::get_summary_paid',
				),
				array(
					'name'     => __( 'Balance', 'multipass' ),
					'id'       => $prefix . 'balance_html',
					'type'     => 'custom_html',
					'class'    => 'balance',
					'callback' => 'Mltp_Prestation::get_summary_balance',
				),
				array(
					'name'     => __( 'Reference #', 'multipass' ),
					'id'       => $prefix . 'reference',
					'type'     => 'custom_html',
					'callback' => 'Mltp_Prestation::get_summary_reference',
				),
				array(
					'name'           => __( 'Status', 'multipass' ),
					'id'             => 'status',
					'type'           => 'taxonomy',
					'taxonomy'       => array( 'prestation-status' ),
					'field_type'     => 'custom_html',
					'callback'       => __CLASS__ . '::display_status',
					'class'          => 'status',
					// 'disabled' => true,
					'readonly'       => true,
					// 'save_field' => false,
					// 'placeholder' => ' ',
					'remove_default' => true,
					'admin_columns'  => array(
						// 'position' => 'after balance',
						// 'sort'       => true,
						'filterable' => true,
					),
				),
			),
		);

		return $meta_boxes;
	}

	static function register_taxonomies() {
		$labels = array(
			'name'                       => esc_html__( 'Prestation statuses', 'multipass' ),
			'singular_name'              => esc_html__( 'Prestation status', 'multipass' ),
			'menu_name'                  => esc_html__( 'Prestation statuses', 'multipass' ),
			'search_items'               => esc_html__( 'Search Prestation statuses', 'multipass' ),
			'popular_items'              => esc_html__( 'Popular Prestation statuses', 'multipass' ),
			'all_items'                  => esc_html__( 'All Prestation statuses', 'multipass' ),
			'parent_item'                => esc_html__( 'Parent Prestation status', 'multipass' ),
			'parent_item_colon'          => esc_html__( 'Parent Prestation status', 'multipass' ),
			'edit_item'                  => esc_html__( 'Edit Prestation status', 'multipass' ),
			'view_item'                  => esc_html__( 'View Prestation status', 'multipass' ),
			'update_item'                => esc_html__( 'Update Prestation status', 'multipass' ),
			'add_new_item'               => esc_html__( 'Add new prestation status', 'multipass' ),
			'new_item_name'              => esc_html__( 'New prestation status name', 'multipass' ),
			'separate_items_with_commas' => esc_html__( 'Separate prestation statuses with commas', 'multipass' ),
			'add_or_remove_items'        => esc_html__( 'Add or remove prestation statuses', 'multipass' ),
			'choose_from_most_used'      => esc_html__( 'Choose most used prestation statuses', 'multipass' ),
			'not_found'                  => esc_html__( 'No prestation statuses found', 'multipass' ),
			'no_terms'                   => esc_html__( 'No Prestation statuses', 'multipass' ),
			'filter_by_item'             => esc_html__( 'Filter by prestation status', 'multipass' ),
			'items_list_navigation'      => esc_html__( 'Prestation statuses list pagination', 'multipass' ),
			'items_list'                 => esc_html__( 'Prestation statuses list', 'multipass' ),
			'most_used'                  => esc_html__( 'Most Used', 'multipass' ),
			'back_to_items'              => esc_html__( 'Back to prestation statuses', 'multipass' ),
			'text_domain'                => 'multipass',
		);
		$args   = array(
			'label'              => esc_html__( 'Prestation statuses', 'multipass' ),
			'labels'             => $labels,
			'description'        => '',
			'public'             => false,
			'publicly_queryable' => false,
			'hierarchical'       => true,
			'show_ui'            => true,
			'show_in_menu'       => false,
			'show_in_nav_menus'  => false,
			'show_in_rest'       => true,
			'show_tagcloud'      => false,
			'show_in_quick_edit' => false,
			'show_admin_column'  => false,

			'query_var'          => true,
			'sort'               => true,
			'meta_box_cb'        => 'post_tags_meta_box',
			'rest_base'          => '',
			'rewrite'            => array(
				'with_front'   => false,
				'hierarchical' => false,
			),
		);
		register_taxonomy( 'prestation-status', array( 'prestation' ), $args );

		/**
		 * Prestation statuses, we use basically the same terminology as
		 * WooCommerce, but it is not mandatory.
		 */
		MultiPass::register_terms(
			'prestation-status',
			array(
				// Open (still modifiable, available for new order inclusion)
				'pending'        => array( 'name' => __( 'Pending payment', 'multipass' ) ),  // unpaid or paid less than deposit, not confirmed
				'on-hold'        => array( 'name' => __( 'On hold', 'multipass' ) ), // fully paid and not started
				'processing'     => array( 'name' => __( 'Processing', 'multipass' ) ), // paid and started

			// Closed (not modifiable except refunds, not available for new order inclusion)
				'completed'      => array( 'name' => __( 'Completed', 'multipass' ) ), // paid and finished
				'cancelled'      => array( 'name' => __( 'Cancelled', 'multipass' ) ),
				'refunded'       => array( 'name' => __( 'Refunded', 'multipass' ) ),
				'failed'         => array( 'name' => __( 'Failed', 'multipass' ) ), // shouldn't need that at prestation level

			// Draft (not available for new order inclusion)
				'checkout-draft' => array( 'name' => __( 'Draft', 'multipass' ) ),

				'deposit'        => array(
					'name'   => __( 'Deposit paid', 'multipass' ),
					'parent' => 'on-hold',
				),
				'paid'           => array(
					'name'   => __( 'Paid', 'multipass' ),
					'parent' => 'on-hold',
				),

				'unpaid'         => array(
					'name'   => __( 'Unpaid', 'multipass' ),
					'parent' => 'pending',
				),
				'partial'        => array(
					'name'   => __( 'Partially paid', 'multipass' ),
					'parent' => 'pending',
				),
			)
		);
	}

	function get_items() {
		$query_args       = array(
			'post_type'   => 'prestation-item',
			'post_status' => 'publish',
			'numberposts' => -1,
			'orderby'     => 'post_date',
			'order'       => 'asc',
			'meta_query'  => array(
				'relation' => 'AND',
				array(
					'key'   => 'prestation_id',
					'value' => $this->ID,
				),
			),
		);
		$prestation_items = get_posts( $query_args );
		$items            = array();
		foreach ( $prestation_items as $prestation_item ) {
			$meta     = get_post_meta( $prestation_item->ID );
			$price    = get_post_meta( $prestation_item->ID, 'price', true );
			$dates    = get_post_meta( $prestation_item->ID, 'dates', true );
			$discount = get_post_meta( $prestation_item->ID, 'discount', true );
			// $deposit = get_post_meta($prestation_item->ID, 'deposit', true);
			$items[] = array(
				'ID'          => $prestation_item->ID,
				'date'        => $prestation_item->post_date,
				'description' => reset( $meta['description'] ),
				'type'        => reset( $meta['type'] ),
				'dates'       => $dates,
				'subtotal'    => $price['sub_total'],
				'discount'    => isset( $discount['amount'] ) ? $discount['amount'] : null,
				'total'       => reset( $meta['total'] ),
				// 'deposit' => $deposit['amount'],
				'paid'        => reset( $meta['paid'] ),
				'balance'     => reset( $meta['balance'] ),
				'source'      => reset( $meta['source'] ),
				'links'       => Mltp_Item::item_links_html( $prestation_item, array( 'format' => 'icon' ) ),
				// 'subtotal' => MultiPass::price($price['sub_total']),
				// 'discount' => MultiPass::price($discount['amount']),
				// 'total' => MultiPass::price(reset($meta['total'])),
				// // 'deposit' => $deposit['amount'],
				// 'paid' => MultiPass::price(reset($meta['paid'])),
				// 'balance' => MultiPass::price(reset($meta['balance'])),
				// 'source' => reset($meta['source']),
				// 'links' => Mltp_Item::item_links_html($prestation_item, ['format' => 'icon']),
			);
		}

		return $items;
	}

	function get_columns() {
		return array(
			// 'ID' => __('ID', 'multipass'),
			// 'date' => __('Date', 'multipass'),
			'type'        => __( 'Type', 'multipass' ),
			'description' => __( 'Description', 'multipass' ),
			'dates'       => __( 'Dates', 'multipass' ),
			'subtotal'    => __( 'Subtotal', 'multipass' ),
			'discount'    => __( 'Discount', 'multipass' ),
			'total'       => __( 'Total', 'multipass' ),
			// 'deposit' => __('deposit', 'multipass'),
			'paid'        => __( 'Paid', 'multipass' ),
			'balance'     => __( 'Balance', 'multipass' ),
			'source'      => __( 'Source', 'multipass' ),
			'links'       => __( 'Actions', 'multipass' ),
		);
	}

	static function items_list( $args = array(), $field = array() ) {
		if ( is_object( $args ) ) {
			$post = $args;
		} else {
			global $post;
		}
		if ( ! self::is_prestation_post( $post ) ) {
			return 'nope';
		}

		$prestation = new Mltp_Prestation( $post );
		$items      = $prestation->get_items();
		$list       = new Mltp_Table(
			array(
				'columns' => $prestation->get_columns(),
				'format'  => array(
					'dates'    => 'date_range',
					'subtotal' => 'price',
					'discount' => 'price',
					'refunded' => 'price',
					'total'    => 'price',
					'paid'     => 'price',
					'balance'  => 'price',
					'status'   => 'status',
				),
				'rows'    => $items,
			)
		);
		// error_log(print_r($list, true));
		return $list->render();
	}

	static function get_managed_list( $args = array(), $field = array() ) {
		$html = apply_filters( 'multipass_managed_list', null );

		// if(empty($html))
		// $html = __('No data', 'multipass' );

		return $html;
	}

	static function get_summary_price( $args = array() ) {
		global $post;
		$amount = get_post_meta( $post->ID, 'price', true );
		if ( empty( $amount ) ) {
			$amount = 0;
		}
		return MultiPass::price( $amount );
	}

	static function get_summary_discount( $args = array() ) {
		global $post;
		$discount = get_post_meta( $post->ID, 'discount', true );
		$amount   = ( isset( $discount['total'] ) ) ? $discount['total'] : null;
		if ( $amount > 0 ) {
			return MultiPass::price( $amount );
		}
	}

	static function get_summary_total( $args = array() ) {
		global $post;
		$amount = get_post_meta( $post->ID, 'total', true );
		if ( empty( $amount ) ) {
			$amount = 0;
		}
		return MultiPass::price( $amount );
	}

	static function get_summary_deposit_percent( $args = array() ) {
		global $post;
		$deposit = get_post_meta( $post->ID, 'deposit', true );
		$percent = ( isset( $deposit['percent'] ) ) ? $deposit['percent'] : null;
		if ( $percent > 0 ) {
			return number_format_i18n( $percent, 0 ) . '%';
		}
	}

	static function get_summary_deposit( $args = array() ) {
		global $post;
		$deposit = get_post_meta( $post->ID, 'deposit', true );
		$amount  = ( isset( $deposit['total'] ) ) ? $deposit['total'] : null;
		if ( $amount > 0 ) {
			return MultiPass::price( $amount );
		}
	}

	static function get_summary_paid( $args = array() ) {
		global $post;
		$amount = get_post_meta( $post->ID, 'paid', true );
		return MultiPass::price( $amount );
	}

	static function get_balance( $args = array() ) {
		global $post;
		$amount = get_post_meta( $post->ID, 'balance', true );
		return $amount;
	}

	static function get_summary_balance( $args = array() ) {
		// global $post;
		// $amount = get_post_meta($post->ID, 'balance', true);
		$amount = self::get_balance();
		return MultiPass::price( $amount );
	}

	static function get_summary_reference( $args = array() ) {
		global $post;
		if ( $post->post_type != 'prestation' ) {
			return;
		}
		if ( MultiPass::is_new_post() ) {
			return; // triggered when opened new post page, empty
		}

		if ( is_post_type_viewable( $post->post_type ) ) {
			return sprintf(
				'<a href="%s"><code>%s</code></a>',
				// '<a href="%s" class="thickbox"><code>%s</code></a>',
				get_permalink( $post ),
				$post->post_name,
			);
		} else {
			return sprintf(
				'<code>%s</code>',
				$post->post_name,
			);
		}
	}


	static function term_link_filter( $termlink, $term, $taxonomy ) {
		if ( 'prestation-status' === $taxonomy ) {
			return add_query_arg(
				array(
					'prestation-status' => $term->slug,
				),
				admin_url( basename( $_SERVER['REQUEST_URI'] ) )
			);
		}
		return $termlink;
	}

	static function display_status() {
		$paid_status = null;
		global $post;
		$terms = get_the_terms( $post, 'prestation-status' );

		if ( is_array( $terms ) && isset( $terms[0] ) ) {
			$status = array();
			foreach ( $terms as $term ) {
				$status[] = sprintf(
					'<span class="%1$s-status-box status-%2$s">%3$s</span>',
					$post->post_type,
					$term->slug,
					__( $term->name, 'multipass' ),
				);
			}
			return implode( ' ', $status );
			// $term = $terms[0];
			// if(!empty($term)) return sprintf(
			// '<span class="%1$s-status-box status-%2$s">%3$s</span>',
			// $post->post_type,
			// $term->slug,
			// $term->name,
			// );
		}
	}

	static function get_post( $object ) {
		if ( self::is_prestation_post( $object ) ) {
			return $object;
		}
		if ( get_class( $object ) == __CLASS__ ) {
			$post = $object->post;
		} elseif ( is_numeric( $object ) ) {
			$post = get_post( $object );
		} else {
			return false;
		}

		return ( self::is_prestation_post( $post ) ) ? $post : false;
	}

	static function is_prestation_post( $object ) {
		if ( ! is_object( $object ) ) {
			return false;
		}
		if ( get_class( $object ) != 'WP_Post' ) {
			return false;
		}
		if ( $object->post_type != 'prestation' ) {
			return false;
		}

		return true;
	}

	static function save_post_action( $post_id, $post, $update ) {
		// if( !$update ) return; // update is not true when created by plugin
		if ( ! self::is_prestation_post( $post ) ) {
			return;
		}
		if ( ! $post ) {
			return;
		}
		if ( $post->post_status == 'trash' ) {
			return; // TODO: remove prestation reference from other post types
		}
		if ( isset( $_REQUEST['action'] ) && $_REQUEST['action'] == 'trash' ) {
			return; // maybe redundant?
		}
		if ( MultiPass::is_new_post() ) {
			return; // triggered when opened new post page, empty
		}

		remove_action( current_action(), __CLASS__ . '::' . __FUNCTION__ );

		$updates['customer_id']    = get_post_meta( $post_id, 'customer_id', true );
		$updates['customer_email'] = get_post_meta( $post_id, 'customer_email', true );
		$updates['customer_name']  = get_post_meta( $post_id, 'customer_name', true );
		$updates['contact_name']   = get_post_meta( $post_id, 'contact_name', true );

		$manual_items        = get_post_meta( $post_id, 'manual_items', true );
		$amounts['managed']  = get_post_meta( $post_id, 'managed', true );
		$amounts['payments'] = get_post_meta( $post_id, 'payments', true );
		$updates['deposit']  = get_post_meta( $post_id, 'deposit', true );
		$updates['discount'] = get_post_meta( $post_id, 'discount', true );
		$updates['balance']  = get_post_meta( $post_id, 'balance', true );
		$updates['dates']    = get_post_meta( $post_id, 'dates', true );

		$updates['price'] = 0; // get_post_meta($post_id, 'price', true);
		$updates['paid']  = 0; // Will be overridden // get_post_meta($post_id, 'paid', true);
		$updates['total'] = 0; // Will be overridden // get_post_meta($post_id, 'paid', true);
		// $updates['balance'] = 0; // Will be overridden // get_post_meta($post_id, 'paid', true);
		$dates = array();

		if ( is_array( $_REQUEST ) ) {
			foreach ( $updates as $key => $value ) {
				if ( isset( $_REQUEST[ $key ] ) ) {
					$updates[ $key ] = is_array( $_REQUEST[ $key ] ) ? $_REQUEST[ $key ] : esc_attr( $_REQUEST[ $key ] );
				}
			}
			foreach ( $amounts as $key => $value ) {
				if ( isset( $_REQUEST[ $key ] ) ) {
					$amounts[ $key ] = is_array( $_REQUEST[ $key ] ) ? $_REQUEST[ $key ] : esc_attr( $_REQUEST[ $key ] );
				}
			}
		}

		if ( ! is_array( $updates['deposit'] ) ) {
			$updates['deposit'] = array(
				'percent' => null,
				'amount'  => null,
			);
		}
		// if(empty($updates['deposit'])) $updates['deposit'] = [];
		$updates['deposit']['managed'] = 0;
		$updates['deposit']['total']   = 0;

		if ( ! is_array( $updates['discount'] ) ) {
			$updates['discount'] = array(
				'percent' => null,
				'amount'  => null,
			);
		}
		// if(empty($updates['discount'])) $updates['discount'] = [];
		// $updates['discount']['amount'] = (empty($updates['discount']['amount'])) ? 0 : $updates['discount']['amount'];
		// $updates['discount']['total'] = $updates['discount']['amount'];
		$updates['discount']['managed'] = 0;
		$updates['discount']['total']   = 0;
		$updates['refunded']            = 0;
		$updates['discount']['total']   = 0;

		$prestation       = new Mltp_Prestation( $post );
		$prestation_items = $prestation->get_items();
		foreach ( $prestation_items as $item ) {
			error_log( "prestation $prestation->ID items " . print_r( $item, true ) );
			$updates['discount']['total'] += $item['discount'];
			$updates['price']             += $item['subtotal'];
			$updates['total']             += $item['total'];
			$updates['paid']              += $item['paid'];
			// $updates['balance'] += $item['balance'];
			//
			// if(!empty($item['from']['timestamp'])) $dates[] = $item['from']['timestamp'];
			if ( ! empty( $item['dates'] ) ) {
				$dates += array_values( $item['dates'] );
			}
		}
		// error_log("items " . print_r($prestation_items, true));

		if ( is_array( $manual_items ) ) {
			foreach ( $manual_items as $item ) {
				if ( isset( $item['paid'] ) ) {
					$updates['paid'] += (float) $item['paid'];
				}

				if ( isset( $item['discount'] ) ) {
					$updates['discount']['total'] += (float) $item['discount'];
				}

				if ( empty( $item['quantity'] ) ) {
					if ( empty( $item['unit_price'] ) ) {
						continue;
					} else {
						$item['quantity'] = 1;
					}
				}
				if ( empty( $item['quantity'] ) || empty( $item['unit_price'] ) ) {
					continue;
				}
				$updates['price'] += (float) $item['quantity'] * (float) $item['unit_price'];

				if ( ! empty( $item['from']['timestamp'] ) ) {
					$dates[] = $item['from']['timestamp'];
				}
				if ( ! empty( $item['to']['timestamp'] ) ) {
					$dates[] = $item['to']['timestamp'];
				}
			}
		}

		if ( $updates['discount']['percent'] > 0 ) {
			$updates['discount']['amount'] = $updates['price'] * $updates['discount']['percent'] / 100;
		} else {
			$updates['discount']['amount'] = ( empty( $updates['discount']['amount'] ) ) ? null : $updates['discount']['amount'];
		}
		// if($updates['discount']['amount'] > $updates['price']) $updates['discount']['amount'] = $updates['price'];
		$updates['total'] -= $updates['discount']['amount'];

		// $updates['total'] = $updates['price'] - $updates['discount']['amount'];

		if ( is_array( $amounts['payments'] ) ) {
			foreach ( $amounts['payments'] as $payment ) {
				if ( empty( $payment['amount'] ) ) {
					continue;
				}
				$amount           = esc_attr( $payment['amount'] );
				$updates['paid'] += $amount;
			}
		}

		// foreach(get_post_meta($post_id) as $key => $serialized) {
		// if(preg_match('/^managed-/', $key)) {
		// $managed = unserialize($serialized[0]);
		// error_log("$key = " . print_r($managed, true));
		// continue;
		// $updates['price'] += @$managed['subtotal'];
		// $updates['deposit']['managed'] += @$managed['deposit'];
		// $updates['discount']['managed'] += @$managed['discount'];
		// $updates['refunded'] += @$managed['refunded'];
		// $updates['total'] += @$managed['total'];
		// $updates['paid'] += @$managed['paid'];
		// if(is_array(@$managed['dates']) &! empty($managed['dates'])) {
		// $dates[] = min($managed['dates']);
		// $dates[] = max($managed['dates']);
		// }
		// }
		// }

		$dates = array_unique( array_filter( $dates ) );
		if ( ! empty( $dates ) ) {
			$updates['dates'] = array(
				'from' => min( $dates ),
				'to'   => max( $dates ),
			);
			if ( $updates['dates']['to'] == $updates['dates']['from'] ) {
				unset( $updates['dates']['to'] );
			}
		}

		$updates['discount']['total'] += $updates['discount']['amount'] + $updates['discount']['managed'];

		if ( $updates['total'] > 0 && $updates['deposit']['percent'] > 0 ) {
			$updates['deposit']['amount'] = $updates['total'] * $updates['deposit']['percent'] / 100;
		} else {
			$updates['deposit']['amount'] = ( empty( $updates['deposit']['amount'] ) ) ? null : $updates['deposit']['amount'];
		}
		$updates['deposit']['total'] += $updates['deposit']['amount'] + $updates['deposit']['managed'];

		// error_log("updates after " . print_r($updates, true));

		$updates['balance'] = ( $updates['total'] - $updates['paid'] == 0 ) ? null : $updates['total'] - $updates['paid'];

		$post_status = $post->post_status;

		switch ( $post->post_status ) {
			case 'publish':
				if ( $updates['total'] <= 0 ) {
					$paid_status = 'on-hold';
				} elseif ( $updates['paid'] < $updates['total'] ) {
					if ( $updates['paid'] >= $updates['deposit']['total'] ) {
						$post_status = 'publish';
						if ( $updates['deposit']['total'] > 0 ) {
							$paid_status = 'deposit';
						} elseif ( $updates['paid'] > 0 ) {
							$paid_status = 'partial';
						} else {
							$paid_status = 'unpaid';
						}
					} else {
						$post_status = 'pending';
						if ( $updates['paid'] > 0 ) {
							$paid_status = 'partial';
						} else {
							$paid_status = 'unpaid';
						}
					}
					// } else if($updates['paid'] > $updates['total']) {
					// $paid_status = 'overpaid';
				} else {
					$post_status = 'publish';
					$paid_status = 'paid';
				}
				break;

			default:
				$paid_status = $post->post_status;
		}
		$paid_status = ( is_array( $paid_status ) ) ? $paid_status : array( $paid_status );

		if ( ! empty( $updates['customer_id'] ) ) {
			$updates['customer_name']  = trim( get_userdata( $updates['customer_id'] )->first_name . ' ' . get_userdata( $updates['customer_id'] )->last_name );
			$updates['customer_email'] = get_userdata( $updates['customer_id'] )->user_email;
		}

		if ( empty( $updates['contact_name'] ) ) {
			$updates['contact_name'] = $updates['customer_name'];
		}
		$display_name = trim( $updates['contact_name'] );

		if ( empty( $updates['attendee_email'] ) ) {
			$updates['attendee_email'] = $updates['customer_email'];
		}

		$updates['sort_date']    = ( isset( $updates['dates'] ) && isset( $updates['dates']['from'] ) ) ? $updates['dates']['from'] : '';
		$updates['display_name'] = $display_name;

		$post_update = array(
			'ID'          => $post_id,
			'post_title'  => trim( $display_name . ' ' . '#' . ( ( empty( $post->post_name ) ) ? $post_id : $post->post_name ) ),
			'post_status' => $post_status,
			'meta_input'  => $updates,
			'tax_input'   => array(
				'prestation-status' => $paid_status,
			),
		);

		wp_update_post( $post_update );
		/*
		* TODO: get why metadata and taxonomies are not saved with wp_update_post
		* In the meantime, we force the update
		*/
		foreach ( $updates as $key => $value ) {
			update_post_meta( $post_id, $key, $value );
		}
		wp_set_object_terms( $post_id, $paid_status, 'prestation-status' );

		add_action( current_action(), __CLASS__ . '::' . __FUNCTION__, 10, 3 );
		return;
	}

	static function add_admin_columns( $columns ) {
		$columns = array(
			'cb'       => $columns['cb'],
			'title'    => __( 'Title', 'multipass' ),
			'customer' => __( 'Customer', 'multipass' ),
			'contact'  => __( 'Contact', 'multipass' ),
			'services' => __( 'Services', 'multipass' ),
			'dates'    => __( 'Dates', 'multipass' ),
			'discount' => __( 'Discount', 'multipass' ),
			'total'    => __( 'Total', 'multipass' ),
			'deposit'  => __( 'Deposit', 'multipass' ),
			'paid'     => __( 'Paid', 'multipass' ),
			'balance'  => __( 'Balance', 'multipass' ),
		);

		// unset($columns['paid']);
		// $columns['paid'] = __('Paid', 'multipass' );

		return $columns;
	}

	static function sortable_columns( $columns ) {
		$columns = array_merge(
			$columns,
			array(
				'dates'    => 'dates',
				'contact'  => 'contact_name',
				'customer' => 'customer',
			// 'total' => 'total',
			// 'discount' => 'discount_total',
			// 'paid' => 'paid',
			// 'balance' => 'balance',
			)
		);
		// $columns['dates'] = 'dates';
		// $columns['contact'] = 'contact';
		return $columns;
	}

	static function admin_columns_display( $column, $post_id ) {
		// Image column
		switch ( $column ) {
			case 'dates':
				echo MultiPass::format_date_range( get_post_meta( $post_id, 'dates', true ) );
				break;

			case 'customer':
				$customer = array(
					'user_id' => get_post_meta( $post_id, 'customer_id', true ),
					'name'    => get_post_meta( $post_id, 'customer_name', true ),
				// 'email' => get_post_meta($post_id, 'customer_email', true),
				);
				echo Mltp_Item::customer_html( $customer );
				break;

			case 'contact':
				// if(get_post_meta($post_id, 'contact_name', true) != get_post_meta($post_id, 'customer_name', true)) {
				$contact = array_merge(
					array(
						// 'user_id' => get_post_meta($post_id, 'customer_id', true),
						'name'  => get_post_meta( $post_id, 'customer_name', true ),
						'email' => get_post_meta( $post_id, 'customer_email', true ),
						'phone' => get_post_meta( $post_id, 'customer_phone', true ),
					),
					array_filter(
						array(
							'name'  => get_post_meta( $post_id, 'contact_name', true ),
							'email' => get_post_meta( $post_id, 'contact_email', true ),
							'phone' => get_post_meta( $post_id, 'contact_phone', true ),
						)
					),
				);
				echo Mltp_Item::customer_html( $contact );
				// }
				break;

			case 'discount':
			case 'deposit':
				$values = get_post_meta( $post_id, $column, true );
				if ( ! empty( $values['total'] ) ) {
					echo MultiPass::price( $values['total'] );
				}
				break;

			case 'total':
			case 'paid':
			case 'balance':
				$value = get_post_meta( $post_id, $column, true );
				// if(empty($value) ) $value = 0;
				echo MultiPass::price( get_post_meta( $post_id, $column, true ) );
				break;

			default:
				echo get_post_meta( $post_id, $column, true );
		}
	}

	static function sortable_columns_order( $query ) {
		if ( ! is_admin() ) {
			return;
		}
		$orderby = $query->get( 'orderby' );

		switch ( $orderby ) {
			case 'dates':
				$query->set( 'meta_key', 'sort_date' );
				$query->set( 'orderby', 'meta_value' );
				break;
		}
	}

	static function new_post_random_slug( $data, $postarr ) {
		if ( ! in_array( $data['post_type'], array( 'prestation' ), true ) ) {
			return $data;
		}

		if ( empty( $postarr['ID'] ) || empty( $postarr['post_name'] ) ) {
			$data['post_name'] = MultiPass::unique_random_slug();
		}

		return $data;
	}

	function get( $args ) {
		if ( empty( $args ) ) {
			return $args;
		}
		if ( is_numeric( $args ) ) {
			$prestation = get_post( $args );
		} elseif ( is_object( $args ) && $args->post_type == 'prestation' ) {
			$prestation = $args;
		}
		if ( isset( $prestation ) ) {
			return $prestation;
		}

		$prestation_id  = $args['prestation_id'];
		$customer_id    = $args['customer_id'];
		$customer_name  = $args['customer_name'];
		$customer_email = $args['customer_email'];

		// Check by customer id, email or name
		$query_args = array(
			'post_type'       => 'prestation',
			'post_status__in' => array( 'pending', 'on-hold', 'deposit', 'partial', 'unpaid', 'processing' ),
			'orderby'         => 'post_date',
			'order'           => 'desc',
		);
		if ( ! empty( $customer_id ) ) {
			$query_args['meta_query'] = array(
				array(
					'key'   => 'customer_id',
					'value' => esc_attr( $customer_id ),
				),
			);
		} elseif ( ! empty( $customer_email ) ) {
			$query_args['meta_query'] = array(
				'relation' => 'OR',
				array(
					'key'   => 'customer_email',
					'value' => esc_attr( $customer_email ),
				),
				array(
					'key'   => 'attendee_email',
					'value' => esc_attr( $customer_email ),
				),
			);
		} elseif ( ! empty( $customer_name ) ) {
			$query_args['meta_query'] = array(
				'relation' => 'OR',
				array(
					'key'   => 'customer_name',
					'value' => esc_attr( $customer_name ),
				),
				array(
					'key'   => 'contact_name',
					'value' => esc_attr( $customer_name ),
				),
			);
		}
		$prestations = get_posts( $query_args );
		$prestation  = false;
		if ( $prestations ) {
			$prestation    = $prestations[0];
			$prestation_id = $prestation->ID;
			// error_log("$prestation->ID $prestation->post_title " . print_r($prestation, true));
			// update_post_meta( $order_id, 'prestation_id', $prestation_id );
		}
		if ( $prestation ) {
			return $prestation;
		}

		// Nothing worked so far, create one
		$meta          = array(
			// 'prestation_id' => $prestation_id,
			'customer_id'    => $customer_id,
			'customer_name'  => $customer_name,
			'customer_email' => $customer_email,
		);
		$postarr       = array(
			'post_author'   => $customer_id,
			'post_date'     => esc_attr( $args['date'] ),
			'post_date_gmt' => esc_attr( $args['date_gmt'] ),
			'post_type'     => 'prestation',
			'post_status'   => 'publish',
			'meta_input'    => $meta,
		);
		$prestation_id = wp_insert_post( $postarr );
		// update_post_meta( $order_id, 'prestation_id', $prestation_id );
		// foreach ($postarr['meta_input'] as $key => $value) update_post_meta( $order_id, $key, $value );

		// if(!empty($prestation_id)) {
			// foreach ($meta as $key => $value) update_post_meta( $order_id, $key, $value );
			// Mltp_WooCommerce::update_prestation_orders($prestation_id, get_post($prestation_id), true );
		// }

		$prestation = get_post( $prestation_id );
		return $prestation;
	}

}
