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
	$nav   = la_suite_csa_copy_get( 'nav' );
	$items = array(
		array(
			'label' => $nav['accueil'] ?? 'Accueil',
			'url'   => home_url( '/' ),
			'check' => 'front',
		),
		array(
			'label' => $nav['services'] ?? 'Services',
			'url'   => home_url( '/services/' ),
			'check' => 'services',
		),
		array(
			'label' => $nav['entreprise'] ?? 'Entreprise',
			'url'   => home_url( '/entreprise/' ),
			'check' => 'page',
		),
		array(
			'label' => $nav['ressources'] ?? 'Ressources',
			'url'   => home_url( '/ressources/' ),
			'check' => 'page',
		),
		array(
			'label' => $nav['outils'] ?? 'Outils',
			'url'   => home_url( '/outils/' ),
			'check' => 'page',
		),
		array(
			'label' => $nav['blog'] ?? 'Blogue',
			'url'   => home_url( '/blogue/' ),
			'check' => 'blog',
		),
	);

	foreach ( $items as $index => $item ) {
		$current = false;
		if ( 'front' === $item['check'] ) {
			$current = is_front_page();
		} elseif ( 'blog' === $item['check'] ) {
			$current = is_home() || is_singular( 'post' );
		} elseif ( 'services' === $item['check'] ) {
			$current = is_page( 'services' ) || ( is_page() && 'services' === get_post_field( 'post_name', wp_get_post_parent_id( get_queried_object_id() ) ) );
		} else {
			$path    = (string) wp_parse_url( $item['url'], PHP_URL_PATH );
			$current = is_page( trim( $path, '/' ) );
		}
		$items[ $index ]['current'] = $current;
		unset( $items[ $index ]['check'] );
	}

	return $items;
}

/**
 * Phone, with the public default when Site Options is empty.
 *
 * @return string
 */
function la_suite_csa_get_phone() {
	$phone = la_suite_csa_get_option( 'phone' );
	if ( is_string( $phone ) && '' !== trim( $phone ) ) {
		return trim( $phone );
	}
	$fallback = la_suite_csa_copy_get( 'footer.phone', '' );
	return is_string( $fallback ) ? $fallback : '';
}

/**
 * Postal address, with the public default when Site Options is empty.
 *
 * @return string
 */
function la_suite_csa_get_address() {
	$address = la_suite_csa_get_option( 'address' );
	if ( is_string( $address ) && '' !== trim( $address ) ) {
		return trim( $address );
	}
	$fallback = la_suite_csa_copy_get( 'footer.address', '' );
	return is_string( $fallback ) ? $fallback : '';
}

/**
 * Public email from Site Options.
 *
 * @return string
 */
function la_suite_csa_get_email() {
	$email = la_suite_csa_get_option( 'email' );
	if ( is_string( $email ) && is_email( $email ) ) {
		return $email;
	}
	return '';
}

/**
 * tel: href for a displayed phone number.
 *
 * @param string $phone Display phone.
 * @return string
 */
function la_suite_csa_tel_href( $phone ) {
	$digits = preg_replace( '/\D+/', '', (string) $phone );
	if ( is_string( $digits ) && 10 === strlen( $digits ) ) {
		$digits = '1' . $digits;
	}
	return 'tel:+' . $digits;
}

/**
 * Prefer a non-empty string, otherwise the bundled default.
 *
 * @param mixed  $value Candidate.
 * @param string $default Fallback.
 * @return string
 */
function la_suite_csa_string_or_default( $value, $default ) {
	if ( is_string( $value ) && '' !== trim( $value ) ) {
		return $value;
	}
	return $default;
}

/**
 * Bundled or uploaded portrait for one founder.
 *
 * @param int                  $index 1-based index.
 * @param array<string, mixed> $member Default member.
 * @param string               $name Display name.
 * @return array{src:string,alt:string,width:int,height:int}
 */
function la_suite_csa_founder_photo( $index, $member, $name ) {
	$field = la_suite_csa_get_option( 'founder_' . $index . '_photo' );

	if ( is_array( $field ) && ! empty( $field['url'] ) ) {
		return array(
			'src'    => $field['url'],
			'alt'    => ! empty( $field['alt'] ) ? $field['alt'] : $name,
			'width'  => ! empty( $field['width'] ) ? (int) $field['width'] : 1067,
			'height' => ! empty( $field['height'] ) ? (int) $field['height'] : 1600,
		);
	}

	if ( is_numeric( $field ) ) {
		$src = wp_get_attachment_image_url( (int) $field, 'large' );
		if ( $src ) {
			$meta = wp_get_attachment_metadata( (int) $field );
			return array(
				'src'    => $src,
				'alt'    => $name,
				'width'  => ! empty( $meta['width'] ) ? (int) $meta['width'] : 1067,
				'height' => ! empty( $meta['height'] ) ? (int) $meta['height'] : 1600,
			);
		}
	}

	$file = ! empty( $member['photo'] ) ? basename( (string) $member['photo'] ) : '';

	return array(
		'src'    => LA_SUITE_CSA_URI . '/assets/images/founders/' . $file,
		'alt'    => $name,
		'width'  => 1067,
		'height' => 1600,
	);
}

