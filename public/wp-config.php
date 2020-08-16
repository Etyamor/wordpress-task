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
define( 'DB_NAME', 'local' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', 'root' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '/0rgKpVqMJQFN6X7sGirHnS1J5PRtgt4Yyhw/RH4Ch7mSFYqRSI+9mrn5MUfQH46faN1cVWQJ26yKDb68m643g==');
define('SECURE_AUTH_KEY',  'RrY+l8FPim9tStM2xfimR4LoAA/8dF7axh1Da9gbPXOx2VH/Ft8r6fs32M+TqZq29u8hgmxsh/KMmdccbLfH4A==');
define('LOGGED_IN_KEY',    '1pYvRfgpqWBz0m1+FF91TTEWUS425zTD/lis3+6PqiaMsZ2qXBYEPyTWrAYO4mUc114cjE8RufzAXD6bwcLt6Q==');
define('NONCE_KEY',        'BbDFeyBYWGMAgJoN5f5YKrNWqSfOw1ZLBcj84vINjpIuzTpUenrKBJy3xxtvzap5P9T+J/JXwncDKxc0vD/KIQ==');
define('AUTH_SALT',        'sijZ7aFGNQZ+XzB9grs0+OjNngcTNg9VjwIQVjLDJv0rF1iGMooSLurb5AzYatrygJqZq2uIvVuhvIS9lGpHtw==');
define('SECURE_AUTH_SALT', '9oIOlgAA5N4BUj6p3mJcCT7oKPywmmkUFBDhcXZXbi1YD0Mfdntb0RXgvVM96+z3oPBfPLoZOuuUQ+SkhRR5Nw==');
define('LOGGED_IN_SALT',   'KH8qO/464f93PkvsyKBCExrTSx5kEhmti/NH9roCI5TfFQ18fahVGDexOneWjzLeCf1ZZLSSqUjmCT0xFtasRA==');
define('NONCE_SALT',       'Ypg0mV4iHDowI09sBxXXA35yuXgTTyixyvpoiAUNZ/5A7bZrv6IQDcxq9uYgbz/ycPO//yT+acP6q+k4O8wLzQ==');

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';




/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
