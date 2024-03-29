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
class Mltp_Contact extends Mltp_Loader {
	protected $db_prefix;
	protected $table;
	protected $db_args;
	protected $default_type_id;

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
	 * If $args is passed, attempt to create a contact object
	 *
	 * @param    integer|object|array $args Object post id or data to use to search contact.
	 */
	public function __construct( $args = null ) {
		global $wpdb;
		$this->db_prefix = $wpdb->prefix;
		$this->table     = $this->db_prefix . 'mltp_contacts';

		$query = $wpdb->prepare( 'SHOW TABLES LIKE %s', $wpdb->esc_like( $this->table ) );
		if ( ! $wpdb->get_var( $query ) == $this->table ) {
			// $notice = "Table $this->table is missing";
			// error_log( __CLASS__ .':' . __METHOD__ . '() ' . $notice );
			// MultiPass::admin_notice( $notice, 'error' );
			$this->actions = array();
			$this->filters = array();
			return;
		}
		// $notice = "Table $this->table  is there.";
		// error_log( __CLASS__ .':' . __METHOD__ . '() ' . $notice );
		// MultiPass::admin_notice( $notice, 'success' );

		$this->db_args         = array(
			'storage_type' => 'custom_table',
			'table'        => $this->table,
		);
		$default_contact_type  = get_term_by( 'name', 'default', 'contact-type' );
		$this->default_type_id = ( $default_contact_type ) ? $default_contact_type->term_id : null;

		$this->actions = array(
			array(
				'component' => $this,
				'hook'      => 'init',
				'callback'  => 'register_post_types',
			),
			array(
				'component' => $this,
				'hook'      => 'init',
				'callback'  => 'register_taxonomies',
			),
			array(
				'component'     => $this,
				'hook'          => 'save_post',
				'callback'      => 'save_post_process',
				'accepted_args' => 3,
			),
			array(
				'component' => $this,
				'hook'      => 'profile_update',
				'callback'  => 'profile_update_post_process',
			),
			array(
				'component' => $this,
				'hook'      => 'woocommerce_customer_save_address',
				'callback'  => 'profile_update_post_process',
			),
			array(
				'component' => $this,
				'hook'      => 'woocommerce_save_account_details',
				'callback'  => 'profile_update_post_process',
			),
		);

		$this->filters = array(
			array(
				'component' => $this,
				'hook'      => 'rwmb_meta_boxes',
				'callback'  => 'register_fields',
				// 'priority'  => 20,
			),
		);

		register_activation_hook( MULTIPASS_FILE, array( $this, 'update_tables' ) );

	}

	/**
	 * Create custom table for contacts
	 */
	function update_tables() {
		$result = MB_Custom_Table_API::create(
			$this->table,   // Table name.
			array(                                  // Table columns (without ID).
				'user_id'      => 'INTEGER',
				'first_name'   => 'VARCHAR(50)',
				'last_name'    => 'VARCHAR(50)',
				// 'display_name'   => "VARCHAR(100) AS (TRIM(CONCAT(COALESCE(first_name, ''), ' ', COALESCE(last_name, '')))) STORED",
				'display_name' => 'VARCHAR(101)',
				'company'      => 'VARCHAR(50)',
				'email'        => 'VARCHAR(100)',
				'phone'        => 'VARCHAR(100)',
				'address'      => 'LONGTEXT',
			),
			array( 'first_name', 'last_name', 'display_name', 'email', 'phone' ),               // List of index keys.
			true                               // Must be true for models.
		);

		if ( is_wp_error( $result ) ) {
			$error_message = $result->error_message();
		} elseif ( ! $result ) {
			$error_message = 'Unknown error ' . print_r( $result, true );
		}
		if ( ! empty( $error_message ) ) {
			$notice = __( 'Tables cration failed.', 'multipass' )
			. "\n" . $error_message;
			error_log( __CLASS__ . ':' . __METHOD__ . '() ' . $notice );
			MultiPass::admin_notice( $notice, 'error' );
		} else {
			$notice = __( 'Tables creation succeeded.', 'multipass' );
			MultiPass::admin_notice( $notice );
			add_action( 'wp_loaded', array( $this, 'migrate_contacts_from_prestation' ) );
		}

	}

