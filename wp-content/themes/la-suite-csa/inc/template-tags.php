<?php
/**
 * Template helpers.
 *
 * @package La_Suite_CSA
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Get an ACF field from the Site Settings page (free-ACF options stand-in).
 *
 * @param string $key Field name.
 * @return mixed
 */
function la_suite_csa_get_option( $key ) {
	if ( ! function_exists( 'get_field' ) || ! function_exists( 'la_suite_csa_get_settings_page_id' ) ) {
		return null;
	}

	$page_id = la_suite_csa_get_settings_page_id();

	if ( ! $page_id ) {
		return null;
	}

	return get_field( $key, $page_id );
}

/**
 * Safely get an ACF field for the current or given post.
 *
 * @param string   $key     Field name.
 * @param int|null $post_id Post ID or null for current.
 * @return mixed
 */
function la_suite_csa_get_field( $key, $post_id = null ) {
	if ( function_exists( 'get_field' ) ) {
		return get_field( $key, $post_id );
	}
	return null;
}

/**
 * Resolve internal path or absolute URL.
 *
 * @param string $path Path or URL.
 * @return string
 */
function la_suite_csa_url( $path ) {
	if ( empty( $path ) ) {
		return home_url( '/' );
	}

	if ( preg_match( '#^https?://#i', $path ) ) {
		return $path;
	}

	return home_url( $path );
}

/**
 * Social links derived from Site Settings URL fields.
 *
 * @return array<int, array{label:string,url:string}>
 */
function la_suite_csa_get_social_links() {
	$map = array(
		'Facebook'  => la_suite_csa_get_option( 'social_facebook' ),
		'Instagram' => la_suite_csa_get_option( 'social_instagram' ),
		'LinkedIn'  => la_suite_csa_get_option( 'social_linkedin' ),
	);

	$links = array();

	foreach ( $map as $label => $url ) {
		if ( empty( $url ) ) {
			continue;
		}
		$links[] = array(
			'label' => $label,
			'url'   => $url,
		);
	}

	return $links;
}

/**
 * Primary nav items used as a fallback when no WP menu is assigned.
 *
 * @return array<int, array{label:string,url:string}>
 */
function la_suite_csa_primary_nav_items() {
	$nav = la_suite_csa_copy_get( 'nav' );

	return array(
		array(
			'label' => $nav['accueil'] ?? 'Accueil',
			'url'   => home_url( '/' ),
		),
		array(
			'label' => $nav['services'] ?? 'Services',
			'url'   => home_url( '/services/' ),
		),
		array(
			'label' => $nav['entreprise'] ?? 'Entreprise',
			'url'   => home_url( '/entreprise/' ),
		),
		array(
			'label' => $nav['ressources'] ?? 'Ressources',
			'url'   => home_url( '/ressources/' ),
		),
		array(
			'label' => $nav['outils'] ?? 'Outils',
			'url'   => home_url( '/outils/' ),
		),
		array(
			'label' => $nav['blog'] ?? 'Blogue',
			'url'   => home_url( '/blogue/' ),
		),
	);
}

/**
 * Wrap a headline into per-word clip spans for entrance motion.
 *
 * @param string $text Headline.
 * @return string
 */
function la_suite_csa_split_headline( $text ) {
	$words = preg_split( '/\s+/u', trim( (string) $text ) );
	if ( ! is_array( $words ) || empty( $words ) ) {
		return '';
	}

	$html = '';
	foreach ( $words as $word ) {
		if ( '' === $word ) {
			continue;
		}
		$html .= '<span class="line-word"><span>' . esc_html( $word ) . '</span></span> ';
	}

	return $html;
}
