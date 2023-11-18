<?php

define( 'WP_DEBUG',false);
define('JWT_AUTH_SECRET_KEY', 'RADAR123..');
define('JWT_AUTH_CORS_ENABLE', true);





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
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'isilgo_qa_ecommerce_db' );

/** Database username */
define( 'DB_USER', 'ecommerce_usr' );

/** Database password */
define( 'DB_PASSWORD', 'hSg%34fdFsre$F' );

/** Database hostname */
define( 'DB_HOST', '10.0.6.40' );

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
define( 'AUTH_KEY',         'Q#KE}tf,Fe5{j,!ElA)?:lU0ei-fCK9%vUk@=aT2#s/)tL1JufarS%z-eq%6_|1)' );
define( 'SECURE_AUTH_KEY',  'n5?okA4IOBJ1?kV,u`#[TN_r[K[Ef@$SS<%.rZ}~L)5cWa6}Q>Bc-btRbqB)B3/U' );
define( 'LOGGED_IN_KEY',    '/s&Nk!-PS>J)`_o[P<xpL-9P>x[%w_x:X}=0 u!{LEc.rOw&DE;=Jh-@9OdWrRM6' );
define( 'NONCE_KEY',        '|H3_jyD+n`x/~+EvH*K]m!0`E)~022uZZau#}#Qi0nQWOaZ7Z]Rx`]MhCb#<sa7A' );
define( 'AUTH_SALT',        '7j>/@ %u2fJ{{l-ADa%}qZ4M9!!+C={wF]XZ*B)0*wzuG_mEzM!=44@ijH^Nm+La' );
define( 'SECURE_AUTH_SALT', 'F>+>@G-yE/fK*7!dcUa4bE2F*nXJ<HpW>3`1Am; 9<t5=QR(m51wN8b7Hruk7#HL' );
define( 'LOGGED_IN_SALT',   'eknD;[8N(vpd%_UK)klZ/<aHZ>G1}3rcwSY?RP8bRAMetiaQjAfxC:n.r(k^{iq^' );
define( 'NONCE_SALT',       ':56#;A~dO0*O5@H<E^M=bC<2TV%kw8mE^C2!HU*gCZ]+XC*Tx&}*-51;v ~vXE%H' );

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
 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/
 */


/* Add any custom values between this line and the "stop editing" line. */



define( 'MO_SAML_LOGGING', false );
define( 'WP_CACHE', true ); // Added by Hummingbird
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
