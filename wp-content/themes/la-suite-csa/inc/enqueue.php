<?php
/**
 * Scripts and styles.
 *
 * GSAP, ScrollTrigger, Lenis and SplitType are bundled in the theme.
 *
 * @package La_Suite_CSA
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Mark motion support before paint so content stays visible without JS.
 */
function la_suite_csa_print_motion_flag() {
	echo "<script>document.documentElement.classList.add('js');if(window.matchMedia('(prefers-reduced-motion: reduce)').matches||/[?&]static(?:=|&|$)/.test(location.search)){document.documentElement.classList.add('no-motion');}else{document.documentElement.classList.add('motion');window.__csaStall=setTimeout(function(){document.documentElement.classList.add('js-stalled');},7000);}</script>\n";
}
add_action( 'wp_head', 'la_suite_csa_print_motion_flag', 1 );

/**
 * Enqueue front-end assets.
 */
function la_suite_csa_enqueue_assets() {
	wp_enqueue_style(
		'la-suite-csa-lenis',
		LA_SUITE_CSA_URI . '/assets/vendor/lenis.css',
		array(),
		'1.1.20'
	);

	wp_enqueue_style(
		'la-suite-csa-main',
		LA_SUITE_CSA_URI . '/assets/css/main.css',
		array( 'la-suite-csa-lenis' ),
		LA_SUITE_CSA_VERSION
	);

	wp_enqueue_script(
		'gsap',
		LA_SUITE_CSA_URI . '/assets/vendor/gsap.min.js',
		array(),
		'3.12.5',
		true
	);

	wp_enqueue_script(
		'gsap-scrolltrigger',
		LA_SUITE_CSA_URI . '/assets/vendor/ScrollTrigger.min.js',
		array( 'gsap' ),
		'3.12.5',
		true
	);

	wp_enqueue_script(
		'lenis',
		LA_SUITE_CSA_URI . '/assets/vendor/lenis.min.js',
		array(),
		'1.1.20',
		true
	);

	wp_enqueue_script(
		'split-type',
		LA_SUITE_CSA_URI . '/assets/vendor/split-type.min.js',
		array(),
		'0.3.4',
		true
	);

	wp_enqueue_script(
		'la-suite-csa-main',
		LA_SUITE_CSA_URI . '/assets/js/main.js',
		array( 'gsap', 'gsap-scrolltrigger', 'lenis', 'split-type' ),
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