	/**
	 * Register Contact post type
	 *
	 * @return void
	 */
	public function register_post_types() {

		$labels = array(
			'name'                     => esc_html__( 'Contacts', 'multipass' ),
			'singular_name'            => esc_html__( 'Contact', 'multipass' ),
			'add_new'                  => esc_html__( 'Add New', 'multipass' ),
			'add_new_item'             => esc_html__( 'Add New Contact', 'multipass' ),
			'edit_item'                => esc_html__( 'Edit Contact', 'multipass' ),
			'new_item'                 => esc_html__( 'New Contact', 'multipass' ),
			'view_item'                => esc_html__( 'View Contact', 'multipass' ),
			'view_items'               => esc_html__( 'View Contacts', 'multipass' ),
			'search_items'             => esc_html__( 'Search Contacts', 'multipass' ),
			'not_found'                => esc_html__( 'No contacts found.', 'multipass' ),
			'not_found_in_trash'       => esc_html__( 'No contacts found in Trash.', 'multipass' ),
			'parent_item_colon'        => esc_html__( 'Parent Contact:', 'multipass' ),
			'all_items'                => esc_html__( 'Contacts', 'multipass' ),
			'archives'                 => esc_html__( 'Contact Archives', 'multipass' ),
			'attributes'               => esc_html__( 'Contact Attributes', 'multipass' ),
			'insert_into_item'         => esc_html__( 'Insert into contact', 'multipass' ),
			'uploaded_to_this_item'    => esc_html__( 'Uploaded to this contact', 'multipass' ),
			'featured_image'           => esc_html__( 'Featured image', 'multipass' ),
			'set_featured_image'       => esc_html__( 'Set featured image', 'multipass' ),
			'remove_featured_image'    => esc_html__( 'Remove featured image', 'multipass' ),
			'use_featured_image'       => esc_html__( 'Use as featured image', 'multipass' ),
			'menu_name'                => esc_html__( 'Contacts', 'multipass' ),
			'filter_items_list'        => esc_html__( 'Filter contacts list', 'multipass' ),
			'filter_by_date'           => esc_html__( 'Contacts date filter', 'multipass' ),
			'items_list_navigation'    => esc_html__( 'Contacts list navigation', 'multipass' ),
			'items_list'               => esc_html__( 'Contacts list', 'multipass' ),
			'item_published'           => esc_html__( 'Contact published.', 'multipass' ),
			'item_published_privately' => esc_html__( 'Contact published privately.', 'multipass' ),
			'item_reverted_to_draft'   => esc_html__( 'Contact reverted to draft.', 'multipass' ),
			'item_scheduled'           => esc_html__( 'Contact scheduled.', 'multipass' ),
			'item_updated'             => esc_html__( 'Contact updated.', 'multipass' ),
			'text_domain'              => esc_html__( 'multipass', 'multipass' ),
		);
		$args   = array(
			'label'               => esc_html__( 'Contacts', 'multipass' ),
			'labels'              => $labels,
			'description'         => 'Contacts for MultiPass plugin',
			'public'              => true,
			'hierarchical'        => false,
			'exclude_from_search' => true,
			'publicly_queryable'  => false, // current_user_can( 'mltp_reader' ),
			'show_ui'             => true,
			'show_in_nav_menus'   => false,
			'show_in_admin_bar'   => true,
			'show_in_rest'        => true,
			'query_var'           => true,
			'can_export'          => true,
			'delete_with_user'    => true,
			'has_archive'         => 'contacts',
			'rest_base'           => '',
			'show_in_menu'        => 'multipass',
			'menu_icon'           => 'dashicons-admin-users',
			'capability_type'     => 'mltp_prestation',
			'supports'            => array( 'title', 'thumbnail' ),
			'taxonomies'          => array(),
			'rewrite'             => array(
				'with_front' => false,
			),
		);

		register_post_type( 'mltp_contact', $args );
		// mb_register_model( 'mltp_contact', $args );
	}

