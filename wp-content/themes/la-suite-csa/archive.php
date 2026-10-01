<?php
/**
 * Archive template.
 *
 * @package La_Suite_CSA
 */

get_header();

$blog = la_suite_csa_copy_get( 'blog' );

get_template_part(
	'template-parts/page-intro',
	null,
	array(
		'eyebrow' => $blog['eyebrow'] ?? 'Blogue',
		'title'   => wp_strip_all_tags( get_the_archive_title() ),
		'lede'    => wp_strip_all_tags( get_the_archive_description() ),
	)
);
?>

<section class="content-section band blog-index">
	<div class="section-block">
		<?php if ( have_posts() ) : ?>
			<ul class="post-grid">
				<?php while ( have_posts() ) : ?>
					<?php the_post(); ?>
					<li class="post-grid__item reveal">
						<article <?php post_class( 'post-card' ); ?>>
							<a class="post-card__media" href="<?php the_permalink(); ?>" tabindex="-1" aria-hidden="true">
								<?php if ( has_post_thumbnail() ) : ?>
									<?php the_post_thumbnail( 'medium_large' ); ?>
								<?php else : ?>
									<span class="post-card__placeholder"></span>
								<?php endif; ?>
							</a>
							<div class="post-card__body">
								<p class="post-card__meta">
									<time datetime="<?php echo esc_attr( get_the_date( DATE_W3C ) ); ?>">
										<?php echo esc_html( get_the_date() ); ?>
									</time>
								</p>
								<h2 class="post-card__title">
									<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
								</h2>
								<div class="post-card__excerpt">
									<?php the_excerpt(); ?>
								</div>
								<a class="post-card__link" href="<?php the_permalink(); ?>">
									<?php echo esc_html( $blog['read_more'] ?? 'Lire l’article' ); ?>
									<span aria-hidden="true">→</span>
								</a>
							</div>
						</article>
					</li>
				<?php endwhile; ?>
			</ul>

			<div class="blog-pagination reveal">
				<?php
				the_posts_pagination(
					array(
						'mid_size'  => 1,
						'prev_text' => '←',
						'next_text' => '→',
					)
				);
				?>
			</div>
		<?php else : ?>
			<p class="blog-empty__lead reveal"><?php esc_html_e( 'Aucun article dans cette archive.', 'la-suite-csa' ); ?></p>
		<?php endif; ?>
	</div>
</section>

<?php
get_footer();
