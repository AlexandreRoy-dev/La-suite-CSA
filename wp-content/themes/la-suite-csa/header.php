<?php
/**
 * Header template.
 *
 * @package La_Suite_CSA
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<a class="skip-link" href="#main">Aller au contenu</a>

<header class="site-header" role="banner">
	<div class="site-header__inner">
		<a class="site-title" href="<?php echo esc_url( home_url( '/' ) ); ?>">
			<?php bloginfo( 'name' ); ?>
		</a>

		<nav class="site-nav" id="site-nav" aria-label="Navigation principale">
			<?php if ( has_nav_menu( 'primary' ) ) : ?>
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'primary',
						'container'      => false,
						'menu_class'     => 'site-nav__list',
						'fallback_cb'    => false,
					)
				);
				?>
			<?php else : ?>
				<ul class="site-nav__list">
					<?php foreach ( la_suite_csa_primary_nav_items() as $item ) : ?>
						<li>
							<a href="<?php echo esc_url( $item['url'] ); ?>"><?php echo esc_html( $item['label'] ); ?></a>
						</li>
					<?php endforeach; ?>
				</ul>
			<?php endif; ?>
		</nav>

		<a class="header-cta" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>">
			<?php echo esc_html( la_suite_csa_copy_get( 'nav.contact' ) ); ?>
			<span class="header-cta__icon" aria-hidden="true">→</span>
		</a>

		<button
			class="nav-toggle"
			type="button"
			aria-expanded="false"
			aria-controls="site-nav"
		>
			<span class="nav-toggle__bars" aria-hidden="true">
				<span></span>
				<span></span>
			</span>
			<span class="screen-reader-text">Menu</span>
		</button>
	</div>
</header>

<main id="main" class="site-main">
