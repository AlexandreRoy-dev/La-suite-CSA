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
			<header class="section-header section-header--flush">
				<h1 class="entry__title"><?php echo esc_html( $copy['title'] ); ?></h1>
				<p class="section-lede"><?php echo esc_html( $copy['lead'] ); ?></p>
			</header>
			<div class="prose-stack">
				<?php foreach ( $copy['body'] as $paragraph ) : ?>
					<p><?php echo esc_html( $paragraph ); ?></p>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
</section>

<?php if ( ! empty( $copy['team'] ) ) : ?>
	<section class="content-section band team-section">
		<div class="section-block">
			<header class="section-header reveal">
				<h2 class="section-header__title"><?php echo esc_html( $copy['team_title'] ); ?></h2>
				<p class="section-lede"><?php echo esc_html( $copy['team_intro'] ); ?></p>
			</header>

			<ul class="team-grid" data-stagger>
				<?php foreach ( $copy['team'] as $member ) : ?>
					<?php $photo = ! empty( $member['photo'] ) ? la_suite_csa_media_get( $member['photo'] ) : null; ?>
					<li class="team-card">
						<figure class="team-card__media mask-reveal">
							<?php if ( $photo ) : ?>
								<img
									src="<?php echo esc_url( $photo['src'] ); ?>"
									alt="<?php echo esc_attr( $photo['alt'] ?: $member['name'] ); ?>"
									width="900"
									height="1100"
									loading="lazy"
									decoding="async"
								>
							<?php else : ?>
								<span class="team-card__placeholder" aria-hidden="true"></span>
							<?php endif; ?>
						</figure>
						<div class="team-card__body">
							<p class="team-card__role"><?php echo esc_html( $member['role'] ); ?></p>
							<h3 class="team-card__name"><?php echo esc_html( $member['name'] ); ?></h3>
							<p class="team-card__bio"><?php echo esc_html( $member['bio'] ); ?></p>
						</div>
					</li>
				<?php endforeach; ?>
			</ul>
		</div>
	</section>
<?php endif; ?>

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
