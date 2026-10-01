<?php
/**
 * Page template.
 *
 * @package La_Suite_CSA
 */

get_header();
?>

<?php
while ( have_posts() ) :
	the_post();
	get_template_part(
		'template-parts/page-intro',
		null,
		array(
			'title' => get_the_title(),
		)
	);
endwhile;
rewind_posts();
?>
<section class="content-section">
	<?php while ( have_posts() ) : ?>
		<?php the_post(); ?>
		<article <?php post_class( 'entry' ); ?>>
			<div class="entry__content">
				<?php the_content(); ?>
			</div>
		</article>
	<?php endwhile; ?>
</section>

<?php
get_footer();
