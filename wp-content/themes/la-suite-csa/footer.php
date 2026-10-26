<?php
/**
 * Footer template.
 *
 * One horizontal row: logo, blurb, email, address, page links.
 * The page list is printed once (the old Pages column repeated the footer menu).
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
$email        = la_suite_csa_get_email();
$address      = la_suite_csa_get_address();
$social_links = la_suite_csa_get_social_links();
?>
</main>

<footer class="ftr" data-section="dark" role="contentinfo">
	<div class="wrap">
		<div class="ftr__row">
			<?php echo la_suite_csa_brand_logo( 'footer' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
			<?php if ( $footer_blurb ) : ?>
				<p class="ftr__tag"><?php echo esc_html( $footer_blurb ); ?></p>
			<?php endif; ?>
			<div class="ftr__meta">
				<?php if ( $email ) : ?>
					<a href="mailto:<?php echo esc_attr( $email ); ?>"><?php echo esc_html( $email ); ?></a>
				<?php endif; ?>
				<?php if ( $address ) : ?>
					<span><?php echo esc_html( $address ); ?></span>
				<?php endif; ?>
				<?php foreach ( $social_links as $link ) : ?>
					<a href="<?php echo esc_url( $link['url'] ); ?>" target="_blank" rel="noopener noreferrer"><?php echo esc_html( $link['label'] ); ?></a>
				<?php endforeach; ?>
			</div>
			<nav aria-label="Pied de page">
				<?php if ( has_nav_menu( 'primary' ) ) : ?>
					<?php
					wp_nav_menu(
						array(
							'theme_location' => 'primary',
							'container'      => false,
							'menu_class'     => 'ftr__links',
							'fallback_cb'    => false,
							'depth'          => 1,
						)
					);
					?>
				<?php else : ?>
					<ul class="ftr__links">
						<?php foreach ( la_suite_csa_primary_nav_items() as $item ) : ?>
							<li><a href="<?php echo esc_url( $item['url'] ); ?>"><?php echo esc_html( $item['label'] ); ?></a></li>
						<?php endforeach; ?>
					</ul>
				<?php endif; ?>
			</nav>
		</div>
	</div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
