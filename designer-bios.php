<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://iconfinder.com/iconify
 * @since             1.0.0
 * @package           Designer_Bios
 *
 * @wordpress-plugin
 * Plugin Name:       Designer Bios
 * Plugin URI:        http://iconfinder.com
 * Description:       A plugin to display an avatar, short bio, and sample icon sets for a designer/author.
 * Version:           1.0.0
 * Author:            Scott Lewis
 * Author URI:        http://iconfinder.com/iconify
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       designer-bios
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
    die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-designer-bios-activator.php
 */
function activate_designer_bios() {
    require_once plugin_dir_path( __FILE__ ) . 'includes/class-designer-bios-activator.php';
    Designer_Bios_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-designer-bios-deactivator.php
 */
function deactivate_designer_bios() {
    require_once plugin_dir_path( __FILE__ ) . 'includes/class-designer-bios-deactivator.php';
    Designer_Bios_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_designer_bios' );
register_deactivation_hook( __FILE__, 'deactivate_designer_bios' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-designer-bios.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_designer_bios() {

    $plugin = new Designer_Bios();
    $plugin->run();

}
run_designer_bios();
