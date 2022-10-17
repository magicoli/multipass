<?php
/**
 * Register all actions and filters for the plugin
 *
 * @link  https://github.com/magicoli/multipass
 * @since 1.0.0
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
class Mltp_Calendar {

	/**
	 * The array of actions registered with WordPress.
	 *
	 * @since  1.0.0
	 * @access protected
	 * @var    array    $actions    The actions registered with WordPress to fire when the plugin loads.
	 */
	protected $actions;

	/**
	 * The array of filters registered with WordPress.
	 *
	 * @since  1.0.0
	 * @access protected
	 * @var    array    $filters    The filters registered with WordPress to fire when the plugin loads.
	 */
	protected $filters;

	/**
	 * Initialize the collections used to maintain the actions and filters.
	 *
	 * @since 1.0.0
	 */
	public function __construct() {
	}

	/**
	 * Register the filters and actions with WordPress.
	 *
	 * @since 1.0.0
	 */
	public function init() {

		$actions = array(
			// array(
			// 'hook'     => 'init',
			// 'callback' => 'register_post_types',
			// ),
			array(
				'hook'     => 'init',
				'callback' => 'register_taxonomies',
			),
			array(
				'hook'     => 'admin_menu',
				'callback' => 'admin_menu_action',
			),

			array(
				'hook'      => 'wp_ajax_feed_events',
				'component' => $this,
				'callback'  => 'ajax_feed_events_action',
			),
			array(
				'hook'      => 'wp_ajax_nopriv_feed_events',
				'component' => $this,
				'callback'  => 'ajax_feed_events_action',
			),

		);

		$filters = array(
			array(
				'hook'     => 'mb_settings_pages',
				'callback' => 'register_settings_pages',
				'priority' => 5,
			),
			array(
				'hook'     => 'rwmb_meta_boxes',
				'callback' => 'register_settings_fields',
			),

			array(
				'hook'     => 'rwmb_meta_boxes',
				'callback' => 'register_fields',
			),

			// array(
			// 'hook'     => 'manage_calendar_posts_columns',
			// 'callback' => 'add_admin_columns',
			// ),
			array(
				'hook'          => 'term_link',
				'callback'      => 'term_link_filter',
				'accepted_args' => 3,
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
	 * Add Calendar tab to settings page.
	 *
	 * @param  array $settings_pages  Current settings.
	 * @return array                  Updated settings.
	 */
	static function register_settings_pages( $settings_pages ) {
		$settings_pages['multipass-settings']['tabs']['calendar'] = __( 'Calendar', 'multipass' );

		return $settings_pages;
	}

	/**
	 * Register Calendar post type
	 *
	 * @return void
	 */
	public static function register_post_types() {
	}

	/**
	 * Register Calendars fields
	 *
	 * @param  array $meta_boxes current metaboxes.
	 * @return array                updated metaboxes.
	 */
	public static function register_settings_fields( $meta_boxes ) {
		$prefix = '';

		$meta_boxes['calendar-settings'] = array(
			'title'          => __( 'Calendar Setttings', 'multipass' ),
			'id'             => 'calendar-setttings',
			'settings_pages' => array( 'multipass-settings' ),
			'tab'            => 'calendar',
			'fields'         => array(
				array(
					'name'            => __( 'Sections Ordering', 'multipass' ),
					'id'              => $prefix . 'sections_ordering',
					'type'            => 'taxonomy_advanced',
					'desc'            => sprintf(
						__( 'To create or delete sections, go to %1$sCalendar Sections edit page%2$s.', 'multipass' ),
						'<a href="' . get_admin_url( null, 'edit-tags.php?taxonomy=calendar-section&post_type=prestation' ) . '">',
						'</a>',
					),
					'taxonomy'        => array( 'calendar-section' ),
					'field_type'      => 'select_advanced',
					'multiple'        => true,
					'select_all_none' => true,
				),
			),
		);

		return $meta_boxes;
	}

	/**
	 * Register Calendars fields
	 *
	 * @param  array $meta_boxes current metaboxes.
	 * @return array                updated metaboxes.
	 */
	public static function register_fields( $meta_boxes ) {
		$prefix = '';

		$meta_boxes[] = array(
			'title'      => __( 'Calendar', 'multipass' ),
			'id'         => 'calendar',
			'post_types' => array( 'mltp_resource' ),
			'context'    => 'side',
			'priority'   => 'low',
			'autosave'   => true,
			'fields'     => array(
				array(
					// 'name'           => __( 'Calendar Section', 'prestations' ),
					'id'             => $prefix . 'calendar_section',
					'type'           => 'taxonomy',
					'taxonomy'       => array( 'calendar-section' ),
					'field_type'     => 'select',
					'remove_default' => true,
					'placeholder'    => _x( 'None', 'Calendar section', 'multipass' ),
					'admin_columns'  => array(
						'position'   => 'after resource_resource_type',
						'title'      => __( 'Calendar', 'multipass' ),
						'sort'       => true,
						'filterable' => true,
					),
				),
			),
		);

		return $meta_boxes;
	}

	/**
	 * Register calendar-section taxonomy.
	 *
	 * @return void
	 */
	public static function register_taxonomies() {
		$labels = array(
			'name'                       => esc_html__( 'Calendar Sections', 'multipass' ),
			'singular_name'              => esc_html__( 'Calendar Section', 'multipass' ),
			'menu_name'                  => esc_html__( 'Sections', 'multipass' ),
			'search_items'               => esc_html__( 'Search Calendar Sections', 'multipass' ),
			'popular_items'              => esc_html__( 'Popular Calendar Sections', 'multipass' ),
			'all_items'                  => esc_html__( 'All Calendar Sections', 'multipass' ),
			'parent_item'                => esc_html__( 'Parent Calendar Section', 'multipass' ),
			'parent_item_colon'          => esc_html__( 'Parent Calendar Section:', 'multipass' ),
			'edit_item'                  => esc_html__( 'Edit Calendar Section', 'multipass' ),
			'view_item'                  => esc_html__( 'View Calendar Section', 'multipass' ),
			'update_item'                => esc_html__( 'Update Calendar Section', 'multipass' ),
			'add_new_item'               => esc_html__( 'Add New Calendar Section', 'multipass' ),
			'new_item_name'              => esc_html__( 'New Calendar Section Name', 'multipass' ),
			'separate_items_with_commas' => esc_html__( 'Separate calendar sections with commas', 'multipass' ),
			'add_or_remove_items'        => esc_html__( 'Add or remove calendar sections', 'multipass' ),
			'choose_from_most_used'      => esc_html__( 'Choose most used calendar sections', 'multipass' ),
			'not_found'                  => esc_html__( 'No calendar sections found.', 'multipass' ),
			'no_terms'                   => esc_html__( 'No calendar sections', 'multipass' ),
			'filter_by_item'             => esc_html__( 'Filter by calendar section', 'multipass' ),
			'items_list_navigation'      => esc_html__( 'Calendar Sections list pagination', 'multipass' ),
			'items_list'                 => esc_html__( 'Calendar Sections list', 'multipass' ),
			'most_used'                  => esc_html__( 'Most Used', 'multipass' ),
			'back_to_items'              => esc_html__( '&larr; Go to Calendar Sections', 'multipass' ),
			'text_domain'                => 'multipass',
		);
		$args   = array(
			'label'              => esc_html__( 'Calendar Sections', 'multipass' ),
			'labels'             => $labels,
			'description'        => '',
			'public'             => true,
			'publicly_queryable' => true,
			'hierarchical'       => false,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'show_in_nav_menus'  => true,
			'show_in_rest'       => true,
			'show_tagcloud'      => true,
			'show_in_quick_edit' => true,
			'show_admin_column'  => false,
			'query_var'          => true,
			'sort'               => false,
			'meta_box_cb'        => 'post_tags_meta_box',
			'rest_base'          => '',
			'rewrite'            => array(
				'with_front'   => false,
				'hierarchical' => false,
			),
		);
		register_taxonomy( 'calendar-section', array( 'mltp_resource' ), $args );

		if ( MultiPass::debug() ) {
			add_submenu_page(
				'multipass', // string $parent_slug,
				$labels['name'], // string $page_title,
				'<span class="dashicons dashicons-admin-tools"></span> ' . $labels['menu_name'], // string $menu_title,
				'mltp_administrator', // string $capability,
				'edit-tags.php?taxonomy=calendar-section', // string $menu_slug,
			);
		}

		MultiPass::register_terms(
			'calendar-section',
			array(
				// 'none'   => _x( 'None', 'Calendar section', 'multipass' ),
				'main'    => _x( 'Main', 'Calendar', 'multipass' ),
				'options' => __( 'Options', 'multipass' ),
			)
		);

	}

	/**
	 * Define additional columns for Calendars admin list.
	 *
	 * @param array $columns Columns.
	 */
	public static function add_admin_columns( $columns ) {
		// $columns['taxonomy-calendar-section'] = __( 'Calendar Type', 'multipass' );
		return $columns;
	}

	/**
	 * Allow filter by term in Calendars admin list.
	 *
	 * @param  string $termlink Term link URL.
	 * @param  object $term     Term object.
	 * @param  string $taxonomy Taxonomy slug.
	 * @return string             Term link URL.
	 */
	public static function term_link_filter( $termlink, $term, $taxonomy ) {
		if ( 'calendar-section' === $taxonomy || 'resource-type' === $taxonomy ) {
			return add_query_arg(
				array(
					$taxonomy => $term->slug,
				),
				admin_url( basename( $_SERVER['REQUEST_URI'] ) )
			);
		}
		return $termlink;
	}

	public static function admin_menu_action() {
		add_submenu_page(
			'multipass', // string $parent_slug,
			__( 'MultiPass Calendar', 'multipass' ), // string $page_title,
			__( 'Calendar', 'multipass' ), // string $menu_title,
			'view_mltp_calendar', // string $capability,
			'multipass', // string $menu_slug,
			__CLASS__ . '::render_calendar_page', // callable $callback = '',
			0, // int|float $position = null
		);
	}

	public static function render_calendar_page() {
		// Full Calendar library
		wp_enqueue_script( 'fullcalendar-cdn', 'https://cdn.jsdelivr.net/npm/fullcalendar-scheduler@5.3.0/main.min.js' );
		// wp_enqueue_script( 'mltp-calendar-main', plugins_url( 'includes/fullcalendar/fullcalendar.js', MULTIPASS_FILE ) );
		wp_enqueue_style( 'fullcalendar-main', plugins_url( 'includes/fullcalendar/fullcalendar.css', MULTIPASS_FILE ), array(), MULTIPASS_VERSION );

		// Calendar additions
		wp_enqueue_script( 'mltp-calendar', plugins_url( 'includes/calendar/calendar.js', MULTIPASS_FILE ), array( 'jquery' ), MULTIPASS_VERSION );
		wp_enqueue_style( 'mltp-calendar', plugins_url( 'includes/calendar/calendar.css', MULTIPASS_FILE ), array(), MULTIPASS_VERSION );

		$calendar_resources = self::get_calendar_resources( true );
		$main_count         = ( empty( $calendar_resources['main_count'] ) ) ? null : $calendar_resources['main_count'];
		if ( $main_count ) {
			$custom_inline_style = sprintf(
				'
				#mltp-calendar .fc-datagrid-body tr:nth-of-type(-n+%1$s):not(:first-of-type) .fc-datagrid-cell-frame,
				#mltp-calendar .fc-scrollgrid-sync-table tr:nth-of-type(-n+%1$s):not(:first-of-type) .fc-timeline-lane-frame {
					min-height: 3.7rem;
				}
				#mltp-calendar .fc-scrollgrid-sync-table  tr:nth-of-type(-n+%1$s):not(:first-of-type) .fc-event {
					font-size: 1.2rem;
					line-height: 200%%;
				}
				#mltp-calendar .fc-scrollgrid-sync-table  tr:nth-of-type(-n+%1$s):not(:first-of-type) .fc-event-start .fc-event-title-container:before {
					width: 2.2em;
					height: 2.2em;
				}
				',
				$main_count,
			);
			wp_add_inline_style( 'mltp-calendar', $custom_inline_style );
		}

		$content = '(no content yet)';
		$actions = '';

		// $args  = array(
		// 'post_type'      => 'mltp_resource',
		// 'posts_per_page' => -1,
		// 'post__not_in'   => array( 498 ),
		// );
		// $query = new WP_Query( $args );
		// if ( $query->have_posts() ) {
		// $actions  = '<span class="navbar">';
		// $actions .= '<button class="button filter-bookings" data-room="all">ALL</button> ';
		// while ( $query->have_posts() ) {
		// $query->the_post();
		// $actions .= sprintf(
		// '<button class="button filter-bookings" data-room="all">ALL</button>',
		// '<button class="button filter-bookings" data-room="%s">%s</button> ',
		// get_the_ID(),
		// get_the_title(),
		// );
		// }
		// $actions .= '</span>';
		// }

		printf(
			'<div id="mltp-calendar-wrapper" class="wrap">
				<div id="mltp-placeholder">
					<h1 class="wp-heading-inline">%s %s</h1>
					<p>%s <span class="dashicons dashicons-update spin"></span></p>
				</div>
				<div id="mltp-calendar"></div>
      </div>',
			get_admin_page_title(),
			$actions,
			__( 'Loading in progress, please wait', 'multipass' ),
		);
	}

	public static function get_calendar_resources( $include_count = false ) {
		$resources[] = array(
			'id'    => 0,
			'title' => __( 'Undefined', 'multipass' ),
		);
		$terms       = get_terms(
			array(
				'taxonomy'   => 'calendar-section',
				'hide_empty' => true,
			)
		);
		if ( $terms ) {
			$sections_ordering = explode( ',', MultiPass::get_option( 'sections_ordering' ) );
			$sections          = array_fill_keys( $sections_ordering, array() );
			foreach ( $terms as $term ) {
				$sections[ $term->term_id ] = $term;
			}
			$sections = array_filter( $sections );

			$main_count = 1;
			$s          = 0; foreach ( $sections as $term ) {
				$s++;
				$resources[] = array(
					'id'       => $term->slug,
					'title'    => $term->name,
					'mp_order' => $s,
					// 'classNames' => 'section-' . $term->slug,
				);
				$args = array(
					'posts_per_page' => -1,
					'post_type'      => 'mltp_resource',
					'meta_key'       => 'position_sort',
					'orderby'        => 'meta_value_num',
					'order'          => 'ASC',
					'tax_query'      => array(
						array(
							'taxonomy' => 'calendar-section',
							'field'    => 'term_id',
							'terms'    => $term->term_id,
						),
					),
				);

				$r     = 0;
				$query = new WP_Query( $args );
				if ( $query->have_posts() ) {
					// Get prestation items for each resource
					while ( $query->have_posts() ) {
						if ( 1 === $s ) {
							$main_count++;
						}
						$r++;
						$query->the_post();
						$resource    = get_post();
						$resources[] = array(
							'id'       => $resource->post_name,
							'title'    => $resource->post_title,
							'parentId' => $term->slug,
							'mp_order' => $r,
							// 'classNames' => 'resource-' . sanitize_title($resource->post_title),
						);

					}
				}
			}
		}
		if ( $include_count ) {
			$resources['main_count'] = $main_count;
		}
		return $resources;
	}

	public function ajax_feed_events_action() {
		// Get calendars from taxonomy
		$events = array();

		$resources = self::get_calendar_resources();

		$args  = array(
			'posts_per_page' => -1,
			'post_type'      => 'mltp_detail',
		);
		$query = new WP_Query( $args );

		$hide_undefined = true;
		if ( $query && $query->have_posts() ) {
			while ( $query->have_posts() ) {
				$query->the_post();
				$item = new Mltp_Item(get_the_ID());
				$item_id = get_the_ID();
				$dates = array_filter(array(
					'from' => (integer)$item->from,
					'to' => (integer)$item->to,
				));
				if ( empty( $dates ) ) {
					continue;
				}
				$iso = array_map( 'MultiPass::format_date_iso', $dates );

				$room              = join(
					'-',
					array(
						get_post_meta( get_the_ID(), 'source_id', true ),
						get_post_meta( get_the_ID(), 'source_item_id', true ),
					)
				);
				$begin             = $iso['from'];
				$end               = ( empty( $iso['to'] ) ) ? $iso['from'] : $iso['to'];
				$prestation_id     = get_post_meta( get_the_ID(), 'prestation_id', true );
				$prestation        = new Mltp_Prestation( $prestation_id );
				$prestation_status = ( $prestation->post ) ? $prestation->post->post_status : null;
				$resource_id       = get_post_meta( get_the_ID(), 'resource_id', true );
				$resource          = get_post( $resource_id );

				if ( $resource ) {
					$resource_slug = $resource->post_name;
				} else {
					$resource_id    = 0;
					$resource_slug  = 0;
					$hide_undefined = false;
				}

				$flags = get_post_meta( get_the_ID(), 'flags', true );
				$flags = empty( $flags ) ? 0 : $flags;

				if ( ! $flags & MLTP_CLOSED_PERIOD ) {
					if ( $prestation ) {
						$pflags = get_post_meta( $prestation_id, 'flags', true );
					}
					$pflags = empty( $pflags ) ? 0 : $pflags;
					$flags  = $flags | ( $pflags & MLTP_PAID_SOME ) | ( $pflags & MLTP_PAID_DEPOSIT ) | ( $pflags & MLTP_PAID_ALL ) | ( $pflags & MLTP_CONFIRMED );
				}

				$classes     = MultiPass::get_flag_slugs( $flags );
				$classes[]   = sanitize_title( get_post_meta( $item_id, 'status', true ) );
				$classes     = ( is_array( $classes ) ) ? preg_replace( '/^/', 'status-', $classes ) : array();
				$source_slug = get_post_meta( $item_id, 'source', true );
				$origin      = get_post_meta( $item_id, 'origin', true );
				$origin      = ( empty( $origin ) ) ? get_post_meta( $item_id, 'source', true ) : $origin;

				// $closed_period = get_post_meta( get_the_ID(), 'closed_period', true );
				// $closed_status = get_post_meta( get_the_ID(), 'status', true );
				// if(12659 === $item_id) {
				// error_log(print_r(get_post_meta($item_id, 'status'), true));
				// }
				// if($closed_period || 'closed' === $closed_status) $classes[] = 'closed-period';

				$classes = array_unique(
					array_merge(
						$classes,
						array(
							'prestation-' . $prestation_id,
							'item-' . $item_id,
							'resource-' . $resource_slug,
							'origin-' . $origin,
						)
					)
				);

				if ( $prestation ) {
					// $calendar = get_the_terms($item_id, )
					$e = array(
						'id'          => 'item-' . $item_id,
						'title'       => html_entity_decode( get_the_title( $prestation_id ) ),
						'description' => 'this is a long description',
						'modal'       => self::get_the_modal( $item_id ),
						'start'       => $begin,
						'end'         => $end,
						'url'         => get_edit_post_link( $prestation_id, '' ),
						// 'url'        => '#',
						'classNames'  => join( ' ', $classes ),
						'allDay'      => true,
						'resourceId'  => $resource_slug,
						// 'allDay' => false,

					);

					array_push( $events, $e );
				}
			}
		}

		if ( $hide_undefined ) {
			array_shift( $resources );
		}

		$data = array(
			'locale'    => MultiPass::get_locale(),
			'resTitle'  => __( 'Resources', 'multipass' ),
			'resources' => $resources,
			'events'    => $events,
		);
		echo json_encode( $data );
		wp_die();
	}

	static function get_the_modal( $item_id ) {
		$event = new Mltp_Event( $item_id );
		if ( ! $event ) {
			return false;
		}
		$event->total    = round( $event->total, 2 );
		$event->subtotal = round( $event->subtotal, 2 );
		$html            = '';
		$data            = array(
			'booking' => array(
				__( 'Check in', 'multipass' )  => MultiPass::format_date( $event->display_start ),
				__( 'Check out', 'multipass' ) => MultiPass::format_date( $event->display_end ),
			),
			'prices'  => array(
				__( 'Subtotal', 'multipass' ) => ( $event->subtotal === $event->total ) ? null : MultiPass::price( $event->subtotal ),
				__( 'Discount', 'multipass' ) => MultiPass::price( $event->discount ),
				__( 'Total', 'multipass' )    => MultiPass::price( $event->total ),
				__( 'Deposit', 'multipass' )  => MultiPass::price( $event->deposit ),
				__( 'Paid', 'multipass' )     => MultiPass::price( $event->paid ),
				__( 'Balance', 'multipass' )  => MultiPass::price( $event->balance ),
			),
			'contact' => array(
				_x( 'Contact', '(noun)', '(noun)', 'multipass' ) => $event->contact,
				_x( 'Email', '(noun)', 'multipass' ) => $event->email,
				_x( 'Phone', '(noun)', 'multipass' ) => $event->phone,
			),
		);
		$rows            = array();
		foreach ( $data as $section => $lines ) {
			$lines = array_filter( $lines );
			if ( empty( $lines ) ) {
				continue;
			}
			// if(!empty($rows)) {
				// $rows[$section] = 'divider';
			// }
			$rows = array_merge( $rows, array( 'divider' ), $lines );
		}
		// $rows = array_filter($rows);
		if ( MultiPass::debug() ) {
			$extra              = array();
			// $extra['Source']    = get_post_meta( $event->id, 'source', true ) . ' ' . get_post_meta( $event->id, 'source_id', true );
			// $extra['Origin']    = get_post_meta( $event->id, 'origin', true ) . ' ' . get_post_meta( $event->id, 'origin_id', true );
			// $extra['Debug']     = '<pre>' . print_r( MultiPass::get_registered_sources(), true ) . '</pre>';

			$sources = array_merge(array(
				'source' => 'Source',
				'origin' => 'Origin',
			), MultiPass::get_registered_sources() );
			foreach ( $sources as $source => $source_name ) {
				$source_id                          = get_post_meta( $event->id, $source . '_id', true );
				$extra[ "$source_name ID" ]         = $source_id;
				$extra[ "$source_name UUID" ]       = get_post_meta( $event->id, $source . '_uuid', true );
				$extra[ "$source_name check hash" ] = MultiPass::hash_source_uuid( $source, $source_id );
				$extra[ "$source_name url" ]        = get_post_meta( $event->id, $source . '_url', true );
				$extra[ "$source_name url" ]        = MultiPass::get_source_url( $source, $source_id );
				$extra[ "$source_name edit url" ]   = get_post_meta( $event->id, $source . '_edit_url', true );
				$extra[ "$source_name view url" ]   = get_post_meta( $event->id, $source . '_view_url', true );
			}

			$rows = array_merge( $rows, array( 'divider' ), array_filter( $extra ) );
		}

		// error_log(print_r($event, true));

		// $prestation_id = get_post_meta($event->post->ID, 'prestation_'
		$html .= '<span class="description">' . $event->title . '</span>';
		$html .= '<table class="modal-summary">';
		foreach ( $rows as $row => $value ) {
			if ( 'divider' === $value ) {
				$html .= sprintf(
					'<tr class="%s"><td colspan=2>%s</td></tr>',
					is_numeric( $row ) ? '' : $row,
					'<hr>',
				);
			} else {
				$html .= sprintf(
					'<tr><th>%s</th><td>%s</td></tr>',
					is_numeric( $row ) ? '' : $row,
					$value,
				);
			}
		}
		$html         .= '<table>';
		$prestation_id = get_post_meta( $event->post->ID, 'prestation_id', true );

		$links = array();

		if ( current_user_can( 'edit_post', $prestation_id ) ) {
			$links['prestation'] = array(
				'label' => __( 'Prestation', 'multipass' ),
				'url'   => get_edit_post_link( $prestation_id ),
				'icon'  => 'edit-page',
			);
		}

		if ( current_user_can( 'edit_post', $event->id ) ) {

			$links['item'] = array(
				'label' => __( 'This rental', 'multipass' ),
				'url'   => get_edit_post_link( $event->id ),
				'icon'  => 'welcome-write-blog',
			);

			$sources = MultiPass::get_registered_sources();
			foreach ( $sources as $source => $source_name ) {
				$source_url = get_post_meta( $event->id, $source . '_edit_url', true );
				if ( ! empty( $source_url ) ) {
					$links[ $source ] = array(
						'label' => sprintf( __( 'View on %s', 'multipass' ), $source_name ),
						'url'   => $source_url,
						'icon'  => 'external',
					);
				}
			}

			/**
			 * Quick fix to get source url stored by the module instead of calculated
			 * one, which might differ, e.g. for closed periods. Best approach would
			 * be to use a filter to generate source url, and to pass context like
			 * closed periods.
			 */
			// $overrides = array_filter(
			// 	array(
			// 		$event->source => $event->source_url,
			// 		$event->origin => $event->origin_url,
			// 	)
			// );
			// foreach ( $overrides as $source => $source_url ) {
			// 	if ( empty( $source ) ) {
			// 		continue;
			// 	}
			// 	$source_name      = ( empty( $sources[ $source ] ) ) ? $source : $sources[ $source ];
			// 	$links[ $source ] = array(
			// 		'label' => sprintf( __( 'View on %s', 'multipass' ), $source_name ),
			// 		'url'   => $source_url,
			// 		'icon'  => 'external',
			// 	);
			// }
			// End quick fix

			// if ( ! empty( $event->origin ) && $event->origin != $event->source ) {
			// $links['origin'] = array(
			// 'label' => sprintf(
			// __( 'Edit on %s', 'multipass' ),
			// $event->origin,
			// ),
			// 'url'   => $event->origin_url,
			// 'icon'  => ( $event->source === 'woocommerce' ) ? 'cart' : 'external',
			// );
			// }
			// if ( ! empty( $links['source']['url'] ) & ! empty( $links['origin']['url'] ) && $links['source']['url'] === $links['origin']['url'] ) {
			// unset( $links['origin'] );
			// }
			// if ( ! empty( $links['view']['url'] ) & ! empty( $links['details']['url'] ) && $links['view']['url'] === $links['details']['url'] ) {
			// unset( $links['view'] );
			// }

		}

		if ( ! empty( $links ) ) {
			$links_html = '';
			foreach ( $links as $link ) {
				if ( empty( $link['url'] ) ) {
					continue;
				}
				$icon        = ( empty( $link['icon'] ) ) ? '' : sprintf(
					'<span class="dashicons dashicons-%s"></span> ',
					$link['icon'],
				);
				$target      = ( MultiPass::is_external( $link['url'] ) ) ? '_blank' : '_self';
				$links_html .= sprintf(
					'<li><a class=button href="%s" target="%s">%s%s</a></li>',
					$link['url'],
					$target,
					$icon,
					// $link['url'],
					$link['label'],
				);
			}

			$html .= '<ul class="modal-buttons">' . $links_html . '</ul>';
		}

		// if ( ! empty( $event->edit_url ) ) {
		// $html .= sprintf(
		// '<a href="%s">%s</a>',
		// $event->edit_url,
		// __( 'Edit event', 'multipass' ),
		// );
		// }
		return $html;
	}
}

