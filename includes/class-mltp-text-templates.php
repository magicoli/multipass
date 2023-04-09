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

class Mltp_Text_Templates extends Mltp_Loader {

	protected $actions;
	protected $filters;

	public function __construct() {
	}

	public function init() {

		$this->actions = array(
		);

		$this->filters = array(
		);

		$this->register_hooks();
	}
}

$this->loaders[] = new Mltp_Text_Templates();
