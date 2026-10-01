<?php
/**
 * Template Name: Services
 * Services hub page (fr-CA).
 *
 * @package La_Suite_CSA
 */

get_header();

$copy = la_suite_csa_copy_get( 'services' );

get_template_part(
	'template-parts/page-intro',
	null,
	array(
		'eyebrow' => 'Services',
		'title'   => $copy['title'],
		'lede'    => $copy['intro'],
	)
);
?>

<section class="content-section">
	<div class="section-block">
	<div class="lever-stage">
		<?php foreach ( $copy['sections'] as $index => $section ) : ?>
			<?php
			$media_key = la_suite_csa_service_media_key( $index );
			$media     = la_suite_csa_media_get( $media_key );
			$link      = $section['link'] ?? '/services/';
			?>
			<a class="lever<?php echo 0 === $index ? ' is-active' : ''; ?>" href="<?php echo esc_url( home_url( $link ) ); ?>">
				<?php if ( $media ) : ?>
					<img
						src="<?php echo esc_url( $media['src'] ); ?>"
						alt=""
						width="1400"
						height="1800"
						loading="<?php echo 0 === $index ? 'eager' : 'lazy'; ?>"
						decoding="async"
					>
				<?php endif; ?>
				<div class="lever__copy">
					<h2 class="lever__title"><?php echo esc_html( $section['title'] ); ?></h2>
					<p class="lever__text"><?php echo esc_html( $section['text'] ); ?></p>
					<span class="lever__link">Voir la page</span>
				</div>
			</a>
		<?php endforeach; ?>
	</div>
	</div>

	<div class="section-block">
		<p class="legal-note reveal"><?php echo esc_html( $copy['note'] ); ?></p>
		<p class="section-cta reveal">
			<a class="button" href="<?php echo esc_url( la_suite_csa_url( $copy['cta_url'] ) ); ?>">
				<?php echo esc_html( $copy['cta_label'] ); ?>
				<span class="button__icon" aria-hidden="true">→</span>
			</a>
		</p>
	</div>
</section>

<?php
get_footer();
