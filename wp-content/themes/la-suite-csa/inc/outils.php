<?php
/**
 * Interactive calculators (Outils).
 *
 * @package La_Suite_CSA
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Calculator definitions for the Outils page.
 *
 * @return array<string, mixed>
 */
function la_suite_csa_outils() {
	return array(
		'title'      => 'Outils',
		'eyebrow'    => 'Calculateurs',
		'lead'       => 'Estimations rapides pour vos décisions de financement, d’emprunt et de fiscalité. Indicatives uniquement : chaque dossier reste unique.',
		'disclaimer' => 'Ces calculateurs sont fournis à titre informatif. Ils ne remplacent pas un avis professionnel, une offre de prêteur ni une lecture officielle d’un programme ou d’un crédit d’impôt.',
		'cta_label'  => 'Un chiffre, et ensuite ?',
		'cta_text'   => 'Nous transformons l’estimation en dossier crédible auprès des bons interlocuteurs.',
		'cta_button' => 'Parler à un conseiller',
		'cta_url'    => '/contact/',
		'tools'      => array(
			array(
				'id'          => 'hypotheque',
				'title'       => 'Paiement de prêt / hypothèque',
				'summary'     => 'Mensualité selon le montant, le taux et l’amortissement (style canadien).',
				'fields'      => array(
					array( 'name' => 'principal', 'label' => 'Montant du prêt ($)', 'type' => 'number', 'min' => 1000, 'step' => 1000, 'value' => 350000 ),
					array( 'name' => 'rate', 'label' => 'Taux annuel (%)', 'type' => 'number', 'min' => 0.1, 'step' => 0.05, 'value' => 4.89 ),
					array( 'name' => 'amortYears', 'label' => 'Amortissement (années)', 'type' => 'number', 'min' => 1, 'step' => 1, 'value' => 25 ),
					array( 'name' => 'termYears', 'label' => 'Terme (années)', 'type' => 'number', 'min' => 1, 'step' => 1, 'value' => 5 ),
				),
			),
			array(
				'id'          => 'capacite',
				'title'       => 'Capacité d’emprunt',
				'summary'     => 'Montant maximal approximatif selon une mensualité cible.',
				'fields'      => array(
					array( 'name' => 'payment', 'label' => 'Mensualité souhaitée ($)', 'type' => 'number', 'min' => 100, 'step' => 50, 'value' => 1800 ),
					array( 'name' => 'rate', 'label' => 'Taux annuel (%)', 'type' => 'number', 'min' => 0.1, 'step' => 0.05, 'value' => 4.89 ),
					array( 'name' => 'amortYears', 'label' => 'Amortissement (années)', 'type' => 'number', 'min' => 1, 'step' => 1, 'value' => 25 ),
				),
			),
			array(
				'id'          => 'interet',
				'title'       => 'Coût total des intérêts',
				'summary'     => 'Intérêt et capital remboursé sur le terme choisi.',
				'fields'      => array(
					array( 'name' => 'principal', 'label' => 'Montant du prêt ($)', 'type' => 'number', 'min' => 1000, 'step' => 1000, 'value' => 250000 ),
					array( 'name' => 'rate', 'label' => 'Taux annuel (%)', 'type' => 'number', 'min' => 0.1, 'step' => 0.05, 'value' => 5.25 ),
					array( 'name' => 'amortYears', 'label' => 'Amortissement (années)', 'type' => 'number', 'min' => 1, 'step' => 1, 'value' => 20 ),
					array( 'name' => 'termYears', 'label' => 'Période analysée (années)', 'type' => 'number', 'min' => 1, 'step' => 1, 'value' => 5 ),
				),
			),
			array(
				'id'          => 'tvq',
				'title'       => 'TPS + TVQ (Québec)',
				'summary'     => 'Taxes de vente sur un montant hors taxes ou toutes taxes comprises.',
				'fields'      => array(
					array( 'name' => 'amount', 'label' => 'Montant ($)', 'type' => 'number', 'min' => 0, 'step' => 0.01, 'value' => 10000 ),
					array(
						'name'    => 'mode',
						'label'   => 'Mode',
						'type'    => 'select',
						'options' => array(
							array( 'value' => 'ht', 'label' => 'Hors taxes → TTC' ),
							array( 'value' => 'ttc', 'label' => 'TTC → hors taxes' ),
						),
						'value'   => 'ht',
					),
				),
			),
			array(
				'id'          => 'subvention',
				'title'       => 'Part subventionnée',
				'summary'     => 'Quote-part de l’aide et reste à financer pour un projet.',
				'fields'      => array(
					array( 'name' => 'cost', 'label' => 'Coût du projet ($)', 'type' => 'number', 'min' => 0, 'step' => 100, 'value' => 150000 ),
					array( 'name' => 'rate', 'label' => 'Taux d’aide (%)', 'type' => 'number', 'min' => 0, 'step' => 0.5, 'value' => 40 ),
					array( 'name' => 'ceiling', 'label' => 'Plafond de l’aide ($)', 'type' => 'number', 'min' => 0, 'step' => 1000, 'value' => 75000 ),
				),
			),
			array(
				'id'          => 'credit',
				'title'       => 'Crédit d’impôt estimé',
				'summary'     => 'Estimation simple : dépenses admissibles × taux du crédit.',
				'fields'      => array(
					array( 'name' => 'spend', 'label' => 'Dépenses admissibles ($)', 'type' => 'number', 'min' => 0, 'step' => 100, 'value' => 80000 ),
					array( 'name' => 'rate', 'label' => 'Taux du crédit (%)', 'type' => 'number', 'min' => 0, 'step' => 0.5, 'value' => 30 ),
				),
			),
			array(
				'id'          => 'seuil',
				'title'       => 'Seuil de rentabilité',
				'summary'     => 'Volume à atteindre pour couvrir les frais fixes.',
				'fields'      => array(
					array( 'name' => 'fixed', 'label' => 'Frais fixes ($ / période)', 'type' => 'number', 'min' => 0, 'step' => 100, 'value' => 12000 ),
					array( 'name' => 'price', 'label' => 'Prix de vente unitaire ($)', 'type' => 'number', 'min' => 0.01, 'step' => 0.01, 'value' => 85 ),
					array( 'name' => 'variable', 'label' => 'Coût variable unitaire ($)', 'type' => 'number', 'min' => 0, 'step' => 0.01, 'value' => 35 ),
				),
			),
			array(
				'id'          => 'marge',
				'title'       => 'Marge brute',
				'summary'     => 'Marge et coefficient à partir du coût et du prix.',
				'fields'      => array(
					array( 'name' => 'cost', 'label' => 'Coût ($)', 'type' => 'number', 'min' => 0, 'step' => 0.01, 'value' => 42 ),
					array( 'name' => 'price', 'label' => 'Prix de vente ($)', 'type' => 'number', 'min' => 0.01, 'step' => 0.01, 'value' => 69 ),
				),
			),
			array(
				'id'          => 'roi',
				'title'       => 'ROI et récupération',
				'summary'     => 'Retour sur investissement et délai de récupération.',
				'fields'      => array(
					array( 'name' => 'invest', 'label' => 'Investissement ($)', 'type' => 'number', 'min' => 1, 'step' => 100, 'value' => 50000 ),
					array( 'name' => 'gain', 'label' => 'Gain net annuel ($)', 'type' => 'number', 'min' => 0, 'step' => 100, 'value' => 14000 ),
				),
			),
			array(
				'id'          => 'endettement',
				'title'       => 'Ratio d’endettement',
				'summary'     => 'Poids des mensualités sur le revenu (indicatif).',
				'fields'      => array(
					array( 'name' => 'income', 'label' => 'Revenu mensuel brut ($)', 'type' => 'number', 'min' => 1, 'step' => 100, 'value' => 8500 ),
					array( 'name' => 'housing', 'label' => 'Frais logement ($ / mois)', 'type' => 'number', 'min' => 0, 'step' => 50, 'value' => 2100 ),
					array( 'name' => 'debts', 'label' => 'Autres dettes ($ / mois)', 'type' => 'number', 'min' => 0, 'step' => 50, 'value' => 450 ),
				),
			),
		),
	);
}