class Mltp_Event extends Mltp_Item {

	public $id;
	public $title;
	public $description;
	public $subtotal;
	public $discount;
	public $total;
	public $deposit;
	public $paid;
	public $balance;
	public $start;
	public $end;
	public $flags;
	public $edit_url;
	public $display_start;
	public $display_end;
	public $contact;
	public $email;
	public $phone;
	public $source;
	public $source_url;
	public $origin;
	public $origin_url;

	public function __construct( $args ) {
		if ( empty( $args ) ) {
			return new WP_Error( 'empty', __( 'Event is empty', 'multipass' ) );
		}

		if ( is_numeric( $args ) ) {
			$this->post = get_post( $args );
		} elseif ( is_object( $args ) && 'mltp_detail' === $args->post_type ) {
			$this->post = $args;
		}
		if ( ! $this->post ) {
			return new WP_Error( 'notfound', __( 'Event not found', 'multipass' ) );
		}
		$type = get_post_meta( $this->post->ID, 'type', true );
		if ( 'booking' !== $type ) {
			return new WP_Error( 'wrongtype', __( 'Not an event', 'multipass' ) );
		}

		$this->id = $this->post->ID;

		$this->title = $this->post->post_title;
		$metas       = get_post_meta( $this->id );
		// $this->source = 'source' => get_post_meta($this->id, 'source', true);
		$this->description = get_post_meta( $this->id, 'description', true );
		$dates             = get_post_meta( $this->id, 'dates', true );
		$price             = get_post_meta( $this->id, 'price', true );
		$this->subtotal    = ( isset( $price['sub_total'] ) ) ? $price['sub_total'] : null;
		$discount          = get_post_meta( $this->id, 'discount', true );
		$this->discount    = ( isset( $discount['amount'] ) ) ? $discount['amount'] : null;
		$this->total       = get_post_meta( $this->id, 'total', true );
		$deposit           = get_post_meta( $this->id, 'deposit', true );
		$this->deposit     = ( isset( $discount['deposit'] ) ) ? $deposit['amount'] : null;
		$this->paid        = get_post_meta( $this->id, 'paid', true );
		$this->balance     = get_post_meta( $this->id, 'balance', true );
		$this->start       = ( isset( $dates['from'] ) ) ? $dates['from'] : null;
		$this->end         = ( isset( $dates['to'] ) ) ? $dates['to'] : null;
		$this->flags       = get_post_meta( $this->id, 'flags', true );
		$this->edit_url    = get_post_meta( $this->id, 'edit_url', true );
		$this->source      = get_post_meta( $this->id, 'source', true );
		$this->source_url  = get_post_meta( $this->id, 'source_url', true );
		$this->origin      = get_post_meta( $this->id, 'origin', true );
		$this->origin_url  = get_post_meta( $this->id, 'origin_url', true );
		$check_in          = ( isset( $dates['check_in'] ) ) ? $dates['check_in'] : null;
		$check_out         = ( isset( $dates['check_out'] ) ) ? $dates['check_in'] : null;

		$d         = 86400;
		$check_in  = ( empty( $check_in ) ) ? ( $d / 2 ) : $check_in;
		$check_out = ( empty( $check_out ) ) ? ( $d / 2 ) : $check_out;

		// $slots             = get_post_meta( $this->id, 'slots', true );
		// $slots             = ( empty( $slots ) ) ? 'overnight' : $slots;

		// $fix_overnight =  get_post_meta( $this->id, 'slots', true );
		//

		$fix_overnight       = true;
		$this->start         = MultiPass::sanitize_timestamp( $this->start );
		$this->end           = MultiPass::sanitize_timestamp( $this->end );
		$this->display_start = ( $fix_overnight ) ? ( round( $this->start / $d ) * $d ) : $this->start;
		$this->display_end   = ( $fix_overnight ) ? ( round( $this->end / $d ) * $d ) : $this->end;

		// if ( 'overnight' === $slots ) {
		// $this->display_start = floor( $this->start / $d ) * $d + $check_in;
		// $this->display_end   = floor( $this->end / $d + 1 ) * $d + $check_out;
		// } else {
		// $this->display_start = $this->start;
		// $this->display_end   = $this->end;
		// }
	}

}

$this->loaders[] = new Mltp_Calendar();
