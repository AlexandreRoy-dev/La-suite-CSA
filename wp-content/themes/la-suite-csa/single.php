<?php
/**
 * Single post template.
 *
 * @package La_Suite_CSA
 */

get_header();

$blog = la_suite_csa_copy_get( 'blog' );
?>

<section class="content-section entry-shell">
	<div class="section-block section-block--narrow">
		<?php while ( have_posts() ) : ?>
			<?php the_post(); ?>
			<article <?php post_class( 'entry entry--single reveal' ); ?>>
				<header class="entry__header">
					<p class="eyebrow"><?php echo esc_html( $blog['eyebrow'] ?? 'Perspectives' ); ?></p>
					<h1 class="entry__title"><?php the_title(); ?></h1>
					<p class="entry__meta">
						<time datetime="<?php echo esc_attr( get_the_date( DATE_W3C ) ); ?>">
							<?php echo esc_html( get_the_date() ); ?>
						</time>
						<?php
						$cats = get_the_category();
						if ( ! empty( $cats ) ) :
							?>
							<span class="post-card__sep" aria-hidden="true">·</span>
							<span><?php echo esc_html( $cats[0]->name ); ?></span>
						<?php endif; ?>
					</p>
				</header>

				<?php if ( has_post_thumbnail() ) : ?>
					<figure class="entry__thumbnail">
						<?php the_post_thumbnail( 'large' ); ?>
					</figure>
				<?php endif; ?>

				<div class="entry__content">
					<?php the_content(); ?>
				</div>

				<footer class="entry__footer">
					<a class="tray__link" href="<?php echo esc_url( get_permalink( get_option( 'page_for_posts' ) ) ?: home_url( '/blogue/' ) ); ?>">
						← <?php echo esc_html( $blog['back'] ?? 'Retour au blogue' ); ?>
					</a>
				</footer>
			</article>
		<?php endwhile; ?>
	</div>
</section>

<?php
get_footer();
