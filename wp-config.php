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
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'diplomat' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

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
define('AUTH_KEY',         'Mu;tw=ltu|@F$pc-HBHT-0RCm(@`JM19*eWxRhNoDVI7o?Rl_~G|*&%&Fl6/3uF`');
define('SECURE_AUTH_KEY',  '[J4HeVEFht7h{}jfSFdw9zk2@Qkg&<Jnplj%Dm.~>$VY;`!b@-?|Av3<QGj48U%w');
define('LOGGED_IN_KEY',    'wk@fNS<wM.]>8iKj[0Cg}.3+2u<}0+Blv&4O|YHdvNT+8y#z5(V00B F[bP${$v$');
define('NONCE_KEY',        '&V*.j|(8,7v`()e:4*SB:m&}EW:(*,sxtVxbPc+5v-bf(@)}Hz^Bu[V!HP};Av3O');
define('AUTH_SALT',        '-l5lWNGgW)Zl8mJ)n[j!%wLO#]<XAI-G^(Z}wZ34Y+?4[e(itoOoO_6#p;by/9:^');
define('SECURE_AUTH_SALT', '_Y-n-tV)7)<Mu%jH:5s|N*BR6OJG|c)W/8avw,~Yy]}FSn|{K<!Si#,U|rT5/oVl');
define('LOGGED_IN_SALT',   'NPVWAK~;}d&``IRnq_:+D~r$wLOD_:[)|0o<J5GY>c6=I*_Eg=<3y&ze>u99ZiMX');
define('NONCE_SALT',       'kh?BxQ, Ko,ZrUD]7kD&i8JLhhB]/-N@I{gS*[T}uv,wi-QbEZ@-T?DSTy@1Mu~}');

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'dip_';

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
// define( 'WP_DEBUG_LOG', true );
// define( 'WP_DEBUG_DISPLAY', true );
// define( 'SCRIPT_DEBUG', true );
// define( 'SAVEQUERIES', true );
// define( 'WP_DISABLE_FATAL_ERROR_HANDLER', true );   // 5.2 and later
// @ini_set( 'log_errors', 'Off' );
// @ini_set( 'display_errors', 'On' );
// @ini_set( 'error_log', '/home/example.com/logs/php_error.log' );

/* Add any custom values between this line and the "stop editing" line. */
/* SSL */
// define( 'FORCE_SSL_LOGIN', true );
// define( 'FORCE_SSL_ADMIN', true );

/* Disable Post Revisions. */
define( 'WP_POST_REVISIONS', false );
define('AUTOSAVE_INTERVAL', 86400 );
// define( 'WP_POST_REVISIONS', 3 );
/* Media Trash. */
define( 'MEDIA_TRASH', true );
/* Trash Days. */
define( 'EMPTY_TRASH_DAYS', '7' );


/* WordPress Cache */
// define( 'WP_CACHE', true );

/* Compression */
// define( 'COMPRESS_CSS',        true );
// define( 'COMPRESS_SCRIPTS',    true );
// define( 'CONCATENATE_SCRIPTS', true );
// define( 'ENFORCE_GZIP',        true );
// define( 'DO_NOT_UPGRADE_GLOBAL_TABLES', true );

/* Updates */
define( 'WP_AUTO_UPDATE_CORE', false );
define( 'DISALLOW_FILE_MODS', true );
define( 'DISALLOW_FILE_EDIT', true );
define( 'AUTOMATIC_UPDATER_DISABLED', true );

/* Custom WordPress URL. */
// register_theme_directory( dirname( __FILE__ ) . '/wp-content/mu-plugins/vendor/typerocket/resources/themes/' );
// define('WP_DEFAULT_THEME', 'templates');
/* That's all, stop editing! Happy publishing. */


/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';