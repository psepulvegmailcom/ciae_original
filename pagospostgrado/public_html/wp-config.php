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
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * Localized language
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'pagospostgrado_db' );

/** Database username */
define( 'DB_USER', 'pagospostgrado_user' );

/** Database password */
define( 'DB_PASSWORD', 'g:&6BMHAzR4?' );

/** Database hostname */
define( 'DB_HOST', '127.0.0.1' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

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
define( 'AUTH_KEY',          '=MW@d4h][&y>lVnWAS,^1[$fX/y,aoJbu0+Qje+VGF7A_&glUsKL0=`8S+4YEd{k' );
define( 'SECURE_AUTH_KEY',   '/-?K9N<4O3)f?)b9h5H-- !o85a93Ggp{p ;Ua^pOi:QjUsX#LDrV{jd 5bfD0OS' );
define( 'LOGGED_IN_KEY',     'Z7Cmbm_/8/DdZ!-L(LAbl.r.mR%lND(&?,)mnDniNjA3/MR8G%JMtS2dh]0jg:7i' );
define( 'NONCE_KEY',         'Hr:a7=!s8<J3E(3eF5r(C;<m*s}92A=nS5Q):|@Y~edfLh51X3qSusaE;[E]yg=5' );
define( 'AUTH_SALT',         'r>p}3)+h/mJ;ZN43%FT6[1uBZ(YjlR6=DVIF6>81en~D>SDU<:LjI3T7gk>5YYt!' );
define( 'SECURE_AUTH_SALT',  'gbh{W)+En6L2-phhj`wUA@ROGV LPveA/C{6d{Qouc)J&#6zI=k$x,O,lfTNV.$]' );
define( 'LOGGED_IN_SALT',    'v}A(FrAk+,?]kLcpGvetR{`7* |}o->7njE&0PQv:TEo$W6&Kgr#`e*72?yPkHWS' );
define( 'NONCE_SALT',        '4A9|hht`~HcH=l;6CUz%g8?0Hk-}8o*~R1Zf!CtOtQTX+mn;83/QTI5F7 .2tl#)' );
define( 'WP_CACHE_KEY_SALT', ']#<HZpt|/WG[vz|_*YwJqoQI<qbVjr$NA}4Qtgqr+eqyEaRn,fKRa,AbwWAQAz5~' );


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



define( 'FS_METHOD', 'direct' );
define( 'WP_AUTO_UPDATE_CORE', 'minor' );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
