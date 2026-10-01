<?php
/**
 * Editorial photos. Founder portraits ship with the theme.
 * Architecture and business photos are local copies, graded in CSS.
 *
 * @package La_Suite_CSA
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Theme-relative editorial image URL.
 *
 * @param string $file File name.
 * @return string
 */
function la_suite_csa_editorial_uri( $file ) {
	return LA_SUITE_CSA_URI . '/assets/images/editorial/' . ltrim( (string) $file, '/' );
}

/**
 * Media library for the theme.
 *
 * @return array<string, array{src:string,alt:string,width:int,height:int}>
 */
function la_suite_csa_media() {
	return array(
		'hero'         => array(
			'src'    => la_suite_csa_editorial_uri( 'hero-towers.jpg' ),
			'alt'    => 'Tours de bureaux vues en contre-plongée',
			'width'  => 2400,
			'height' => 1600,
		),
		'facade'       => array(
			'src'    => la_suite_csa_editorial_uri( 'interlude-facade.jpg' ),
			'alt'    => 'Façade contemporaine en contre-plongée',
			'width'  => 2400,
			'height' => 1600,
		),
		'atmosphere'   => array(
			'src'    => la_suite_csa_editorial_uri( 'chantier.jpg' ),
			'alt'    => 'Chantier et projet d’entreprise',
			'width'  => 2000,
			'height' => 1333,
		),
		'financements' => array(
			'src'    => la_suite_csa_editorial_uri( 'service-finance.jpg' ),
			'alt'    => 'Atelier de production',
			'width'  => 1600,
			'height' => 1067,
		),
		'subventions'  => array(
			'src'    => la_suite_csa_editorial_uri( 'service-team.jpg' ),
			'alt'    => 'Équipe autour d’un dossier',
			'width'  => 1600,
			'height' => 1050,
		),
		'credits'      => array(
			'src'    => la_suite_csa_editorial_uri( 'service-docs.jpg' ),
			'alt'    => 'Documents et pièces d’un dossier',
			'width'  => 1600,
			'height' => 918,
		),
		'entreprise'   => array(
			'src'    => la_suite_csa_editorial_uri( 'discussion.jpg' ),
			'alt'    => 'Équipe en discussion',
			'width'  => 1600,
			'height' => 1067,
		),
		'cta'          => array(
			'src'    => la_suite_csa_editorial_uri( 'meeting.jpg' ),
			'alt'    => 'Conversation d’affaires',
			'width'  => 1800,
			'height' => 1012,
		),
		'atelier'      => array(
			'src'    => la_suite_csa_editorial_uri( 'atelier.jpg' ),
			'alt'    => 'Atelier industriel',
			'width'  => 1600,
			'height' => 1067,
		),
		'founder-1'    => array(
			'src'    => LA_SUITE_CSA_URI . '/assets/images/founders/charles-brassard.jpg',
			'alt'    => 'Charles Brassard',
			'width'  => 1067,
			'height' => 1600,
		),
		'founder-2'    => array(
			'src'    => LA_SUITE_CSA_URI . '/assets/images/founders/anika-gaudet.jpg',
			'alt'    => 'Anika Gaudet',
			'width'  => 1067,
			'height' => 1600,
		),
		'founder-3'    => array(
			'src'    => LA_SUITE_CSA_URI . '/assets/images/founders/sandrine-quirion.jpg',
			'alt'    => 'Sandrine Quirion',
			'width'  => 1067,
			'height' => 1600,
		),
	);
}

/**
 * Get one media item.
 *
 * @param string $key Key.
 * @return array{src:string,alt:string,width:int,height:int}|null
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
