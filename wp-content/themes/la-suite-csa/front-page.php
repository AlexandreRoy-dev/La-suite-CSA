<?php
/**
 * Front page: Accueil - Devis Expert-style canvas hero.
 *
 * @package La_Suite_CSA
 */

get_header();

$hero_eyebrow      = la_suite_csa_field_or_copy( 'hero_eyebrow', 'home.hero_eyebrow' );
$hero_brand_line_1 = la_suite_csa_field_or_copy( 'hero_brand_line_1', 'home.hero_brand_line_1' );
$hero_brand_line_2 = la_suite_csa_field_or_copy( 'hero_brand_line_2', 'home.hero_brand_line_2' );
$hero_text         = la_suite_csa_field_or_copy( 'hero_text', 'home.hero_text' );
$hero_cta_label    = la_suite_csa_field_or_copy( 'hero_cta_label', 'home.hero_cta_label' );
$hero_cta_url      = la_suite_csa_field_or_copy( 'hero_cta_url', 'home.hero_cta_url' );
$promise_text      = la_suite_csa_field_or_copy( 'promise_text', 'home.promise_text' );
$home              = la_suite_csa_copy_get( 'home' );
$cta_media         = la_suite_csa_media_get( 'cta' );
$pulse             = ! empty( $home['pulse'] ) && is_array( $home['pulse'] ) ? $home['pulse'] : array();
$services          = ! empty( $home['services'] ) && is_array( $home['services'] ) ? $home['services'] : array();

$hero_visual = function_exists( 'get_field' ) ? get_field( 'hero_visual' ) : null;
$hero_visual_src = get_template_directory_uri() . '/assets/images/hero-suite.svg';
$hero_visual_w   = 720;
$hero_visual_h   = 480;
if ( is_array( $hero_visual ) && ! empty( $hero_visual['url'] ) ) {
	$hero_visual_src = $hero_visual['url'];
	$hero_visual_w   = ! empty( $hero_visual['width'] ) ? (int) $hero_visual['width'] : 720;
	$hero_visual_h   = ! empty( $hero_visual['height'] ) ? (int) $hero_visual['height'] : 480;
}

$glass_levers = array();
for ( $i = 1; $i <= 3; $i++ ) {
	$glass_levers[] = array(
		'title' => la_suite_csa_field_or_copy( 'lever_' . $i . '_title', 'home.lever_' . $i . '_title' ),
		'text'  => la_suite_csa_field_or_copy( 'lever_' . $i . '_text', 'home.lever_' . $i . '_text' ),
	);
}
if ( empty( array_filter( wp_list_pluck( $glass_levers, 'title' ) ) ) && $services ) {
	$glass_levers = array();
	foreach ( array_slice( $services, 0, 3 ) as $service ) {
		$glass_levers[] = array(
			'title' => $service['title'],
			'text'  => wp_trim_words( $service['text'], 9, '…' ),
		);
	}
}
?>

<section class="hero hero--canvas" aria-label="Accueil">
	<div class="hero__atmosphere" aria-hidden="true">
		<span class="hero__orb hero__orb--a"></span>
		<span class="hero__orb hero__orb--b"></span>
		<span class="hero__orb hero__orb--c"></span>
		<span class="hero__vignette"></span>
		<span class="hero__grain"></span>
	</div>

	<?php if ( $hero_eyebrow ) : ?>
		<p class="hero-eyebrow"><span><?php echo esc_html( $hero_eyebrow ); ?></span></p>
	<?php endif; ?>

	<div class="hero-canvas">
		<h1 class="hero-brand" aria-label="<?php echo esc_attr( trim( $hero_brand_line_1 . ' ' . $hero_brand_line_2 ) ); ?>">
			<span><?php echo esc_html( $hero_brand_line_1 ); ?></span>
			<span><?php echo esc_html( $hero_brand_line_2 ); ?></span>
		</h1>

		<div class="hero-stage">
			<div class="hero-stage__glow" aria-hidden="true"></div>
			<img
				class="hero-visual"
				src="<?php echo esc_url( $hero_visual_src ); ?>"
				alt=""
				width="<?php echo esc_attr( (string) $hero_visual_w ); ?>"
				height="<?php echo esc_attr( (string) $hero_visual_h ); ?>"
				fetchpriority="high"
				decoding="async"
			>
		</div>

		<div class="hero-left">
			<p><?php echo esc_html( $hero_text ); ?></p>
			<?php if ( $hero_cta_label && $hero_cta_url ) : ?>
				<a class="button button--hero" href="<?php echo esc_url( la_suite_csa_url( $hero_cta_url ) ); ?>">
					<?php echo esc_html( $hero_cta_label ); ?>
					<span class="button__icon" aria-hidden="true">→</span>
				</a>
			<?php endif; ?>
		</div>

		<aside class="hero-right" aria-label="Leviers">
			<ul class="glass-stack">
				<?php foreach ( $glass_levers as $index => $lever ) : ?>
					<?php if ( empty( $lever['title'] ) ) { continue; } ?>
					<li class="glass-shell">
						<div class="glass-card glass-tile">
							<span class="glass-icon" aria-hidden="true"><?php echo esc_html( sprintf( '%02d', $index + 1 ) ); ?></span>
							<div class="glass-copy">
								<strong><?php echo esc_html( $lever['title'] ); ?></strong>
								<?php if ( ! empty( $lever['text'] ) ) : ?>
									<span><?php echo esc_html( $lever['text'] ); ?></span>
								<?php endif; ?>
							</div>
						</div>
					</li>
				<?php endforeach; ?>
			</ul>
			<a class="explore" href="<?php echo esc_url( home_url( '/services/' ) ); ?>">Explorer</a>
		</aside>
	</div>

	<div class="scroll-hint" aria-hidden="true">
		<span>Scroll</span>
		<i></i>
	</div>
