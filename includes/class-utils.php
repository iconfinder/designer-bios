<?php
/**
 * Class of globally-used utility functions.
 *
 * @link       http://iconfinder.com/iconify
 * @since      1.0.0
 *
 * @package    Designer_Bios
 */
class Utils {

    /**
     * Returns the requested value or default if empty
     * @param mixed $subject
     * @param string $key
     * @param mixed $default
     * @return mixed
     *
     * @since 1.1.0
     */
    public static function get($subject, $key, $default=null) {
        $value = $default;
        if (is_array($subject)) {
            if (isset($subject[$key])) {
                $value = $subject[$key];
            }
        }
        else if (is_object($subject)) {
            if (isset($subject->$key)) {
                $value = $subject->$key;
            }
        }
        else if (! empty($subject)) {
            $value = $subject;
        }
        return $value;
    }

    /**
     * Tests a mixed variable for true-ness.
     * @param int|null|bool|string $value
     * @param null|string|bool|int $default
     * @return bool|null
     */
    public static function is_true($value, $default=null) {
        $result = $default;
        $trues  = array(1, '1', 'true', true, 'yes', 'da', 'si', 'oui', 'absolutment', 'yep', 'yeppers', 'fuckyeah');
        $falses = array(0, '0', 'false', false, 'no', 'non', 'nein', 'nyet', 'nope', 'nowayjose');
        if (in_array(strtolower($value), $trues, true)) {
            $result = true;
        }
        else if (in_array(strtolower($value), $falses, true)) {
            $result = false;
        }
        return $result;
    }

    /**
     * This is a debug function and ideally should be removed from the production code.
     * @param array|object  $what   The object|array to be printed
     * @param bool          $die    Whether or not to die after printing the object
     * @return string
     */
    public static function dump($what, $die=true) {

        if (is_string( $what )) $what = array( 'debug' => $what );
        $output = sprintf( '<pre>%s</pre>', print_r($what, true) );
        if ( $die ) die( $output );
        return $output;
    }

    /**
     * This is an alias for Utils::dump()
     * @param array|object  $what   The object|array to be printed
     * @param bool          $die    Whether or not to die after printing the object
     * @return string
     */
    public static function debug($what, $die=true) {

        return Utiles::dump( $what, $die );
    }

    /**
     * Buffers the output from a file and returns the contents as a string.
     * You can pass named variables to the file using a keyed array.
     * For instance, if the file you are loading accepts a variable named
     * $foo, you can pass it to the file  with the following:
     *
     * @example
     *
     *      do_buffer('path/to/file.php', array('foo' => 'bar'));
     *
     * @param string $path
     * @param array $vars
     * @return string
     */
    public static function buffer( $path, $vars=null ) {
        $output = null;
        if (! empty($vars)) {
            extract($vars);
        }
        if (file_exists( $path )) {
            ob_start();
            include_once( $path );
            $output = ob_get_contents();
            ob_end_clean();
        }
        return $output;
    }

    /**
     * Filter the entire dataset of iconsets searching for
     * specific iconset_ids.
     * @param array $iconsets The whole dataset
     * @param array $sets An array of iconset_ids to find
     * @return array
     */
    public static function filter_iconsets( $iconsets, $sets ) {
        $filtered = array();
        if (is_array($iconsets) && count($iconsets)) {
            foreach ($iconsets as $iconset) {
                if (in_array($iconset['iconset_id'], $sets)) {
                    array_push($filtered, $iconset);
                }
            }
        }
        return $filtered;
    }

    /**
     * List N number of iconsets by a specific user.
     * @param string    $username   The username of the user whose iconsets we want.
     * @param int       $count      The number of iconsets to list
     * @return array
     */
    public static function user_iconsets( $username, $count=-1 ) {

        $result = self::all_iconsets( $username );

        if (isset($result['items'])) {
            $result = $result['items'];
            if ($count != -1) {
                $result = array_slice( $result, 0, $count );
            }
        }

        return $result;
    }

    /**
     * Get all iconsets.
     * @param string    $username   Optional username for who to get all iconsets.
     * @return array|mixed|null|object
     */
    public static function all_iconsets( $username=null ) {

        static $iconsets = array();

        $items = array();

        if (empty($iconsets) || ! empty($username)) {

            $path = API::path('iconsets', array( 'username' => $username ));

            $batch = API::call(
                API::url($path, array( 'count' => API::maxcount() ))
            );
            $total_count = self::get($batch, 'total_count') + 1;
            $page_count = ceil($total_count / API::maxcount() );
            $iconsets = $batch;
            for ($i=0; $i<$page_count; $i++) {
                $last_id = null;
                if (isset($batch['items']) && count($batch['items'])) {
                    $n = count($batch['items'])-1;
                    if (isset($batch['items'][$n]['iconset_id'])) {
                        $last_id = $batch['items'][$n]['iconset_id'];
                        $batch = API::call(
                            API::url($path, array( 'after' => $last_id, 'count' => API::maxcount() ))
                        );
                        if (is_array($iconsets['items']) && is_array($batch['items'])) {
                            $iconsets['items'] = array_merge($iconsets['items'], $batch['items']);
                        }
                    }
                }
            }
            if (isset($iconsets['items'])) {
                $ids = array();
                foreach ($iconsets['items'] as $item) {
                    if (! in_array($item['iconset_id'], $ids)) {
                        $items[] = $item;
                    }
                }
                $iconsets['items'] = $items;
                $iconsets['item_count'] = count($iconsets['items']);
            }
        }
        $result = $iconsets;
        if (! empty($username)) $iconsets = array();
        return $result;
    }

    /**
     * Get the current WP context.
     * @return string
     */
    public static function wp_context() {

        $context = 'index';

        if ( is_home() ) {
            // Blog Posts Index
            $context = 'home';
            if ( is_front_page() ) {
                // Front Page
                $context = 'front-page';
            }
        }
        else if ( is_date() ) {
            // Date Archive Index
            $context = 'date';
        }
        else if ( is_author() ) {
            // Author Archive Index
            $context = 'author';
        }
        else if ( is_category() ) {
            // Category Archive Index
            $context = 'category';
        }
        else if ( is_tag() ) {
            // Tag Archive Index
            $context = 'tag';
        }
        else if ( is_tax() ) {
            // Taxonomy Archive Index
            $context = 'taxonomy';
        }
        else if ( is_archive() ) {
            // Archive Index
            $context = 'archive';
        }
        else if ( is_search() ) {
            // Search Results Page
            $context = 'search';
        }
        else if ( is_404() ) {
            // Error 404 Page
            $context = '404';
        }
        else if ( is_attachment() ) {
            // Attachment Page
            $context = 'attachment';
        }
        else if ( is_single() ) {
            // Single Blog Post
            $context = 'single';
        }
        else if ( is_page() ) {
            // Static Page
            $context = 'page';
        }
        return $context;
    }
}