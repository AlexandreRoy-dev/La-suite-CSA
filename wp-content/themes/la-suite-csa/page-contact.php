<?php
/**
 * Template Name: Contact
 * Contact page (fr-CA).
 *
 * @package La_Suite_CSA
 */

get_header();

$copy    = la_suite_csa_copy_get( 'contact' );
$phone   = la_suite_csa_get_phone();
$email   = la_suite_csa_get_email();
$address = la_suite_csa_get_address();

get_template_part(
	'template-parts/page-intro',
	null,
	array(
		'eyebrow' => 'Contact',
		'title'   => $copy['title'],
		'lede'    => $copy['intro'],
	)
);
?>

<section class="content-section">
	<div class="section-block contact-layout">
		<div class="contact-layout__main">

			<?php
			// phpcs:ignore WordPress.Security.NonceVerification.Recommended
			$status = isset( $_GET['contact'] ) ? sanitize_key( wp_unslash( $_GET['contact'] ) ) : '';
			if ( 'sent' === $status ) :
				?>
				<p class="form-success" role="status"><?php echo esc_html( $copy['success'] ); ?></p>
			<?php elseif ( 'error' === $status ) : ?>
				<p class="form-error" role="alert">Une erreur est survenue. Vérifiez les champs et réessayez.</p>
			<?php endif; ?>

			<form class="contact-form" method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" novalidate>
				<input type="hidden" name="action" value="la_suite_csa_contact">
				<?php wp_nonce_field( 'la_suite_csa_contact', 'la_suite_csa_contact_nonce' ); ?>

				<p class="contact-form__hp" aria-hidden="true">
					<label for="company_website"><?php esc_html_e( 'Leave blank', 'la-suite-csa' ); ?></label>
					<input type="text" name="company_website" id="company_website" tabindex="-1" autocomplete="off">
				</p>

				<p>
					<label for="contact_name"><?php echo esc_html( $copy['label_name'] ); ?></label>
					<input type="text" id="contact_name" name="contact_name" required autocomplete="name">
				</p>
				<p>
					<label for="contact_email"><?php echo esc_html( $copy['label_email'] ); ?></label>
					<input type="email" id="contact_email" name="contact_email" required autocomplete="email">
				</p>
				<p>
					<label for="contact_phone"><?php echo esc_html( $copy['label_phone'] ); ?></label>
					<input type="tel" id="contact_phone" name="contact_phone" autocomplete="tel">
				</p>
				<p>
					<label for="contact_message"><?php echo esc_html( $copy['label_msg'] ); ?></label>
					<textarea id="contact_message" name="contact_message" rows="5" required></textarea>
				</p>
				<p class="form-note"><?php echo esc_html( $copy['form_note'] ); ?></p>
				<p>
					<button type="submit" class="button"><?php echo esc_html( $copy['submit'] ); ?></button>
				</p>
			</form>
		</div>

		<aside class="contact-layout__aside">
			<h2 class="feature-grid__title"><?php echo esc_html( $copy['aside_title'] ); ?></h2>
			<p><?php echo esc_html( $copy['aside_text'] ); ?></p>
			<?php if ( $phone ) : ?>
				<p><a href="<?php echo esc_attr( la_suite_csa_tel_href( $phone ) ); ?>"><?php echo esc_html( $phone ); ?></a></p>
			<?php endif; ?>
			<?php if ( $email ) : ?>
				<p><a href="mailto:<?php echo esc_attr( $email ); ?>"><?php echo esc_html( $email ); ?></a></p>
			<?php endif; ?>
			<?php if ( $address ) : ?>
				<p><?php echo esc_html( $address ); ?></p>
			<?php endif; ?>
		</aside>
	</div>
</section>

<?php
get_footer();
