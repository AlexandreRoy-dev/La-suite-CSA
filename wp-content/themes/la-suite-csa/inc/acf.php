<?php
/**
 * ACF field groups (PHP-registered so they ship with the theme).
 *
 * Compatible with free Advanced Custom Fields (no Options Page / Repeater; those are PRO).
 * Site-wide fields live on a dedicated "Site Settings" page (slug: site-settings).
 *
 * @package La_Suite_CSA
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Slug for the private Site Settings page.
 */
define( 'LA_SUITE_CSA_SETTINGS_SLUG', 'site-settings' );

/**
 * Option key storing the Site Settings page ID.
 */
define( 'LA_SUITE_CSA_SETTINGS_PAGE_OPTION', 'la_suite_csa_settings_page_id' );

/**
 * Ensure the Site Settings page exists (private, not in menus by default).
 *
 * @return int Page ID or 0.
 */
function la_suite_csa_ensure_settings_page() {
	$stored_id = (int) get_option( LA_SUITE_CSA_SETTINGS_PAGE_OPTION, 0 );

	if ( $stored_id && get_post_status( $stored_id ) ) {
		return $stored_id;
	}

	$existing = get_posts(
		array(
			'name'             => LA_SUITE_CSA_SETTINGS_SLUG,
			'post_type'        => 'page',
			'post_status'      => array( 'private', 'publish', 'draft' ),
			'posts_per_page'   => 1,
			'fields'           => 'ids',
			'suppress_filters' => true,
		)
	);

	if ( ! empty( $existing[0] ) ) {
		$page_id = (int) $existing[0];
		update_option( LA_SUITE_CSA_SETTINGS_PAGE_OPTION, $page_id );
		return $page_id;
	}

	$page_id = wp_insert_post(
		array(
			'post_title'   => __( 'Site Settings', 'la-suite-csa' ),
			'post_name'    => LA_SUITE_CSA_SETTINGS_SLUG,
			'post_status'  => 'private',
			'post_type'    => 'page',
			'post_content' => '',
		),
		true
	);

	if ( is_wp_error( $page_id ) ) {
		return 0;
	}

	update_option( LA_SUITE_CSA_SETTINGS_PAGE_OPTION, (int) $page_id );
	return (int) $page_id;
}
add_action( 'after_switch_theme', 'la_suite_csa_ensure_settings_page' );
add_action( 'after_setup_theme', 'la_suite_csa_ensure_settings_page' );

/**
 * Get Site Settings page ID.
 *
 * @return int
 */
function la_suite_csa_get_settings_page_id() {
	$stored_id = (int) get_option( LA_SUITE_CSA_SETTINGS_PAGE_OPTION, 0 );

	if ( $stored_id && get_post_status( $stored_id ) ) {
		return $stored_id;
	}

	return la_suite_csa_ensure_settings_page();
}

/**
 * Admin menu link to the Site Settings page (free-ACF stand-in for Options Page).
 */
function la_suite_csa_settings_menu() {
	$page_id = la_suite_csa_get_settings_page_id();

	if ( ! $page_id ) {
		return;
	}

	add_menu_page(
		__( 'Site Options', 'la-suite-csa' ),
		__( 'Site Options', 'la-suite-csa' ),
		'edit_theme_options',
		'la-suite-csa-site-options',
		'__return_null',
		'dashicons-admin-generic',
		59
	);
}
add_action( 'admin_menu', 'la_suite_csa_settings_menu' );

/**
 * Redirect the Site Options menu item to the settings page editor.
 */
function la_suite_csa_settings_menu_redirect() {
	// phpcs:ignore WordPress.Security.NonceVerification.Recommended
	$page = isset( $_GET['page'] ) ? sanitize_key( wp_unslash( $_GET['page'] ) ) : '';

	if ( 'la-suite-csa-site-options' !== $page ) {
		return;
	}

	$page_id = la_suite_csa_get_settings_page_id();

	if ( ! $page_id ) {
		return;
	}

	wp_safe_redirect( get_edit_post_link( $page_id, 'raw' ) );
	exit;
}
add_action( 'admin_init', 'la_suite_csa_settings_menu_redirect' );

