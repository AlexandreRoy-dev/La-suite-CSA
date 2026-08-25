<?php
/**
 * Contact form handler + page seeding.
 *
 * @package La_Suite_CSA
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Seed core pages and menus after theme activation.
 */
function la_suite_csa_seed_content() {
	$pages = array(
		array(
			'title'    => 'Accueil',
			'slug'     => 'accueil',
			'template' => '',
			'is_front' => true,
		),
		array(
			'title'    => 'Services',
			'slug'     => 'services',
			'template' => 'page-services.php',
		),
		array(
			'title'    => 'Entreprise',
			'slug'     => 'entreprise',
			'template' => 'page-entreprise.php',
		),
		array(
			'title'    => 'Ressources',
			'slug'     => 'ressources',
			'template' => 'page-ressources.php',
		),
		array(
			'title'    => 'Outils',
			'slug'     => 'outils',
			'template' => 'page-outils.php',
		),
		array(
			'title'    => 'Blogue',
			'slug'     => 'blogue',
			'template' => '',
			'is_blog'  => true,
		),
		array(
			'title'    => 'Contact',
			'slug'     => 'contact',
			'template' => 'page-contact.php',
		),
	);

	$ids = array();

	foreach ( $pages as $page ) {
		$existing = get_page_by_path( $page['slug'] );

		if ( $existing instanceof WP_Post ) {
			$ids[ $page['slug'] ] = (int) $existing->ID;
			if ( ! empty( $page['template'] ) ) {
				update_post_meta( $existing->ID, '_wp_page_template', $page['template'] );
			}
			continue;
		}

		$page_id = wp_insert_post(
			array(
				'post_title'   => $page['title'],
				'post_name'    => $page['slug'],
				'post_status'  => 'publish',
				'post_type'    => 'page',
				'post_content' => '',
			),
			true
		);

		if ( is_wp_error( $page_id ) ) {
			continue;
		}

		if ( ! empty( $page['template'] ) ) {
			update_post_meta( $page_id, '_wp_page_template', $page['template'] );
		}

		$ids[ $page['slug'] ] = (int) $page_id;
	}

	if ( function_exists( 'la_suite_csa_ensure_service_pages' ) ) {
		la_suite_csa_ensure_service_pages();
	}

	if ( ! empty( $ids['accueil'] ) ) {
		update_option( 'show_on_front', 'page' );
		update_option( 'page_on_front', $ids['accueil'] );
	}

	if ( ! empty( $ids['blogue'] ) ) {
		update_option( 'page_for_posts', $ids['blogue'] );
	}

	update_option( 'blogname', 'La Suite CSA Inc.' );
	update_option( 'blogdescription', la_suite_csa_copy_get( 'home.hero_headline' ) );

	$settings_id = la_suite_csa_get_settings_page_id();
	if ( $settings_id && function_exists( 'update_field' ) ) {
		update_field( 'footer_blurb', la_suite_csa_copy_get( 'footer.blurb' ), $settings_id );
	} elseif ( $settings_id ) {
		update_post_meta( $settings_id, 'footer_blurb', la_suite_csa_copy_get( 'footer.blurb' ) );
	}

	if ( ! empty( $ids['accueil'] ) && function_exists( 'update_field' ) ) {
		$accueil = $ids['accueil'];
		update_field( 'hero_eyebrow', la_suite_csa_copy_get( 'home.hero_eyebrow' ), $accueil );
		update_field( 'hero_brand_line_1', la_suite_csa_copy_get( 'home.hero_brand_line_1' ), $accueil );
		update_field( 'hero_brand_line_2', la_suite_csa_copy_get( 'home.hero_brand_line_2' ), $accueil );
		update_field( 'hero_text', la_suite_csa_copy_get( 'home.hero_text' ), $accueil );
		update_field( 'hero_cta_label', la_suite_csa_copy_get( 'home.hero_cta_label' ), $accueil );
		update_field( 'hero_cta_url', home_url( '/contact/' ), $accueil );
		update_field( 'promise_text', la_suite_csa_copy_get( 'home.promise_text' ), $accueil );
		update_field( 'lever_1_title', la_suite_csa_copy_get( 'home.lever_1_title' ), $accueil );
		update_field( 'lever_1_text', la_suite_csa_copy_get( 'home.lever_1_text' ), $accueil );
		update_field( 'lever_2_title', la_suite_csa_copy_get( 'home.lever_2_title' ), $accueil );
		update_field( 'lever_2_text', la_suite_csa_copy_get( 'home.lever_2_text' ), $accueil );
		update_field( 'lever_3_title', la_suite_csa_copy_get( 'home.lever_3_title' ), $accueil );
		update_field( 'lever_3_text', la_suite_csa_copy_get( 'home.lever_3_text' ), $accueil );
	}

	$menu_name = 'Menu principal';
	$menu      = wp_get_nav_menu_object( $menu_name );

	if ( ! $menu ) {
		$menu_id = wp_create_nav_menu( $menu_name );
	} else {
		$menu_id = (int) $menu->term_id;
	}

	if ( ! is_wp_error( $menu_id ) ) {
		$existing_items = wp_get_nav_menu_items( $menu_id );
		if ( empty( $existing_items ) ) {
			$order   = 1;
			$nav_map = array(
				'accueil'    => la_suite_csa_copy_get( 'nav.accueil' ),
				'services'   => la_suite_csa_copy_get( 'nav.services' ),
				'entreprise' => la_suite_csa_copy_get( 'nav.entreprise' ),
				'ressources' => la_suite_csa_copy_get( 'nav.ressources' ),
				'outils'     => la_suite_csa_copy_get( 'nav.outils' ),
				'blogue'     => la_suite_csa_copy_get( 'nav.blog' ),
				'contact'    => la_suite_csa_copy_get( 'nav.contact' ),
			);

			foreach ( $nav_map as $slug => $label ) {
				if ( empty( $ids[ $slug ] ) ) {
					continue;
				}
				wp_update_nav_menu_item(
					$menu_id,
					0,
					array(
						'menu-item-title'     => $label,
						'menu-item-object'    => 'page',
						'menu-item-object-id' => $ids[ $slug ],
						'menu-item-type'      => 'post_type',
						'menu-item-status'    => 'publish',
						'menu-item-position'  => $order++,
					)
				);
			}
		}

		$locations            = get_theme_mod( 'nav_menu_locations', array() );
		$locations['primary'] = $menu_id;
		$locations['footer']  = $menu_id;
		set_theme_mod( 'nav_menu_locations', $locations );
	}
}
add_action( 'after_switch_theme', 'la_suite_csa_seed_content' );