	public function register_fields( $meta_boxes ) {
		$prefix = '';

		// Fields appearing in contact edit page
		$meta_boxes[] = array(
			'title'        => __( 'Contact fields', 'multipass' ),
			'id'           => 'contact-fields',
			'post_types'   => array( 'mltp_contact' ),
			'context'      => 'after_title',
			'storage_type' => 'custom_table',  // Must be 'custom_table'
			'table'        => $this->table,  // Custom table name
			'style'        => 'seamless',
			'autosave'     => true,
			'geo'          => true,
			'fields'       => array(
				array(
					'name'       => __( 'User', 'multipass' ),
					'id'         => $prefix . 'user_id',
					'type'       => 'user',
					'field_type' => 'select_advanced',
					'add_new'    => true,
				),
				array(
					'name'          => __( 'First Name', 'multipass' ),
					'id'            => $prefix . 'first_name',
					'type'          => 'text',
					'columns'       => 6,
					'admin_columns' => array(
						'position'   => 'after title',
						'searchable' => true,
					),
					'visible'       => array(
						'when'     => array( array( 'user_id', '=', '' ) ),
						'relation' => 'or',
					),
				),
				array(
					'name'          => __( 'Last Name', 'multipass' ),
					'id'            => $prefix . 'last_name',
					'type'          => 'text',
					'columns'       => 6,
					'admin_columns' => array(
						'position'   => 'after first_name',
						'searchable' => true,
					),
					'visible'       => array(
						'when'     => array( array( 'user_id', '=', '' ) ),
						'relation' => 'or',
					),
				),
				array(
					'name'          => __( 'Company', 'multipass' ),
					'id'            => $prefix . 'company',
					'type'          => 'text',
					'admin_columns' => array(
						'position'   => 'after last_name',
						'searchable' => true,
					),
				),
				array(
					'name'          => __( 'Email', 'multipass' ),
					'id'            => $prefix . 'email',
					'type'          => 'email',
					'admin_columns' => array(
						'position'   => 'replace date',
						'searchable' => true,
					),
					'visible'       => array(
						'when'     => array( array( 'user_id', '=', '' ) ),
						'relation' => 'or',
					),
				),
				array(
					'name'              => __( 'Phone Number', 'multipass' ),
					'id'                => $prefix . 'phone',
					'type'              => 'tel',
					'columns'           => 9,
					'clone'             => true,
					'clone_as_multiple' => true,
					'add_button'        => __( 'Add a phone number', 'multipass' ),
					'admin_columns'     => array(
						'position'   => 'after email',
						'searchable' => true,
					),
				),
				array(
					'name'              => __( 'Address', 'multipass' ),
					'id'                => $prefix . 'address',
					'type'              => 'group',
					'clone'             => true,
					'clone_as_multiple' => true,
					'add_button'        => __( 'Add an address', 'multipass' ),
					// 'admin_columns'     => 'after title',
					'sanitize_callback' => 'MultiPass::sanitize_address',
					'fields'            => array(
						array(
							'id'          => $prefix . 'search',
							'type'        => 'text',
							'placeholder' => __( 'Type address here to search', 'multipass' ),
							'prepend'     => '<span class="dashicons dashicons-search"></span>',
						),
						array(
							'id'          => $prefix . 'building',
							'type'        => 'text',
							'placeholder' => __( 'Building', 'multipass' ),
						),
						array(
							'id'          => $prefix . 'street',
							'type'        => 'text',
							'placeholder' => __( 'Street', 'multipass' ),
							'binding'     => 'house_number + " " + aeroway + " " + road',
						),
						array(
							'id'          => $prefix . 'neighbourhood',
							'type'        => 'text',
							'placeholder' => __( 'Neighbourhood / Suburb', 'multipass' ),
							'binding'     => 'neighbourhood + " " + suburb',
						),
						array(
							'id'          => $prefix . 'postcode',
							'type'        => 'text',
							'placeholder' => __( 'Postcode', 'multipass' ),
							'columns'     => 2,
						),
						array(
							'id'          => $prefix . 'city',
							'type'        => 'text',
							'placeholder' => __( 'Village / Town / Locality', 'multipass' ),
							'columns'     => 5,
							'binding'     => 'village + " " + town + " " + locality',
						),
						array(
							'id'          => $prefix . 'state',
							'type'        => 'text',
							'placeholder' => __( 'County / State', 'multipass' ),
							'columns'     => 5,
							'binding'     => 'county + " " + state',
						),
						array(
							'id'            => $prefix . 'country',
							'type'          => 'text',
							'placeholder'   => __( 'Country', 'multipass' ),
							'admin_columns' => array(
								'position' => 'after title',
								'title'    => 'Country',
							),
							'columns'       => 4,
						),
						array(
							'id'            => $prefix . 'geocode',
							'type'          => 'osm',
							'address_field' => 'search',
							'language'      => 'fr',
							'class'         => 'hidden thisisaclassiuseonlyhere',
						),
					),
				),
			),
		);

		// Contact fields for mltp_prestation and mltp_detail post types
		$prefix       = 'contacts_';
		$meta_boxes[] = array(
			'title'      => __( 'Contacts', 'multipass' ),
			'id'         => 'contacts',
			'post_types' => 'mltp_prestation', // | 'mltp_prestation', 'mltp_detail' ],
			'context'    => 'after_title',
			'priority'   => 'high',
			'style'      => 'seamless',
			'fields'     => array(
				// array(
				// 'name'    => __( 'Use parent', 'multipass' ),
				// 'id'      => $prefix . 'use_parent',
				// 'type'    => 'switch',
				// 'style'   => 'rounded',
				// 'std'     => true,
				// 'visible' => array(
				// 'when'     => array( array( 'prestation_id', '>', 0 ) ),
				// 'relation' => 'or',
				// ),
				// ),
				array(
					'name'              => __( 'Customer', 'multipass' ),
					'id'                => $prefix . 'contact',
					'type'              => 'group',
					'clone'             => true,
					'sort_clone'        => true,
					'clone_default'     => true,
					'clone_as_multiple' => true,
					'add_button'        => __( 'Add contact', 'multipass' ),
					'class'             => 'inline',
					'hidden'            => array(
						'when'     => array(
							array( 'prestation_id', '>', 0 ),
							array( 'use_parent', '=', 1 ),
							array( 'post_type', '!=', 'mltp_prestation' ),
						),
						'relation' => 'and',
					),
					'fields'            => array(
						array(
							'name'        => __( 'Type', 'multipass' ),
							'id'          => 'type',
							'type'        => 'taxonomy_advanced',
							'taxonomy'    => array( 'contact-type' ),
							'field_type'  => 'select',
							'add_new'     => true,
							'placeholder' => __( 'Select a type', 'multipass' ),
							'required'    => true,
							'std'         => $this->default_type_id,
								// 'size' => 1,
						),
						array(
							'name'       => __( 'Contact', 'multipass' ),
							'id'         => 'id',
							'type'       => 'post',
							'post_type'  => array( 'mltp_contact' ),
							'field_type' => 'select_advanced',
							'add_new'    => true,
						),
						array(
							'name'   => __( 'Name', 'multipass' ),
							'id'     => 'name',
							'type'   => 'text',
							'hidden' => array(
								'when'     => array( array( 'id', '>', 0 ) ),
								'relation' => 'or',
							),
						),
						array(
							'name'   => __( 'Phone', 'multipass' ),
							'id'     => 'phone',
							'type'   => 'text',
							'hidden' => array(
								'when'     => array( array( 'id', '>', 0 ) ),
								'relation' => 'or',
							),
						),
						array(
							'name'   => __( 'Email', 'multipass' ),
							'id'     => 'email',
							'type'   => 'email',
							'hidden' => array(
								'when'     => array( array( 'id', '>', 0 ) ),
								'relation' => 'or',
							),
						),
						array(
							'name'     => __( 'Summary', 'multipass' ),
							'id'       => 'summary',
							'type'     => 'custom_html',
							'callback' => 'Mltp_Contact::summary',
							'hidden'   => array(
								'when'     => array( array( 'id', '=', '' ) ),
								'relation' => 'or',
							),
						),
					),
				),
			),
		);

		return $meta_boxes;
	}

