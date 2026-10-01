<?php
/**
 * Header template.
 *
 * @package La_Suite_CSA
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$phone = la_suite_csa_get_phone();
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
	<meta name="theme-color" content="#0B1629">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<a class="skip-link" href="#main">Aller au contenu</a>

<?php if ( is_front_page() ) : ?>
	<div class="loader" aria-hidden="true">
		<div class="loader__inner">
			<img class="loader__mark" src="<?php echo esc_url( LA_SUITE_CSA_URI . '/assets/images/brand/logo-la-suite-csa-blanc.svg' ); ?>" alt="" width="301" height="177">
			<p class="loader__word"><span>La Suite</span><span>CSA</span></p>
		</div>
	</div>
<?php endif; ?>

<div class="cursor" aria-hidden="true">
	<div class="cursor__ring"><span class="cursor__label">Voir</span></div>
	<div class="cursor__dot"></div>
</div>

<header class="hdr<?php echo is_front_page() ? '' : ' is-solid'; ?>" data-hdr>
	<?php echo la_suite_csa_brand_logo( 'header' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>

	<nav class="hdr__nav" id="site-nav" aria-label="Navigation principale">
		<?php if ( has_nav_menu( 'primary' ) ) : ?>
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'primary',
					'container'      => false,
					'menu_class'     => 'hdr__menu',
					'fallback_cb'    => false,
				)
			);
			?>
		<?php else : ?>
			<ul class="hdr__menu">
				<?php foreach ( la_suite_csa_primary_nav_items() as $item ) : ?>
					<li>
						<a href="<?php echo esc_url( $item['url'] ); ?>" data-hover<?php echo ! empty( $item['current'] ) ? ' aria-current="page"' : ''; ?>><?php echo esc_html( $item['label'] ); ?></a>
					</li>
				<?php endforeach; ?>
			</ul>
		<?php endif; ?>
	</nav>

	<div class="hdr__cta">
		<?php if ( $phone ) : ?>
			<a class="hdr__tel" href="<?php echo esc_attr( la_suite_csa_tel_href( $phone ) ); ?>" data-hover><?php echo esc_html( $phone ); ?></a>
		<?php endif; ?>
		<a class="btn btn--sm" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" data-magnetic>
			<span class="btn__label" data-text="<?php echo esc_attr( la_suite_csa_copy_get( 'nav.contact' ) ); ?>"><?php echo esc_html( la_suite_csa_copy_get( 'nav.contact' ) ); ?></span>
			<span class="btn__arrow" aria-hidden="true"></span>
		</a>
		<button class="nav-toggle" type="button" aria-expanded="false" aria-controls="site-nav">
			<span class="nav-toggle__bars" aria-hidden="true"><span></span><span></span></span>
			<span class="screen-reader-text">Menu</span>
		</button>
	</div>
</header>

<main id="main" class="site-main" data-section="light">