</section>

<?php if ( $promise_text ) : ?>
	<section class="promise" aria-label="Promesse">
		<div class="glass-card promise-card">
			<p><?php echo wp_kses_post( la_suite_csa_format_marked_text( $promise_text ) ); ?></p>
		</div>
	</section>
<?php endif; ?>

<?php if ( $pulse ) : ?>
	<section class="logo-cloud" aria-label="Écosystème">
		<div class="section-block">
			<p class="logo-cloud__label reveal">Dans l’écosystème des programmes publics et privés</p>
			<div class="logo-cloud__track" aria-hidden="true">
				<div class="logo-cloud__row">
					<?php for ( $i = 0; $i < 2; $i++ ) : ?>
						<?php foreach ( $pulse as $item ) : ?>
							<span><?php echo esc_html( $item ); ?></span>
						<?php endforeach; ?>
					<?php endfor; ?>
				</div>
			</div>
		</div>
	</section>
<?php endif; ?>

<section class="content-section problem-split">
	<div class="section-block problem-split__grid">
		<header class="problem-split__intro reveal">
			<p class="eyebrow"><?php echo esc_html( $home['problem_eyebrow'] ?? 'Contexte' ); ?></p>
			<h2 class="section-header__title"><?php echo esc_html( $home['problem_title'] ); ?></h2>
			<p class="section-lede"><?php echo esc_html( $home['problem_text'] ); ?></p>
		</header>
		<?php if ( ! empty( $home['problem_points'] ) ) : ?>
			<ul class="friction-list">
				<?php foreach ( $home['problem_points'] as $index => $point ) : ?>
					<li class="friction-list__item reveal" data-reveal>
						<span class="friction-list__index" aria-hidden="true"><?php echo esc_html( sprintf( '%02d', $index + 1 ) ); ?></span>
						<div>
							<h3 class="friction-list__title"><?php echo esc_html( $point['label'] ); ?></h3>
							<p><?php echo esc_html( $point['text'] ); ?></p>
						</div>
					</li>
				<?php endforeach; ?>
			</ul>
		<?php endif; ?>
	</div>
</section>

<section class="content-section features-bands" id="services-apercu">
	<div class="section-block">
		<header class="section-header section-header--center reveal">
			<p class="eyebrow"><?php echo esc_html( $home['expertise_eyebrow'] ?? 'Nos services' ); ?></p>
			<h2 class="section-header__title"><?php echo esc_html( $home['services_title'] ); ?></h2>
			<p class="section-lede"><?php echo esc_html( $home['services_intro'] ); ?></p>
		</header>
	</div>
	<ul class="service-bands">
		<?php foreach ( $services as $index => $item ) : ?>
			<li class="service-band reveal" data-reveal>
				<div class="section-block service-band__inner">
					<span class="service-band__index" aria-hidden="true"><?php echo esc_html( sprintf( '%02d', $index + 1 ) ); ?></span>
					<div class="service-band__copy">
						<h3 class="service-band__title"><?php echo esc_html( $item['title'] ); ?></h3>
						<p><?php echo esc_html( $item['text'] ); ?></p>
					</div>
					<a class="service-band__link" href="<?php echo esc_url( home_url( $item['link'] ?? '/services/' ) ); ?>">
						En savoir plus
						<span aria-hidden="true">→</span>
					</a>
				</div>
			</li>
		<?php endforeach; ?>
	</ul>
