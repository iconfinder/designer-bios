<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       http://iconfinder.com/iconify
 * @since      1.0.0
 *
 * @package    Designer_Bios
 * @subpackage Designer_Bios/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Designer_Bios
 * @subpackage Designer_Bios/includes
 * @author     Scott Lewis <scott@iconfinder.com>
 */
class Designer_Bios_i18n {


    /**
     * Load the plugin text domain for translation.
     *
     * @since    1.0.0
     */
    public function load_plugin_textdomain() {

        load_plugin_textdomain(
            'designer-bios',
            false,
            dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
        );

    }



}
