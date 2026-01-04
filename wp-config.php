<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
// define( 'DB_NAME', 'abc' );
define( 'DB_NAME', 'notoutcricket' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

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
define('AUTH_KEY',         '~d)_/W+YlCL-q|PF`fuQSbjdJ#/AdpgOv$j%}P|J$4$c#%qO2v R(us0?(d4JIz<');
define('SECURE_AUTH_KEY',  '+E6p,[xGWY&Xqk[u|yMT$qHwJ;j;{kzM8B}I:X=xjn?e0GLN5(Ta<6v<vBd6J&#I');
define('LOGGED_IN_KEY',    'Ha6kWR!Vb![O_IF>d3u&+i>CO7f5K!FZh~8m%mQ|X(_bog(3_3`?U*skF(LZ+*~f');
define('NONCE_KEY',        'VXv]48>C}9V>|*|ei.JhTEI[,c80|z)uV2@?Rxtl+hw9_UZ+<(>HufY[sUd4~R)8');
define('AUTH_SALT',        'Y[sA.neY93`ZQq_RSjQ{P`[-)$>i+=|OdPlm@As[M9AlzDe %$3`p&}&y#I0JmBg');
define('SECURE_AUTH_SALT', ')T rY%!8a|8MUDi|[YVm|)fQzumf|w=;tz%S|9pT7_o!39%2WWQ*BZh-,mYpo)RU');
define('LOGGED_IN_SALT',   '<]9B9p<spu~Ss0Zj+%{0C)p9{mIxuhB^!yKBkj7Pt`.OT}]ti+n`g|+^tZU^$Sg?');
define('NONCE_SALT',       '{geZv alb *zV+TDc-.[&AG[)z(+Ot==@M.f%z:nQj+fTB4XT};Sf~}3/E-UNafi');

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 *
 * At the installation time, database tables are created with the specified prefix.
 * Changing this value after WordPress is installed will make your site think
 * it has not been installed.
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/#table-prefix
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
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
 */
define( 'WP_DEBUG', true );
define( 'WP_DEBUG_LOG', true );
define( 'WP_DEBUG_DISPLAY', false );

/* Add any custom values between this line and the "stop editing" line. */

// Fix for login redirect loop on localhost
define('WP_HOME', 'http://localhost/cricket');
define('WP_SITEURL', 'http://localhost/cricket');

// Force correct cookie settings for localhost
define('COOKIE_DOMAIN', '');
define('COOKIEPATH', '/cricket/');
define('SITECOOKIEPATH', '/cricket/');
define('ADMIN_COOKIE_PATH', '/cricket/');
define('PLUGINS_COOKIE_PATH', '/cricket/wp-content/plugins');

// Disable script concatenation (can cause login issues)
define('CONCATENATE_SCRIPTS', false);

// Force fresh login
define('WP_CACHE', false);



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
