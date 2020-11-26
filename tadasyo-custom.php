<?php
/**
 * Plugin name: tadasho-custom
 * Description: The extension plugin for tadasho.
 * Version: 0.1.0
 *
 * @package tadasho-custom
 * @author ko31
 * @license GPL-2.0+
 */

defined( 'ABSPATH' ) || die();

define( 'TDS_DIRPATH', plugin_dir_path( __FILE__ ) );

/**
 * yStandard theme only.
 */
$theme = wp_get_theme();
if ( 'ystandard' !== $theme->template ) {
	return;
}

/**
 * Include custom libraries.
 */
foreach ( [ 'inc' ] as $dir_name ) {
	$dir = __DIR__ . '/' . $dir_name;
	if ( is_dir( $dir ) ) {
		foreach ( scandir( $dir ) as $file ) {
			if ( preg_match( '#^[^._].*\.php$#u', $file ) ) {
				require $dir . '/' . $file;
			}
		}
	}
}

/**
 * Get plugin version.
 *
 * @return mixed
 */
function tds_version() {
	$data = get_file_data( __FILE__, [ 'version' => 'Version' ] );

	return $data['version'];
}
