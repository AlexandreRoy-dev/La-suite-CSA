<?php
/**
 * Theme supports and menus.
 *
 * @package La_Suite_CSA
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register theme supports and navigation menus.
 */
function la_suite_csa_setup() {
	load_theme_textdomain( 'la-suite-csa', LA_SUITE_CSA_DIR . '/languages' );

	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 177,
			'width'       => 301,
			'flex-height' => true,
			'flex-width'  => true,
		)
	);

	register_nav_menus(
		array(
			'primary' => __( 'Primary Menu', 'la-suite-csa' ),
			'footer'  => __( 'Footer Menu', 'la-suite-csa' ),
		)
	);
}
add_action( 'after_setup_theme', 'la_suite_csa_setup' );
