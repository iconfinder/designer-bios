<?php

/**
 * Iconfinder portfolio global settings
 */

define( 'ICONFINDER_DOMAIN',        'iconfinder.com' );
define( 'ICONFINDER_URL',           'https://iconfinder.com/' );
define( 'ICONFINDER_API_URL',       'https://api.iconfinder.com/v2/' );
define( 'ICONFINDER_CDN_URL',       'https://cdn4.iconfinder.com/' );
define( 'ICONFINDER_LINK_ICONS',    'https://www.iconfinder.com/icons/' );
define( 'ICONFINDER_LINK_ICONSETS', 'https://www.iconfinder.com/iconsets/' );


/**
 * API Settings
 */

define( 'API_MAX_COUNT', 100 );
define( 'API_SSL_VERIFY', false );

/**
 * Miscellaneous
 */

/**
 * We define this here and take an indirect approach to using it
 * so that if details like the locations of images changes on the
 * Iconfinder side, we only have one file to update in the WP Plugin
 */

define('ICF_TOKEN_SIZE', '@SIZE');
define('ICF_TOKEN_IDENTIFIER', '@IDENTIFIER');
define('ICF_ICONSET_PREVIEW_URL',  ICONFINDER_CDN_URL . 'data/iconsets/previews/' . ICF_TOKEN_SIZE . '/' . ICF_TOKEN_IDENTIFIER . '.png');