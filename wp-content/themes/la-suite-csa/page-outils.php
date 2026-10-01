<?php
/**
 * Template Name: Outils
 * Interactive business calculators (fr-CA).
 *
 * @package La_Suite_CSA
 */

get_header();

$data  = la_suite_csa_outils();
$tools = $data['tools'];

get_template_part(
	'template-parts/page-intro',
	null,
	array(
		'eyebrow' => 'Outils',
		'title'   => $data['title'],
		'lede'    => $data['lead'],
	)
);
?>

<section class="content-section band">
	<div class="section-block">
		<div class="tools-shell reveal" data-tools-root>
			<div class="tools-nav" role="tablist" aria-label="Calculateurs">
				<?php foreach ( $tools as $index => $tool ) : ?>
					<button
						type="button"
						class="tools-nav__btn<?php echo 0 === $index ? ' is-active' : ''; ?>"
						role="tab"
						id="tab-<?php echo esc_attr( $tool['id'] ); ?>"
						aria-selected="<?php echo 0 === $index ? 'true' : 'false'; ?>"
						aria-controls="panel-<?php echo esc_attr( $tool['id'] ); ?>"
						data-tool-tab="<?php echo esc_attr( $tool['id'] ); ?>"
					>
						<?php echo esc_html( $tool['title'] ); ?>
					</button>
				<?php endforeach; ?>
			</div>

			<?php foreach ( $tools as $index => $tool ) : ?>
				<div
					class="tool-panel<?php echo 0 === $index ? ' is-active' : ''; ?>"
					id="panel-<?php echo esc_attr( $tool['id'] ); ?>"
					role="tabpanel"
					aria-labelledby="tab-<?php echo esc_attr( $tool['id'] ); ?>"
					data-tool-panel="<?php echo esc_attr( $tool['id'] ); ?>"
					<?php echo 0 === $index ? '' : 'hidden'; ?>
				>
					<div class="tool-panel__intro">
						<h2 class="tool-panel__title"><?php echo esc_html( $tool['title'] ); ?></h2>
						<p><?php echo esc_html( $tool['summary'] ); ?></p>
					</div>

					<form class="tool-form" data-calculator="<?php echo esc_attr( $tool['id'] ); ?>" novalidate>
						<div class="tool-form__grid">
							<?php foreach ( $tool['fields'] as $field ) : ?>
								<p class="tool-field">
									<label for="<?php echo esc_attr( $tool['id'] . '-' . $field['name'] ); ?>">
										<?php echo esc_html( $field['label'] ); ?>
									</label>
									<?php if ( 'select' === ( $field['type'] ?? '' ) ) : ?>
										<select
											id="<?php echo esc_attr( $tool['id'] . '-' . $field['name'] ); ?>"
											name="<?php echo esc_attr( $field['name'] ); ?>"
											data-field
										>
											<?php foreach ( $field['options'] as $option ) : ?>
												<option
													value="<?php echo esc_attr( $option['value'] ); ?>"
													<?php selected( $field['value'], $option['value'] ); ?>
												>
													<?php echo esc_html( $option['label'] ); ?>
												</option>
											<?php endforeach; ?>
										</select>
									<?php else : ?>
										<input
											id="<?php echo esc_attr( $tool['id'] . '-' . $field['name'] ); ?>"
											name="<?php echo esc_attr( $field['name'] ); ?>"
											type="number"
											inputmode="decimal"
											min="<?php echo esc_attr( (string) ( $field['min'] ?? 0 ) ); ?>"
											step="<?php echo esc_attr( (string) ( $field['step'] ?? 1 ) ); ?>"
											value="<?php echo esc_attr( (string) $field['value'] ); ?>"
											data-field
										>
									<?php endif; ?>
								</p>
							<?php endforeach; ?>
						</div>
						<div class="tool-results" data-results aria-live="polite"></div>
					</form>
				</div>
			<?php endforeach; ?>
		</div>

		<p class="legal-note reveal"><?php echo esc_html( $data['disclaimer'] ); ?></p>
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
