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

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wordpress_tutorial_2019_mamp' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', 'root' );

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
define( 'AUTH_KEY',         '}AMm;E2x<5H&|J7.YYOP@>U*ZN!8JO/n*OD,J=+EzEtk~YPd<BLV[5tun^&[tl{w' );
define( 'SECURE_AUTH_KEY',  '2t9nn(VrP)=?u]`;=$@~_RNsi`|^;5_r|ysOe:;#0<A`CE4n9YPvr5K1bOZ;3%pr' );
define( 'LOGGED_IN_KEY',    ')n_6oW?by/`FJ)<Y%=R@PVPc936Uu]a>lE<H<BB2RO.SeKlo YeAIv8sIl3Ma1nP' );
define( 'NONCE_KEY',        '2U|Y4p@-G4Jwu*-WeMEeWs8~!s8w;$lp?e$]Z4M|J8zX9Q-o%3$~F%R$Go]K*~DO' );
define( 'AUTH_SALT',        'JS0Sr_UU?G1!OeG{?TKTHELZ;D1LgurpW@f!hpt Ff=?>szgkz:ADhyQHY..3/q?' );
define( 'SECURE_AUTH_SALT', 'X]q:{nN($@Rgb[:t<YDN-)v!-X_tL_<crvw)R0yt?9If.k|s50=6qfg!Ek Crf0F' );
define( 'LOGGED_IN_SALT',   '=yZ+d3^/_sQ*Bb)u>Qh,>xhp@r<^Jk(%>94ASgs/KgnB6XRZ}U;g,ES<7olAAu`M' );
define( 'NONCE_SALT',       '~a2ytrzw,j0Ahp{8u}ee-&R0q97k/dwTK)LRR2}X@.+r^%KgxR;9v)ig[HUC95=)' );

/**#@-*/

/**
 * WordPress Database Table prefix.
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
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define( 'WP_DEBUG', false );

// dont insert break-lines in contact form 7 - PRIDAVAL SOM TO JA!!!
define( 'WPCF7_AUTOP', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );
