<?php
/**
 * One-time content updates for theme 5.1.0.
 *
 * Runs on an existing site where pages, menus and resource links
 * were already stored by WordPress. Fresh installs pick up the new
 * defaults from the theme files. Values already edited in the admin
 * are left as they are, except the exact previous defaults listed here.
 *
 * @package La_Suite_CSA
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Apply the 5.1.0 content migration once.
 */
function la_suite_csa_upgrade_510() {
	if ( get_option( 'la_suite_csa_upgraded_510' ) ) {
		return;
	}
	if ( ! function_exists( 'get_page_by_path' ) ) {
		return;
	}

	la_suite_csa_upgrade_510_copy();
	la_suite_csa_upgrade_510_team_page();
	la_suite_csa_upgrade_510_resources();

	if ( ! la_suite_csa_outils_enabled() ) {
		$outils = get_page_by_path( 'outils' );
		if ( $outils instanceof WP_Post && 'publish' === $outils->post_status ) {
			wp_update_post(
				array(
					'ID'          => $outils->ID,
					'post_status' => 'draft',
				)
			);
		}
	}

	update_option( 'la_suite_csa_upgraded_510', 1, false );
}
add_action( 'init', 'la_suite_csa_upgrade_510', 50 );

/**
 * Replace stored defaults that 5.1.0 changes. Custom text is kept.
 */
function la_suite_csa_upgrade_510_copy() {
	$front_id = (int) get_option( 'page_on_front' );
	if ( $front_id ) {
		$label = la_suite_csa_upgrade_510_meta( $front_id, 'hero_cta_label' );
		if ( 'Réserver un appel' === $label ) {
			la_suite_csa_upgrade_510_set_meta( $front_id, 'hero_cta_label', 'Planifier un appel' );
		}
	}

	$settings_id = function_exists( 'la_suite_csa_get_settings_page_id' ) ? la_suite_csa_get_settings_page_id() : 0;
	if ( ! $settings_id ) {
		return;
	}

	$old_blurbs = array(
		'La Suite CSA Inc. accompagne les entreprises du Québec en financements, subventions et crédits d’impôt.',
		"La Suite CSA Inc. accompagne les entreprises du Québec en financements, subventions et crédits d'impôt.",
	);
	$blurb = la_suite_csa_upgrade_510_meta( $settings_id, 'footer_blurb' );
	if ( in_array( $blurb, $old_blurbs, true ) ) {
		la_suite_csa_upgrade_510_set_meta( $settings_id, 'footer_blurb', la_suite_csa_copy_get( 'footer.blurb' ) );
	}

	$email = la_suite_csa_upgrade_510_meta( $settings_id, 'email' );
	if ( ! is_string( $email ) || ! is_email( $email ) ) {
		$fallback = la_suite_csa_copy_get( 'footer.email', '' );
		if ( is_string( $fallback ) && is_email( $fallback ) ) {
			la_suite_csa_upgrade_510_set_meta( $settings_id, 'email', $fallback );
		}
	}
}

/**
 * Rename the Entreprise page and its menu label when they still use the old title.
 */
function la_suite_csa_upgrade_510_team_page() {
	$team = get_page_by_path( 'entreprise' );
	if ( $team instanceof WP_Post && 'Entreprise' === $team->post_title ) {
		wp_update_post(
			array(
				'ID'         => $team->ID,
				'post_title' => 'Notre équipe',
			)
		);
	}

	$menus = wp_get_nav_menus();
	if ( ! is_array( $menus ) ) {
		return;
	}

	foreach ( $menus as $menu ) {
		$items = wp_get_nav_menu_items( $menu->term_id );
		if ( ! is_array( $items ) ) {
			continue;
		}
		foreach ( $items as $item ) {
			if ( ! $item instanceof WP_Post ) {
				continue;
			}
			if ( 'Entreprise' === $item->title ) {
				wp_update_post(
					array(
						'ID'         => $item->ID,
						'post_title' => 'Notre équipe',
					)
				);
			}
		}
	}
}

/**
 * Read a field from ACF or post meta.
 *
 * @param int    $post_id Post ID.
 * @param string $key Field name.
 * @return mixed
 */
function la_suite_csa_upgrade_510_meta( $post_id, $key ) {
	if ( function_exists( 'get_field' ) ) {
		$value = get_field( $key, $post_id );
		if ( is_string( $value ) && '' !== trim( $value ) ) {
			return $value;
		}
	}
	$meta = get_post_meta( $post_id, $key, true );
	return is_string( $meta ) ? $meta : '';
}

/**
 * Store a field through ACF when it is available.
 *
 * @param int    $post_id Post ID.
 * @param string $key Field name.
 * @param string $value Value.
 */
function la_suite_csa_upgrade_510_set_meta( $post_id, $key, $value ) {
	if ( function_exists( 'update_field' ) ) {
		update_field( $key, $value, $post_id );
		return;
	}
	update_post_meta( $post_id, $key, $value );
}

/**
 * Ressource links added under Subventions et crédits d'impôt.
 *
 * @return array<int, array<string, string>>
 */
function la_suite_csa_upgrade_510_grant_links() {
	return array(
		array(
			'name'        => 'Musicaction',
			'short'       => 'Musicaction',
			'description' => 'Programmes de soutien à la musique de langue française, au Canada et à l’international.',
			'url'         => 'https://musicaction.ca/',
			'tag'         => 'Musique',
		),
		array(
			'name'        => 'Fonds Radiostar',
			'short'       => 'Radiostar',
			'description' => 'Soutien à la promotion radiophonique d’enregistrements d’artistes canadiens.',
			'url'         => 'https://fondsradiostar.com/',
			'tag'         => 'Musique',
		),
		array(
			'name'        => 'SODEC: subvention et crédit d’impôt',
			'short'       => 'SODEC',
			'description' => 'Subventions et crédits d’impôt pour les projets culturels au Québec.',
			'url'         => 'https://sodec.gouv.qc.ca/',
			'tag'         => 'Québec',
		),
		array(
			'name'        => 'Conseil des Arts du Canada',
			'short'       => 'CAC',
			'description' => 'Subventions aux arts, dont la musique, à l’échelle du Canada.',
			'url'         => 'https://conseildesarts.ca/',
			'tag'         => 'Fédéral',
		),
		array(
			'name'        => 'Conseil des Arts et des Lettres du Québec',
			'short'       => 'CALQ',
			'description' => 'Aide financière aux arts et aux lettres au Québec.',
			'url'         => 'https://www.calq.gouv.qc.ca/',
			'tag'         => 'Québec',
		),
	);
}

/**
 * Reorder resource categories, retire two of them, and add the cultural links.
 */
