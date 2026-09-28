<?php
/**
 * Founders grid shared by Accueil and Entreprise.
 *
 * @package La_Suite_CSA
 *
 * @var array $args {
 *     @type bool $show_cta Link toward the company page.
 * }
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$founders = la_suite_csa_founders();
if ( empty( $founders ) ) {
	return;
}

$about    = la_suite_csa_copy_get( 'about' );
$show_cta = ! empty( $args['show_cta'] );
?>
<section class="content-section team-section">
	<div class="section-block">
		<header class="section-header section-header--center reveal">
			<h2 class="section-header__title"><?php echo esc_html( $about['team_title'] ); ?></h2>
			<?php if ( ! empty( $about['team_intro'] ) ) : ?>
				<p class="section-lede"><?php echo esc_html( $about['team_intro'] ); ?></p>
			<?php endif; ?>
		</header>
		<ul class="team-grid">
			<?php foreach ( $founders as $member ) : ?>
				<li class="team-card reveal" data-reveal>
					<figure class="team-card__media">
						<img
							src="<?php echo esc_url( $member['photo']['src'] ); ?>"
							alt="<?php echo esc_attr( $member['photo']['alt'] ); ?>"
							width="<?php echo esc_attr( (string) $member['photo']['width'] ); ?>"
							height="<?php echo esc_attr( (string) $member['photo']['height'] ); ?>"
							loading="lazy"
							decoding="async"
						>
					</figure>
					<div class="team-card__body">
						<?php if ( $member['role'] ) : ?>
							<p class="team-card__role"><?php echo esc_html( $member['role'] ); ?></p>
						<?php endif; ?>
						<h3 class="team-card__name"><?php echo esc_html( $member['name'] ); ?></h3>
						<?php if ( $member['excerpt'] ) : ?>
							<p class="team-card__bio"><?php echo esc_html( $member['excerpt'] ); ?></p>
						<?php endif; ?>
						<?php if ( ! empty( $member['paragraphs'] ) ) : ?>
							<button
								type="button"
								class="team-card__more"
								aria-haspopup="dialog"
								aria-controls="<?php echo esc_attr( $member['id'] ); ?>"
								aria-label="<?php echo esc_attr( sprintf( 'Lire la bio de %s', $member['name'] ) ); ?>"
							>
								Lire la bio
							</button>
						<?php endif; ?>
					</div>
				</li>
			<?php endforeach; ?>
		</ul>
		<?php if ( $show_cta ) : ?>
			<p class="section-cta section-cta--center reveal">
				<a class="button button--ghost" href="<?php echo esc_url( home_url( '/entreprise/' ) ); ?>">
					Découvrir l’entreprise
					<span class="button__icon" aria-hidden="true">→</span>
				</a>
			</p>
		<?php endif; ?>
	</div>

	<?php foreach ( $founders as $member ) : ?>
		<?php if ( empty( $member['paragraphs'] ) ) { continue; } ?>
		<dialog class="bio-dialog" id="<?php echo esc_attr( $member['id'] ); ?>" aria-labelledby="<?php echo esc_attr( $member['id'] . '-title' ); ?>">
			<div class="bio-dialog__layout">
				<figure class="bio-dialog__photo">
					<img
						src="<?php echo esc_url( $member['photo']['src'] ); ?>"
						alt=""
						width="<?php echo esc_attr( (string) $member['photo']['width'] ); ?>"
						height="<?php echo esc_attr( (string) $member['photo']['height'] ); ?>"
					>
				</figure>
				<div class="bio-dialog__body">
					<form method="dialog">
						<button class="bio-dialog__close" value="close">Fermer</button>
					</form>
					<p class="bio-dialog__role"><?php echo esc_html( $member['role'] ); ?></p>
					<h2 class="bio-dialog__name" id="<?php echo esc_attr( $member['id'] . '-title' ); ?>"><?php echo esc_html( $member['name'] ); ?></h2>
					<div class="bio-dialog__text">
						<?php foreach ( $member['paragraphs'] as $paragraph ) : ?>
							<p><?php echo esc_html( $paragraph ); ?></p>
						<?php endforeach; ?>
					</div>
				</div>
			</div>
		</dialog>
	<?php endforeach; ?>
</section>
