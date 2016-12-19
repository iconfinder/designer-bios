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
    function get($subject, $key, $default=null) {
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
    function is_true($value, $default=null) {
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
    function dump($what, $die=true) {
        $output = sprintf( '<pre>%s</pre>', print_r($what, true) );
        if ( $die ) die( $output );
        return $output;
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
    function buffer($path, $vars=null) {
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
}