	/**
	 * Register contact-type taxonomy.
	 *
	 * @return void
	 */
	public static function register_taxonomies() {

		$labels = array(
			'name'                       => esc_html__( 'Contact Types', 'multipass' ),
			'singular_name'              => esc_html__( 'Contact Type', 'multipass' ),
			'menu_name'                  => esc_html__( 'Contact Types', 'multipass' ),
			'search_items'               => esc_html__( 'Search Types', 'multipass' ),
			'popular_items'              => esc_html__( 'Popular Types', 'multipass' ),
			'all_items'                  => esc_html__( 'All Contact Types', 'multipass' ),
			'parent_item'                => esc_html__( 'Parent Type', 'multipass' ),
			'parent_item_colon'          => esc_html__( 'Parent Type:', 'multipass' ),
			'edit_item'                  => esc_html__( 'Edit Type', 'multipass' ),
			'view_item'                  => esc_html__( 'View Type', 'multipass' ),
			'update_item'                => esc_html__( 'Update Type', 'multipass' ),
			'add_new_item'               => esc_html__( 'Add New Type', 'multipass' ),
			'new_item_name'              => esc_html__( 'New Type Name', 'multipass' ),
			'separate_items_with_commas' => esc_html__( 'Separate types with commas', 'multipass' ),
			'add_or_remove_items'        => esc_html__( 'Add or remove contact types', 'multipass' ),
			'choose_from_most_used'      => esc_html__( 'Choose most used types', 'multipass' ),
			'not_found'                  => esc_html__( 'No types found.', 'multipass' ),
			'no_terms'                   => esc_html__( 'No types', 'multipass' ),
			'filter_by_item'             => esc_html__( 'Filter by contact type', 'multipass' ),
			'items_list_navigation'      => esc_html__( 'Contact Types list pagination', 'multipass' ),
			'items_list'                 => esc_html__( 'Contact Types list', 'multipass' ),
			'most_used'                  => esc_html__( 'Most Used', 'multipass' ),
			'back_to_items'              => esc_html__( '&larr; Go to Contact Types', 'multipass' ),
			'text_domain'                => esc_html__( 'multipass', 'multipass' ),
		);
		$args   = array(
			'label'              => esc_html__( 'Contact Types', 'multipass' ),
			'labels'             => $labels,
			'description'        => '',
			'public'             => false,
			'publicly_queryable' => false,
			'hierarchical'       => false,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'show_in_nav_menus'  => true,
			'show_in_rest'       => true,
			'show_tagcloud'      => false,
			'show_in_quick_edit' => true,
			'show_admin_column'  => true,
			'query_var'          => true,
			'sort'               => false,
			'meta_box_cb'        => 'post_tags_meta_box',
			'rest_base'          => '',
			'rewrite'            => array(
				'with_front'   => false,
				'hierarchical' => false,
			),
		);
		register_taxonomy( 'contact-type', array(), $args );

		if ( MultiPass::debug() ) {
			add_submenu_page(
				'multipass', // string $parent_slug,
				$labels['name'], // string $page_title,
				'<span class="dashicons dashicons-admin-tools"></span> ' . $labels['menu_name'], // string $menu_title,
				'mltp_administrator', // string $capability,
				'edit-tags.php?taxonomy=contact-type&post_type=mltp_contact', // string $menu_slug,
			);
		}
		add_action( 'contact-type_pre_add_form', 'MultiPass::back_to_multipass_button' );

		/**
		 * types, we use basically the same terminology as
		 * WooCommerce, but it is not mandatory.
		 */
		MultiPass::register_terms(
			'contact-type',
			array(
				// Open (still modifiable, available for new order inclusion).
				'default' => array( 'name' => __( 'Default', 'multipass' ) ),  // unpaid or paid less than deposit, not confirmed.
				'billing' => array( 'name' => __( 'Billing', 'multipass' ) ), // fully paid and not started.
				'guest'   => array( 'name' => __( 'Guest', 'multipass' ) ), // paid and started.
				// 'partial'        => array(
				// 'name'   => __( 'Partially paid', 'multipass' ),
				// 'parent' => 'pending',
				// ),
			)
		);
	}

