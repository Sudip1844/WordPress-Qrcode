<?php
if (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https') {
    $_SERVER['HTTPS'] = 'on';
}

define( 'DB_NAME', 'wordpress' );
define( 'DB_USER', '' );
define( 'DB_PASSWORD', '' );
define( 'DB_HOST', '' );
define( 'DB_CHARSET', 'utf8' );
define( 'DB_COLLATE', '' );

$table_prefix = 'wp_';

define( 'AUTH_KEY',         'unique phrase here 1' );
define( 'SECURE_AUTH_KEY',  'unique phrase here 2' );
define( 'LOGGED_IN_KEY',    'unique phrase here 3' );
define( 'NONCE_KEY',        'unique phrase here 4' );
define( 'AUTH_SALT',        'unique phrase here 5' );
define( 'SECURE_AUTH_SALT', 'unique phrase here 6' );
define( 'LOGGED_IN_SALT',   'unique phrase here 7' );
define( 'NONCE_SALT',       'unique phrase here 8' );

define( 'WP_DEBUG', true );
define( 'WP_DEBUG_LOG', true );
define( 'WP_DEBUG_DISPLAY', false );

$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https://' : 'http://';
$domain = getenv('REPLIT_DEV_DOMAIN') ?: $_SERVER['HTTP_HOST'];
define( 'WP_HOME', $protocol . $domain );
define( 'WP_SITEURL', $protocol . $domain );
define( 'FORCE_SSL_ADMIN', false );

define( 'FS_METHOD', 'direct' );

if ( ! defined( 'ABSPATH' ) ) {
    define( 'ABSPATH', __DIR__ . '/' );
}

require_once ABSPATH . 'wp-settings.php';