/**
 * Founders shared by Accueil and Entreprise.
 * Empty Site Options fields fall back to the bundled copy and photos.
 *
 * @return array<int, array<string, mixed>>
 */
function la_suite_csa_founders() {
	$defaults = la_suite_csa_copy_get( 'about.team', array() );
	if ( ! is_array( $defaults ) ) {
		return array();
	}

	$founders = array();
	$index    = 0;

	foreach ( $defaults as $member ) {
		if ( ! is_array( $member ) ) {
			continue;
		}
		$index++;
		$name = la_suite_csa_string_or_default(
			la_suite_csa_get_option( 'founder_' . $index . '_name' ),
			isset( $member['name'] ) ? (string) $member['name'] : ''
		);
		$role = la_suite_csa_string_or_default(
			la_suite_csa_get_option( 'founder_' . $index . '_role' ),
			isset( $member['role'] ) ? (string) $member['role'] : ''
		);
		$excerpt = la_suite_csa_string_or_default(
			la_suite_csa_get_option( 'founder_' . $index . '_excerpt' ),
			isset( $member['excerpt'] ) ? (string) $member['excerpt'] : ''
		);
		$bio = la_suite_csa_string_or_default(
			la_suite_csa_get_option( 'founder_' . $index . '_bio' ),
			isset( $member['bio'] ) ? (string) $member['bio'] : ''
		);
		$parts = preg_split( "/\n\s*\n/u", trim( $bio ) );
		if ( ! is_array( $parts ) ) {
			$parts = array( $bio );
		}
		$paragraphs = array();
		foreach ( $parts as $part ) {
			$part = trim( (string) $part );
			if ( '' !== $part ) {
				$paragraphs[] = $part;
			}
		}

		$founders[] = array(
			'name'       => $name,
			'role'       => $role,
			'excerpt'    => $excerpt,
			'paragraphs' => $paragraphs,
			'photo'      => la_suite_csa_founder_photo( $index, $member, $name ),
			'id'         => 'founder-bio-' . $index,
		);
	}

	return $founders;
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

/**
 * Official logo: Customizer logo when set, otherwise the bundled white and blue SVGs.
 *
 * @param string $placement header or footer.
 * @return string
 */
function la_suite_csa_brand_logo( $placement = 'header' ) {
	$placement = ( 'footer' === $placement ) ? 'footer' : 'header';
	$alt       = 'La Suite CSA';
	$base      = LA_SUITE_CSA_URI . '/assets/images/brand/';

	if ( has_custom_logo() ) {
		$logo_id = (int) get_theme_mod( 'custom_logo' );
		$img     = wp_get_attachment_image(
			$logo_id,
			'full',
			false,
			array(
				'class'    => 'hdr__logo-img',
				'alt'      => $alt,
				'decoding' => 'async',
			)
		);
		if ( is_string( $img ) && preg_match( '/\b(?:width|height)="0"/', $img ) ) {
			$img = preg_replace( '/\s(?:width|height)="0"/', '', $img );
		}
	} elseif ( 'footer' === $placement ) {
		$img = sprintf(
			'<img class="hdr__logo-img" src="%1$s" alt="%2$s" width="301" height="177" decoding="async">',
			esc_url( $base . 'logo-la-suite-csa-blanc.svg' ),
			esc_attr( $alt )
		);
	} else {
		$img  = sprintf(
			'<img class="hdr__logo-w" src="%1$s" alt="%2$s" width="301" height="177" decoding="async">',
			esc_url( $base . 'logo-la-suite-csa-blanc.svg' ),
			esc_attr( $alt )
		);
		$img .= sprintf(
			'<img class="hdr__logo-n" src="%1$s" alt="" width="301" height="177" decoding="async">',
			esc_url( $base . 'logo-la-suite-csa-bleu.svg' )
		);
	}

	$class = ( 'footer' === $placement ) ? 'ftr__logo' : 'hdr__logo';

	return sprintf(
		'<a class="%1$s" href="%2$s" aria-label="%3$s">%4$s</a>',
		esc_attr( $class ),
		esc_url( home_url( '/' ) ),
		esc_attr( $alt ),
		$img
	);
}
