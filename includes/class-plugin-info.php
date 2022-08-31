<?php

/**
 * Register all actions and filters for the plugin
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    multiservices
 * @subpackage multiservices/includes
 */

/**
 * Register all actions and filters for the plugin.
 *
 * Maintain a list of all hooks that are registered throughout
 * the plugin, and register them with the WordPress API. Call the
 * run function to execute the list of actions and filters.
 *
 * @package    multiservices
 * @subpackage multiservices/includes
 * @author     Your Name <email@example.com>
 */
class MultiServices_PluginInfo {

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
	public function __construct() {
		$this->plugin_file = plugin_basename(MULTISERVICES_FILE);
		$this->slug = basename(MULTISERVICES_DIR);
		$this->installed_version = MULTISERVICES_VERSION;
	}


	/**
	 * Register the filters and actions with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {

		add_filter('plugins_api', array($this, 'injectInfo'), 20, 3);
		add_filter('plugin_row_meta', array($this, 'plugin_row_meta'), 10, 4);

	}

	public function requestInfo($queryArgs = array()) {
		list($pluginInfo, $result) = $this->requestMetadata('Puc_v4p9_Plugin_Info', 'request_info', $queryArgs);

		if ( $pluginInfo !== null ) {
			$pluginInfo->filename = $this->plugin_file;
			$pluginInfo->slug = $this->slug;
		}

		error_log("pluginInfo " . print_r($pluginInfo, true));
		return $pluginInfo;
	}

	public function injectInfo($result, $action = null, $args = null){

		$relevant = ($action == 'plugin_information') && isset($args->slug) && (
				($args->slug == $this->slug) || ($args->slug == dirname($this->plugin_file))
			);
		if ( !$relevant ) {
			return $result;
		}

		$pluginInfo = $this->requestInfo();
		// $this->fixSupportedWordpressVersion($pluginInfo);

		if ( $pluginInfo ) {
			return $pluginInfo->toWpFormat();
		}

		return $result;
	}

	function plugin_row_meta( $plugin_meta, $plugin_file, $plugin_data, $status ) {
		// if($plugin_file != basename(MULTISERVICES_DIR) . '/' . basename(MULTISERVICES_FILE)) return;
		if( $plugin_file != $this->plugin_file ) return $plugin_meta;
		// error_log("plugin data " . print_r(get_plugin_data(MULTISERVICES_FILE), true));
		// error_log($plugin_file);
		// return $plugin_meta;

		// if ( $this->isMyplugin_file($plugin_file) && !isset($plugin_data['slug']) ) {
			$linkText = apply_filters('view_details_link', __('View details'));
			if ( !empty($linkText) ) {
				$viewDetailsLinkPosition = 'append';

				//Find the "Visit plugin site" link (if present).
				$visitPluginSiteLinkIndex = count($plugin_meta) - 1;
				if ( $plugin_data['PluginURI'] ) {
					$escapedPluginUri = esc_url($plugin_data['PluginURI']);
					foreach ($plugin_meta as $linkIndex => $existingLink) {
						if ( strpos($existingLink, $escapedPluginUri) !== false ) {
							$visitPluginSiteLinkIndex = $linkIndex;
							$viewDetailsLinkPosition = apply_filters(
								'view_details_link_position',
								'before'
							);
							break;
						}
					}
				}

				$viewDetailsLink = sprintf('<a href="%s" class="thickbox open-plugin-details-modal" aria-label="%s" data-title="%s">%s</a>',
					esc_url(network_admin_url('plugin-install.php?tab=plugin-information&plugin=' . urlencode($this->slug) .
						'&TB_iframe=true&width=600&height=550')),
					esc_attr(sprintf(__('More information about %s'), $plugin_data['Name'])),
					esc_attr($plugin_data['Name']),
					esc_attr(__('View details')),
				);
				switch ($viewDetailsLinkPosition) {
					case 'before':
						array_splice($plugin_meta, $visitPluginSiteLinkIndex, 0, $viewDetailsLink);
						break;
					case 'after':
						array_splice($plugin_meta, $visitPluginSiteLinkIndex + 1, 0, $viewDetailsLink);
						break;
					case 'replace':
						$plugin_meta[$visitPluginSiteLinkIndex] = $viewDetailsLink;
						break;
					case 'append':
					default:
						$plugin_meta[] = $viewDetailsLink;
						break;
				}
			}
		// }
		return $plugin_meta;
	}

	protected function requestMetadata($metaClass, $filterRoot, $queryArgs = array()) {
		$metadata = [];
		$result = true;
		return array($metadata, $result);
	}

	public function unique_name($name) {
		return join('_', array_filter(array(
			$this->slug,
			$name,
		)));
	}

}
