<?php
/**
 * 404 template.
 *
 * @package La_Suite_CSA
 */

get_header();

$copy = la_suite_csa_copy_get( '404' );
?>

<section class="content-section">
	<header class="entry__header">
		<h1 class="entry__title"><?php echo esc_html( $copy['title'] ); ?></h1>
	</header>
	<p><?php echo esc_html( $copy['text'] ); ?></p>
	<p><a class="button" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php echo esc_html( $copy['cta'] ); ?></a></p>
</section>

<?php
get_footer();
