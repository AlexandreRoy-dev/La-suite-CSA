<?php
/**
 * Page template.
 *
 * @package La_Suite_CSA
 */

get_header();
?>

<section class="content-section">
	<?php while ( have_posts() ) : ?>
		<?php the_post(); ?>
		<article <?php post_class( 'entry' ); ?>>
			<header class="entry__header">
				<h1 class="entry__title"><?php the_title(); ?></h1>
			</header>
			<div class="entry__content">
				<?php the_content(); ?>
			</div>
		</article>
	<?php endwhile; ?>
</section>

<?php
get_footer();