/**
 * Handle contact form submissions.
 */
function la_suite_csa_handle_contact() {
	if ( ! isset( $_POST['la_suite_csa_contact_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['la_suite_csa_contact_nonce'] ) ), 'la_suite_csa_contact' ) ) {
		wp_safe_redirect( home_url( '/contact/?contact=error' ) );
		exit;
	}

	if ( ! empty( $_POST['company_website'] ) ) {
		wp_safe_redirect( home_url( '/contact/?contact=sent' ) );
		exit;
	}

	$name    = isset( $_POST['contact_name'] ) ? sanitize_text_field( wp_unslash( $_POST['contact_name'] ) ) : '';
	$email   = isset( $_POST['contact_email'] ) ? sanitize_email( wp_unslash( $_POST['contact_email'] ) ) : '';
	$phone   = isset( $_POST['contact_phone'] ) ? sanitize_text_field( wp_unslash( $_POST['contact_phone'] ) ) : '';
	$message = isset( $_POST['contact_message'] ) ? sanitize_textarea_field( wp_unslash( $_POST['contact_message'] ) ) : '';

	if ( '' === $name || '' === $email || '' === $message || ! is_email( $email ) ) {
		wp_safe_redirect( home_url( '/contact/?contact=error' ) );
		exit;
	}

	$to      = get_option( 'admin_email' );
	$subject = sprintf( '[La Suite CSA Inc.] Message de %s', $name );
	$body    = "Nom: {$name}\nCourriel: {$email}\nTéléphone: {$phone}\n\n{$message}";
	$headers = array( 'Content-Type: text/plain; charset=UTF-8', 'Reply-To: ' . $name . ' <' . $email . '>' );

	wp_mail( $to, $subject, $body, $headers );

	wp_safe_redirect( home_url( '/contact/?contact=sent' ) );
	exit;
}
add_action( 'admin_post_nopriv_la_suite_csa_contact', 'la_suite_csa_handle_contact' );
add_action( 'admin_post_la_suite_csa_contact', 'la_suite_csa_handle_contact' );
