<?php
/** Enable W3 Total Cache */
define('WP_CACHE', true); // Added by W3 Total Cache

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

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wp_learnwp' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'WK~=H:HOj@l8$~/r)93^{k*<:I}JyVnUa=8GavDJPYE.`9VahLBAAafrDsQn0$g5' );
define( 'SECURE_AUTH_KEY',  'ANfkz*$d50:APhx5_|i)O#]Fz]` XfpRS7j_Iyi1@nI}XM%dLR+2/0M79g^X2em|' );
define( 'LOGGED_IN_KEY',    'N&(b-Wz{i~+Bv=7;.*P@xa}geL3v^w_9=dRzQXh3<F5@GYwci.6O^@H1=*5n.zXF' );
define( 'NONCE_KEY',        'dJw;;@%uAN9=g0^}m4A2~cq.:t7$}s_)Ba6%X.5(@hx}Uu_o^*3uqFlS#Jje>9i$' );
define( 'AUTH_SALT',        '6CGL[?%G#|HO+a5L)~I:.2aXASf`n}PeMw_.wn>Wq@A.s(/5u.uv={{`utpS?ut/' );
define( 'SECURE_AUTH_SALT', 'Y>X,r*P;}XMCH)&)4XDn-p{a,vgSHOl+VC{O~PNTe2&%@FVv>qVS|5 RQ9Ap4zRb' );
define( 'LOGGED_IN_SALT',   ')F&YBk)Y_eye}oh&d;xecrjS[j?rpT9.:veSUQkq|Dz#rty0OwFQN!@noz3mGZwE' );
define( 'NONCE_SALT',       'Z%LpfL9&L6^~8C6F?8Fx* >zqPdnTmw2 RyKU 3Uy;f0K?AK%?WaDp}DV8e1W(_D' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wpcrs_';

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
define( 'WP_DEBUG', true );

define( 'WP_DEBUG_LOG', true );

define( 'WP_DEBUG_DISPLAY', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );

/** Add here*/
define('FS_METHOD','direct');
define("FTP_HOST", "localhost");
define("FTP_USER", 'hanuz06');
define("FTP_PASS", 'hanuz06');
/** To here*/