	public static function merge_name( $first_name, $last_name = '', $company = '' ) {
		if ( is_array( $first_name ) ) {
			$data = array_merge(
				array(
					'first_name' => null,
					'last_name'  => null,
					'company'    => null,
				),
				$first_name
			);

			$first_name = $data['first_name'];
			$last_name  = $data['last_name'];
			$company    = $data['company'];
		}

		$name  = trim( $first_name . ' ' . $last_name );
		$name .= ( ( ! empty( $company ) && ! empty( $name ) ) ? ' - ' : '' ) . $company;

		return $name;
	}

	function split_name( $name ) {
		$name  = preg_replace( '/\s+-\s+.*/', '', $name );
		$names = explode( ' ', $name, 2 );

		$first_name = isset( $names[0] ) ? trim( $names[0] ) : '';
		$last_name  = isset( $names[1] ) ? trim( $names[1] ) : '';

		return array(
			'first_name' => $first_name,
			'last_name'  => $last_name,
		);
	}

	public function save_post_process( $post_id, $post = null, $update = null ) {
		// $old_meta = get_post_meta($post_id);
		// error_log("meta " . print_r(get_post_meta($post_id), true));
		$meta = array_filter(
			array(
				'first_name' => get_post_meta( $post_id, 'first_name', true ),
				'last_name'  => get_post_meta( $post_id, 'last_name', true ),
				'company'    => get_post_meta( $post_id, 'company', true ),
				'phone'      => get_post_meta( $post_id, 'phone' ),
				'email'      => get_post_meta( $post_id, 'email', true ),
			)
		);

		foreach ( $meta as $key => $value ) {
			delete_post_meta( $post_id, $key );
			rwmb_set_meta( $post_id, $key, $value, $this->db_args );
		}

		$this->set_title( $post_id );

		return $update;
	}

	public function build_title( $post_id ) {
		$post = get_post( $post_id );

		$title = $post->post_title;

		if ( get_post_type( $post_id ) === 'mltp_contact' ) {
			// Get the updated post object

			$data = array(
				'first_name' => rwmb_meta( 'first_name', $this->db_args, $post_id ),
				'last_name'  => rwmb_meta( 'last_name', $this->db_args, $post_id ),
				'company'    => rwmb_meta( 'company', $this->db_args, $post_id ),
				'email'      => rwmb_meta( 'email', $this->db_args, $post_id ),
			);

			// Build the title
			$title = self::merge_name( $data );
		}

		if ( empty( $title ) && empty( $post->post_title ) ) {
			$title = sprintf( __( 'Not enough data %s', 'multipass' ), $post->ID );
		}

		return $title;
	}

	public function set_title( $post_id, $post = null ) {
		// Check if it is the mltp_contact post type
		if ( get_post_type( $post_id ) === 'mltp_contact' ) {

			$post = get_post( $post_id );

			// First sync with user if any
			$this->sync_contact_from_wp_user( $post_id );

			$title = $this->build_title( $post_id );

			// Update the post title only if it changed and is not empty
			remove_action( 'save_post', array( $this, 'save_post_process' ) ); // Remove the action temporarily to prevent recursion
			if ( ! empty( $title ) && $title !== $post->post_title ) {
				wp_update_post(
					array(
						'ID'         => $post_id,
						'post_title' => $title,
					)
				);
			}
			add_action( 'save_post', array( $this, 'save_post_process' ) ); // Add the action back after updating the post title

		}
	}

