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
define( 'DB_NAME', 'lifeBridge' );

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
define( 'AUTH_KEY',         '@m} Q7c^=yI46`S1Hx|fQNV%%RWEicRc~1p)!^Kw$bQGpJx91#Q#V9cX*{xn<u3 ' );
define( 'SECURE_AUTH_KEY',  'PfKw5C0odih(}GgW<*weT=)x9mr+PHD?#w:8G#p(j>[.SfG_0KZTT.TeA#R>}@.o' );
define( 'LOGGED_IN_KEY',    'LHa6g6:Frr_u#h@:`6(]Y7 1/39s+5$W&jOE?D,:-yB;e86k#GdML!Coll&>q8{g' );
define( 'NONCE_KEY',        ':2P~>[t;3LFom,=:Q%{JMq?+^Lc4A;3o+-40B[Lz Oj@5yRcs={hpxcrEo;J 6o]' );
define( 'AUTH_SALT',        'psP<[xWm)K;S}kg0pgKcY7STqr[.I};|mJ]/D.}lgGr?e3g~qH-59?vt:=L A@.f' );
define( 'SECURE_AUTH_SALT', 'YK$TF*#?!b G{zn~@a*jX%_9j3bs+Ww|29;Tw&z_MZ*`?o|e@q6Dr)weeq)r-``P' );
define( 'LOGGED_IN_SALT',   'PDrIArS,K<WVb<i{D[ge<&32kRMpDH(s4y@uZ}Psd@!b^CPt*/%HGGPz-ZznFS>B' );
define( 'NONCE_SALT',       'waF_l aE4I+T{Y|B{+|]ANHaKg8?/mLo>.yod)3BM(N,&z!c>tN _H)lv9fv`d6%' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'lb_';

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
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
