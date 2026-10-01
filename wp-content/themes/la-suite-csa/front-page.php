<?php
/**
 * Front page. Versa-style sequence mapped onto La Suite CSA content.
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
$about             = la_suite_csa_copy_get( 'about' );
$hero_headline     = isset( $home['hero_headline'] ) ? (string) $home['hero_headline'] : '';

$hero_media = la_suite_csa_media_get( 'hero' );
$hero_src   = $hero_media ? $hero_media['src'] : '';
$hero_alt   = $hero_media ? $hero_media['alt'] : '';
$hero_w     = $hero_media ? (int) $hero_media['width'] : 2400;
$hero_h     = $hero_media ? (int) $hero_media['height'] : 1600;

$hero_visual = function_exists( 'get_field' ) ? get_field( 'hero_visual' ) : null;
if ( is_array( $hero_visual ) && ! empty( $hero_visual['url'] ) ) {
	$hero_src = $hero_visual['url'];
	$hero_alt = ! empty( $hero_visual['alt'] ) ? $hero_visual['alt'] : $hero_alt;
	$hero_w   = ! empty( $hero_visual['width'] ) ? (int) $hero_visual['width'] : $hero_w;
	$hero_h   = ! empty( $hero_visual['height'] ) ? (int) $hero_visual['height'] : $hero_h;
}

$lever_links = array(
	'/services/financements/',
	'/services/subventions/',
	'/services/credits-impot/',
);
$pillars     = array();
for ( $i = 1; $i <= 3; $i++ ) {
	$pillars[] = array(
		'title' => la_suite_csa_field_or_copy( 'lever_' . $i . '_title', 'home.lever_' . $i . '_title' ),
		'text'  => la_suite_csa_field_or_copy( 'lever_' . $i . '_text', 'home.lever_' . $i . '_text' ),
		'url'   => $lever_links[ $i - 1 ],
		'media' => la_suite_csa_media_get( la_suite_csa_service_media_key( $i - 1 ) ),
	);
}

$about_image = la_suite_csa_media_get( 'about' );
$facade      = la_suite_csa_media_get( 'facade' );
$value_image = la_suite_csa_media_get( 'value' );
$cta_image   = la_suite_csa_media_get( 'cta' );
$step_media  = array(
	la_suite_csa_media_get( 'step_talk' ),
	la_suite_csa_media_get( 'step_map' ),
	la_suite_csa_media_get( 'step_file' ),
	la_suite_csa_media_get( 'step_exchange' ),
	la_suite_csa_media_get( 'step_follow' ),
);
$phone       = la_suite_csa_get_phone();
$email       = la_suite_csa_get_email();
$address     = la_suite_csa_get_address();
$aria_title  = trim( $hero_brand_line_1 . ' ' . $hero_brand_line_2 . ' ' . $hero_headline );
?>

<section class="hero" data-section="dark">
	<div class="hero__media">
		<?php if ( $hero_src ) : ?>
			<img
				class="hero__img"
				src="<?php echo esc_url( $hero_src ); ?>"
				alt="<?php echo esc_attr( $hero_alt ); ?>"
				width="<?php echo esc_attr( (string) $hero_w ); ?>"
				height="<?php echo esc_attr( (string) $hero_h ); ?>"
				fetchpriority="high"
				decoding="async"
			>
		<?php endif; ?>
		<div class="hero__grade" aria-hidden="true"></div>
		<div class="hero__veil" aria-hidden="true"></div>
		<div class="hero__cols" aria-hidden="true"><i></i><i></i><i></i><i></i></div>
		<div class="grain" aria-hidden="true"></div>
	</div>
	<div class="hero__grid wrap">
		<div class="hero__top">
			<?php if ( $hero_eyebrow ) : ?>
				<p class="label label--on-dark hero__kicker">
					<span class="stripes" aria-hidden="true"><i></i><i></i><i></i><i></i></span>
					<?php echo esc_html( $hero_eyebrow ); ?>
				</p>
			<?php endif; ?>
		</div>
		<h1 class="hero__title" aria-label="<?php echo esc_attr( $aria_title ); ?>">
			<?php if ( $hero_brand_line_1 ) : ?>
				<span class="ln"><span class="ln__i"><?php echo esc_html( $hero_brand_line_1 ); ?></span></span>
			<?php endif; ?>
			<?php if ( $hero_brand_line_2 ) : ?>
				<span class="ln"><span class="ln__i"><?php echo esc_html( $hero_brand_line_2 ); ?></span></span>
			<?php endif; ?>
			<?php if ( $hero_headline ) : ?>
				<span class="ln ln--sentence"><span class="ln__i"><?php echo esc_html( $hero_headline ); ?></span></span>
			<?php endif; ?>
		</h1>
		<div class="hero__foot">
			<span class="hero__rule" aria-hidden="true"></span>
			<div class="hero__lede fade">
				<?php if ( $hero_text ) : ?>
					<p><?php echo esc_html( $hero_text ); ?></p>
				<?php endif; ?>
				<?php if ( $hero_cta_label && $hero_cta_url ) : ?>
					<a class="btn btn--light" href="<?php echo esc_url( la_suite_csa_url( $hero_cta_url ) ); ?>" data-magnetic>
						<span class="btn__label" data-text="<?php echo esc_attr( $hero_cta_label ); ?>"><?php echo esc_html( $hero_cta_label ); ?></span>
						<span class="btn__arrow" aria-hidden="true"></span>
					</a>
				<?php endif; ?>
			</div>
			<div class="hero__meta fade">
				<p class="label label--on-dark"><?php echo esc_html( $home['expertise_eyebrow'] ?? 'Nos services' ); ?></p>
				<p class="hero__aside">
					<?php
					$aside = array();
					foreach ( $pillars as $pillar ) {
						if ( ! empty( $pillar['title'] ) ) {
							$aside[] = esc_html( $pillar['title'] );
						}
					}
					echo implode( '<br>', $aside ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
					?>
				</p>
			</div>
			<a class="hero__scroll fade" href="#promesse" data-hover>
				<span class="label label--on-dark">Découvrir</span>
				<span class="hero__scroll-line" aria-hidden="true"></span>
			</a>
		</div>
	</div>
</section>

<section class="about" id="promesse" data-section="light">
	<div class="wrap">
		<div class="sec-head">
			<p class="label">Promesse</p>
			<span class="hair" aria-hidden="true"></span>
		</div>
		<?php if ( $promise_text ) : ?>
			<p class="about__statement" data-words><?php echo wp_kses_post( la_suite_csa_format_marked_text( $promise_text ) ); ?></p>
		<?php endif; ?>
		<div class="about__grid">
			<?php if ( $about_image ) : ?>
				<figure class="about__fig reveal-clip" data-cursor>
					<div class="about__fig-in parallax" data-speed="0.12">
						<img
							src="<?php echo esc_url( $about_image['src'] ); ?>"
							alt="<?php echo esc_attr( $about_image['alt'] ); ?>"
							width="<?php echo esc_attr( (string) $about_image['width'] ); ?>"
							height="<?php echo esc_attr( (string) $about_image['height'] ); ?>"
							loading="lazy"
							decoding="async"
						>
					</div>
				</figure>
			<?php endif; ?>
			<div class="about__copy">
				<?php if ( ! empty( $about['lead'] ) ) : ?>
					<p class="about__lead split"><?php echo esc_html( $about['lead'] ); ?></p>
				<?php endif; ?>
				<?php if ( ! empty( $about['body'][0] ) ) : ?>
					<p class="body fade"><?php echo esc_html( $about['body'][0] ); ?></p>
				<?php endif; ?>
				<?php if ( ! empty( $home['problem_points'] ) ) : ?>
					<div class="about__trio fade">
						<?php foreach ( $home['problem_points'] as $point ) : ?>
							<div>
								<p class="label"><?php echo esc_html( $point['label'] ); ?></p>
								<p><?php echo esc_html( $point['text'] ); ?></p>
							</div>
						<?php endforeach; ?>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
</section>

<section class="pillars" id="services" data-section="light">
	<div class="pillars__pin">
		<div class="wrap pillars__wrap">
			<div class="pillars__top">
				<p class="label"><?php echo esc_html( $home['expertise_eyebrow'] ?? 'Nos services' ); ?></p>
				<?php if ( ! empty( $home['services_intro'] ) ) : ?>
					<p class="pillars__intro"><?php echo esc_html( $home['services_intro'] ); ?></p>
				<?php endif; ?>
				<ol class="pillars__tabs">
					<?php foreach ( $pillars as $index => $pillar ) : ?>
						<?php if ( empty( $pillar['title'] ) ) { continue; } ?>
						<li<?php echo 0 === $index ? ' class="is-on"' : ''; ?>><span><?php echo esc_html( $pillar['title'] ); ?></span><i></i></li>
					<?php endforeach; ?>
				</ol>
			</div>
			<div class="pillars__stage">
				<div class="pillars__texts">
					<?php foreach ( $pillars as $pillar ) : ?>
						<?php if ( empty( $pillar['title'] ) ) { continue; } ?>
						<article class="pillar">
							<h2 class="pillar__title"><?php echo esc_html( $pillar['title'] ); ?></h2>
							<?php if ( ! empty( $pillar['text'] ) ) : ?>
								<p class="pillar__body"><?php echo esc_html( $pillar['text'] ); ?></p>
							<?php endif; ?>
							<a class="pillar__link" href="<?php echo esc_url( home_url( $pillar['url'] ) ); ?>">Voir le service</a>
						</article>
					<?php endforeach; ?>
				</div>
				<div class="pillars__frame" data-cursor>
					<?php foreach ( $pillars as $pillar ) : ?>
						<?php if ( empty( $pillar['media'] ) ) { continue; } ?>
						<img
							class="pillars__img"
							src="<?php echo esc_url( $pillar['media']['src'] ); ?>"
							alt="<?php echo esc_attr( $pillar['media']['alt'] ); ?>"
							width="<?php echo esc_attr( (string) $pillar['media']['width'] ); ?>"
							height="<?php echo esc_attr( (string) $pillar['media']['height'] ); ?>"
							loading="lazy"
							decoding="async"
						>
					<?php endforeach; ?>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="inter" data-section="dark">
	<div class="inter__media">
		<?php if ( $facade ) : ?>
			<img
				src="<?php echo esc_url( $facade['src'] ); ?>"
				alt=""
				width="<?php echo esc_attr( (string) $facade['width'] ); ?>"
				height="<?php echo esc_attr( (string) $facade['height'] ); ?>"
				loading="lazy"
				decoding="async"
			>
		<?php endif; ?>
	</div>
	<div class="inter__content wrap">
		<p class="label label--on-dark"><?php echo esc_html( $home['problem_eyebrow'] ?? 'Contexte' ); ?></p>
		<h2 class="inter__title split"><?php echo esc_html( $home['problem_title'] ); ?></h2>
		<p class="inter__body fade"><?php echo esc_html( $home['problem_text'] ); ?></p>
	</div>
</section>

<section class="hscroll" id="deroulement" data-section="dark">
	<div class="hscroll__pin">
		<div class="hscroll__track">
			<div class="hpanel hpanel--intro">
				<p class="label label--on-dark"><?php echo esc_html( $home['method_eyebrow'] ?? 'Déroulement' ); ?></p>
				<h2 class="hpanel__title split"><?php echo esc_html( $home['method_title'] ); ?></h2>
			</div>
			<?php foreach ( $home['method_steps'] as $index => $step ) : ?>
				<?php $shot = $step_media[ $index ] ?? null; ?>
				<article class="hpanel">
					<?php if ( $shot ) : ?>
						<figure class="hpanel__fig" data-cursor>
							<img
								src="<?php echo esc_url( $shot['src'] ); ?>"
								alt=""
								width="<?php echo esc_attr( (string) $shot['width'] ); ?>"
								height="<?php echo esc_attr( (string) $shot['height'] ); ?>"
								loading="lazy"
								decoding="async"
							>
						</figure>
					<?php endif; ?>
					<div class="hpanel__body">
						<p class="label label--on-dark"><?php echo esc_html( $home['method_eyebrow'] ?? 'Déroulement' ); ?></p>
						<h3 class="hpanel__name"><?php echo esc_html( $step['title'] ); ?></h3>
						<p><?php echo esc_html( $step['text'] ); ?></p>
					</div>
				</article>
			<?php endforeach; ?>
		</div>
		<div class="hscroll__bar wrap" aria-hidden="true">
			<span class="label label--on-dark">Défiler</span>
			<div class="hscroll__prog"><i></i></div>
		</div>
	</div>
</section>

<section class="value" id="valeur" data-section="light">
	<div class="wrap">
		<div class="sec-head">
			<p class="label"><?php echo esc_html( $about['values_title'] ?? 'Ce qui nous guide' ); ?></p>
			<span class="hair" aria-hidden="true"></span>
		</div>
		<div class="value__grid">
			<div class="value__side">
				<h2 class="value__title split"><?php echo esc_html( $about['values_title'] ); ?></h2>
				<?php if ( $value_image ) : ?>
					<figure class="value__fig reveal-clip" data-cursor>
						<div class="parallax" data-speed="0.1">
							<img
								src="<?php echo esc_url( $value_image['src'] ); ?>"
								alt="<?php echo esc_attr( $value_image['alt'] ); ?>"
								width="<?php echo esc_attr( (string) $value_image['width'] ); ?>"
								height="<?php echo esc_attr( (string) $value_image['height'] ); ?>"
								loading="lazy"
								decoding="async"
							>
						</div>
					</figure>
				<?php endif; ?>
			</div>
			<ul class="value__list">
				<?php foreach ( $about['values'] as $value ) : ?>
					<li class="vrow">
						<span class="vrow__t"><?php echo esc_html( $value['title'] ); ?></span>
						<span class="vrow__d"><?php echo esc_html( $value['text'] ); ?></span>
					</li>
				<?php endforeach; ?>
			</ul>
		</div>
	</div>
</section>

<?php
get_template_part(
	'template-parts/founders',
	null,
	array(
		'show_cta' => true,
	)
);
?>

<?php if ( ! empty( $home['quote_text'] ) ) : ?>
	<section class="engage" data-section="light">
		<div class="wrap engage__wrap">
			<p class="label"><?php echo esc_html( $home['quote_attr'] ); ?></p>
			<blockquote class="engage__quote split">
				<p><?php echo esc_html( $home['quote_text'] ); ?></p>
			</blockquote>
		</div>
	</section>
<?php endif; ?>

<section class="cta" id="contact" data-section="dark">
	<?php if ( $cta_image ) : ?>
		<div class="cta__media" aria-hidden="true">
			<img
				src="<?php echo esc_url( $cta_image['src'] ); ?>"
				alt=""
				width="<?php echo esc_attr( (string) $cta_image['width'] ); ?>"
				height="<?php echo esc_attr( (string) $cta_image['height'] ); ?>"
				loading="lazy"
				decoding="async"
			>
		</div>
	<?php endif; ?>
	<div class="cta__grade" aria-hidden="true"></div>
	<div class="wrap cta__wrap">
		<p class="label label--on-dark">Contact</p>
		<h2 class="cta__title split"><?php echo esc_html( $home['cta_title'] ); ?></h2>
		<p class="cta__lede fade"><?php echo esc_html( $home['cta_text'] ); ?></p>
		<div class="cta__row">
			<?php if ( $phone ) : ?>
				<a class="cta__link" href="<?php echo esc_attr( la_suite_csa_tel_href( $phone ) ); ?>">
					<span class="label label--on-dark">Téléphone</span>
					<span class="cta__big"><?php echo esc_html( $phone ); ?></span>
				</a>
			<?php endif; ?>
			<?php if ( $email ) : ?>
				<a class="cta__link" href="mailto:<?php echo esc_attr( $email ); ?>">
					<span class="label label--on-dark">Courriel</span>
					<span class="cta__big"><?php echo esc_html( $email ); ?></span>
				</a>
			<?php elseif ( $address ) : ?>
				<div class="cta__link">
					<span class="label label--on-dark">Adresse</span>
					<span class="cta__big"><?php echo esc_html( $address ); ?></span>
				</div>
			<?php endif; ?>
			<a class="btn btn--light" href="<?php echo esc_url( la_suite_csa_url( $home['cta_url'] ) ); ?>" data-magnetic>
				<span class="btn__label" data-text="<?php echo esc_attr( $home['cta_label'] ); ?>"><?php echo esc_html( $home['cta_label'] ); ?></span>
				<span class="btn__arrow" aria-hidden="true"></span>
			</a>
		</div>
	</div>
</section>

<?php
get_footer();