</section>

<section class="content-section trust-saas">
	<div class="section-block">
		<ul class="trust-metrics">
			<?php foreach ( $home['trust'] as $item ) : ?>
				<li class="trust-metrics__item reveal" data-reveal>
					<p class="trust-metrics__label"><?php echo esc_html( $item['label'] ); ?></p>
					<p class="trust-metrics__value"><?php echo esc_html( $item['value'] ); ?></p>
				</li>
			<?php endforeach; ?>
		</ul>
	</div>
</section>

<section class="content-section process-section" id="processus">
	<div class="section-block">
		<header class="process-intro reveal">
			<p class="eyebrow"><?php echo esc_html( $home['method_eyebrow'] ?? 'Déroulement' ); ?></p>
			<h2 class="section-header__title" id="process-heading"><?php echo esc_html( $home['method_title'] ); ?></h2>
		</header>
		<ol class="timeline">
			<?php foreach ( $home['method_steps'] as $index => $step ) : ?>
				<li class="timeline-item" data-reveal>
					<span class="timeline-dot" aria-hidden="true"></span>
					<div class="timeline-card glass-card">
						<p class="timeline-step">Étape <?php echo esc_html( sprintf( '%02d', $index + 1 ) ); ?></p>
						<h3 class="timeline-card__title"><?php echo esc_html( $step['title'] ); ?></h3>
						<p><?php echo esc_html( $step['text'] ); ?></p>
					</div>
				</li>
			<?php endforeach; ?>
		</ol>
	</div>
</section>

<section class="content-section quote-saas">
	<div class="section-block section-block--narrow reveal">
		<blockquote class="quote quote--saas">
			<p><?php echo esc_html( $home['quote_text'] ); ?></p>
			<footer><?php echo esc_html( $home['quote_attr'] ); ?></footer>
		</blockquote>
	</div>
</section>

<?php
$team = la_suite_csa_copy_get( 'about.team' );
if ( is_array( $team ) && ! empty( $team ) ) :
	$about = la_suite_csa_copy_get( 'about' );
	?>
	<section class="content-section team-section">
		<div class="section-block">
			<header class="section-header section-header--center reveal">
				<h2 class="section-header__title"><?php echo esc_html( $about['team_title'] ); ?></h2>
				<p class="section-lede"><?php echo esc_html( $about['team_intro'] ); ?></p>
			</header>
			<ul class="team-grid">
				<?php foreach ( $team as $member ) : ?>
					<?php $photo = ! empty( $member['photo'] ) ? la_suite_csa_media_get( $member['photo'] ) : null; ?>
					<li class="team-card reveal" data-reveal>
						<figure class="team-card__media">
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
			<p class="section-cta section-cta--center reveal">
				<a class="button button--ghost" href="<?php echo esc_url( home_url( '/entreprise/' ) ); ?>">
					Découvrir l’entreprise
					<span class="button__icon" aria-hidden="true">→</span>
				</a>
			</p>
		</div>
	</section>
<?php endif; ?>

<section class="content-section band--cta band--cta-saas">
	<?php if ( $cta_media ) : ?>
		<div class="cta-media" aria-hidden="true">
			<img
				src="<?php echo esc_url( $cta_media['src'] ); ?>"
				alt=""
				width="1600"
				height="900"
				loading="lazy"
				decoding="async"
			>
		</div>
	<?php endif; ?>
	<div class="section-block section-block--narrow reveal">
		<h2 class="section-header__title"><?php echo esc_html( $home['cta_title'] ); ?></h2>
		<p class="section-lede"><?php echo esc_html( $home['cta_text'] ); ?></p>
		<p class="section-cta section-cta--center">
			<a class="button" href="<?php echo esc_url( la_suite_csa_url( $home['cta_url'] ) ); ?>">
				<?php echo esc_html( $home['cta_label'] ); ?>
				<span class="button__icon" aria-hidden="true">→</span>
			</a>
		</p>
	</div>
</section>

<?php
get_footer();
