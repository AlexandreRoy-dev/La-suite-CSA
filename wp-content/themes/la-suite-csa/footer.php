<?php
/**
 * Footer template.
 *
 * @package La_Suite_CSA
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$footer_blurb = la_suite_csa_get_option( 'footer_blurb' );
if ( ! is_string( $footer_blurb ) || '' === trim( $footer_blurb ) ) {
	$footer_blurb = la_suite_csa_copy_get( 'footer.blurb' );
}
$phone        = la_suite_csa_get_option( 'phone' );
$email        = la_suite_csa_get_option( 'email' );
$social_links = la_suite_csa_get_social_links();
?>
</main>

<footer class="site-footer" role="contentinfo">
	<div class="site-footer__inner">
		<?php if ( $footer_blurb ) : ?>
			<p class="site-footer__blurb"><?php echo esc_html( $footer_blurb ); ?></p>
		<?php endif; ?>

		<div class="site-footer__contact">
			<?php if ( $phone ) : ?>
				<a href="tel:<?php echo esc_attr( preg_replace( '/\s+/', '', $phone ) ); ?>"><?php echo esc_html( $phone ); ?></a>
			<?php endif; ?>
			<?php if ( $email ) : ?>
				<a href="mailto:<?php echo esc_attr( $email ); ?>"><?php echo esc_html( $email ); ?></a>
			<?php endif; ?>
		</div>

		<?php if ( ! empty( $social_links ) ) : ?>
			<ul class="site-footer__social">
				<?php foreach ( $social_links as $link ) : ?>
					<li>
						<a href="<?php echo esc_url( $link['url'] ); ?>" target="_blank" rel="noopener noreferrer">
							<?php echo esc_html( $link['label'] ); ?>
						</a>
					</li>
				<?php endforeach; ?>
			</ul>
		<?php endif; ?>

		<?php if ( has_nav_menu( 'footer' ) ) : ?>
			<nav class="site-footer__nav" aria-label="<?php echo esc_attr( la_suite_csa_copy_get( 'nav.contact' ) ); ?>">
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'footer',
						'container'      => false,
						'menu_class'     => 'site-footer__nav-list',
						'fallback_cb'    => false,
						'depth'          => 1,
					)
				);
				?>
			</nav>
		<?php endif; ?>

		<p class="site-footer__copy">
			&copy; <?php echo esc_html( gmdate( 'Y' ) ); ?>
			<?php bloginfo( 'name' ); ?>
		</p>
	</div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
