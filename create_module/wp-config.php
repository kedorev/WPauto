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

// ** MySQL settings ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'create_module' );

/** MySQL database username */
define( 'DB_USER', 'admin' );

/** MySQL database password */
define( 'DB_PASSWORD', '00000' );

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
define('AUTH_KEY',         '[is1F0[_f|F,!jrCK)<PSh}iA-/`d3>J^JI>n-nz=Asd8@d;{T2C-~=a +eJy|e8');
define('SECURE_AUTH_KEY',  '>~JRQ]/-8!x]L&4%HF{3;T#)DV~^=:vA{0VeITC1a+VOIDORqwZu~s2H+!2W[0Hj');
define('LOGGED_IN_KEY',    'j=]_V#+<$MRbd^pX:->z@%I/qY=dVl=I&w~s:/b9Emlot}!C<0bqJ91._e[)KtNV');
define('NONCE_KEY',        ';vRrw|RJ-Tlc1gN!*/CV1VOQ5G8CnHPxc!YCT;Tl!USx3RdJ=5=qZn+c_scVh|{u');
define('AUTH_SALT',        'jB4W^evu-?FB]~|x}[<(zPiF&Kx%|!t!8F]xl+1LW>P*M]]Fe^iZz_Y@*hXAL3S2');
define('SECURE_AUTH_SALT', '~^v/b-HYmZ3_N=l:!5owa~,e8Mr0_OW~Tt4mu%NA]hNsDp*ve2U5L k2!`vgd]$y');
define('LOGGED_IN_SALT',   'Ow;:(oGR)J|?2*kA0(3G+UK$KpVT7PB4aD-It?;.-D5-cn<7.dD&0:Di<:3<U_=n');
define('NONCE_SALT',       'Lh-`jZL<@nP:/_+*ylhr=mzy[(u.+8|(gH{ZjXN;SIL;_dsRkAlzs<)S(t:qsr}L');


/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'WP_';




/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) )
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
