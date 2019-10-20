<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://mattwoods.io/
 * @since             1.0.0
 * @package           Frida
 *
 * @wordpress-plugin
 * Plugin Name:       frida
 * Plugin URI:        https://wordpress.org/plugins/frida/
 * Description:       See all your thumbnails at a glance!
 * Version:           1.0.0
 * Author:            Matt Woods
 * Author URI:        https://mattwoods.io/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       frida
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if (!defined('WPINC')) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define('FRIDA_VERSION', '1.0.0');

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-frida-activator.php
 */
function activate_frida()
{
	require_once plugin_dir_path(__FILE__) . 'includes/class-frida-activator.php';
	Frida_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-frida-deactivator.php
 */
function deactivate_frida()
{
	require_once plugin_dir_path(__FILE__) . 'includes/class-frida-deactivator.php';
	Frida_Deactivator::deactivate();
}

register_activation_hook(__FILE__, 'activate_frida');
register_deactivation_hook(__FILE__, 'deactivate_frida');

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path(__FILE__) . 'includes/class-frida.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_frida()
{

	$plugin = new Frida();
	$plugin->run();
}
run_frida();
