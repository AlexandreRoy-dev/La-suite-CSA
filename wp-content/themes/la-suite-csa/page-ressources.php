<?php
/**
 * Template Name: Ressources
 * Government business portals directory (fr-CA).
 *
 * @package La_Suite_CSA
 */

get_header();

$data = la_suite_csa_ressources();
?>

<section class="content-section ressources-hero">
	<div class="section-block reveal">
		<header class="section-header">
			<h1 class="entry__title"><?php echo esc_html( $data['title'] ); ?></h1>
			<p class="section-lede"><?php echo esc_html( $data['lead'] ); ?></p>
		</header>
	</div>
</section>

<?php foreach ( $data['categories'] as $category ) : ?>
	<section class="content-section band">
		<div class="section-block">
			<header class="section-header reveal">
				<h2 class="section-header__title"><?php echo esc_html( $category['title'] ); ?></h2>
				<p class="section-lede"><?php echo esc_html( $category['intro'] ); ?></p>
			</header>

			<ul class="resource-grid">
				<?php foreach ( $category['items'] as $item ) : ?>
					<li class="resource-grid__item reveal">
						<a
							class="resource-card"
							href="<?php echo esc_url( $item['url'] ); ?>"
							target="_blank"
							rel="noopener noreferrer"
						>
							<span class="resource-card__logo">
								<?php if ( ! empty( $item['logo_url'] ) ) : ?>
									<img
										src="<?php echo esc_url( $item['logo_url'] ); ?>"
										alt=""
										width="160"
										height="64"
										loading="lazy"
										decoding="async"
									>
								<?php else : ?>
									<span class="resource-card__logo-fallback"><?php echo esc_html( $item['short'] ?? '' ); ?></span>
								<?php endif; ?>
							</span>
							<span class="resource-card__meta">
								<span class="resource-card__tag"><?php echo esc_html( $item['tag'] ); ?></span>
								<span class="resource-card__name"><?php echo esc_html( $item['name'] ); ?></span>
								<span class="resource-card__desc"><?php echo esc_html( $item['description'] ); ?></span>
								<span class="resource-card__action">
									Ouvrir le portail
									<span aria-hidden="true">↗</span>
								</span>
							</span>
						</a>
					</li>
				<?php endforeach; ?>
			</ul>
		</div>
	</section>
<?php endforeach; ?>

<section class="content-section">
	<div class="section-block section-block--narrow reveal">
		<p class="legal-note"><?php echo esc_html( $data['note'] ); ?></p>
	</div>
</section>

<section class="content-section band band--cta">
	<div class="section-block section-block--narrow reveal">
		<h2 class="section-header__title"><?php echo esc_html( $data['cta_label'] ); ?></h2>
		<p class="section-lede"><?php echo esc_html( $data['cta_text'] ); ?></p>
		<p class="section-cta">
			<a class="button" href="<?php echo esc_url( la_suite_csa_url( $data['cta_url'] ) ); ?>">
				<?php echo esc_html( $data['cta_button'] ); ?>
				<span class="button__icon" aria-hidden="true">→</span>
			</a>
		</p>
	</div>
</section>

<?php
get_footer();
