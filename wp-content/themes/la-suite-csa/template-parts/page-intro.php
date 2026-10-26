<?php
/**
 * Compact inner-page hero. Same type and colour as the home hero, lighter motion.
 *
 * @package La_Suite_CSA
 *
 * @var array $args {
 *     @type string $eyebrow Small label.
 *     @type string $title   Page title.
 *     @type string $lede    Supporting sentence.
 * }
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$eyebrow = isset( $args['eyebrow'] ) ? (string) $args['eyebrow'] : '';
$title   = isset( $args['title'] ) ? (string) $args['title'] : '';
$lede    = isset( $args['lede'] ) ? (string) $args['lede'] : '';
$facade  = la_suite_csa_media_get( 'facade' );
?>
<section class="page-hero" data-section="dark">
	<?php if ( $facade ) : ?>
		<div class="page-hero__media" aria-hidden="true">
			<img
				src="<?php echo esc_url( $facade['src'] ); ?>"
				alt=""
				width="<?php echo esc_attr( (string) $facade['width'] ); ?>"
				height="<?php echo esc_attr( (string) $facade['height'] ); ?>"
				decoding="async"
			>
			<div class="page-hero__veil"></div>
		</div>
	<?php endif; ?>
	<div class="wrap page-hero__inner">
		<?php if ( $eyebrow ) : ?>
			<p class="label label--on-dark"><?php echo esc_html( $eyebrow ); ?></p>
		<?php endif; ?>
		<?php if ( $title ) : ?>
			<h1 class="page-hero__title split"><?php echo esc_html( $title ); ?></h1>
		<?php endif; ?>
		<?php if ( $lede ) : ?>
			<p class="page-hero__lede fade"><?php echo esc_html( $lede ); ?></p>
		<?php endif; ?>
	</div>
</section>
