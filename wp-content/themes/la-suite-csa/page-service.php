<?php
/**
 * Template Name: Service
 * Individual service detail page (fr-CA).
 *
 * @package La_Suite_CSA
 */

get_header();

$slug = get_post_field( 'post_name', get_queried_object_id() );
$data = la_suite_csa_service_page( $slug );

if ( ! $data ) {
	$data = array(
		'title'     => get_the_title(),
		'eyebrow'   => 'Services',
		'lead'      => '',
		'media'     => 'atmosphere',
		'intro'     => '',
		'points'    => array(),
		'for_whom'  => '',
		'cta_label' => 'Nous contacter',
		'cta_text'  => 'Parlez-nous de votre projet.',
		'cta_url'   => '/contact/',
		'related'   => array(),
	);
}

$media   = la_suite_csa_media_get( $data['media'] );
$atmos   = la_suite_csa_media_get( 'atmosphere' );
$all     = la_suite_csa_service_pages();
$related = array();
foreach ( $data['related'] ?? array() as $rel_slug ) {
	if ( isset( $all[ $rel_slug ] ) ) {
		$related[ $rel_slug ] = $all[ $rel_slug ];
	}
}
?>

<section class="content-section">
	<div class="section-block split-media">
		<?php if ( $media ) : ?>
			<div class="split-media__frame reveal">
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
				<h1 class="entry__title"><?php echo esc_html( $data['title'] ); ?></h1>
				<?php if ( ! empty( $data['lead'] ) ) : ?>
					<p class="section-lede"><?php echo esc_html( $data['lead'] ); ?></p>
				<?php endif; ?>
			</header>
			<?php if ( ! empty( $data['intro'] ) ) : ?>
				<div class="prose-stack">
					<p><?php echo esc_html( $data['intro'] ); ?></p>
				</div>
			<?php endif; ?>
		</div>
	</div>
</section>

<?php if ( ! empty( $data['points'] ) ) : ?>
	<section class="content-section band">
		<div class="section-block">
			<header class="section-header reveal">
				<h2 class="section-header__title"><?php echo esc_html( $data['points_title'] ?? 'Une démarche claire, étape par étape.' ); ?></h2>
			</header>
			<ul class="feature-grid">
				<?php foreach ( $data['points'] as $point ) : ?>
					<li class="feature-grid__item reveal">
						<h3 class="feature-grid__title"><?php echo esc_html( $point['title'] ); ?></h3>
						<p><?php echo esc_html( $point['text'] ); ?></p>
					</li>
				<?php endforeach; ?>
			</ul>
		</div>
	</section>
<?php endif; ?>

<?php if ( ! empty( $data['outcomes'] ) ) : ?>
	<section class="content-section">
		<div class="section-block reveal">
			<header class="section-header">
				<h2 class="section-header__title"><?php echo esc_html( $data['outcomes_title'] ?? 'Ce que vous repartez avec' ); ?></h2>
			</header>
			<ul class="deliverables-list">
				<?php foreach ( $data['outcomes'] as $item ) : ?>
					<li><?php echo esc_html( $item ); ?></li>
				<?php endforeach; ?>
			</ul>
		</div>
	</section>
<?php endif; ?>

<?php if ( $atmos ) : ?>
	<figure class="media-band reveal">
		<div class="media-band__frame">
			<div class="media-band__crop">
				<img
					class="parallax-media"
					src="<?php echo esc_url( $atmos['src'] ); ?>"
					alt="<?php echo esc_attr( $atmos['alt'] ); ?>"
					width="1600"
					height="700"
					loading="lazy"
					decoding="async"
				>
			</div>
		</div>
	</figure>
<?php endif; ?>

<?php if ( ! empty( $data['process'] ) ) : ?>
	<section class="content-section band">
		<div class="section-block">
			<header class="section-header reveal">
				<h2 class="section-header__title"><?php echo esc_html( $data['process_title'] ?? 'Comment ça se passe' ); ?></h2>
			</header>
			<div class="steps-wrap reveal">
				<ol class="steps steps--timeline" data-stagger>
					<?php foreach ( $data['process'] as $step ) : ?>
						<li class="steps__item">
							<h3 class="steps__title"><?php echo esc_html( $step['title'] ); ?></h3>
							<p><?php echo esc_html( $step['text'] ); ?></p>
						</li>
					<?php endforeach; ?>
				</ol>
			</div>
		</div>
	</section>
<?php endif; ?>

