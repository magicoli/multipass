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
		$this->actions = array(
			array(
				'hook'     => 'init',
				'callback' => 'register_post_types',
			),
			array(
				'hook'     => 'init',
				'callback' => 'register_taxonomies',
			),
		);

		$this->filters = array(
			array(
				'component' => $this,
				'hook'      => 'rwmb_meta_boxes',
				'callback'  => 'register_fields',
			),
		);

	}

	/**
	 * Register Contact post type
	 *
	 * @return void
	 */
	public static function register_post_types() {
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
	}

	public function register_fields( $meta_boxes ) {
		$prefix = '';

		$meta_boxes[] = array(
			'title'      => __( 'Contact fields', 'multipass' ),
			'id'         => 'contact-fields',
			'post_types' => array( 'mltp_contact' ),
			'context'    => 'after_title',
			'style'      => 'seamless',
			'autosave'   => true,
			'geo'        => true,
			'fields'     => array(
				array(
					'name'       => __( 'User', 'multipass' ),
					'id'         => $prefix . 'user_id',
					'type'       => 'user',
					'field_type' => 'select_advanced',
					'add_new'    => true,
				),
				array(
					'name'    => __( 'First Name', 'multipass' ),
					'id'      => $prefix . 'first_name',
					'type'    => 'text',
					'columns' => 6,
					'visible' => array(
						'when'     => array( array( 'user_id', '=', '' ) ),
						'relation' => 'or',
					),
				),
				array(
					'name'    => __( 'Last Name', 'multipass' ),
					'id'      => $prefix . 'last_name',
					'type'    => 'text',
					'columns' => 6,
					'visible' => array(
						'when'     => array( array( 'user_id', '=', '' ) ),
						'relation' => 'or',
					),
				),
				array(
					'name' => __( 'Company', 'multipass' ),
					'id'   => $prefix . 'company',
					'type' => 'text',
				),
				array(
					'name'          => __( 'Email', 'multipass' ),
					'id'            => $prefix . 'email',
					'type'          => 'email',
					'admin_columns' => 'after title',
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
					'admin_columns'     => 'after title',
				),
				array(
					'name'              => __( 'Address', 'multipass' ),
					'id'                => $prefix . 'address',
					'type'              => 'group',
					'clone'             => true,
					'clone_as_multiple' => true,
					'add_button'        => __( 'Add an address', 'multipass' ),
					'admin_columns'     => 'after title',
					'sanitize_callback' => 'MultiPass::sanitize_address',
					'fields'            => array(
						array(
							'id'          => $prefix . 'address',
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
							'id'          => $prefix . 'neighbourhood_suburb',
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
							'id'          => $prefix . 'village_town_locality',
							'type'        => 'text',
							'placeholder' => __( 'Village / Town / Locality', 'multipass' ),
							'columns'     => 5,
							'binding'     => 'village + " " + town + " " + locality',
						),
						array(
							'id'          => $prefix . 'county_state',
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
						// [
						// 'id'      => $prefix . 'house_number',
						// 'type'    => 'hidden',
						// ],
						// [
						// 'id'      => $prefix . 'aeroway',
						// 'type'    => 'hidden',
						// ],
						// [
						// 'id'      => $prefix . 'road',
						// 'type'    => 'hidden',
						// ],
						// [
						// 'id'      => $prefix . 'neighbourhood',
						// 'type'    => 'hidden',
						// ],
						// [
						// 'id'      => $prefix . 'suburb',
						// 'type'    => 'hidden',
						// ],
						// [
						// 'id'      => $prefix . 'village',
						// 'type'    => 'hidden',
						// ],
						// [
						// 'id'      => $prefix . 'town',
						// 'type'    => 'hidden',
						// ],
						// [
						// 'id'      => $prefix . 'locality',
						// 'type'    => 'hidden',
						// ],
						// [
						// 'id'      => $prefix . 'county',
						// 'type'    => 'hidden',
						// ],
						// [
						// 'id'      => $prefix . 'state',
						// 'type'    => 'hidden',
						// ],
						// [
						// 'id'      => $prefix . 'country_code',
						// 'type'    => 'hidden',
						// ],
						array(
							'id'            => $prefix . 'geocode',
							'type'          => 'osm',
							'address_field' => 'address',
							'language'      => 'fr',
							'class'         => 'hidden thisisaclassiuseonlyhere',
						),
					),
				),
			),
		);

		return $meta_boxes;
	}

	/**
	 * Register contact-status taxonomy.
	 *
	 * @return void
	 */
	public static function register_taxonomies() {
	}
}

$this->loaders[] = new Mltp_Contact();