	public function sync_contact_from_wp_user( $contact_id, $user_id = null ) {
		// Get the post object
		$contact = get_post( $contact_id );

		// Check if it is the mltp_contact post type
		if ( $contact->post_type === 'mltp_contact' ) {
			// Get the user_id and email values from the post meta
			$address_group_id = rwmb_meta( 'address_group_id', $this->db_args, $contact_id ); // Replace 'address_group_id' with your address group field key

			$user_id = empty( $user_id ) ? rwmb_meta( 'user_id', $this->db_args, $contact_id ) : $user_id;
			// Check if user_id is set and fetch the user data
			if ( ! empty( $user_id ) ) {
				$user = get_user_by( 'ID', $user_id );
			}

			// If user_id is not set, check email and fetch the user data
			if ( empty( $user ) && ! empty( $email ) ) {
				$email = rwmb_meta( 'email', $this->db_args, $contact_id );
				if ( empty( $email ) ) {
					return;
				}
				$user = get_user_by( 'email', $email );
			}

			// Import the user data into the corresponding fields
			if ( ! empty( $user ) ) {
				// Import user_id and email using rwmb_set_meta
				rwmb_set_meta( $contact_id, 'user_id', $user->ID, $this->db_args );
				rwmb_set_meta( $contact_id, 'email', $user->user_email, $this->db_args );

				// Import data from user object
				$first_name = get_user_meta( $user_id, 'billing_first_name', true );
				$first_name = empty( $first_name ) ? $user->first_name : $first_name;
				$last_name  = get_user_meta( $user_id, 'billing_last_name', true );
				$last_name  = empty( $last_name ) ? $user->last_name : $last_name;
				rwmb_set_meta( $contact_id, 'first_name', $first_name, $this->db_args );
				rwmb_set_meta( $contact_id, 'last_name', $last_name, $this->db_args );

				// Check if WooCommerce is active
				if ( class_exists( 'WooCommerce' ) ) {
					// Import billing_company from user meta
					$company = get_user_meta( $user->ID, 'billing_company', true );

					rwmb_set_meta( $contact_id, 'company', $company, $this->db_args );

					// Import billing_phone from user meta
					$phone = get_user_meta( $user->ID, 'billing_phone', true );
					rwmb_set_meta( $contact_id, 'phone', array( $phone ), $this->db_args );

					// Import billing address
					$address = array(
						'street'        => get_user_meta( $user->ID, 'billing_address_1', true ),
						'neighbourhood' => get_user_meta( $user->ID, 'billing_address_2', true ),
						'city'          => get_user_meta( $user->ID, 'billing_city', true ),
						'state'         => get_user_meta( $user->ID, 'billing_state', true ),
						'postcode'      => get_user_meta( $user->ID, 'billing_postcode', true ),
						'country'       => get_user_meta( $user->ID, 'billing_country', true ),
					);
					if ( ! empty( $address['country'] ) ) {
						$countryName        = WC()->countries->countries[ $address['country'] ];
						$address['country'] = ( empty( $countryName ) ) ? $address['country'] : $countryName;
					}

					$address['search'] = join( ', ', array_filter( $address ) );
					rwmb_set_meta( $contact_id, 'address', array( $address ), $this->db_args );
				}
			}

			$title = self::merge_name(
				array(
					'first_name' => isset( $first_name ) ? $first_name : '',
					'last_name'  => isset( $last_name ) ? $last_name : '',
					'company'    => ( isset( $company ) ) ? $company : null,
				)
			);

			  // Update the post title only if it is different
			if ( $title !== $contact->post_title ) {
				wp_update_post(
					array(
						'ID'         => $contact_id,
						'post_title' => $title,
					)
				);
			}
		}
	}

	public function get_contact_id( $data ) {
		$contact_id = null;

		if ( is_object( $data ) && property_exists( $data, 'ID' ) ) {
			$contact_id = $data->ID;
		} elseif ( is_int( $data ) ) {
			$contact_id = $data;
		} else {
			if ( is_string( $data ) && is_email( $data ) ) {
				$data = array( 'email' => $data );
			} elseif ( is_string( $data ) ) {
				$data = array( 'name' => $data );
			}

			if ( isset( $data['id'] ) && is_int( $data['id'] ) ) {
				$contact_id = $data['id'];
			} elseif ( isset( $data['user_id'] ) && is_int( $data['user_id'] ) ) {
				$contact_id = $this->get_contact_id_by_user_id( $data['user_id'] );
			} elseif ( ! empty( $data['email'] ) && is_email( $data['email'] ) ) {
				$contact_id = $this->get_contact_id_by( 'email', $data['email'] );
			} elseif ( ! empty( $data['name'] ) && is_string( $data['name'] ) ) {
				$contact_id = $this->get_contact_id_by( 'name', $data['name'] );
			}
		}

		if ( empty( $contact_id ) || get_post_type( $contact_id ) !== 'mltp_contact' ) {
			return false;
		}

		return $contact_id;
	}

	public function get_contact_id_by_user_id( $user_id ) {
		if ( empty( $user_id ) ) {
			return false;
		}

		// Query the mltp_contact posts
		global $wpdb;
		$prepared_statement = $wpdb->prepare(
			"SELECT ID FROM $this->table WHERE user_id = %d ORDER BY id LIMIT 1",
			$user_id,
		);
		$contact_id         = $wpdb->get_var( $prepared_statement );
		if ( ! empty( $contact_id ) && get_post_type( $contact_id ) !== 'mltp_contact' ) {
			return false;
		}
		return $contact_id;
	}

	public function get_contact_id_by( $field, $value ) {
		if ( empty( $field ) || empty( $value ) ) {
			return false;
		}

		// Query the mltp_contact posts
		global $wpdb;

		$column = ( $field === 'name' ) ? 'display_name' : $field;

		$sql                = "SELECT ID FROM {$this->table} WHERE {$column} = %s ORDER BY ID;";
		$prepared_statement = $wpdb->prepare( $sql, $value );
		$contact_id         = $wpdb->get_var( $prepared_statement );

		if ( ! empty( $contact_id ) && get_post_type( $contact_id ) !== 'mltp_contact' ) {
			return false;
		}

		return $contact_id;
	}

