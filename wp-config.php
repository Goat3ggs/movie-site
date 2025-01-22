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
define( 'DB_NAME', 'local' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', 'root' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

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
define( 'AUTH_KEY',          'JsW1Oe<:#5lSl$=x2#S@]LE4Llzf.586!Y !hb_B;vqbQ8gT-W}:chqUY)aY)9F)' );
define( 'SECURE_AUTH_KEY',   'AXL071IqvTVN1N9bxK(yQJMip~%5t@Y.vj469FqntQIodYzS92WINcEs.!Gy_79,' );
define( 'LOGGED_IN_KEY',     '&nmLCa]2}7c;aHfuVdt7ou(uS4%)%K~{36n3aUIQ!eY}Wte=%C]8~SPWa1umPhBV' );
define( 'NONCE_KEY',         ':@dADQup<1s62z_{0CRYc,[(<rviP=ZXk4)8T[&Usu8R}%743L1c+@babnm{Wp=c' );
define( 'AUTH_SALT',         '5^W=6K#sKyH?5,+{D77s!6:?7oXjRaW9t,rOT47A2}`V;hjUR yLVmenw81hR@I^' );
define( 'SECURE_AUTH_SALT',  'EZq1rST=RKGvk2ssBwCP~SRO/cC/d=e,/PcNGl<D,kZSv4wudDb35q;fVD2}rIok' );
define( 'LOGGED_IN_SALT',    'I*iy<^o)g$^@%tN?r)-iud}{1!a,{lOhJX_s!oq=XjaS3nw`&8X:qoA0(U4 l@oB' );
define( 'NONCE_SALT',        ']#U;$oPKq>rX|sK1mQw^hbD)^I{=QYXtBD0MNQ+Xl(4`V&b -U)s7<Nkka8A D7-' );
define( 'WP_CACHE_KEY_SALT', 'jIUrJgJPbTU*aiPF8D%c&N`zRwRs6XOA=~;C]j5rnc{8h~Pc;5Sba.!r#[;[E<1:' );


/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';


/* Add any custom values between this line and the "stop editing" line. */



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
if ( ! defined( 'WP_DEBUG' ) ) {
	define( 'WP_DEBUG', false );
}

define( 'WP_ENVIRONMENT_TYPE', 'local' );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