function la_suite_csa_upgrade_510_resources() {
	if ( ! post_type_exists( 'csa_ressource' ) ) {
		return;
	}

	$remove_slugs = array( 'fiscalite-et-authentification', 'registres-et-demarrage' );
	foreach ( $remove_slugs as $slug ) {
		$term = get_term_by( 'slug', $slug, 'csa_ressource_cat' );
		if ( ! $term instanceof WP_Term ) {
			continue;
		}
		$posts = get_posts(
			array(
				'post_type'      => 'csa_ressource',
				'post_status'    => 'any',
				'posts_per_page' => -1,
				'tax_query'      => array(
					array(
						'taxonomy' => 'csa_ressource_cat',
						'field'    => 'term_id',
						'terms'    => (int) $term->term_id,
					),
				),
			)
		);
		foreach ( $posts as $post ) {
			if ( 'publish' === $post->post_status ) {
				wp_update_post(
					array(
						'ID'          => $post->ID,
						'post_status' => 'draft',
					)
				);
			}
		}
	}

	$renames = array(
		'financement-et-accompagnement' => array(
			'name'  => 'Financements',
			'intro' => 'Prêts, capital et expertise pour faire avancer vos projets.',
			'sort'  => 2,
		),
		'subventions-et-innovation'     => array(
			'name'  => 'Subventions et crédits d’impôt',
			'intro' => 'Organismes et programmes de subventions et de crédits d’impôt, dont le secteur culturel.',
			'sort'  => 1,
		),
	);

	foreach ( $renames as $slug => $info ) {
		$term = get_term_by( 'slug', $slug, 'csa_ressource_cat' );
		if ( ! $term instanceof WP_Term ) {
			continue;
		}
		wp_update_term(
			$term->term_id,
			'csa_ressource_cat',
			array(
				'name'        => $info['name'],
				'description' => $info['intro'],
			)
		);
		update_term_meta( $term->term_id, 'csa_sort', $info['sort'] );
	}

	$grants_id = la_suite_csa_upgrade_510_term_id( array( 'Subventions et crédits d’impôt', "Subventions et crédits d'impôt" ) );
	$finance_id = la_suite_csa_upgrade_510_term_id( array( 'Financements' ) );

	if ( $grants_id ) {
		update_term_meta( $grants_id, 'csa_sort', 1 );
		la_suite_csa_upgrade_510_insert_links( $grants_id, la_suite_csa_upgrade_510_grant_links() );
	}
	if ( $finance_id ) {
		update_term_meta( $finance_id, 'csa_sort', 2 );
	}
}

/**
 * Find a resource category by possible names.
 *
 * @param array<int, string> $names Names.
 * @return int
 */
function la_suite_csa_upgrade_510_term_id( $names ) {
	$terms = get_terms(
		array(
			'taxonomy'   => 'csa_ressource_cat',
			'hide_empty' => false,
		)
	);
	if ( ! is_array( $terms ) ) {
		return 0;
	}
	foreach ( $terms as $term ) {
		if ( $term instanceof WP_Term && in_array( $term->name, $names, true ) ) {
			return (int) $term->term_id;
		}
	}
	return 0;
}

/**
 * Insert resource links that are not already stored, and place them first.
 *
 * @param int                              $term_id Term ID.
 * @param array<int, array<string, string>> $items Items.
 */
function la_suite_csa_upgrade_510_insert_links( $term_id, $items ) {
	$missing = array();
	foreach ( $items as $item ) {
		$found = get_posts(
			array(
				'post_type'      => 'csa_ressource',
				'post_status'    => 'any',
				'posts_per_page' => 1,
				'meta_key'       => 'resource_url',
				'meta_value'     => $item['url'],
				'fields'         => 'ids',
			)
		);
		if ( empty( $found ) ) {
			$missing[] = $item;
		}
	}

	if ( empty( $missing ) ) {
		return;
	}

	$existing = get_posts(
		array(
			'post_type'      => 'csa_ressource',
			'post_status'    => 'any',
			'posts_per_page' => -1,
			'tax_query'      => array(
				array(
					'taxonomy' => 'csa_ressource_cat',
					'field'    => 'term_id',
					'terms'    => $term_id,
				),
			),
		)
	);
	foreach ( $existing as $post ) {
		wp_update_post(
			array(
				'ID'         => $post->ID,
				'menu_order' => (int) $post->menu_order + 20,
			)
		);
	}

	$order = 0;
	foreach ( $missing as $item ) {
		$order++;
		$post_id = wp_insert_post(
			array(
				'post_type'   => 'csa_ressource',
				'post_status' => 'publish',
				'post_title'  => $item['name'],
				'menu_order'  => $order,
			),
			true
		);
		if ( is_wp_error( $post_id ) ) {
			continue;
		}
		wp_set_object_terms( (int) $post_id, array( $term_id ), 'csa_ressource_cat' );
		$meta = array(
			'resource_url'         => $item['url'],
			'resource_description' => $item['description'],
			'resource_tag'         => $item['tag'],
			'resource_short'       => $item['short'],
			'resource_logo_file'   => '',
		);
		foreach ( $meta as $key => $value ) {
			la_suite_csa_upgrade_510_set_meta( (int) $post_id, $key, $value );
		}
	}
}
