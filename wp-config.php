<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'coupantask' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

if ( !defined('WP_CLI') ) {
    define( 'WP_SITEURL', $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] );
    define( 'WP_HOME',    $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] );
}



/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'KoKHhNGEgNKVZCqay9HgARhdMkfIgYQDD7R8kZNiJQZISY5P72ItyDu1HQ2iiv8c' );
define( 'SECURE_AUTH_KEY',  'TwoZl51SHTw4qK57pFWIhBT9ZvA014DoIKY6SWDPj02XWDjmdZy9nxEaRrfKaXaF' );
define( 'LOGGED_IN_KEY',    'vL9LArUoYdub8YJrM4YFUc9WWgF1aRllJx8quCVGIN21aKcVvF1sJzOEYso8jRgY' );
define( 'NONCE_KEY',        'fK9SKqd6QMRMthMa3m9OMtCU1LOvwMxi6t0dRxMevLiFOSaps9Fyez8evW300joA' );
define( 'AUTH_SALT',        'ZcdK9Gw4ZlGiaylVSDB8WMguJUYuodm3eSEvAnsUdjT47y75ppAryYpsaBQT3C97' );
define( 'SECURE_AUTH_SALT', 'gWOOmM6wT6rczAM04Th4mNgbFPkqZ3YVgFGCDr87hE2gP867iRxc6Xw4qWvdrLUI' );
define( 'LOGGED_IN_SALT',   'NFmGtVtu64DGblEtAmhrSUsxTKZpH2QZWKNkTPMF8yjdTnXAGzqan34t5fD1shH3' );
define( 'NONCE_SALT',       'HUVE0yWHDU8oGKOfVJC7QtyztFZRlV6YNbSJxyXx6awihinlkDP3N4Tuxz2yFCt1' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
