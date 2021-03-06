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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', "wordpress" );

/** MySQL database username */
define( 'DB_USER', "root" );

/** MySQL database password */
define( 'DB_PASSWORD', "" );

/** MySQL hostname */
define( 'DB_HOST', "localhost" );

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
define( 'AUTH_KEY',         'w7g,gGgx@)c4UD.RHq}4QBw4]W.i>VrRwQD0I[Q`j,5zMx)SwFza>0=s)v~2EP}_' );
define( 'SECURE_AUTH_KEY',  'IZ<7VxHa)+N+QJErOLqv#HAzWbGAI&F%!R Y>8)X+rQ9EO>rW@Yg0D I2o1:N8m(' );
define( 'LOGGED_IN_KEY',    ';u^&mL=n!ku%^N7q/ [OU[I&+)AIr&f~.w|/:J8FXp9*%iG(l&A)Qep~&Z`2WUNa' );
define( 'NONCE_KEY',        '1XnN>3)l@=s0e;H@y<D0pw|d9p3-;hHF3_|y=}e#Tx*P>f-d7()KY)xjM?4}SL V' );
define( 'AUTH_SALT',        '~$)TM6}4T+LdgtE*hnn>)T%+>mrTjiswR6`8w43Ei,vXtCc.UDI?uMlUb(.yEv?i' );
define( 'SECURE_AUTH_SALT', 'Sng+>Y-^IcU8~$gf3&bS>o*{&uN.Z>nCpf%|` fEUghv@a@;x7ttvZbdS!N>(-`0' );
define( 'LOGGED_IN_SALT',   'Y*18Vi(*zsSw6aq<:n1&/G0r^cb&^E@AxkEAcM^3vxLehg(Tkm8sL/jo?,00$w7b' );
define( 'NONCE_SALT',       'q@>w>|Xg/@]da3$M5z-b*`9x5I{4`qX4yC?IV(`jhQ0@MpALAuI$ KVPw5#ZS:kt' );

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
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname(__FILE__) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
