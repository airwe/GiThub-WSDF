<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('WP_CACHE', true); //Added by WP-Cache Manager
define( 'WPCACHEHOME', '/home/wwwcaste/public_html/wsdf/wp-content/plugins/wp-super-cache/' ); //Added by WP-Cache Manager

define('DB_NAME', 'wsdfgo_wsdfdbase');

/** MySQL database username */
define('DB_USER', 'wsdfgo_wsdfuser2');

/** MySQL database password */
define('DB_PASSWORD', 'E,F-5KcMq{c3');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'Uq0Jr-Uk/C3CdLvSroe?q*i*>J2GU3hu)(xDn9k4MNn)NCh3y>fY*-ZT!3aGl~AK8^yMU-$TETHK)63b~');
define('SECURE_AUTH_KEY',  '');
define('LOGGED_IN_KEY',    'zsdzjuCm#SRru|KLM1)F^?Dj:tY!6H0E?b#4ZV=sT)qzlUZ\`duU$JeImcLKJO#:3gy6@<YT9');
define('NONCE_KEY',        'E65PZN=uBRQ<mfsL-l@|2E:t7VgoGUYfaWH7_tzmIV4SNkHZZ_Veg5=K|JeJh|f4mFM*lvO>Bs:rJ)<s5zR1');
define('AUTH_SALT',        'AjxCjt|hc=kOR_N:uwL$Z|nA?8lvL4i:CexrsXhV|QtXH5vhYhXr483y(t#B;WIKq9gvk');
define('SECURE_AUTH_SALT', 'kO$hgIo4~R/ApX>lSfBT6sAxhnHbvkqe~Y-8iAdU3\`T6eI#siS6KVLoBabH5O=IRZ3Y;3tnP0tK@o=');
define('LOGGED_IN_SALT',   'n4W^\`thQ6>(63YoTH@8\`Gm)B)DE39kf:^>Z-vJz97\`-p6sNTgDXjz$X=a3TBmgS>=1PcAR9YVZ');
define('NONCE_SALT',       'X2P63m(v)b4y?Q(150/H=vp3(cm:k0tgA)Io8!ngP=fFJWPM2)#4p!p(^hU>I(mH/)T4/j_');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
