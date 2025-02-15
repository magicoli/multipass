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
 * @author     Magiiic <info@magiiic.com>
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

	public $post = false;
	public $id   = false;
	public $name = false;

	/**
	 * Initialize the collections used to maintain the actions and filters.
	 * If $args is passed, attempt to create a prestation object
	 *
	 * @param    integer|object|array $args Object post id or data to use to search prestation.
	 */
	public function __construct( $args = null ) {
		$post = $this->get( $args );
		if ( is_object( $post ) & ! is_wp_error( $post ) ) {
			$this->id   = $post->ID;
			$this->name = $post->post_title;
			$this->post = $post;
			$this->slug = $post->post_name;

			$this->customer_name  = get_post_meta( $this->id, 'customer_name', true );
			$this->customer_email = get_post_meta( $this->id, 'customer_email', true );
			$this->customer_phone = get_post_meta( $this->id, 'customer_phone', true );

			$this->dates     = get_post_meta( $this->id, 'dates', true );
			$this->from      = get_post_meta( $this->id, 'from', true );
			$this->to        = get_post_meta( $this->id, 'to', true );
			$this->guests    = get_post_meta( $this->id, 'guests', true );
			$this->attendees = get_post_meta( $this->id, 'attendees', true );

			$discount       = get_post_meta( $this->id, 'discount', true );
			$this->discount = ( is_array( $discount ) ) ? ( isset( $discount['amount'] ) ? $discount['amount'] : null ) : $discount;
			$deposit        = get_post_meta( $this->id, 'deposit', true );
			$this->deposit  = ( is_array( $deposit ) ) ? ( isset( $deposit['amount'] ) ? $deposit['amount'] : null ) : $deposit;

			$this->subtotal = ( isset( $price['sub_total'] ) ) ? $price['sub_total'] : null;
			$this->total    = get_post_meta( $this->id, 'total', true );
			$this->paid     = get_post_meta( $this->id, 'paid', true );
			$this->balance  = get_post_meta( $this->id, 'balance', true );
		}
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
	 * @param    int    $accepted_args    Optional. The number of arguments that should be passed to the $callback. Default is 1.
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
	public function init() {

		$actions = array(
			array(
				'hook'     => 'init',
				'callback' => 'register_post_types',
			),
			array(
				'component' => $this,
				'hook'      => 'admin_init',
				'callback'  => 'register_permalink_options',
			),
			array(
				'hook'     => 'init',
				'callback' => 'register_taxonomies',
			),
			array(
				'component' => $this,
				'hook' => 'mb_relationships_init',
				'callback' => 'register_relationships',
			),

			array(
				'hook'          => 'save_post', // use save_post because save_post_mltp_detail is fired before actual save and meta values are not yet updated.
				'callback'      => 'save_post_action',
				'accepted_args' => 3,
			),

			array(
				'hook'     => 'pre_get_posts',
				'callback' => 'sortable_columns_order',
			),

			array(
				'component' => $this,
				'hook'      => 'loop_start',
				'callback'  => 'hide_content_for_unauthorized_users',
			),
			array(
				'component' => $this,
				'hook'      => 'restrict_manage_posts',
				'callback'  => 'add_year_dropdown',
			),
		);

		$filters = array(
			array(
				'component' => $this,
				'hook'      => 'rwmb_meta_boxes',
				'callback'  => 'register_fields',
				'priority'  => 5,
			),
			array(
				'component'     => $this,
				'hook'          => 'the_title',
				'callback'      => 'rewrite_the_title',
				'accepted_args' => 2,
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
				'hook'     => 'manage_mltp_prestation_posts_columns',
				'callback' => 'add_admin_columns',
			),
			array(
				'hook'          => 'manage_mltp_prestation_posts_custom_column',
				'callback'      => 'admin_columns_display',
				'priority'      => 99,
				'accepted_args' => 2,
			),
			array(
				'hook'     => 'manage_edit-mltp_prestation_sortable_columns',
				'callback' => 'sortable_columns',
			),
			array(
				'component' => $this,
				'hook'      => 'parse_query',
				'callback'  => 'filter_by_year',
			),
		);

		foreach ( $filters as $hook ) {
			$hook = array_merge(
				array(
					'component'     => __CLASS__,
					'priority'      => 10,
					'accepted_args' => 1,
				),
				$hook
			);
			add_filter( $hook['hook'], array( $hook['component'], $hook['callback'] ), $hook['priority'], $hook['accepted_args'] );
		}

		foreach ( $actions as $hook ) {
			$hook = array_merge(
				array(
					'component'     => __CLASS__,
					'priority'      => 10,
					'accepted_args' => 1,
				),
				$hook
			);
			add_action( $hook['hook'], array( $hook['component'], $hook['callback'] ), $hook['priority'], $hook['accepted_args'] );
		}

	}


	/**
	 * Register Prestation post type
	 *
	 * @return void
	 */
	public static function register_post_types() {
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
			'all_items'                => esc_html__( 'Prestations', 'multipass' ),
			'menu_name'                => esc_html__( 'Prestations', 'multipass' ),
			'archives'                 => esc_html__( 'Prestation Archives', 'multipass' ),
			'attributes'               => esc_html__( 'Prestation Attributes', 'multipass' ),
			'insert_into_item'         => esc_html__( 'Insert into prestation', 'multipass' ),
			'uploaded_to_this_item'    => esc_html__( 'Uploaded to this prestation', 'multipass' ),
			'featured_image'           => esc_html__( 'Featured image', 'multipass' ),
			'set_featured_image'       => esc_html__( 'Set featured image', 'multipass' ),
			'remove_featured_image'    => esc_html__( 'Remove featured image', 'multipass' ),
			'use_featured_image'       => esc_html__( 'Use as featured image', 'multipass' ),
			'filter_items_list'        => esc_html__( 'Filter prestations list', 'multipass' ),
			'filter_by_date'           => esc_html__( 'Filter by date', 'multipass' ),
			'items_list_navigation'    => esc_html__( 'Prestations list navigation', 'multipass' ),
			'items_list'               => esc_html__( 'Prestations list', 'multipass' ),
			'item_published'           => esc_html__( 'Prestation published', 'multipass' ),
			'item_published_privately' => esc_html__( 'Prestation published privately', 'multipass' ),
			'item_reverted_to_draft'   => esc_html__( 'Prestation reverted to draft', 'multipass' ),
			'item_scheduled'           => esc_html__( 'Prestation scheduled', 'multipass' ),
			'item_updated'             => esc_html__( 'Prestation updated', 'multipass' ),
			'select_an_item'           => esc_html__( 'Select a prestation', 'multipass' ),
			'text_domain'              => 'multipass',
		);
		$args   = array(
			'label'               => esc_html__( 'Prestations', 'multipass' ),
			'labels'              => $labels,
			'description'         => '',
			'public'              => false,
			'hierarchical'        => false,
			'exclude_from_search' => ! current_user_can( 'mltp_reader' ),
			'publicly_queryable'  => true, // current_user_can( 'mltp_reader' ),
			'show_ui'             => true,
			'show_in_nav_menus'   => true,
			'show_in_admin_bar'   => true,
			'show_in_rest'        => true,
			'query_var'           => true,
			'can_export'          => true,
			'delete_with_user'    => true,
			'has_archive'         => 'prestations',
			'has_archive'         => true,
			'rest_base'           => '',
			'show_in_menu'        => 'multipass',
			// 'show_in_menu'        => true,
			// 'menu_position' => 25,
			'capability_type'     => 'mltp_prestation',
			'supports'            => array( '' ),
			'taxonomies'          => array(),
			'rewrite'             => array(
				'slug'       => self::slug(),
				'with_front' => false,
			),
		);

		register_post_type( 'mltp_prestation', $args );

		register_post_status(
			'canceled',
			array(
				'label'                     => __( 'Canceled', 'multipass' ),
				'label_count'               => _n_noop(
					'Canceled <span class="count">(%s)</span>',
					'Canceled <span class="count">(%s)</span>',
				),
				'show_in_admin_status_list' => true,
			)
		);
		register_post_status(
			'open',
			array(
				'label'                     => __( 'Open', 'multipass' ),
				'label_count'               => _n_noop(
					'Open <span class="count">(%s)</span>',
					'Open <span class="count">(%s)</span>',
				),
				'show_in_admin_status_list' => true,
			)
		);

	}

	function register_permalink_options() {
		if ( isset( $_POST ) ) {
			self::multipass_permalink_save( $_POST );
		}

		// Add the MultiPass section to the permalinks admin page
		add_settings_section(
			'mltp-permalink-options', // ID for the section
			__( 'MultiPass permalinks', 'multipass' ), // Title of the section
			array( $this, 'multipass_permalink_callback' ), // Callback function to display the section content
			'permalink' // Page on which to display the section
		);

		// Save the MultiPass option value
		add_settings_field(
			'mltp_prestation_slug', // ID for the field
			__( 'Prestation slug', 'multipass' ), // Title of the field
			array( $this, 'mltp_prestation_slug_callback' ), // Callback function to display the field content
			'permalink', // Page on which to display the field
			'mltp-permalink-options' // Section ID
		);

		register_setting( 'permalink', 'mltp_prestation_slug' );
	}

	function multipass_permalink_callback() {
		// echo '<p>Customize the MultiPass permalink structure:</p>';
	}

	static function slug() {
		$slug = get_option( 'mltp_prestation_slug' );
		$slug = ( empty( $slug ) ) ? __( 'prestations', 'multipass' ) : $slug;
		return $slug;
	}

	function mltp_prestation_slug_callback() {
		wp_nonce_field( 'mltp_prestation_slug', 'mltp_prestation_slug_nonce' );
		printf(
			'<input name="mltp_prestation_slug" id="mltp_prestation_slug" type="text" value="%s" />
			<p class="description">%s</p>',
			self::slug(),
			sprintf(
				__( 'Slug prepended to prestations urls, leave empty for default (%s).', 'multipass' ),
				'<code>prestations</code>',
			),
		);
	}

	function multipass_permalink_save( $input ) {
		if ( isset( $input['mltp_prestation_slug'] ) && isset( $input['mltp_prestation_slug_nonce'] ) ) {
			// Verify the nonce
			if ( ! wp_verify_nonce( $input['mltp_prestation_slug_nonce'], 'mltp_prestation_slug' ) ) {
				return $input;
			}

			$new_slug = sanitize_title( $input['mltp_prestation_slug'] );
			$old_slug = get_option( 'mltp_prestation_slug' );

			if ( $new_slug != $old_slug ) {
				update_option( 'mltp_prestation_slug', $new_slug );
			}

			$input['mltp_prestation_slug'] = $new_slug;
		}

		return $input;
	}

	/**
	 * Register Prestations fields
	 *
	 * @param  array $meta_boxes    current metaboxes.
	 * @return array                updated metaboxes.
	 */
	public function register_fields( $meta_boxes ) {
		$js_date_format_short = preg_match( '/^[Fm]/', get_option( 'date_format' ) ) ? 'mm-dd-yy' : 'dd-mm-yy';

		$prefix                         = '';
		$meta_boxes['prestation-title'] = array(
			'title'      => __( 'Prestations', 'multipass' ),
			'id'         => 'prestation-title-fields',
			'post_types' => array( 'mltp_prestation' ),
			'context'    => 'form_top',
			'context'    => 'after_title',
			'priority'   => 'high',
			'style'      => 'seamless',
			'autosave'   => true,
			'fields'     => array(
				array(
					'id'       => $prefix . 'title_html',
					'type'     => 'custom_html',
					'callback' => 'MultiPass::title_html',
				),
			),
		);
		$meta_boxes['prestation-cpt']   = array(
			'title'      => __( 'Prestations', 'multipass' ),
			'id'         => 'prestation-fields',
			'post_types' => array( 'mltp_prestation' ),
			'priority'   => 'low',
			'style'      => 'seamless',
			'autosave'   => true,
			'fields'     => array(
				// array(
				// 'name'       => __( 'Customer', 'multipass' ),
				// 'id'         => $prefix . 'customer_id',
				// 'type'       => 'user',
				// 'field_type' => 'select_advanced',
				// ),
				// array(
				// 'name'        => __( 'Contact name', 'multipass' ),
				// 'id'          => $prefix . 'contact_name',
				// 'type'        => 'text',
				// 'description' => __( 'Leave empty if same as customer name', 'multipass' ),
				// ),
				// array(
				// 'name' => _x( 'Contact', '(noun)', 'multipass' ),
				// 'id'   => $prefix . 'display_name',
				// 'type' => 'hidden',
				// ),
				// array(
				// 'name' => __( 'Contact Email', 'multipass' ),
				// 'id'   => $prefix . 'contact_email',
				// 'type' => 'email',
				// ),
				// array(
				// 'name' => __( 'Contact Phone', 'multipass' ),
				// 'id'   => $prefix . 'contact_phone',
				// 'type' => 'text',
				// ),
				array(
					'name'   => __( 'Dates', 'multipass' ),
					'id'     => $prefix . 'dates',
					'type'   => 'group',
					'class'  => 'inline',
					'fields' => array(
						array(
							'prepend'    => __( 'From', 'multipass' ),
							'id'         => $prefix . 'from',
							// 'readonly'   => true,
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
							// 'readonly'   => true,
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
		$meta_boxes['prestation-notes'] = array(
			// 'title'      => __( 'Notes', 'multipass' ),
			'id'         => 'prestation-notes',
			'post_types' => array( 'mltp_prestation' ),
			// 'context'    => 'after_title',
			'style'      => 'seamless',
			// 'autosave'   => true,
			'fields'     => array(
				array(
					'name'    => __( 'Notes', 'prestations' ),
					'id'      => $prefix . 'notes',
					'type'    => 'wysiwyg',
					'raw'     => false,
					'options' => array(
						'textarea_rows'     => 10,
						'teeny'             => true,
						'media_buttonsbool' => false,
					),
					// 'columns' => 6,
				),
				// array(
				// 'name'    => __( 'Notes', 'prestations' ),
				// 'id'       => $prefix . 'details_notes',
				// 'type'     => 'custom_html',
				// 'callback' => 'Mltp_Prestation::render_details_notes',
				// 'columns'  => 6,
				// ),
			),
		);

		$prefix                = 'managed_';
		$meta_boxes['managed'] = array(
			'id'         => 'prestation-managed',
			'post_types' => array( 'mltp_prestation' ),
			'style'      => 'seamless',
			'readonly'   => true,
			'fields'     => array(
				array(
					'name'     => __( 'Elements', 'multipass' ),
					'id'       => $prefix . 'items',
					'type'     => 'custom_html',
					'callback' => __CLASS__ . '::items_list',
					'columns'  => 12,
				),
			),
		);

		$prefix       = '';
		$meta_boxes[] = array(
			'id'         => 'mltp_details',
			'post_types' => array( 'mltp_prestation' ),
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
								'product'  => __( 'Product', 'multipass' ),
								'resource' => __( 'Resource', 'multipass' ),
								'booking'  => __( 'Booking', 'multipass' ),
								'payment'  => __( 'Payment', 'multipass' ),
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
							'pattern' => '-*[0-9]+([,\.][0-9]+)?',
						),
					),
				),
			),
		);

		$meta_boxes['prestation-summary'] = array(
			'title'      => __( 'Summary', 'multipass' ),
			'id'         => 'prestation-summary',
			'post_types' => array( 'mltp_prestation' ),
			'context'    => 'side',
			'fields'     => array(
				array(
					'name'     => __( 'Regular Price', 'multipass' ),
					'id'       => $prefix . 'price_html',
					'type'     => 'custom_html',
					'callback' => array( $this, 'get_summary_subtotal' ),
				),
				array(
					'name'     => __( 'Discount', 'multipass' ),
					'id'       => $prefix . 'discount_html',
					'type'     => 'custom_html',
					'callback' => array( $this, 'get_summary_discount' ),
				),
				array(
					'name'     => __( 'Total', 'multipass' ),
					'id'       => $prefix . 'total_html',
					'type'     => 'custom_html',
					'class'    => 'total',
					'callback' => array( $this, 'get_summary_total' ),
				),
				array(
					'name'     => __( 'Deposit', 'multipass' ),
					'id'       => $prefix . 'deposit_amount_html',
					'type'     => 'custom_html',
					'callback' => array( $this, 'get_summary_deposit' ),
				),
				array(
					'name'     => __( 'Paid', 'multipass' ),
					'id'       => $prefix . 'paid_html',
					'type'     => 'custom_html',
					'callback' => array( $this, 'get_summary_paid' ),
				),
				array(
					'name'     => __( 'Balance', 'multipass' ),
					'id'       => $prefix . 'balance_html',
					'type'     => 'custom_html',
					'class'    => 'balance',
					'callback' => array( $this, 'get_summary_balance' ),
				),
				array(
					'name'     => __( 'Reference #', 'multipass' ),
					'id'       => $prefix . 'reference',
					'type'     => 'custom_html',
					'callback' => array( $this, 'get_summary_reference' ),
				),
				array(
					'name'           => __( 'Status', 'multipass' ),
					'id'             => 'status',
					'type'           => 'taxonomy',
					'taxonomy'       => array( 'prestation-status' ),
					'field_type'     => 'custom_html',
					'callback'       => __CLASS__ . '::display_status',
					'class'          => 'status',
					'readonly'       => true,
					'remove_default' => true,
					'admin_columns'  => array(
						'filterable' => true,
					),
				),
			),
		);

		return $meta_boxes;
	}

	/**
	 * Register prestation-task relationship.
	 */
	function register_relationships() {
		MB_Relationships_API::register( [
			'id'   => 'prestation-task',
			'from' => [
				'object_type'  => 'post',
				'post_type'    => 'mltp_prestation',
				'admin_column' => [
					'position' => 'after title',
					'title'    => __( 'Elements', 'multipass' ),
					'link'     => 'edit',
				],
				'meta_box'     => [
					'context'  => 'normal',
					'priority' => 'high',
					'style'    => 'seamless',
				],
				'field'        => [
					'name'      => __('Prestation', 'multipass'),
					'max_clone' => 1,
				],
			],
			'to'   => [
				'object_type'  => 'post',
				'post_type'    => 'mltp_detail',
				'admin_column' => [
					'position' => 'after title',
					'title'    => __('Prestation', 'multipass'),
					'link'     => 'edit',
				],
				'meta_box'     => [
					'priority' => 'high',
					'style'    => 'seamless',
				],
				'field'        => [
					'name'    => __('Elements', 'multipass'),
					'add_new' => true,
					'multiple' => false,
				],
			],
		] );
	}

	/**
	 * Register prestation-status taxonomy.
	 *
	 * @return void
	 */
	public static function register_taxonomies() {
		$labels = array(
			'name'                       => esc_html__( 'Prestation statuses', 'multipass' ),
			'singular_name'              => esc_html__( 'Prestation status', 'multipass' ),
			'menu_name'                  => esc_html__( 'Statuses', 'multipass' ),
			'search_items'               => esc_html__( 'Search statuses', 'multipass' ),
			'popular_items'              => esc_html__( 'Popular statuses', 'multipass' ),
			'all_items'                  => esc_html__( 'All statuses', 'multipass' ),
			'parent_item'                => esc_html__( 'Parent Prestation status', 'multipass' ),
			'parent_item_colon'          => esc_html__( 'Parent Prestation status', 'multipass' ),
			'edit_item'                  => esc_html__( 'Edit Prestation status', 'multipass' ),
			'view_item'                  => esc_html__( 'View Prestation status', 'multipass' ),
			'update_item'                => esc_html__( 'Update Prestation status', 'multipass' ),
			'add_new_item'               => esc_html__( 'Add new prestation status', 'multipass' ),
			'new_item_name'              => esc_html__( 'New prestation status name', 'multipass' ),
			'separate_items_with_commas' => esc_html__( 'Separate statuses with commas', 'multipass' ),
			'add_or_remove_items'        => esc_html__( 'Add or remove statuses', 'multipass' ),
			'choose_from_most_used'      => esc_html__( 'Choose most used statuses', 'multipass' ),
			'not_found'                  => esc_html__( 'No status found', 'multipass' ),
			'no_terms'                   => esc_html__( 'No status', 'multipass' ),
			'filter_by_item'             => esc_html__( 'Filter by prestation status', 'multipass' ),
			'items_list_navigation'      => esc_html__( 'Prestation statuses list pagination', 'multipass' ),
			'items_list'                 => esc_html__( 'Prestation statuses list', 'multipass' ),
			'most_used'                  => esc_html__( 'Most Used', 'multipass' ),
			'back_to_items'              => esc_html__( 'Back to statuses', 'multipass' ),
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
		register_taxonomy( 'prestation-status', array( 'mltp_prestation' ), $args );

		if ( MultiPass::debug() ) {
			add_submenu_page(
				'multipass', // string $parent_slug,
				$labels['name'], // string $page_title,
				'<span class="dashicons dashicons-admin-tools"></span> ' . $labels['menu_name'], // string $menu_title,
				'mltp_administrator', // string $capability,
				'edit-tags.php?taxonomy=prestation-status&post_type=mltp_prestation', // string $menu_slug,
			);
		}
		add_action( 'prestation-status_pre_add_form', 'MultiPass::back_to_multipass_button' );

		/**
		 * statuses, we use basically the same terminology as
		 * WooCommerce, but it is not mandatory.
		 */
		MultiPass::register_terms(
			'prestation-status',
			array(
				// Open (still modifiable, available for new order inclusion).
				'pending'        => array( 'name' => __( 'Pending payment', 'multipass' ) ),  // unpaid or paid less than deposit, not confirmed.
				'on-hold'        => array( 'name' => __( 'On hold', 'multipass' ) ), // fully paid and not started.
				'processing'     => array( 'name' => __( 'Processing', 'multipass' ) ), // paid and started.

			// Closed (not modifiable except refunds, not available for new order inclusion).
				'completed'      => array( 'name' => __( 'Completed', 'multipass' ) ), // paid and finished.
				'canceled'       => array( 'name' => __( 'Canceled', 'multipass' ) ),
				'refunded'       => array( 'name' => __( 'Refunded', 'multipass' ) ),
				'failed'         => array( 'name' => __( 'Failed', 'multipass' ) ), // shouldn't need that at prestation level.

			// Draft (not available for new order inclusion).
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

	public function hide_content_for_unauthorized_users() {
		global $post;

		// Check if the post type is mltp_prestation
		if ( 'mltp_prestation' !== @$post->post_type ) {
			return;
		}

		// if ( ! session_id() ) {
		// 	session_start();
		// }

		// Check if the user has mltp_reader capability
		if ( current_user_can( 'mltp_reader' ) ) {
			return;
		}

		// Get the customer_email value for the current post
		$customer_email = get_post_meta( $post->ID, 'customer_email', true );
		$customer_id    = get_post_meta( $post->ID, 'customer_id', true );

		// Check if the current user has the same email as the customer_email
		if ( is_user_logged_in() ) {
			$current_user  = wp_get_current_user();
			$visitor_email = $current_user->user_email;
			if ( $customer_email === $visitor_email || $customer_id == $current_user->ID ) {
				return;
			}
		}

		if ( isset( $_SESSION['validated_email'] ) ) {
			$visitor_email = sanitize_email( $_SESSION['validated_email'] );
		}

		if ( isset( $_POST['email'] ) && ! empty( $_POST['email'] ) ) {
			// Verify the nonce
			if ( ! wp_verify_nonce( $_POST['email_nonce'], 'email_validation' ) ) {
				$mltp_auth_error = __( 'Invalid session, please try again', 'multipass' );
				// wp_die( esc_html__( 'Invalid nonce.', 'multipass' ) );
			} else {
				$visitor_email = sanitize_email( $_POST['email'] );
			}
		}

		if ( isset( $visitor_email ) ) {
			if ( $customer_email === $visitor_email ) {
				// The visitor's email matches the customer's email, grant access and store the validated email in a session
				$_SESSION['validated_email'] = $visitor_email;
				return;
			} else {
				$mltp_auth_error = __( 'Invalid email, try again', 'multipass' );
			}
		}

		if ( isset( $_POST['email'] ) ) {
			$submitted_mail = $_POST['email'];
		} elseif ( isset( $_SESSION['validated_email'] ) ) {
			$submitted_mail = $_SESSION['validated_email'];
		} elseif ( is_user_logged_in() ) {
			$submitted_mail = wp_get_current_user()->user_email;
		}

		// session_write_close();

		printf(
			'
			<div class="login mltp-mail-validation-form">
				<h2>%1$s</h2>
				<form id=loginform method="post">
					%2$s
					<p class="description">
						%7$s
					</p>
					<p>
						<label for="email">
							<input type="email" name="email" id="email" placeholder="%3$s" value="%4$s" required>
						</label>
						<input type="submit" value="%5$s">
						%6$s
					</p>
				</form>
			</div>',
			esc_html__( 'Please provide your email address to access this content:', 'multipass' ),
			wp_nonce_field( 'email_validation', 'email_nonce', true, false ),
			esc_html__( 'Your Email', 'multipass' ),
			( isset( $submitted_mail ) ) ? esc_attr( $submitted_mail, 'multipass' ) : '',
			esc_attr__( 'Submit', 'multipass' ),
			( empty( $mltp_auth_error ) ) ? '' : sprintf( '<p id=login_error class="error">%s</p>', esc_html( $mltp_auth_error ) ),
			__( 'Only used for validation, it will not be stored and no message will be sent.' ),
		);
		exit();
	}

	/**
	 * Return an array of prestation posts for field option
	 */
	public static function get_prestation_options() {
		$options = get_transient('mltp_prestation_options');

		if ($options !== false) {
			return $options;
		}

		$posts = get_posts(
			array(
				'post_type'      => 'mltp_prestation',
				'posts_per_page' => -1,
				'post_status'    => array( 'publish', 'open', 'draft' ),
				'orderby'        => 'post_date',
				'order'          => 'desc',
			)
		);
		
		// $options = wp_list_pluck( $posts, 'post_title', 'ID' );
		$options = array();
		foreach ($posts as $post) {
			$prestation = new Mltp_Prestation($post->ID);
			$options[$post->ID] = $prestation->full_title();
		}
	
		set_transient('mltp_prestation_options', $options, 12 * HOUR_IN_SECONDS);
		return $options;
	}
	
	/**
	 * Get items belonging to this prestation.
	 *
	 * @return array Items formatted as array.
	 */
	public function get_items_as_posts() {
		$query_args = array(
			'post_type'   => 'mltp_detail',
			'post_status' => array( 'publish', 'open', 'canceled' ),
			'numberposts' => -1,
			'orderby'     => 'post_date',
			'order'       => 'asc',
			'meta_query'  => array(
				'relation' => 'AND',
				array(
					'key'   => 'prestation_id',
					'value' => $this->id,
				),
			),
		);
		$item_posts = get_posts( $query_args );
		return $item_posts;
	}

	public function summary( $context = null ) {
		if ( ! $this->is_prestation() ) {
			return;
		}

		$details        = $this->get_details_array();
		$total          = get_post_meta( $this->id, 'total', true );
		$subtotal       = get_post_meta( $this->id, 'subtotal', true );
		$deposit_rules  = get_post_meta( $this->id, 'deposit', true );
		$deposit        = ( ! empty( $deposit_rules['amount'] ) ) ? $deposit_rules['amount'] : null;
		$discount_rules = get_post_meta( $this->id, 'discount', true );
		$discount       = ( ! empty( $discount_rules['amount'] ) ) ? $discount_rules['amount'] : null;
		$paid           = get_post_meta( $this->id, 'paid', true );
		$balance        = get_post_meta( $this->id, 'balance', true );

		$title   = '<tr><th colspan="2">' . $this->name . '</th></tr>';
		$list    = array( $title );
		$amounts = array();
		foreach ( $details as $detail ) {
			$amounts[] = array(
				'desc'  => $detail['description'],
				'price' => MultiPass::price( $detail['total'] ),
			);
		}
		// if ( ! empty( $this->get_summary_total( true ) ) ) {
		// $amounts += array(
		// 'total' => array(
		// 'desc'  => __( 'Prestation total', 'multipass' ),
		// 'price' => $this->get_summary_total(),
		// ),
		// );
		// }

		if ( $subtotal != $total ) {
			$amounts += array(
				'subtotal' => array(
					'desc'  => __( 'Prestation subtotal', 'multipass' ),
					'price' => MultiPass::price( $subtotal ),
				),
				'discount' => array(
					'desc'  => __( 'Prestation discount', 'multipass' ),
					'price' => MultiPass::price( $discount ),
				),
			);
		}

		if ( ! empty( $total ) ) {
			$amounts += array(
				'total' => array(
					'desc'  => __( 'Prestation total', 'multipass' ),
					'price' => MultiPass::price( $total ),
				),
			);
		}
		if ( ! empty( $deposit ) && $deposit < $paid ) {
			$amounts += array(
				'deposit' => array(
					'desc'  => __( 'Deposit', 'multipass' ),
					'price' => MultiPass::price( $deposit ),
				),
			);
		}
		if ( ! empty( $paid ) ) {
			$amounts += array(
				'paid' => array(
					'desc'  => __( 'Paid', 'multipass' ),
					'price' => MultiPass::price( $paid ),
				),
			);
		}
		if ( ! empty( $balance ) ) {
			$amounts += array(
				'balance' => array(
					'desc'  => __( 'Balance', 'multipass' ),
					'price' => MultiPass::price( $balance ),
				),
			);
		}

		// $amounts['total'] = array(
		// 'desc' => __('Prestation total', 'multipass'),
		// 'price' => $detail['total']
		// )
		$output[] = $title;
		foreach ( $amounts as $key => $amount ) {
			$output[] = sprintf(
				'<tr>
				<td class="description">%s</td>
				<td class="price">%s</td>
				</tr>',
				$amount['desc'],
				$amount['price'],
			);
		}

		return '<table class="prestation-summary">' . join( ' ', $output ) . '</table>';

	}

	/**
	 * Get items belonging to this prestation.
	 *
	 * @return array Items formatted as array.
	 */
	public function get_details_array() {

		$item_posts = $this->get_items_as_posts();
		$data       = array();

		foreach ( $item_posts as $item_post ) {
			$meta = array_merge(
				array(
					'description' => $item_post->post_title,
					'type'        => null,
					'source'      => null,
				),
				get_post_meta( $item_post->ID ),
			);
			if ( ! isset( $meta['description'] ) ) {
				// error_log( print_r( $meta, true ) );
			}

			$price    = get_post_meta( $item_post->ID, 'price', true );
			$dates    = get_post_meta( $item_post->ID, 'dates', true );
			$discount = get_post_meta( $item_post->ID, 'discount', true );
			$deposit  = get_post_meta( $item_post->ID, 'deposit', true );
			$links    = Mltp_Item::item_links_html( $item_post, array( 'format' => 'icon' ) );

			$data[] = array(
				'ID'          => $item_post->ID,
				'date'        => $item_post->post_date,
				'description' => empty( $meta['description'] ) ? $item_post->post_title : ( is_array( $meta['description'] ) ? reset( $meta['description'] ) : $meta['description'] ),
				'type'        => is_array( $meta['type'] ) ? reset( $meta['type'] ) : $meta['type'],
				'dates'       => $dates,
				'subtotal'    => isset( $price['sub_total'] ) ? $price['sub_total'] : null,
				'discount'    => isset( $discount['amount'] ) ? $discount['amount'] : null,
				'total'       => ( isset( $meta['total'] ) && is_array( $meta['total'] ) ) ? reset( $meta['total'] ) : null,
				'deposit'     => ( is_array( $deposit ) & ! empty( $deposit['amount'] ) ) ? $deposit['amount'] : null,
				'paid'        => ( isset( $meta['paid'] ) && is_array( $meta['paid'] ) ) ? reset( $meta['paid'] ) : null,
				'balance'     => ( isset( $meta['balance'] ) && is_array( $meta['balance'] ) ) ? reset( $meta['balance'] ) : null,
				'source'      => is_array( $meta['source'] ) ? reset( $meta['source'] ) : ( isset( $meta['source'] ) ? $meta['source'] : '' ),
				'links'       => $links,
				'notes'       => get_post_meta( $item_post->ID, 'notes', true ),
			);
		}

		return $data;
	}

	/**
	 * Define columns to display in admin list.
	 *
	 * @return array Columns.
	 */
	public function get_columns() {
		return array(
			// 'ID' => __('ID', 'multipass'),
			// 'date' => __('Date', 'multipass'),
			'type'        => __( 'Type', 'multipass' ),
			'description' => __( 'Description', 'multipass' ),
			'dates'       => __( 'Dates', 'multipass' ),
			'subtotal'    => __( 'Subtotal', 'multipass' ),
			'discount'    => __( 'Discount', 'multipass' ),
			'total'       => __( 'Total', 'multipass' ),
			'deposit'     => __( 'Deposit', 'multipass' ),
			'paid'        => __( 'Paid', 'multipass' ),
			'balance'     => __( 'Balance', 'multipass' ),
			'source'      => __( 'Source', 'multipass' ),
			'links'       => __( 'Actions', 'multipass' ),
			'debug'       => __( 'Debug', 'multipass' ),
		);
	}

	function get_years() {
		$years = array();
		$posts = get_posts(
			array(
				'post_type'        => 'mltp_prestation',
				'posts_per_page'   => -1,
				'meta_key'         => 'from',
				'orderby'          => 'meta_value',
				'order'            => 'DESC',
				'fields'           => 'ids',
				'suppress_filters' => true,
			)
		);
		foreach ( $posts as $post_id ) {
			$timestamp = MultiPass::timestamp( get_post_meta( $post_id, 'from', true ) );
			if ( ! empty( $timestamp ) ) {
				$year = date( 'Y', $timestamp );
				if ( ! in_array( $year, $years ) ) {
					$years[] = $year;
				}
			}
		}
		return $years;
	}

	/**
	 * Add filter for 'year' custom field to mltp_prestation admin list
	 */
	function add_year_dropdown() {
		global $typenow;
		if ( $typenow == 'mltp_prestation' ) {
			$selected_year = isset( $_GET['year'] ) ? $_GET['year'] : '';
			$years         = $this->get_years();
			?>
			<select name="year">
				<option value=""><?php esc_html_e( 'All Years', 'text-domain' ); ?></option>
				<?php foreach ( $years as $year ) : ?>
					<option value="<?php echo esc_attr( $year ); ?>" <?php selected( $selected_year, $year ); ?>><?php echo esc_html( $year ); ?></option>
				<?php endforeach; ?>
			</select>
			<?php
		}
	}

	/**
	 * Filter mltp_prestation posts by 'year' custom field
	 */
	function filter_by_year( $query ) {
		global $pagenow, $typenow;
		if ( $typenow == 'mltp_prestation' && $pagenow == 'edit.php' & ! empty( $_GET['year'] ) ) {
			$query->query_vars['meta_query'] = array(
				array(
					'key'     => 'from',
					'value'   => array( strtotime( $_GET['year'] . '-01-01' ), strtotime( $_GET['year'] . '-12-31' ) ),
					'compare' => 'BETWEEN',
					'type'    => 'NUMERIC',
				),
			);
		}
	}

	/**
	 * Build items list to display on prestation edit page.
	 *
	 * @param  object $post    Prestation post.
	 * @param  array  $field   Field info passed by callback, unused.
	 *
	 * @return string  HTML formatted list.
	 */
	public static function items_list( $post = null, $field = array() ) {
		if ( ! is_object( $post ) ) {
			$post = get_post();
		}
		if ( ! self::is_prestation_post( $post ) ) {
			return false;
		}

		$prestation = new Mltp_Prestation( $post );
		$posts      = $prestation->get_details_array();
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
				'rows'    => $posts,
			)
		);

		return $list->render();
	}

	/**
	 * Format subtotal price for summary metabox.
	 *
	 * @return string  HTML formatted currency amount.
	 */
	public function get_summary_subtotal() {
		$amount = get_post_meta( get_post()->ID, 'subtotal', true );
		return MultiPass::price( ( empty( $amount ) ) ? 0 : $amount );
	}


	/**
	 * Format discount amount for summary metabox.
	 *
	 * @return string  HTML formatted currency amount.
	 */

	public function get_discount() {
		$discount = get_post_meta( $this->get_id(), 'discount', true );
		$amount   = ( isset( $discount['total'] ) ) ? $discount['total'] : null;
		if ( $amount > 0 ) {
			return $amount;
		}
	}

	public function get_summary_discount() {
		return MultiPass::price( $this->get_discount() );
		// global $post;
		// $discount = get_post_meta( $post->ID, 'discount', true );
		// $amount   = ( isset( $discount['total'] ) ) ? $discount['total'] : null;
		// if ( $amount > 0 ) {
		// return MultiPass::price( $amount );
		// }
	}

	public function get_id() {
		if ( ! empty( $this->id ) ) {
			return $this->id;
		} else {
			global $post;
			return $post->ID;
		}
	}

	/**
	 * Format total price for summary metabox.
	 *
	 * @return string  HTML formatted currency amount.
	 */
	public function get_total() {
		return get_post_meta( $this->get_id(), 'total', true );
	}


	public function get_summary_total( $raw = false ) {
		return MultiPass::price( $this->get_total() );
		// global $post;
		// error_log("this " . print_r($this, true) . " post_id $post->ID" );
		// $amount = get_post_meta( $post->ID, 'total', true );
		// if ( empty( $amount ) ) {
		// $amount = 0;
		// }
		// error_log(
		// "\nbefore\n" . MultiPass::price( $amount )
		// . "\nnow\n" . MultiPass::price($this->get_total())
		// . "\n"
		// );
		// // return MultiPass::price($this->get_total());
	}

	/**
	 * Format discount percentage for summary metabox.
	 *
	 * @return string  HTML formatted percentage.
	 */
	public function get_summary_deposit_percent() {
		global $post;
		$deposit = get_post_meta( $post->ID, 'deposit', true );
		$percent = ( isset( $deposit['percent'] ) ) ? $deposit['percent'] : null;
		if ( $percent > 0 ) {
			return number_format_i18n( $percent, 0 ) . '%';
		}
	}

	/**
	 * Format deposit amount for summary metabox.
	 *
	 * @return string  HTML formatted currency amount.
	 */
	public function get_summary_deposit() {
		global $post;
		$deposit = get_post_meta( $post->ID, 'deposit', true );
		$amount  = ( isset( $deposit['total'] ) ) ? $deposit['total'] : null;
		if ( $amount > 0 ) {
			$prestation = new Mltp_Prestation( $post->ID );
			return ( $prestation ) ? MultiPass::price_with_links( $prestation, $amount ) : MultiPass::price( $amount );
		}
	}

	/**
	 * Format paid amount for summary metabox.
	 *
	 * @return string  HTML formatted currency amount.
	 */
	public function get_summary_paid() {
		global $post;
		$amount = get_post_meta( $post->ID, 'paid', true );
		return MultiPass::price( $amount );
	}

	/**
	 * Get balance prestation balance
	 *
	 * @return float  Balance amount.
	 */
	public static function get_balance() {
		global $post;
		$amount = get_post_meta( $post->ID, 'balance', true );
		return $amount;
	}

	/**
	 * Format balance amount for summary metabox.
	 *
	 * @return string  HTML formatted currency amount.
	 */
	public function get_summary_balance() {
		$prestation = new Mltp_Prestation( get_post() );
		$amount     = $prestation->get_balance();

		return ( $prestation ) ? MultiPass::price_with_links( $prestation, $amount ) : MultiPass::price( $amount );
	}

	/**
	 * Get prestation reference for summary..
	 *
	 * @return string  HTML formatted reference.
	 */
	public function get_summary_reference() {
		global $post;
		if ( 'mltp_prestation' !== $post->post_type ) {
			return;
		}
		if ( MultiPass::is_new_post() ) {
			return; // triggered when opened new post page, empty.
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

	/**
	 * Change status button link to filter status in Prestations admin list.
	 *
	 * @param  string $termlink               Initial link.
	 * @param  object $term                   Term object.
	 * @param  string $taxonomy               Taxonomy slug.
	 * @return string           Updated term link.
	 */
	public static function term_link_filter( $termlink, $term, $taxonomy ) {
		$server = wp_unslash( $_SERVER );
		if ( 'prestation-status' === $taxonomy && ( isset( $server['REQUEST_URI'] ) ) ) {
			$termlink = add_query_arg(
				array(
					'prestation-status' => $term->slug,
				),
				admin_url( basename( esc_url( $server['REQUEST_URI'] ) ) )
			);
		}
		return $termlink;
	}

	/**
	 * Build html for prestation status
	 *
	 * @return string HTML formatted status button
	 */
	public static function display_status() {
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
					$term->name,
				);
			}
			return implode( ' ', $status );
		}
	}

	/**
	 * Extended get_post for Prestations
	 *
	 * @param  object $object  Post.
	 * @return boolean|object  Return false if not found or not prestation, prestation post otherwise.
	 */
	public static function get_post( $object ) {
		if ( self::is_prestation_post( $object ) ) {
			return $object;
		}
		if ( get_class( $object ) === __CLASS__ ) {
			$post = $object->post;
		} elseif ( is_numeric( $object ) ) {
			$post = get_post( $object );
		} else {
			return false;
		}

		return ( self::is_prestation_post( $post ) ) ? $post : false;
	}

	/**
	 * Check wether input is a valid Prestation post object.
	 *
	 * @param  object $object Post to check.
	 * @return boolean        True if obhect is a prestation.
	 */
	public static function is_prestation_post( $object ) {
		if ( ! is_object( $object ) ) {
			return false;
		}
		if ( is_wp_error( $object ) ) {
			return false;
		}
		if ( 'WP_Post' !== get_class( $object ) ) {
			return false;
		}
		if ( 'mltp_prestation' !== $object->post_type ) {
			return false;
		}

		return true;
	}

	function is_prestation() {
		if ( empty( $this->post ) ) {
			return false;
		}
		return self::is_prestation_post( $this->post );
	}

	function update( $args = array() ) {
		if ( ! $this->post ) {
			return;
		}
		return self::save_post_action( $this->id, $this->post, true );
	}
	/**
	 * Save post action, uptate summary values and prestation status.
	 *
	 * @param  integer $post_id   Post ID.
	 * @param  object  $post       Post.
	 * @param  boolean $update    True when updating.
	 * @return boolean              Result
	 */
	public static function save_post_action( $post_id, $post, $update ) {

		if ( ! self::is_prestation_post( $post ) ) {
			return;
		}
		if ( ! $post ) {
			return;
		}

		// delete transient mltp_prestation_options
		delete_transient('mltp_prestation_options');

		if ( MultiPass::is_new_post() ) {
			// triggered when opened new post page, empty.
			return;
		}
		if ( 'trash' === $post->post_status ) {
			// TODO: remove related prestation items and reference in post types.
			return;
		}

		/**
		 * Maybe obsolete.  We probably don't need to check request ation anymore,
		 * since the post is already saved.
		 */
		// $request = wp_unslash( $_REQUEST );
		// if ( isset( $request['action'] ) ) {
		// if ( 'trash' === $request['action'] ) {
		// return; // maybe redundant?
		// }
		//
		// if ( isset( $request['_wpnonce'] ) &! wp_verify_nonce( $request['_wpnonce'] ) ) {
		// return;
		// }
		// }
		// End maybe obsolete check.

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
		$updates['from']     = get_post_meta( $post_id, 'from', true );
		$updates['to']       = get_post_meta( $post_id, 'to', true );
		$updates['subtotal'] = 0;
		$updates['paid']     = 0;
		$updates['total']    = 0;
		$dates               = array();

		// if ( is_array( $request ) ) {
		// foreach ( $updates as $key => $value ) {
		// if ( isset( $request[ $key ] ) ) {
		// $updates[ $key ] = is_array( $request[ $key ] ) ? $request[ $key ] : esc_attr( $request[ $key ] );
		// }
		// }
		// foreach ( $amounts as $key => $value ) {
		// if ( isset( $request[ $key ] ) ) {
		// $amounts[ $key ] = is_array( $request[ $key ] ) ? $request[ $key ] : esc_attr( $request[ $key ] );
		// }
		// }
		// }

		if ( ! is_array( $updates['deposit'] ) ) {
			$updates['deposit'] = array(
				'percent' => null,
				'amount'  => null,
			);
		}
		$updates['deposit']['managed'] = 0;
		$updates['deposit']['total']   = 0;

		if ( ! is_array( $updates['discount'] ) ) {
			$updates['discount'] = array(
				'percent' => null,
				'amount'  => null,
			);
		}
		$updates['discount']['managed'] = 0;
		$updates['discount']['total']   = 0;
		$updates['refunded']            = 0;
		$updates['discount']['total']   = 0;

		$prestation   = new Mltp_Prestation( $post );
		$mltp_details = $prestation->get_details_array();

		$details_statuses = array();
		foreach ( $mltp_details as $item ) {
			$status                        = get_post_status( $item['ID'] );
			$details_statuses[ $status ]   = true;
			$updates['discount']['total'] += empty( $item['discount'] ) ? 0 : $item['discount'];
			$updates['subtotal']          += empty( $item['subtotal'] ) ? 0 : $item['subtotal'];
			$updates['total']             += empty( $item['total'] ) ? 0 : $item['total'];
			$updates['paid']              += empty( $item['paid'] ) ? 0 : $item['paid'];
			if ( ! empty( $item['from'] ) ) {
				$dates[] = MultiPass::timestamp( $item['from'] );
			}
			if ( ! empty( $item['to'] ) ) {
				$dates[] = MultiPass::timestamp( $item['to'] );
			}

			if ( ! empty( $item['dates'] ) ) {
				$dates = array_merge( $dates, array_values( $item['dates'] ) );
			}
			if ( ! empty( $item['notes'] ) ) {
				$notes[] = $item['notes'];
			}
		}
		if ( ! empty( $notes ) ) {
			$updates['notes'] = '<p>' . join( '</p><p>', array_unique( $notes ) ) . '</p>';
		}
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
				$updates['subtotal'] += (float) $item['quantity'] * (float) $item['unit_price'];

				if ( ! empty( $item['from'] ) ) {
					$dates[] = MultiPass::timestamp( $item['from'] );
				}
				if ( ! empty( $item['to'] ) ) {
					$dates[] = MultiPass::timestamp( $item['to'] );
				}
			}
		}

		if ( $updates['discount']['percent'] > 0 ) {
			$updates['discount']['amount'] = $updates['subtotal'] * $updates['discount']['percent'] / 100;
		} else {
			$updates['discount']['amount'] = ( empty( $updates['discount']['amount'] ) ) ? null : $updates['discount']['amount'];
		}
		$updates['total'] -= $updates['discount']['amount'];

		if ( is_array( $amounts['payments'] ) ) {
			foreach ( $amounts['payments'] as $payment ) {
				if ( empty( $payment['amount'] ) ) {
					continue;
				}
				$amount           = esc_attr( $payment['amount'] );
				$updates['paid'] += $amount;
			}
		}

		$dates = array_filter( $dates );
		foreach ( $dates as $key => $date ) {
			$dates[ $key ] = MultiPass::timestamp( $date );
		}

		if ( ! empty( $dates ) ) {
			$dates = array(
				'from' => min( $dates ),
				'to'   => max( $dates ),
			);
			if ( $dates['to'] === $dates['from'] ) {
				$dates['to'] = null;
			}
		}

		$updates['from']  = ( isset( $dates['from'] ) ) ? $dates['from'] : null;
		$updates['to']    = ( isset( $dates['to'] ) ) ? $dates['to'] : null;
		$updates['dates'] = array(
			'from' => $updates['from'],
			'to'   => $updates['to'],
		);

		$updates['discount']['total'] += $updates['discount']['amount'] + $updates['discount']['managed'];

		if ( $updates['total'] > 0 && isset( $updates['deposit']['percent'] ) && $updates['deposit']['percent'] > 0 ) {
			$updates['deposit']['amount'] = $updates['total'] * $updates['deposit']['percent'] / 100;
		} else {
			$updates['deposit']['amount'] = ( empty( $updates['deposit']['amount'] ) ) ? null : $updates['deposit']['amount'];
		}
		$updates['deposit']['total'] += $updates['deposit']['amount'] + $updates['deposit']['managed'];

		$balance            = MultiPass::round_amount( $updates['total'] - $updates['paid'] );
		$updates['balance'] = ( 0 === $balance ) ? null : $balance;

		$post_status = $post->status;
		if ( empty( $details_statuses ) ) {
			if(empty($details_statuses)) {
				$post_status = 'publish';
			} else {
				$post_status = 'canceled';
			}
		} elseif ( isset( $details_statuses['publish'] ) ) {
			$post_status = 'publish';
		} elseif ( isset( $details_statuses['open'] ) ) {
			$post_status = 'open';
		} elseif ( isset( $details_statuses['canceled'] ) ) {
			$post_status = 'canceled';
		}
		// MultiPass::debug($post_status);

		switch ( $post->post_status ) {
			case 'publish':
				if ( $updates['total'] <= 0 ) {
					$paid_status = 'on-hold';
				} elseif ( MultiPass::round_amount( $updates['paid'] ) < MultiPass::round_amount( $updates['total'] ) ) {
					if ( $updates['paid'] >= $updates['deposit']['total'] ) {
						if ( $updates['deposit']['total'] > 0 ) {
							$paid_status = 'deposit';
						} elseif ( $updates['paid'] > 0 ) {
							$paid_status = 'partial';
						} else {
							$paid_status = 'unpaid';
						}
					} else {
						// $post_status = 'pending';
						if ( $updates['paid'] > 0 ) {
							$paid_status = 'partial';
						} else {
							$paid_status = 'unpaid';
						}
					}
				} else {
					$paid_status = 'paid';
				}
				break;

			default:
				$paid_status = $post_status;
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

		$updates['flags']   = MultiPass::set_flags( $updates );
		$updates['classes'] = MultiPass::get_flag_slugs( $updates['flags'] );
		$post_update        = array(
			'ID'          => $post_id,
			'post_title'  => trim( $display_name . ' #' . ( ( empty( $post->post_name ) ) ? $post_id : $post->post_name ) ),
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
	}

	public function rewrite_the_title( $post_title, $post_id ) {
		if ( 'mltp_prestation' != get_post_type( $post_id ) ) {
			return $post_title;
		}
		if ( ! is_single() & ! is_archive() ) {
			return $post_title;
		}

		$prestation = new Mltp_Prestation( $post_id );
		if ( ! $prestation->is_prestation() ) {
			return $post_title;
		}

		return $prestation->full_title( $post_title );
	}

	public function full_title( $post_title = null ) {
		if ( ! $this->is_prestation() ) {
			if ( ! empty( $post_title ) ) {
				return $post_title;
			}
			if ( ! empty( $this->post_title ) ) {
				return $this->post_title;
			}
			return;
		}
		$title = $this->name;
		$title = preg_replace( '/ *#.*/', '', $title );

		return MultiPass::array_join(
			array(
				$title,
				MultiPass::format_date_range( $this->dates ),
				array(
					( ( empty( $this->slug ) ) ? null : "#$this->slug" ),
					( empty( $this->origin_id ) ) ? null : $this->origin . ' ' . $this->origin_id,
				),
			)
		);

		return $title;
	}

	/**
	 * Add Prestations admin columns.
	 *
	 * @param array $columns  Columns.
	 * @return array                    Updated columns.
	 */
	public static function add_admin_columns( $columns ) {
		$columns = array(
			'cb'        => $columns['cb'],
			'title'     => __( 'Title', 'multipass' ),
			'customer'  => __( 'Customer', 'multipass' ),
			'contact'   => _x( 'Contact', '(noun)', 'multipass' ),
			'resources' => __( 'Resources', 'multipass' ),
			'dates'     => __( 'Dates', 'multipass' ),
			'discount'  => __( 'Discount', 'multipass' ),
			'total'     => __( 'Total', 'multipass' ),
			'deposit'   => __( 'Deposit', 'multipass' ),
			'paid'      => __( 'Paid', 'multipass' ),
			'balance'   => __( 'Balance', 'multipass' ),
		);

		return $columns;
	}

	/**
	 * Define Prestations sortable admin columns.
	 *
	 * @param array $columns  Sortable columns.
	 * @return array                    Updated sortable columns.
	 */
	public static function sortable_columns( $columns ) {
		$columns = array_merge(
			$columns,
			array(
				'dates'    => 'dates',
				'contact'  => 'contact_name',
				'customer' => 'customer',
			)
		);

		return $columns;
	}

	/**
	 * Define custom Prestation admin columns sort order.
	 *
	 * @param  object $query  Query.
	 */
	public static function sortable_columns_order( $query ) {
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

	/**
	 * Output for custom Prestations admin columns.
	 *
	 * @param  array   $column   Current column.
	 * @param  integer $post_id  Current post ID.
	 */
	public static function admin_columns_display( $column, $post_id ) {
		switch ( $column ) {
			case 'dates':
				echo MultiPass::format_date_range( get_post_meta( $post_id, 'dates', true ) );
				break;

			case 'customer':
				$customer = array(
					'user_id' => get_post_meta( $post_id, 'customer_id', true ),
					'name'    => get_post_meta( $post_id, 'customer_name', true ),
				);
				echo Mltp_Item::customer_html( $customer );
				break;

			case 'contact':
				$contact = array_merge(
					array(
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
				echo MultiPass::price( get_post_meta( $post_id, $column, true ) );
				break;

			default:
				echo get_post_meta( $post_id, $column, true );
		}
	}

	/**
	 * Set random slug for new prestations, will be used as booking id when needed.
	 *
	 * @param  array $data      post data.
	 * @param  array $postarr   post array.
	 * @return string           generated slug.
	 */
	public static function new_post_random_slug( $data, $postarr ) {
		if ( ! in_array( $data['post_type'], array( 'mltp_prestation' ), true ) ) {
			return $data;
		}

		if ( empty( $postarr['ID'] ) || empty( $postarr['post_name'] ) ) {
			$data['post_name'] = MultiPass::unique_random_slug();
		}

		return $data;
	}

	/**
	 * Get prestation, by post ID, post or search args.
	 * Create new prestation if none found and args provided.
	 *
	 * @param  integer|object|array $args   Prestation ID, prestation post or search arguments.
	 * @return object                                       Prestation post if found, false if not found.
	 */
	public function get( $args ) {
		if ( empty( $args ) ) {
			return $args;
		}
		$prestation_post = false;

		if ( is_numeric( $args ) ) {
			$prestation_post = get_post( $args );
			if ( ! isset( $prestation_post->post_type ) ) {
				return new WP_Error( 'prestation-wrong-type', "Prestation $args not found" );
			}
			if ( 'mltp_prestation' !== $prestation_post->post_type ) {
				return new WP_Error( 'prestation-wrong-type', "Object $args is not a prestation" );
			}
		} elseif ( is_object( $args ) && 'mltp_prestation' === $args->post_type ) {
			$prestation_post = $args;
		} elseif ( is_string( $args ) ) {
			$prestation_post = get_page_by_path( $args, OBJECT, 'mltp_prestation' );
		} elseif ( is_array( $args ) ) {
			$search_id   = ( ! empty( $args['prestation_id'] ) && is_numeric( $args['prestation_id'] ) ) ? esc_attr( $args['prestation_id'] ) : null;
			$search_code = esc_attr( $args['reference_code'] );

			if ( ! empty( $search_id ) ) {
				// MultiPass::debug(__METHOD__, 'looking by id ', $search_id);
				$prestation_post = get_post( $search_id );
			} elseif ( ! empty( $search_code ) ) {
				// MultiPass::debug(__METHOD__, 'looking by reference_code ', $search_code );
				$query_args = array(
					'name'            => $search_code,
					'post_type'       => 'mltp_prestation',
					// 'post_status__in' => array( 'publish', 'pending', 'on-hold', 'deposit', 'partial', 'unpaid', 'processing' ),
					'post_status__in' => array( 'pending', 'on-hold', 'deposit', 'partial', 'unpaid', 'processing' ),
					'orderby'         => 'post_date',
					'order'           => 'desc',
					// 'meta_query' => array(
					// array(
					// 'key'   => 'reference_code',
					// 'value' => $search_code,
					// ),
					// ),
				);
				$prestation_posts = get_posts( $query_args );
				$prestation_post  = false;
				if ( $prestation_posts ) {
					$prestation_post = $prestation_posts[0];
					$prestation_id   = $prestation_post->ID;
				}
			}

			if ( $prestation_post && 'mltp_prestation' === $prestation_post->post_type ) {
				// MultiPass::debug(__METHOD__, 'found ', $prestation_id);
				return $prestation_post;
			} else {
				// MultiPass::debug(__METHOD__, 'not found');
			}
		}
		if ( $prestation_post && empty( $args ) ) {
			return $prestation_post;
		}
		if ( is_wp_error( $prestation_post ) ) {
			$error_code    = array_key_first( $user_id->errors );
			$error_message = $user_id->errors[ $error_code ][0];
			error_log( "\nCould not get prestation - $error_message" );
			return false;
		}
		// if ( ! is_array( $args ) ) {
		// error_log( __CLASS__ . '::' . __METHOD__ . '( ' . print_r( $args, true ) . '): args should be an id, a post or an array' );
		// return false;
		// }

		if ( ! $prestation_post ) {
			$args                   = array_merge(
				array(
					'prestation_id'  => null,
					'reference_code' => null,
					'customer_id'    => null,
					'customer_name'  => null,
					'customer_email' => null,
					'customer_phone' => null,
					'from'           => null,
					'to'             => null,
				),
				$args
			);
			$args['customer_email'] = MultiPass::sanitize_email( $args['customer_email'] );
			// MultiPass::debug( 'prestation not passed, looking with  ' . json_encode( $args ) );

			$prestation_id  = $args['prestation_id'];
			$customer_id    = $args['customer_id'];
			$customer_name  = $args['customer_name'];
			$customer_email = $args['customer_email'];
			$customer_phone = $args['customer_phone'];

			// Check by customer id, email or name.
			$query_args = array(
				'post_type'       => 'mltp_prestation',
				// 'post_status__in' => array( 'publish', 'pending', 'on-hold', 'deposit', 'partial', 'unpaid', 'processing' ),
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

			if ( ! empty( $args['from'] ) ) {
				$from_query = array(
					'relation' => 'OR',
					array(
						'key'     => 'from',
						'type'    => 'numeric',
						'compare' => 'between',
						'value'   => array(
							$args['from'] - 3600,
							$args['to'] + 3600,
						),
					),
					array(
						'key'     => 'to',
						'type'    => 'numeric',
						'compare' => 'between',
						'value'   => array(
							$args['from'] - 3600,
							$args['to'] + 3600,
						),
					),
				);

				if ( empty( $query_args['meta_query'] ) ) {
					$query_args['meta_query'] = $from_query;
				} else {
					$query_args['meta_query'] = array(
						'relation' => 'AND',
						$query_args['meta_query'],
						$from_query,
					);
				}
			}

			$prestation_posts = get_posts( $query_args );
			$prestation_post  = false;
			if ( $prestation_posts ) {
				$prestation_post = $prestation_posts[0];
				$prestation_id   = $prestation_post->ID;
				// update_post_meta( $order_id, 'prestation_id', $prestation_id );
			}
		}
		if ( $prestation_post && ! is_array( $args ) ) {
			return $prestation_post;
		}

		// Nothing worked so far, create new prestation post.
		// $meta    = array(
		// 'customer_id'    => $customer_id,
		// 'customer_name'  => $customer_name,
		// 'customer_email' => $customer_email,
		// 'customer_phone' => $customer_email,
		// 'from'           => $args['from'],
		// 'to'             => $args['to'],
		// );
		//
		// if(!empty(array_filter($args))) {
			// $args = array_replace(array(
			// 'customer_id'    => null,
			// 'customer_name'  => null,
			// 'customer_email' => null,
			// 'customer_phone' => null,
			// ), $args);
			$meta = array(
				'customer_id'    => $customer_id,
				'customer_name'  => $customer_name,
				'customer_email' => $customer_email,
				'customer_phone' => $customer_phone,
				// 'from'           => null,
				// 'to'             => null,
			);
			// MultiPass::debug($args, $meta);

			// }
			$prestation_postarr = array(
				'ID'          => ( $prestation_post ) ? $prestation_post->ID : null,
				'post_author' => $customer_id,
				'post_date'   => ( empty( $args['date'] ) ) ? null : esc_attr( $args['date'] ),
				// 'post_date_gmt' => (empty($args['date_gmt'])) ? null : esc_attr( $args['date_gmt'] ),
				'post_type'   => 'mltp_prestation',
				'post_status' => 'publish',
				'meta_input'  => $meta,
			);

			$prestation_id = wp_insert_post( $prestation_postarr );
			if ( 0 === $prestation_id ) {
				error_log( "\ncould not create prestation " . print_r( $prestation_postarr, true ) );
				return false;
			}
			if ( is_wp_error( $prestation_id ) ) {
				$error_code    = array_key_first( $user_id->errors );
				$error_message = $user_id->errors[ $error_code ][0];
				error_log( "\ncould not create prestation " . print_r( $prestation_postarr, true ) . "\n$error_message" );
				return false;
			}

			$prestation_post = get_post( $prestation_id );

			// MultiPass::debug( __CLASS__,__FUNCTION__, $mltp_detail->id );

			return $prestation_post;
	}

	static function render_details_notes() {
		global $post;
		$prestation = new Mltp_Prestation( $post );
		$items      = $prestation->get_details_array();
		$html       = '';
		foreach ( $items as $item ) {
			if ( ! empty( $item['notes'] ) ) {
				$html .= sprintf(
					'<h4>%s</h4>
					<p>%s</p>',
					$item['description'],
					$item['notes'],
				);
			}
		}
		return $html;
	}
}

$this->loaders[] = new Mltp_Prestation();
