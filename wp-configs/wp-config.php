<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

require __DIR__ . '/vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable( __DIR__ );
$dotenv->load();

/** Set default theme to SparkPress  */
define('WP_DEFAULT_THEME', 'sparkpress-theme');

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', $_SERVER['MYSQL_DATABASE'] );

/** MySQL database username */
define( 'DB_USER', $_SERVER['MYSQL_USER'] );

/** MySQL database password */
define( 'DB_PASSWORD', $_SERVER['MYSQL_PASSWORD'] );

/** MySQL hostname */
define( 'DB_HOST', $_SERVER['MYSQL_HOST'] );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/** In localhost, allow for plugin installs */
define( 'FS_METHOD', 'direct' );

/** Current environment */
define( 'WP_ENV', $_SERVER['WP_ENV'] );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY', '5148e1e269b13026f46edf54743fbd6cf03d7d8c' );
define( 'SECURE_AUTH_KEY', '3bde6c061ae466d85c5415a9f421171d91bc5158' );
define( 'LOGGED_IN_KEY', '8bc9b7a5b3df68eebb5f531af6fb1c643cc68ee9' );
define( 'NONCE_KEY', '3d462461ad13688498388d98fcc068c4d037eef3' );
define( 'AUTH_SALT', 'e61e2ecaee8d871a2dcd127205040921985df6b0' );
define( 'SECURE_AUTH_SALT', '63c307a9dc66132d4c85b9a6ad7835d693e8b071' );
define( 'LOGGED_IN_SALT', '04480cd5f538ee7b656771dad183c71e31042967' );
define( 'NONCE_SALT', '1f24faa17298f9ab276998fd4dd567c4b7b11475' );

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_'; // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define( 'WP_DEBUG', ( ! empty( WP_ENV ) && strpos( WP_ENV, 'local' ) ) );


// If we're behind a proxy server and using HTTPS, we need to alert WordPress of that fact
// see also http://codex.wordpress.org/Administration_Over_SSL#Using_a_Reverse_Proxy.
if ( isset( $_SERVER['HTTP_X_FORWARDED_PROTO'] ) && 'https' === $_SERVER['HTTP_X_FORWARDED_PROTO'] ) {
	$_SERVER['HTTPS'] = 'on';
}

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' ); // phpcs:ignore
