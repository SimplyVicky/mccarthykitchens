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
define( 'DB_NAME', 'junglcu2_mccarthy' );

/** MySQL database username */
define( 'DB_USER', 'junglcu2_mccarthy' );

/** MySQL database password */
define( 'DB_PASSWORD', 'mccarthypwd' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

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
define( 'AUTH_KEY',         'eegirnnkrrtymmt7jbulm10ass9fifv1pkvjfsgx3nxfml5fbsi2zrasmt6hdw05' );
define( 'SECURE_AUTH_KEY',  '8viwukixsnfrllx588nxdztpmstpinuejbb65wd6kl6s9ylknjmkq1hn9hzwjjlf' );
define( 'LOGGED_IN_KEY',    '0lglnn56uxzov9902vbxxlyfmgun3joxmqaflzgzcxex6yiltc9lxt4s3bvoduo1' );
define( 'NONCE_KEY',        'o6rv7gern3zvkbkdnndtzuahczpgkqayd4ckt9ygzzczh4jymrwdxd6qqcqtksir' );
define( 'AUTH_SALT',        'rpzibkqwdub3gkpkgz8puuljkudtgneuoyqdudjrwy8gs1iz27jjvywl4c22phdq' );
define( 'SECURE_AUTH_SALT', 't0yeadtw54zqdojmnqcoo4g00d0tsgwlw6pb38qt8eecrqqdqmokpczcukbdl5jx' );
define( 'LOGGED_IN_SALT',   'bhdyclocrxamsxgexyzr65h6abgwendgsg5exkwjgmfz17cjqjcom2dagbqisfsh' );
define( 'NONCE_SALT',       'vg5gn66qkx3qxzvjsfnwn2efqoljk1315pviehr4jj9qbhehnq3tppfajr22pieu' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wpoa_';

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
