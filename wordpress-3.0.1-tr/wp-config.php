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
define('DB_NAME', 'localpress');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'admin');

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
define('AUTH_KEY',         '-%Wl`43g<F:[F,t D1CSlayCx78O,~LB#7m_]-+CJw=2wjS-Dnf?0*U70mV(H(iD');
define('SECURE_AUTH_KEY',  '(e{@te6%Fs3kzJh9I?),2>d&4ra>q|h%</7aZ]L/.kQe<^D$TS04Hchs,CG<.CWd');
define('LOGGED_IN_KEY',    '!`kQW4]W+$b34yd=2;3/o*B]7ViDKd[,fo@;|3:->C<o`}mYq#J(zHr3=ZZEb`PV');
define('NONCE_KEY',        'p(gY%v.-TVs#yE[<(!_o}cnwjyA1$&ZG5lFz_h<wq(U:LK0Xa|CRSVW:`E@9keQE');
define('AUTH_SALT',        '~sTm|1oRqcwHv5/@``d((ey71nmr_kg)rBtBj~GbJB@[7EPD:}it=38Dy[,aG$iO');
define('SECURE_AUTH_SALT', 'tp$gA131Fv*Z#&&GNK,kRf}i>0P})E>Y E+dJ_}Gg$p&b(HZ2=y?A *_Fw>fot?O');
define('LOGGED_IN_SALT',   'vFhuE9{n.(Pkc`60C9}z7{a(V!dUh?Y|TwPX9d$;g7gGiIKe_*jM_i}]t?4*N.qk');
define('NONCE_SALT',       '#K)<ml^{vwJamLIUE3#}v!}:B:SJTAh<Di6V</dRYj9`=QreZu08m<F8NNyd;!Pg');

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
 * Change this to localize WordPress.  A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de.mo to wp-content/languages and set WPLANG to 'de' to enable German
 * language support.
 */
define ('WPLANG', '');

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
