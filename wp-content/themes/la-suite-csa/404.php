<?php
/**
 * 404 template.
 *
 * @package La_Suite_CSA
 */

get_header();

$copy = la_suite_csa_copy_get( '404' );

get_template_part(
	'template-parts/page-intro',
	null,
	array(
		'eyebrow' => '404',
		'title'   => $copy['title'],
		'lede'    => $copy['text'],
	)
);
?>

<section class="content-section">
	<div class="section-block">
		<a class="btn" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php echo esc_html( $copy['cta'] ); ?></a>
	</div>
</section>

<?php
get_footer();
