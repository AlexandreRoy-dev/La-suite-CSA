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
			'src'    => la_suite_csa_editorial_uri( 'hero-city.jpg' ),
			'alt'    => 'Rue du centre-ville et tours de bureaux',
			'width'  => 2200,
			'height' => 1467,
		),
		'facade'       => array(
			'src'    => la_suite_csa_editorial_uri( 'interlude-arch.jpg' ),
			'alt'    => 'Façade contemporaine claire',
			'width'  => 2200,
			'height' => 1467,
		),
		'about'        => array(
			'src'    => la_suite_csa_editorial_uri( 'about-consult.jpg' ),
			'alt'    => 'Deux professionnelles en consultation devant un portable',
			'width'  => 1800,
			'height' => 1200,
		),
		'atmosphere'   => array(
			'src'    => la_suite_csa_editorial_uri( 'workplace-retail.jpg' ),
			'alt'    => 'Commerce lumineux, lieu de travail d’une PME',
			'width'  => 1800,
			'height' => 1201,
		),
		'financements' => array(
			'src'    => la_suite_csa_editorial_uri( 'pillar-finance.jpg' ),
			'alt'    => 'Poignée de main entre deux personnes en complet',
			'width'  => 1800,
			'height' => 1202,
		),
		'subventions'  => array(
			'src'    => la_suite_csa_editorial_uri( 'pillar-grant.jpg' ),
			'alt'    => 'Présentation d’un plan en salle de réunion',
			'width'  => 1800,
			'height' => 1200,
		),
		'credits'      => array(
			'src'    => la_suite_csa_editorial_uri( 'pillar-tax.jpg' ),
			'alt'    => 'Calculatrice, stylo et documents sur un bureau',
			'width'  => 1800,
			'height' => 1200,
		),
		'entreprise'   => array(
			'src'    => la_suite_csa_editorial_uri( 'entreprise-pair.jpg' ),
			'alt'    => 'Deux professionnelles en discussion au bureau',
			'width'  => 1800,
			'height' => 2700,
		),
		'value'        => array(
			'src'    => la_suite_csa_editorial_uri( 'value-team.jpg' ),
			'alt'    => 'Équipe autour d’une table de travail',
			'width'  => 1800,
			'height' => 1200,
		),
		'cta'          => array(
			'src'    => la_suite_csa_editorial_uri( 'cta-office.jpg' ),
			'alt'    => 'Bureau vitré contemporain',
			'width'  => 1800,
			'height' => 1202,
		),
		'step_talk'    => array(
			'src'    => la_suite_csa_editorial_uri( 'step-talk.jpg' ),
			'alt'    => 'Rencontre de consultation autour d’un portable',
			'width'  => 1800,
			'height' => 1200,
		),
		'step_map'     => array(
			'src'    => la_suite_csa_editorial_uri( 'step-map.jpg' ),
			'alt'    => 'Portable, graphiques et carnet sur un bureau',
			'width'  => 1800,
			'height' => 1282,
		),
		'step_file'    => array(
			'src'    => la_suite_csa_editorial_uri( 'step-file.jpg' ),
			'alt'    => 'Personne qui annote des documents',
			'width'  => 1800,
			'height' => 1201,
		),
		'step_exchange' => array(
			'src'    => la_suite_csa_editorial_uri( 'step-exchange.jpg' ),
			'alt'    => 'Réunion dans une salle de conseil',
			'width'  => 1800,
			'height' => 1200,
		),
		'step_follow'  => array(
			'src'    => la_suite_csa_editorial_uri( 'step-follow.jpg' ),
			'alt'    => 'Professionnelle au travail dans un bureau lumineux',
			'width'  => 1800,
			'height' => 1202,
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