	public function migrate_contacts_from_prestation() {

		// Query the mltp_prestation posts
		global $wpdb;
		$sql            = "SELECT ID FROM {$wpdb->posts} WHERE post_type = 'mltp_prestation' ORDER BY CASE WHEN post_status = 'publish' THEN 2 ELSE 1 END, ID;";
		$prestation_ids = $wpdb->get_col( $sql );

		// Iterate over the mltp_prestation posts and import data
		$c = count( $prestation_ids );
		$p = 0;
		$u = 0;
		$e = 0;
		foreach ( $prestation_ids as $prestation_id ) {
			$p++;
			$prestation = get_post( $prestation_id );

			// Get the contact details from the post meta
			$old_contact           = array_merge(
				array(
					'id'      => null,
					'user_id' => get_post_meta( $prestation_id, 'customer_id', true ),
					'name'    => get_post_meta( $prestation_id, 'display_name', true ),
					'email'   => get_post_meta( $prestation_id, 'contact_email', true ),
					'phone'   => get_post_meta( $prestation_id, 'contact_phone', true ),
				),
				array_filter(
					array(
						'name' => get_post_meta( $prestation_id, 'contact_name', true ),
					)
				),
				array_filter(
					array(
						'name'  => get_post_meta( $prestation_id, 'customer_name', true ),
						'email' => get_post_meta( $prestation_id, 'customer_email', true ),
						'phone' => get_post_meta( $prestation_id, 'customer_phone', true ),
					)
				),
			);
				$old_contact['id'] = $this->get_contact_id( $old_contact );

				// Get new format contacts if any
				$contacts = get_post_meta( $prestation_id, 'contacts_contact' );

				$found_matching_contact = false;
			foreach ( $contacts as $key => $contact ) {
				if (
				( ! empty( $contact['id'] ) && $contact['id'] === $old_contact['id'] )
				|| ( ! empty( $contact['email'] ) && $contact['email'] == $old_contact['email'] )
				) {
					$found_matching_contact = true;
					// error_log("found contact $contact_id by name from " . print_r($data, true));
					$contact = array_merge( $old_contact, array_filter( $contacts ) );
				};
				$contact['type'] = empty( $contact['type'] ) ? $this->default_type_id : $contact['type'];

				// Create or update the corresponding mltp_contact
				if ( empty( $contact['id'] ) ) {
					$contact_id = $this->create_or_update_contact( $contact );
					if ( ! empty( $contact_id ) ) {
						$found_matching_contact = true;
						$contact['id']          = $contact_id;
					}
				}
				$contacts[ $key ] = $contact;
			}

			if ( ! $found_matching_contact ) {
				$old_contact['id'] = $this->create_or_update_contact( $old_contact );
				if ( ! empty( $old_contact['id'] ) ) {
					$u++;
				}
				// unset($old_contact['id']);
				$contacts[] = array_filter( $old_contact );
			}

			// Update the mltp_prestation post with the new contact ID
			rwmb_set_meta( $prestation_id, 'contacts_contact', $contacts );

			// // Delete original meta values used for import
			// $wpdb->query("DELETE FROM {$wpdb->postmeta}
			// WHERE post_id = $prestation_id
			// AND meta_key IN (
			// 'customer_id', 'display_name', 'contact_email', 'contact_phone',
			// 'contact_name', 'customer_name', 'customer_email', 'customer_phone'
			// )"
			// );

		}

		// Delete meta from mltp_details post type
		$wpdb->query(
			"
		    DELETE FROM {$wpdb->postmeta}
		    WHERE (post_id IN (
		        SELECT ID
		        FROM {$wpdb->posts}
		        WHERE post_type = 'mltp_prestation' OR WHERE post_type = 'mltp_detail'
		    ))
		    AND meta_key IN (
		        'customer_id', 'display_name', 'contact_email',
		        'contact_phone', 'contact_name', 'customer_name', 'customer_email',
		        'customer_phone', 'first_name', 'last_name'
		    )
		"
		);

		$notice = sprintf( "Contacts migration processed, $p prestations scanned, $u contacts updated ($e errors)" );
		error_log( $notice );
		MultiPass::admin_notice( $notice );
	}

