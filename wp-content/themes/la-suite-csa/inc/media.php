<?php
/**
 * Editorial photos. Founder portraits ship with the theme.
 *
 * @package La_Suite_CSA
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Media library for the theme.
 *
 * @return array<string, array{src:string,alt:string}>
 */
function la_suite_csa_media() {
	return array(
		'hero'         => array(
			'src' => 'https://images.unsplash.com/photo-1504328345606-18bbc8c9d7d1?auto=format&fit=crop&w=2000&q=80',
			'alt' => '',
		),
		'atmosphere'   => array(
			'src' => 'https://images.unsplash.com/photo-1541888946425-d81bb19240f5?auto=format&fit=crop&w=1600&q=80',
			'alt' => 'Chantier et projet d’entreprise',
		),
		'financements' => array(
			'src' => 'https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?auto=format&fit=crop&w=1400&q=80',
			'alt' => 'Atelier de production',
		),
		'subventions'  => array(
			'src' => 'https://images.unsplash.com/photo-1521737604893-d14cc237f11d?auto=format&fit=crop&w=1400&q=80',
			'alt' => 'Équipe autour d’un dossier',
		),
		'credits'      => array(
			'src' => 'https://images.unsplash.com/photo-1554224155-6726b3ff858f?auto=format&fit=crop&w=1400&q=80',
			'alt' => 'Documents et pièces d’un dossier',
		),
		'entreprise'   => array(
			'src' => 'https://images.unsplash.com/photo-1522202176988-66273c2fd55f?auto=format&fit=crop&w=1600&q=80',
			'alt' => 'Équipe en discussion',
		),
		'cta'          => array(
			'src' => 'https://images.unsplash.com/photo-1556761175-5973dc0f32e7?auto=format&fit=crop&w=1600&q=80',
			'alt' => 'Conversation d’affaires',
		),
		'founder-1'    => array(
			'src' => LA_SUITE_CSA_URI . '/assets/images/founders/charles-brassard.jpg',
			'alt' => 'Charles Brassard',
		),
		'founder-2'    => array(
			'src' => LA_SUITE_CSA_URI . '/assets/images/founders/anika-gaudet.jpg',
			'alt' => 'Anika Gaudet',
		),
		'founder-3'    => array(
			'src' => LA_SUITE_CSA_URI . '/assets/images/founders/sandrine-quirion.jpg',
			'alt' => 'Sandrine Quirion',
		),
	);
}

/**
 * Get one media item.
 *
 * @param string $key Key.
 * @return array{src:string,alt:string}|null
 */
function la_suite_csa_media_get( $key ) {
	$all = la_suite_csa_media();
	return isset( $all[ $key ] ) ? $all[ $key ] : null;
}

/**
 * Map service index to media key.
 *
 * @param int $index Zero-based.
 * @return string
 */
function la_suite_csa_service_media_key( $index ) {
	$map = array( 'financements', 'subventions', 'credits' );
	return $map[ $index ] ?? 'atmosphere';
}
