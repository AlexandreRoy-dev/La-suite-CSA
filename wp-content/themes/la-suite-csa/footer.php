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
$phone        = la_suite_csa_get_phone();
$email        = la_suite_csa_get_email();
$address      = la_suite_csa_get_address();
$social_links = la_suite_csa_get_social_links();
?>
</main>

<footer class="ftr" data-section="dark" role="contentinfo">
	<div class="wrap">
		<div class="ftr__top">
			<?php echo la_suite_csa_brand_logo( 'footer' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
			<?php if ( $footer_blurb ) : ?>
				<p class="ftr__tag"><?php echo esc_html( $footer_blurb ); ?></p>
			<?php endif; ?>
		</div>

		<div class="ftr__cols">
			<div>
				<p class="label label--on-dark">Contact</p>
				<?php if ( $phone ) : ?>
					<p><a href="<?php echo esc_attr( la_suite_csa_tel_href( $phone ) ); ?>"><?php echo esc_html( $phone ); ?></a></p>
				<?php endif; ?>
				<?php if ( $email ) : ?>
					<p><a href="mailto:<?php echo esc_attr( $email ); ?>"><?php echo esc_html( $email ); ?></a></p>
				<?php endif; ?>
				<?php if ( $address ) : ?>
					<p><?php echo esc_html( $address ); ?></p>
				<?php endif; ?>
			</div>
			<div>
				<p class="label label--on-dark">Pages</p>
				<ul>
					<?php foreach ( la_suite_csa_primary_nav_items() as $item ) : ?>
						<li><a href="<?php echo esc_url( $item['url'] ); ?>"><?php echo esc_html( $item['label'] ); ?></a></li>
					<?php endforeach; ?>
				</ul>
			</div>
			<div>
				<?php if ( ! empty( $social_links ) ) : ?>
					<p class="label label--on-dark">Réseaux</p>
					<ul>
						<?php foreach ( $social_links as $link ) : ?>
							<li>
								<a href="<?php echo esc_url( $link['url'] ); ?>" target="_blank" rel="noopener noreferrer"><?php echo esc_html( $link['label'] ); ?></a>
							</li>
						<?php endforeach; ?>
					</ul>
				<?php endif; ?>
				<?php if ( has_nav_menu( 'footer' ) ) : ?>
					<nav aria-label="Pied de page">
						<?php
						wp_nav_menu(
							array(
								'theme_location' => 'footer',
								'container'      => false,
								'menu_class'     => 'ftr__menu',
								'fallback_cb'    => false,
								'depth'          => 1,
							)
						);
						?>
					</nav>
				<?php endif; ?>
			</div>
		</div>

		<p class="ftr__base">
			<span>&copy; <?php echo esc_html( gmdate( 'Y' ) ); ?> <?php bloginfo( 'name' ); ?></span>
			<span>Financements, subventions, crédits d’impôt</span>
		</p>
	</div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
