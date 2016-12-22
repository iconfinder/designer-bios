<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://iconfinder.com/iconify
 * @since      1.0.0
 *
 * @package    Designer_Bios
 * @subpackage Designer_Bios/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Designer_Bios
 * @subpackage Designer_Bios/public
 * @author     Scott Lewis <scott@iconfinder.com>
 */
class Designer_Bios_Public {

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
     * @param      string    $plugin_name       The name of the plugin.
     * @param      string    $version    The version of this plugin.
     */
    public function __construct( $plugin_name, $version ) {

        $this->plugin_name = $plugin_name;
        $this->version = $version;

        $this->add_shortcodes();
    }

    /**
     * Register the stylesheets for the public-facing side of the site.
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

        wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/designer-bios-public.css', array(), $this->version, 'all' );

    }

    /**
     * Register the JavaScript for the public-facing side of the site.
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

        wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/designer-bios-public.js', array( 'jquery' ), $this->version, false );

    }

    /**
     * Add the plugin's shortcode definitions
     */
    public function add_shortcodes() {

        add_shortcode( 'designer_bio', array( __CLASS__, 'designer_bio' ) );
    }

    /**
     * Displays a Designer Bio box
     * @param array $attrs      The shortcode attributes
     * @param bool  $refresh    Whether or not to refresh any cached version
     * @return string
     *
     * Allowed values:
     *
     *      username        Iconfinder username
     *      wp_username     WordPress username (may differ from Iconfinder username)
     *      bio             1 or 0 (whether or not to show bio)
     *      count           Number of iconset previews to show
     *      sets            Iconset IDs of specific sets to show (over-rides count)
     *
     * Username Priority:
     *    - If a wp_username value is given, it will over-ride the user metadata for current blog post's author
     *    - If an `username` (iconfinder username) is given, will be used for API call.
     *    - If no wp_username or username value is given, values from author of current post will be used.
     *
     *      In most cases the wp_username and Iconfinder username will likely be the same. But since the two
     *      systems are independent of one another, it is possible for the usernames to be different. If the
     *      Profile information you want to display is for the author of the current post, then the wp_username
     *      is not needed because it will be pulled from the current post's author metadata. But the shortcode
     *      allows you to display author bio information of any user and is not tightly coupled to the current
     *      blog post, which is why the wp_username can be explicitly indicated.
     *
     * @example
     *
     *      [designer_bio username=iconify wp_username=vectoricons bio=1 count=3]
     *      [designer_bio username=iconify wp_username=vectoricons bio=0 sets=1245,1246,1247]
     */
    public static function designer_bio( $attrs=array(), $refresh=true ) {

        $attrs = shortcode_atts(array(
            'username'    => null,
            'wp_username' => null,
            'bio'         => 1,
            'avatar'      => 1,
            'count'       => 3,
            'use_ref'     => 0,
            'refresh'     => 0,
            'sets'        => array()
        ), $attrs );

        $username     = Utils::get( $attrs, 'username', get_the_author_meta( 'iconfinder_username' ) );
        $wp_username  = Utils::get( $attrs, 'wp_username' );
        $show_bio     = Utils::is_true(Utils::get( $attrs, 'bio', 1 ));
        $show_avatar  = Utils::is_true(Utils::get( $attrs, 'avatar', 1 ));
        $use_ref      = Utils::is_true(Utils::get( $attrs, 'use_ref', 0 ));
        $count        = Utils::get( $attrs, 'count', 3 );
        $sets         = Utils::get( $attrs, 'sets', array() );
        $refresh      = Utils::get( $attrs, 'refresh', $refresh );

        /**
         * Initiate our vars
         */

        $results  = null;
        $user_id  = null;
        $nickname = null;
        $avatar   = null;
        $bio      = null;

        /**
         * Create a unique key for caching the shortcode data.
         */

        $cache_key = "desbio_{$username}_{$show_bio}_sets_";

        if (! empty($sets)) {
            $cache_key .= str_replace(',', '_', $sets);
        }
        else {
            $cache_key .= $count;
        }

        if ( ! $refresh && $cache = get_transient( $cache_key ) ) {
            $output = $cache;
        }
        else {

            if (! empty($wp_username)) {
                $user = get_user_by( 'login', $wp_username );
                $user_id = $user->ID;
            }
            else if (! empty($username)) {
                $nickname = $username;
                $user_query = new WP_User_Query( array(
                    'meta_key'   => 'iconfinder_username',
                    'meta_value' => $username
                ));
                $results = $user_query->get_results();
                if ( is_array($results) && isset($results[0]) ) {
                    $user     = $results[0];
                    $user_id  = $user->ID;
                    $nickname = get_the_author_meta( 'nickname', $user_id );
                    $bio      = get_the_author_meta( 'description', $user_id );
                    $avatar   = get_avatar( get_the_author_meta( 'user_email', $user_id ), '128' );
                }
            }

            /**
             * If we did not find a WordPress user corresponding to the username,
             * then there is no bio to show.
             */

            if (empty($results)) {
                $show_bio = 0;
            }

            if ( ! empty($sets) ) {
                $sets = explode(',', $sets);
                $count = count($sets);
            }

            /**
             * Theme the shorcode output.
             */

            $theme_args = array_merge( $attrs, array(
                'username'    => $username,
                'nickname'    => $nickname,
                'avatar'      => $avatar,
                'show_bio'    => $show_bio,
                'show_avatar' => $show_avatar,
                'bio'         => $bio,
                'count'       => $count,
                'user_id'     => $user_id,
                'use_ref'     => $use_ref,
                'ref_code'    => Utils::is_true($use_ref) ? "?ref={$username}" : "",
                'iconsets'    => self::designer_iconsets( $username, $count, $sets )
            ));

            /**
             * Cache the output in case we need it again.
             */

            $output = Utils::buffer( BIOS_THEMES_FRONT . "shortcode-author-box.php", $theme_args );
            set_transient( $cache_key, $output, 3600 );
        }

        return $output;
    }

    /**
     * Show samples from a designer's Iconfinder profile.
     * @param string    $username       The user for whom to get the iconsets.
     * @param int       $count          The number of iconsets to show.
     * @param array     $sets           An array of iconset IDs to retrieve from the icons.
     * @return string
     */
    public static function designer_iconsets( $username, $count, $sets=array() ) {

        /**
         * Get all of the user's iconsets
         */

        $iconsets = Utils::user_iconsets( $username );

        if ( isset( $iconsets['items'] ) ) {
            $iconsets = $iconsets['items'];
        }

        /**
         * If specific sets have been specified, filter for those sets, or
         * if a count has been given, return the specified number of previews.
         */

        if ( ! empty($sets) ) {
            $iconsets = Utils::filter_iconsets( $iconsets, $sets );
        }
        else if ( $count > 0 ) {
            $iconsets = array_slice( $iconsets, 0, $count );
        }

        return $iconsets;
    }
}
