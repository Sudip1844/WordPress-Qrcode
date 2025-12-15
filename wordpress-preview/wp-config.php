<?php
define( 'DB_NAME', 'wordpress' );
define( 'DB_USER', '' );
define( 'DB_PASSWORD', '' );
define( 'DB_HOST', '' );
define( 'DB_CHARSET', 'utf8' );
define( 'DB_COLLATE', '' );

define( 'USE_MYSQL', false );

define( 'AUTH_KEY',         'put-your-unique-phrase-here-1' );
define( 'SECURE_AUTH_KEY',  'put-your-unique-phrase-here-2' );
define( 'LOGGED_IN_KEY',    'put-your-unique-phrase-here-3' );
define( 'NONCE_KEY',        'put-your-unique-phrase-here-4' );
define( 'AUTH_SALT',        'put-your-unique-phrase-here-5' );
define( 'SECURE_AUTH_SALT', 'put-your-unique-phrase-here-6' );
define( 'LOGGED_IN_SALT',   'put-your-unique-phrase-here-7' );
define( 'NONCE_SALT',       'put-your-unique-phrase-here-8' );

$table_prefix = 'wp_';

define( 'WP_DEBUG', true );
define( 'WP_DEBUG_LOG', true );
define( 'WP_DEBUG_DISPLAY', false );

$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';
$host = isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : 'localhost:5000';
define( 'WP_HOME', $protocol . '://' . $host );
define( 'WP_SITEURL', $protocol . '://' . $host );

define( 'AUTOMATIC_UPDATER_DISABLED', true );
define( 'WP_AUTO_UPDATE_CORE', false );

if ( ! defined( 'ABSPATH' ) ) {
    define( 'ABSPATH', __DIR__ . '/' );
}

require_once ABSPATH . 'wp-settings.php';
