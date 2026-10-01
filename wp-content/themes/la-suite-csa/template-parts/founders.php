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
<section class="team" id="equipe" data-section="light">
	<div class="wrap">
		<div class="sec-head">
			<p class="label"><?php echo esc_html( $about['team_eyebrow'] ?? 'Équipe' ); ?></p>
			<span class="hair" aria-hidden="true"></span>
		</div>
		<h2 class="team__title split"><?php echo esc_html( $about['team_title'] ); ?></h2>
		<?php if ( ! empty( $about['team_intro'] ) ) : ?>
			<p class="team__intro fade"><?php echo esc_html( $about['team_intro'] ); ?></p>
		<?php endif; ?>
		<ul class="team__grid">
			<?php foreach ( $founders as $member ) : ?>
				<li class="team__card reveal-clip" data-cursor>
					<figure class="team__photo">
						<img
							src="<?php echo esc_url( $member['photo']['src'] ); ?>"
							alt="<?php echo esc_attr( $member['photo']['alt'] ); ?>"
							width="<?php echo esc_attr( (string) $member['photo']['width'] ); ?>"
							height="<?php echo esc_attr( (string) $member['photo']['height'] ); ?>"
							loading="lazy"
							decoding="async"
						>
					</figure>
					<div class="team__body">
						<?php if ( $member['role'] ) : ?>
							<p class="label"><?php echo esc_html( $member['role'] ); ?></p>
						<?php endif; ?>
						<h3 class="team__name"><?php echo esc_html( $member['name'] ); ?></h3>
						<?php if ( $member['excerpt'] ) : ?>
							<p class="team__excerpt"><?php echo esc_html( $member['excerpt'] ); ?></p>
						<?php endif; ?>
						<?php if ( ! empty( $member['paragraphs'] ) ) : ?>
							<button
								type="button"
								class="team__more"
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
			<p class="team__cta fade">
				<a class="btn" href="<?php echo esc_url( home_url( '/entreprise/' ) ); ?>" data-magnetic>
					<span class="btn__label" data-text="Découvrir l’entreprise">Découvrir l’entreprise</span>
					<span class="btn__arrow" aria-hidden="true"></span>
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
					<p class="label"><?php echo esc_html( $member['role'] ); ?></p>
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