/**
 * Exclude Site Settings from public queries / sitemaps noise when possible.
 *
 * @param WP_Query $query Query.
 */
function la_suite_csa_exclude_settings_page( $query ) {
	if ( is_admin() || ! $query->is_main_query() ) {
		return;
	}

	$page_id = la_suite_csa_get_settings_page_id();

	if ( ! $page_id ) {
		return;
	}

	if ( $query->is_page() && (int) $query->get_queried_object_id() === $page_id ) {
		$query->set_404();
		status_header( 404 );
	}
}
add_action( 'pre_get_posts', 'la_suite_csa_exclude_settings_page' );

/**
 * Register field groups.
 */
function la_suite_csa_acf_register_fields() {
	if ( ! function_exists( 'acf_add_local_field_group' ) ) {
		return;
	}

	$page_id = la_suite_csa_get_settings_page_id();

	if ( $page_id ) {
		acf_add_local_field_group(
			array(
				'key'      => 'group_la_suite_csa_site_options',
				'title'    => __( 'Site Options', 'la-suite-csa' ),
				'fields'   => array(
					array(
						'key'   => 'field_la_suite_csa_footer_blurb',
						'label' => __( 'Footer blurb', 'la-suite-csa' ),
						'name'  => 'footer_blurb',
						'type'  => 'textarea',
						'rows'  => 3,
					),
					array(
						'key'   => 'field_la_suite_csa_phone',
						'label' => __( 'Phone', 'la-suite-csa' ),
						'name'  => 'phone',
						'type'  => 'text',
					),
					array(
						'key'   => 'field_la_suite_csa_email',
						'label' => __( 'Email', 'la-suite-csa' ),
						'name'  => 'email',
						'type'  => 'email',
					),
					array(
						'key'   => 'field_la_suite_csa_social_facebook',
						'label' => __( 'Facebook URL', 'la-suite-csa' ),
						'name'  => 'social_facebook',
						'type'  => 'url',
					),
					array(
						'key'   => 'field_la_suite_csa_social_instagram',
						'label' => __( 'Instagram URL', 'la-suite-csa' ),
						'name'  => 'social_instagram',
						'type'  => 'url',
					),
					array(
						'key'   => 'field_la_suite_csa_social_linkedin',
						'label' => __( 'LinkedIn URL', 'la-suite-csa' ),
						'name'  => 'social_linkedin',
						'type'  => 'url',
					),
				),
				'location' => array(
					array(
						array(
							'param'    => 'page',
							'operator' => '==',
							'value'    => (string) $page_id,
						),
					),
				),
				'active'   => true,
				'style'    => 'seamless',
				'position' => 'acf_after_title',
			)
		);
	}

	acf_add_local_field_group(
		array(
			'key'      => 'group_la_suite_csa_front_page',
			'title'    => __( 'Accueil - Hero & promesse', 'la-suite-csa' ),
			'fields'   => array(
				array(
					'key'   => 'field_la_suite_csa_hero_eyebrow',
					'label' => __( 'Sur-titre (eyebrow)', 'la-suite-csa' ),
					'name'  => 'hero_eyebrow',
					'type'  => 'text',
				),
				array(
					'key'   => 'field_la_suite_csa_hero_brand_line_1',
					'label' => __( 'Titre ligne 1', 'la-suite-csa' ),
					'name'  => 'hero_brand_line_1',
					'type'  => 'text',
					'instructions' => __( 'Ex. : La Suite', 'la-suite-csa' ),
				),
				array(
					'key'   => 'field_la_suite_csa_hero_brand_line_2',
					'label' => __( 'Titre ligne 2', 'la-suite-csa' ),
					'name'  => 'hero_brand_line_2',
					'type'  => 'text',
					'instructions' => __( 'Ex. : CSA', 'la-suite-csa' ),
				),
				array(
					'key'   => 'field_la_suite_csa_hero_text',
					'label' => __( 'Texte d’appui (gauche)', 'la-suite-csa' ),
					'name'  => 'hero_text',
					'type'  => 'textarea',
					'rows'  => 3,
				),
				array(
					'key'   => 'field_la_suite_csa_hero_cta_label',
					'label' => __( 'Libellé du bouton', 'la-suite-csa' ),
					'name'  => 'hero_cta_label',
					'type'  => 'text',
				),
				array(
					'key'   => 'field_la_suite_csa_hero_cta_url',
					'label' => __( 'URL du bouton', 'la-suite-csa' ),
					'name'  => 'hero_cta_url',
					'type'  => 'url',
				),
				array(
					'key'           => 'field_la_suite_csa_hero_visual',
					'label'         => __( 'Visuel central (optionnel)', 'la-suite-csa' ),
					'name'          => 'hero_visual',
					'type'          => 'image',
					'return_format' => 'array',
					'preview_size'  => 'medium',
					'library'       => 'all',
					'instructions'  => __( 'Laissez vide pour garder le visuel par défaut du thème.', 'la-suite-csa' ),
				),
				array(
					'key'   => 'field_la_suite_csa_promise_text',
					'label' => __( 'Texte de la promesse', 'la-suite-csa' ),
					'name'  => 'promise_text',
					'type'  => 'textarea',
					'rows'  => 3,
					'instructions' => __( 'Utilisez **mots** pour mettre en gras (ex. : **financement**).', 'la-suite-csa' ),
				),
				array(
					'key'   => 'field_la_suite_csa_lever_1_title',
					'label' => __( 'Carte 01 - titre', 'la-suite-csa' ),
					'name'  => 'lever_1_title',
					'type'  => 'text',
				),
				array(
					'key'   => 'field_la_suite_csa_lever_1_text',
					'label' => __( 'Carte 01 - texte', 'la-suite-csa' ),
					'name'  => 'lever_1_text',
					'type'  => 'text',
				),
				array(
					'key'   => 'field_la_suite_csa_lever_2_title',
					'label' => __( 'Carte 02 - titre', 'la-suite-csa' ),
					'name'  => 'lever_2_title',
					'type'  => 'text',
				),
				array(
					'key'   => 'field_la_suite_csa_lever_2_text',
					'label' => __( 'Carte 02 - texte', 'la-suite-csa' ),
					'name'  => 'lever_2_text',
					'type'  => 'text',
				),
				array(
					'key'   => 'field_la_suite_csa_lever_3_title',
					'label' => __( 'Carte 03 - titre', 'la-suite-csa' ),
					'name'  => 'lever_3_title',
					'type'  => 'text',
				),
				array(
					'key'   => 'field_la_suite_csa_lever_3_text',
					'label' => __( 'Carte 03 - texte', 'la-suite-csa' ),
					'name'  => 'lever_3_text',
					'type'  => 'text',
				),
			),
			'location' => array(
				array(
					array(
						'param'    => 'page_type',
						'operator' => '==',
						'value'    => 'front_page',
					),
				),
			),
			'active'   => true,
			'style'    => 'default',
			'position' => 'acf_after_title',
		)
	);
}
add_action( 'acf/init', 'la_suite_csa_acf_register_fields' );

/**
 * Admin notice when ACF is missing.
 */
function la_suite_csa_acf_missing_notice() {
	if ( function_exists( 'acf_add_local_field_group' ) ) {
		return;
	}

	if ( ! current_user_can( 'activate_plugins' ) ) {
		return;
	}

	echo '<div class="notice notice-warning"><p>';
	echo esc_html__(
		'La Suite CSA Inc. : installez et activez Advanced Custom Fields pour les Site Options et les champs éditables.',
		'la-suite-csa'
	);
	echo '</p></div>';
}
add_action( 'admin_notices', 'la_suite_csa_acf_missing_notice' );
