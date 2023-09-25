<?php

/**
 * Plugin Name: Andbrand Wp Plugin Block Forms Base
 * Plugin URI: https://github.com/andBrandCo/andbrand-wp-plugin-block-forms-base
 * Description: &BRAND form builder plugin.
 * Author: &BRAND Team
 * Author URI: https://andbrand.co/
 * Version: 1.3.0
 * Text Domain: andbrand-forms
 *
 * @package AndbrandWpPluginBlockFormsBase
 */

declare(strict_types=1);

namespace AndbrandWpPluginBlockFormsBase;

use AndbrandWpPluginBlockFormsBase\Main\Main;

/**
 * If this file is called directly, abort.
 */
if (! \defined('WPINC')) {
	die;
}

/**
 * Include the autoloader so we can dynamically include the rest of the classes.
 */
$loader = require __DIR__ . '/vendor/autoload.php';

/**
 * The code that runs during plugin activation.
 */
\register_activation_hook(
	__FILE__,
	function () {
		PluginFactory::activate();
	}
);

/**
 * The code that runs during plugin deactivation.
 */
\register_deactivation_hook(
	__FILE__,
	function () {
		PluginFactory::deactivate();
	}
);

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 */
if (\class_exists(Main::class)) {
	(new Main($loader->getPrefixesPsr4(), __NAMESPACE__))->register();
}
