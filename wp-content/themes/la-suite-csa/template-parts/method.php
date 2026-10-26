<?php
/**
 * Déroulement. Moved from the home page to Services in 5.1.0.
 *
 * @package La_Suite_CSA
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$home = la_suite_csa_copy_get( 'home' );
if ( empty( $home['method_steps'] ) || ! is_array( $home['method_steps'] ) ) {
	return;
}

$step_keys  = array( 'step_talk', 'step_map', 'step_file', 'step_exchange', 'step_follow' );
$step_media = array();
foreach ( $step_keys as $key ) {
	$step_media[] = la_suite_csa_media_get( $key );
}
?>
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
						<figure class="hpanel__fig">
							<img
								src="<?php echo esc_url( $shot['src'] ); ?>"
								alt="<?php echo esc_attr( $shot['alt'] ); ?>"
								width="<?php echo esc_attr( (string) $shot['width'] ); ?>"
								height="<?php echo esc_attr( (string) $shot['height'] ); ?>"
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