<?php if ( ! empty( $data['deliverables'] ) ) : ?>
	<section class="content-section">
		<div class="section-block context-band__grid">
			<div class="reveal">
				<header class="section-header section-header--flush">
					<h2 class="section-header__title"><?php echo esc_html( $data['deliverables_title'] ?? 'Ce qui est livré' ); ?></h2>
				</header>
				<ul class="deliverables-list">
					<?php foreach ( $data['deliverables'] as $item ) : ?>
						<li><?php echo esc_html( $item ); ?></li>
					<?php endforeach; ?>
				</ul>
			</div>
			<?php if ( ! empty( $data['for_whom'] ) ) : ?>
				<div class="service-aside reveal">
					<h2 class="feature-grid__title"><?php echo esc_html( $data['for_whom_title'] ?? 'À qui s’adresse ce service' ); ?></h2>
					<p><?php echo esc_html( $data['for_whom'] ); ?></p>
				</div>
			<?php endif; ?>
		</div>
	</section>
<?php endif; ?>

<?php if ( ! empty( $data['situations'] ) ) : ?>
	<section class="content-section band">
		<div class="section-block">
			<header class="section-header reveal">
				<h2 class="section-header__title"><?php echo esc_html( $data['situations_title'] ?? 'Situations où ce service aide' ); ?></h2>
			</header>
			<ul class="feature-grid">
				<?php foreach ( $data['situations'] as $item ) : ?>
					<li class="feature-grid__item reveal">
						<h3 class="feature-grid__title"><?php echo esc_html( $item['title'] ); ?></h3>
						<p><?php echo esc_html( $item['text'] ); ?></p>
					</li>
				<?php endforeach; ?>
			</ul>
		</div>
	</section>
<?php endif; ?>

<?php if ( ! empty( $data['pitfalls'] ) ) : ?>
	<section class="content-section">
		<div class="section-block reveal">
			<header class="section-header">
				<h2 class="section-header__title"><?php echo esc_html( $data['pitfalls_title'] ?? 'Pièges fréquents à éviter' ); ?></h2>
			</header>
			<ul class="context-points">
				<?php foreach ( $data['pitfalls'] as $item ) : ?>
					<li class="context-points__item">
						<p class="context-points__label"><?php echo esc_html( $item['label'] ); ?></p>
						<p class="context-points__text"><?php echo esc_html( $item['text'] ); ?></p>
					</li>
				<?php endforeach; ?>
			</ul>
		</div>
	</section>
<?php endif; ?>

<?php if ( ! empty( $data['note'] ) ) : ?>
	<section class="content-section">
		<div class="section-block section-block--narrow reveal">
			<p class="legal-note"><?php echo esc_html( $data['note'] ); ?></p>
		</div>
	</section>
<?php endif; ?>

<?php if ( $related ) : ?>
	<section class="content-section band">
		<div class="section-block">
			<header class="section-header reveal">
				<h2 class="section-header__title">Autres leviers de la suite</h2>
			</header>
			<ul class="expertise-grid expertise-grid--duo">
				<?php
				foreach ( $related as $rel_slug => $rel ) :
					$rel_media = la_suite_csa_media_get( $rel['media'] );
					?>
					<li class="expertise-grid__item reveal">
						<div class="tray">
							<div class="tray__inner">
								<?php if ( $rel_media ) : ?>
									<div class="tray__visual">
										<img
											src="<?php echo esc_url( $rel_media['src'] ); ?>"
											alt="<?php echo esc_attr( $rel_media['alt'] ); ?>"
											width="1200"
											height="800"
											loading="lazy"
											decoding="async"
										>
									</div>
								<?php endif; ?>
								<div class="tray__body">
									<h3 class="feature-grid__title"><?php echo esc_html( $rel['title'] ); ?></h3>
									<p><?php echo esc_html( $rel['lead'] ); ?></p>
									<a class="tray__link" href="<?php echo esc_url( home_url( '/services/' . $rel_slug . '/' ) ); ?>">
										Voir le service <span aria-hidden="true">→</span>
									</a>
								</div>
							</div>
						</div>
					</li>
				<?php endforeach; ?>
			</ul>
		</div>
	</section>
<?php endif; ?>

<section class="content-section band band--cta">
	<div class="section-block section-block--narrow reveal">
		<h2 class="section-header__title"><?php echo esc_html( $data['cta_label'] ); ?></h2>
		<p class="section-lede"><?php echo esc_html( $data['cta_text'] ?? 'Parlez-nous de votre projet. Nous vous dirons rapidement ce qui est réaliste.' ); ?></p>
		<p class="section-cta">
			<a class="button" href="<?php echo esc_url( la_suite_csa_url( $data['cta_url'] ) ); ?>">
				Nous contacter
				<span class="button__icon" aria-hidden="true">→</span>
			</a>
		</p>
	</div>
</section>

<?php
get_footer();
