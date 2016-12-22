<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://iconfinder.com/iconify
 * @since      1.0.0
 *
 * @package    Designer_Bios
 * @subpackage Designer_Bios/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Designer_Bios
 * @subpackage Designer_Bios/admin
 * @author     Scott Lewis <scott@iconfinder.com>
 */
class Designer_Bios_Admin {

    /**
     * The ID of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string    $plugin_name    The ID of this plugin.
     */
    private $plugin_name;

    /**
     * The version of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string    $version    The current version of this plugin.
     */
    private $version;

    /**
     * Initialize the class and set its properties.
     *
     * @since    1.0.0
     * @param      string    $plugin_name       The name of this plugin.
     * @param      string    $version    The version of this plugin.
     */
    public function __construct( $plugin_name, $version ) {

        $this->plugin_name = $plugin_name;
        $this->version = $version;

    }

    /**
     * Register the stylesheets for the admin area.
     *
     * @since    1.0.0
     */
    public function enqueue_styles() {

        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in Designer_Bios_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The Designer_Bios_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */

        wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/designer-bios-admin.css', array(), $this->version, 'all' );

    }

    /**
     * Register the JavaScript for the admin area.
     *
     * @since    1.0.0
     */
    public function enqueue_scripts() {

        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in Designer_Bios_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The Designer_Bios_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */

        wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/designer-bios-admin.js', array( 'jquery' ), $this->version, false );

    }

    /**
     * Adds form fields to the Profile admin screen.
     * @param \WP_User $user    The WP_User object
     */
    public function add_user_profile_fields( $user ) {

        echo Utils::buffer( BIOS_THEMES_ADMIN . 'user-fields.php', array('user' => $user ) );
    }

    /**
     * Saves the custom user profile fields.
     * @param   int   $user_id
     * @return  bool
     */
    function save_user_profile_fields( $user_id ) {

        if ( ! current_user_can( 'edit_user', $user_id ) )
            return false;

        $result = update_user_meta( $user_id, 'iconfinder_username', Utils::get( $_POST, 'iconfinder_username' ) );
        if ( is_wp_error( $result )) {
            //TODO: Handle the error
        }
        $result = update_user_meta( $user_id, 'twitter_username', Utils::get( $_POST, 'twitter_username' ) );
        if ( is_wp_error( $result )) {
            //TODO: Handle the error
        }
    }

}