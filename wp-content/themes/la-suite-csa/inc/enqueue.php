<?php
/**
 * Scripts and styles.
 *
 * @package La_Suite_CSA
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Preconnect to Google Fonts and image CDN.
 *
 * @param array  $urls URLs.
 * @param string $relation_type Relation.
 * @return array
 */
function la_suite_csa_font_preconnect( $urls, $relation_type ) {
	if ( 'preconnect' !== $relation_type ) {
		return $urls;
	}

	$urls[] = array(
		'href' => 'https://fonts.googleapis.com',
	);
	$urls[] = array(
		'href'        => 'https://fonts.gstatic.com',
		'crossorigin' => 'anonymous',
	);
	$urls[] = array(
		'href' => 'https://images.unsplash.com',
	);

	return $urls;
}
add_filter( 'wp_resource_hints', 'la_suite_csa_font_preconnect', 10, 2 );

/**
 * Enqueue front-end assets.
 */
function la_suite_csa_enqueue_assets() {
	wp_enqueue_style(
		'la-suite-csa-fonts',
		'https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,400;0,500;0,600;0,700;0,800;1,400&display=swap',
		array(),
		null
	);

	wp_enqueue_style(
		'la-suite-csa-main',
		LA_SUITE_CSA_URI . '/assets/css/main.css',
		array( 'la-suite-csa-fonts' ),
		LA_SUITE_CSA_VERSION
	);

	wp_enqueue_script(
		'gsap',
		'https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/gsap.min.js',
		array(),
		'3.12.5',
		true
	);

	wp_enqueue_script(
		'gsap-scrolltrigger',
		'https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/ScrollTrigger.min.js',
		array( 'gsap' ),
		'3.12.5',
		true
	);

	wp_enqueue_script(
		'la-suite-csa-main',
		LA_SUITE_CSA_URI . '/assets/js/main.js',
		array( 'gsap', 'gsap-scrolltrigger' ),
		LA_SUITE_CSA_VERSION,
		true
	);

	wp_enqueue_script(
		'la-suite-csa-outils',
		LA_SUITE_CSA_URI . '/assets/js/outils.js',
		array(),
		LA_SUITE_CSA_VERSION,
		true
	);
}
add_action( 'wp_enqueue_scripts', 'la_suite_csa_enqueue_assets' );

/**
 * Bundled favicon when the site has no WordPress site icon.
 */
function la_suite_csa_print_favicon() {
	if ( function_exists( 'has_site_icon' ) && has_site_icon() ) {
		return;
	}

	$base = LA_SUITE_CSA_URI . '/assets/images/brand/';

	printf(
		'<link rel="icon" href="%s" type="image/svg+xml">' . "\n",
		esc_url( $base . 'favicon.svg' )
	);
	printf(
		'<link rel="icon" href="%s" type="image/png" sizes="32x32">' . "\n",
		esc_url( $base . 'favicon-32.png' )
	);
	printf(
		'<link rel="apple-touch-icon" href="%s" sizes="180x180">' . "\n",
		esc_url( $base . 'apple-touch-icon.png' )
	);
}
add_action( 'wp_head', 'la_suite_csa_print_favicon', 5 );