	public function create_or_update_contact( $data ) {
		$data = array_merge(
			array(
				'id'         => null,
				'name'       => null,
				'first_name' => null,
				'last_name'  => null,
				'email'      => null,
				'phone'      => null,
			),
			$data
		);

		if ( empty( array_filter( $data ) ) ) {
			return null;
		}

		$contact_id = null;

		$found_contact_id = null;
		if ( isset( $data['id'] ) && get_post_type( $data['id'] ) === 'mltp_contact' ) {
			$found_contact_id = $data['id'];
			// error_log("update contact $found_contact_id with " . join(", ", array_filter($data)));
		} else {
			unset( $data['id'] );
			$found_contact_id = $this->get_contact_id( $data );
		}
		$data['id'] = $found_contact_id;

		$first_name   = empty( $found_contact_id ) ? $data['first_name'] : rwmb_meta( 'first_name', $this->db_args, $found_contact_id );
		$last_name    = empty( $found_contact_id ) ? $data['last_name'] : rwmb_meta( 'last_name', $this->db_args, $found_contact_id );
		$display_name = empty( $found_contact_id ) ? $data['name'] : rwmb_meta( 'display_name', $this->db_args, $found_contact_id );

		if ( empty( $first_name . $last_name ) ) {
			$split = self::split_name( $display_name );
			$data  = array_merge( $data, array_filter( $split ) );
		} else {
			$data = array_merge(
				$data,
				array(
					'first_name' => $first_name,
					'last_name'  => $last_name,
				)
			);
		}
		unset( $data['name'] ); // name column is a virtual stored field, used only to match contact here

		$post_title = sanitize_text_field( self::merge_name( $data ) );

		remove_action( 'save_post', array( $this, 'save_post_process' ) ); // Remove the action temporarily to prevent recursion
		$args = array(
			'ID'          => ( empty( $found_contact_id ) ) ? null : $found_contact_id,
			'post_type'   => 'mltp_contact',
			'post_status' => 'publish',
			'post_title'  => $post_title,
			'meta_input'  => $data,
		);

		remove_action( 'save_post', array( $this, 'save_post_process' ) ); // Remove the action temporarily to prevent recursion
		$contact_id = wp_insert_post( $args );
		add_action( 'save_post', array( $this, 'save_post_process' ) ); // Add the action back after updating the post title

		if ( ! $contact_id ) {
			// error_log("could not mach or create contact with data " . print_r($data, true));
			return false;
		}

		$contact = get_post( $contact_id );

		if ( ! $contact ) {
			// error_log("got contact id $contact_id but it's not a contact");
			return false;
		}

		$data['id'] = $contact_id;

		foreach ( $data as $key => $new_value ) {
			$current_value = rwmb_meta( $key, $this->db_args, $contact_id );

			if ( empty( $current_value ) && ! empty( $new_value ) ) {
				switch ( $key ) {
					case 'email':
						$new_value = sanitize_email( $new_value );
						break;
					case 'phone':
						if ( ! is_array( $new_value ) ) {
							$new_value = array( $new_value );
						}
						$new_value = array_map( 'sanitize_text_field', $new_value );
						break;

					default:
						if ( is_array( $new_value ) ) {
							$new_value = array_map( 'sanitize_text_field', $new_value );
						} else {
							$new_value = sanitize_text_field( $new_value );
						}
						break;
				}

				// update_post_meta( $contact_id, $key, $new_value);
				rwmb_set_meta( $contact_id, $key, $new_value, $this->db_args );
			}
		}
		$contact = get_post( $contact_id );

		return $contact_id;
	}

	public function profile_update_post_process( $user_id ) {
		// Get the user data
		$user = get_user_by( 'ID', $user_id );

		if (
			current_filter() === 'profile_update'
			&& (
				isset( $_POST['save-account-details-nonce'] )
				|| isset( $_POST['woocommerce-edit-address-nonce'] )
			)
		) {
			return;
		}

		// Check if user data exists
		if ( $user ) {
			// Query the mltp_contact posts
			global $wpdb;
			$prepared_statement = $wpdb->prepare(
				"SELECT ID FROM $this->table WHERE user_id = %d OR ( email != '' AND email = %s )",
				$user_id,
				$user->user_email,
			);
			$ids                = $wpdb->get_col( $prepared_statement );

			if ( empty( $ids ) ) {
				// Create a new contact

				$old_contact_id = wp_insert_post(
					array(
						'post_type'   => 'mltp_contact',
						'post_status' => 'publish',
						'post_title'  => $user->display_name, // Set the initial title for the new contact
						// 'meta_input'  => array(
						// 'user_id'    => $user->ID,
						// 'email'      => $user->email,
						// 'first_name' => $user->first_name,
						// 'last_name'  => $user->last_name,
						// ),
					)
				);

				// Import data from WP users for the new contact
				$this->sync_contact_from_wp_user( $old_contact_id, $user_id );
			} else {
				$contacts = get_posts(
					array(
						'post_type'   => 'mltp_contact',
						'numberposts' => -1,
						'post__in'    => $ids,
					)
				);

				// Iterate over the found contacts and import data
				foreach ( $contacts as $contact ) {
					$contact_id = $contact->ID;
					// Import data from WP users
					$this->sync_contact_from_wp_user( $contact_id, $user_id );
				}
			}
		}
	}

	public function import_contacts_from_wp_users() {
		// Get all users
		$users = get_users();

		// Iterate over the users
		foreach ( $users as $user ) {
			// Call the profile_update_post_process method for each user
			$this->profile_update_post_process( $user->ID );
		}

		$notice = sprintf( __( '%s contacts updated from existing WP users.', 'multipass' ), count( $users ) );
		error_log( $notice );
		MultiPass::admin_notice( $notice );

	}

}

$this->loaders[] = new Mltp_Contact();
