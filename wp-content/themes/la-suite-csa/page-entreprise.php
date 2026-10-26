<?php
/**
 * Template Name: Entreprise
 * Team page. Public title: Notre équipe. Slug stays entreprise unless changed in the admin.
 *
 * @package La_Suite_CSA
 */

get_header();

$copy = la_suite_csa_copy_get( 'about' );

get_template_part(
	'template-parts/page-intro',
	null,
	array(
		'eyebrow' => 'Équipe',
		'title'   => $copy['title'],
		'lede'    => $copy['lead'],
	)
);
?>

<section class="content-section">
	<div class="section-block section-block--narrow">
		<div class="prose-stack reveal">
			<?php foreach ( $copy['body'] as $paragraph ) : ?>
				<p><?php echo esc_html( $paragraph ); ?></p>
			<?php endforeach; ?>
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
		<ul class="feature-grid feature-grid--five" data-stagger>
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
