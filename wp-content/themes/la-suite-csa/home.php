<?php
/**
 * Blog posts index (when a static front page is set).
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
		'title'   => $blog['title'],
		'lede'    => $blog['intro'],
	)
);
?>

<section class="content-section band blog-index">
	<div class="section-block">
		<?php if ( have_posts() ) : ?>
			<ul class="post-grid">
				<?php
				$i = 0;
				while ( have_posts() ) :
					the_post();
					$i++;
					$featured = 1 === $i && ! is_paged();
					?>
					<li class="post-grid__item<?php echo $featured ? ' post-grid__item--featured' : ''; ?> reveal">
						<article <?php post_class( 'post-card' ); ?>>
							<a class="post-card__media" href="<?php the_permalink(); ?>" tabindex="-1" aria-hidden="true">
								<?php if ( has_post_thumbnail() ) : ?>
									<?php the_post_thumbnail( $featured ? 'large' : 'medium_large' ); ?>
								<?php else : ?>
									<span class="post-card__placeholder"></span>
								<?php endif; ?>
							</a>
							<div class="post-card__body">
								<p class="post-card__meta">
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
			<div class="blog-empty reveal">
				<div class="blog-empty__panel">
					<p class="blog-empty__lead"><?php echo esc_html( $blog['empty'] ); ?></p>
					<?php if ( ! empty( $blog['topics'] ) ) : ?>
						<p class="blog-empty__label"><?php echo esc_html( $blog['empty_note'] ?? '' ); ?></p>
						<ul class="blog-topics">
							<?php foreach ( $blog['topics'] as $topic ) : ?>
								<li><?php echo esc_html( $topic ); ?></li>
							<?php endforeach; ?>
						</ul>
					<?php endif; ?>
					<p class="section-cta">
						<a class="button button--ghost" href="<?php echo esc_url( home_url( '/ressources/' ) ); ?>">
							Voir les ressources
							<span class="button__icon" aria-hidden="true">→</span>
						</a>
						<a class="button" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>">
							Nous contacter
							<span class="button__icon" aria-hidden="true">→</span>
						</a>
					</p>
				</div>
			</div>
		<?php endif; ?>
	</div>
</section>

<?php
get_footer();
