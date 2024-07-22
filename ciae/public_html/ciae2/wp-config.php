<?php
define('WP_AUTO_UPDATE_CORE', 'minor');// This setting is required to make sure that WordPress updates can be properly managed in WordPress Toolkit. Remove this line if this WordPress website is not managed by WordPress Toolkit anymore.
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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'ciae_ciae2' );

/** MySQL database username */
define( 'DB_USER', 'ciae_ciae2' );

/** MySQL database password */
define( 'DB_PASSWORD', 'xU=N?j5(@&U3' );

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
define('AUTH_KEY',         'j>5M>9`0z`GnJ[5UJEu^_X_KY;g ij$x+R?Kg8jY|29`#:6fc~78x,3N<Ku14k&g');
define('SECURE_AUTH_KEY',  'dmp^P*L`2RwV2K>nT)G4;K%tMm-]1p@Tl|+h1n*ynQa$XQNVi,%L~+f%?@>}kh g');
define('LOGGED_IN_KEY',    '%ttM$+=|XDhTP^UD4X%7Z5+hY -b--M,uq>+)q|+695w9HSb5~=;+Dr{A|r<Zx.f');
define('NONCE_KEY',        ':9^zIUVMP+uL+@NE?d|NyCxZ13r+TD6||Y[4?85CgMp +g?3Fb,1;5xw_[7%C>uy');
define('AUTH_SALT',        '@$5&8:FdwhoI*nQR)ccm9+2x~~:-QRs)LEkCVQkx>jdAr![tW4z-jLN~N~1X*@@D');
define('SECURE_AUTH_SALT', 'S[*ibhTyy;Qn<H/:jrj =I*4]}?,SmYY1|[oO?#&HOxB_otaEtNZ,*NR^,H?|?~F');
define('LOGGED_IN_SALT',   'z,8}sQ{um)5;LeaWzyZ{1YPrurXk$qB ?B4,8f[w{L utPk:>}rExSzSh;LiWjW|');
define('NONCE_SALT',       'O3u%O:#j0XU.AB.)Fuwd|hhFTk=7`U{rrZr;(n`aR.7o~dG|uF8{y4<FrFoHVo<y');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wpo0_';

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
define('WP_DEBUG', true);
define('WPLANG', 'es_ES');
/* Frontend */
define( 'WP_MEMORY_LIMIT', '96M' );
/* Backend */
define( 'WP_MAX_MEMORY_LIMIT', '128M' );
define( 'AUTOMATIC_UPDATER_DISABLED', true );
/* Aumentar memoria para carga de archivos */
ini_set( 'upload_max_size' , '1000M' );
ini_set( 'post_max_size', '1300M');
ini_set( 'memory_limit', '1500M' );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
