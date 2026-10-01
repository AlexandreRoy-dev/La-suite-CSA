<?php
/**
 * Template Name: Entreprise
 * Company page (fr-CA) with founders team.
 *
 * @package La_Suite_CSA
 */

get_header();

$copy  = la_suite_csa_copy_get( 'about' );
$media = la_suite_csa_media_get( 'entreprise' );

get_template_part(
	'template-parts/page-intro',
	null,
	array(
		'eyebrow' => 'Entreprise',
		'title'   => $copy['title'],
		'lede'    => $copy['lead'],
	)
);
?>

<section class="content-section">
	<div class="section-block split-media">
		<?php if ( $media ) : ?>
			<div class="split-media__frame mask-reveal reveal">
				<div class="split-media__crop">
					<img
						src="<?php echo esc_url( $media['src'] ); ?>"
						alt="<?php echo esc_attr( $media['alt'] ); ?>"
						width="1200"
						height="1500"
						loading="eager"
						decoding="async"
					>
				</div>
			</div>
		<?php endif; ?>
		<div class="reveal">
			<div class="prose-stack">
				<?php foreach ( $copy['body'] as $paragraph ) : ?>
					<p><?php echo esc_html( $paragraph ); ?></p>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
</section>

<?php
get_template_part( 'template-parts/founders' );
?>

<section class="content-section">
	<div class="section-block">
		<header class="section-header reveal">
			<h2 class="section-header__title"><?php echo esc_html( $copy['values_title'] ); ?></h2>
		</header>
		<ul class="feature-grid" data-stagger>
			<?php foreach ( $copy['values'] as $value ) : ?>
				<li class="feature-grid__item">
					<h3 class="feature-grid__title"><?php echo esc_html( $value['title'] ); ?></h3>
					<p><?php echo esc_html( $value['text'] ); ?></p>
				</li>
			<?php endforeach; ?>
		</ul>
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
