<?php
/**
 * Per-service page content helpers.
 *
 * @package La_Suite_CSA
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Service page definitions keyed by slug.
 *
 * @return array<string, array<string, mixed>>
 */
function la_suite_csa_service_pages() {
	return array(
		'financements' => array(
			'title'            => 'Financements',
			'eyebrow'          => 'Services',
			'lead'             => 'Structurer une demande de financement solide, avec les bons interlocuteurs et un dossier qui tient la route.',
			'media'            => 'financements',
			'intro'            => 'Qu’il s’agisse d’un prêt, d’un fonds de roulement ou d’un montage plus complexe, nous clarifions le besoin, le montant réaliste et la façon de le présenter.',
			'points_title'     => 'Une démarche claire, étape par étape.',
			'points'           => array(
				array(
					'title' => 'Lecture du besoin',
					'text'  => 'Nous cadrons le projet, les flux et la capacité de remboursement avant d’ouvrir trop de portes.',
				),
				array(
					'title' => 'Montages possibles',
					'text'  => 'Banque, BDC, Investissement Québec ou autres leviers : on compare ce qui colle à votre réalité.',
				),
				array(
					'title' => 'Dossier argumenté',
					'text'  => 'Chiffres, récit et pièces réunies pour maximiser vos chances auprès des bons décideurs.',
				),
			),
			'outcomes_eyebrow' => 'Résultats',
			'outcomes_title'   => 'Ce que vous repartez avec',
			'outcomes'         => array(
				'Une lecture nette du montant réaliste et du type de financement.',
				'Une liste priorisée d’interlocuteurs et de leviers à aborder.',
				'Un dossier chiffré, cohérent et prêt à être présenté.',
			),
			'process_eyebrow'  => 'Déroulement',
			'process_title'    => 'Comment ça se passe',
			'process'          => array(
				array(
					'title' => 'Diagnostic',
					'text'  => 'Besoin, flux, garanties et calendrier : on pose le cadre avant de dépêcher des demandes.',
				),
				array(
					'title' => 'Stratégie',
					'text'  => 'On cible les bons canaux et on définit le récit financier à défendre.',
				),
				array(
					'title' => 'Dossier',
					'text'  => 'Pièces, projections et argumentation réunies pour un dépôt crédible.',
				),
				array(
					'title' => 'Suivi',
					'text'  => 'Questions des prêteurs, ajustements et appui jusqu’à une réponse concrète.',
				),
			),
			'deliverables_eyebrow' => 'Inclus',
			'deliverables_title'   => 'Ce qui est livré',
			'deliverables'         => array(
				'Fiche de besoin et hypothèses de financement.',
				'Cartographie des options (prêt, marge, programmes).',
				'Dossier de présentation (narratif + chiffres).',
				'Liste de pièces à réunir et calendrier de dépôt.',
			),
			'situations_eyebrow' => 'Cas types',
			'situations_title'  => 'Situations où ce service aide',
			'situations'        => array(
				array(
					'title' => 'Croissance',
					'text'  => 'Expansion, embauches ou nouveaux marchés qui demandent du capital.',
				),
				array(
					'title' => 'Équipement',
					'text'  => 'Achat ou modernisation d’actifs avec un montage adapté.',
				),
				array(
					'title' => 'Liquidités',
					'text'  => 'Fonds de roulement, consolidation ou période de tension de trésorerie.',
				),
			),
			'pitfalls_eyebrow' => 'Attention',
			'pitfalls_title'  => 'Pièges fréquents à éviter',
			'pitfalls'        => array(
				array(
					'label' => 'Montant',
					'text'  => 'Demander trop… ou trop peu, sans lien avec les flux.',
				),
				array(
					'label' => 'Récit',
					'text'  => 'Des chiffres sans histoire claire pour le prêteur.',
				),
				array(
					'label' => 'Cible',
					'text'  => 'Frapper à la mauvaise porte avec le mauvais dossier.',
				),
			),
			'for_whom_eyebrow' => 'Pour qui',
			'for_whom_title'   => 'À qui s’adresse ce service',
			'for_whom'         => 'Dirigeants qui prévoient une croissance, un achat d’équipement, une consolidation ou un besoin de liquidités.',
			'note'             => 'Aucun financement n’est garanti. Chaque dossier dépend de l’admissibilité, des critères en vigueur et de la décision du prêteur ou de l’organisme.',
			'cta_label'        => 'Discuter d’un financement',
			'cta_text'         => 'Parlez-nous de votre projet. Nous vous dirons rapidement ce qui est réaliste à viser.',
			'cta_url'          => '/contact/',
			'related'          => array( 'subventions', 'credits-impot' ),
		),
		'subventions'  => array(
			'title'            => 'Subventions',
			'eyebrow'          => 'Services',
			'lead'             => 'Repérer les programmes pertinents, préparer les demandes et suivre jusqu’à la décision.',
			'media'            => 'subventions',
			'intro'            => 'Les aides existent, mais elles sont fragmentées. Notre travail : cartographier ce qui s’applique vraiment, puis bâtir un dossier admissible.',
			'points_title'     => 'Une démarche claire, étape par étape.',
			'points'           => array(
				array(
					'title' => 'Cartographie',
					'text'  => 'Programmes fédéraux, provinciaux et régionaux filtrés selon votre secteur et votre projet.',
				),
				array(
					'title' => 'Préparation',
					'text'  => 'Rédaction, budgets, justifications et pièces pour coller aux critères en vigueur.',
				),
				array(
					'title' => 'Suivi',
					'text'  => 'Dépôt, questions des organismes et suivi administratif jusqu’à l’accusé ou l’octroi.',
				),
			),
			'outcomes_eyebrow' => 'Résultats',
			'outcomes_title'   => 'Ce que vous repartez avec',
			'outcomes'         => array(
				'Une shortlist de programmes réellement pertinents.',
				'Un dossier de demande structuré et justifié.',
				'Un suivi clair des échéances et des retours.',
			),
			'process_eyebrow'  => 'Déroulement',
			'process_title'    => 'Comment ça se passe',
			'process'          => array(
				array(
					'title' => 'Cadrage',
					'text'  => 'Projet, secteur, calendrier et enveloppe : on filtre ce qui est crédible.',
				),
				array(
					'title' => 'Sélection',
					'text'  => 'On priorise les programmes avec le meilleur rapport effort / chance.',
				),
				array(
					'title' => 'Rédaction',
					'text'  => 'Demande, budget, indicateurs et pièces alignés sur les critères.',
				),
				array(
					'title' => 'Dépôt',
					'text'  => 'Transmission, réponses aux questions et suivi jusqu’à la décision.',
				),
			),
			'deliverables_eyebrow' => 'Inclus',
			'deliverables_title'   => 'Ce qui est livré',
			'deliverables'         => array(
				'Cartographie des programmes retenus (et exclus, avec raisons).',
				'Plan de dépôt et échéancier.',
				'Dossier de demande prêt à soumettre.',
				'Suivi des échanges avec l’organisme.',
			),
			'situations_eyebrow' => 'Cas types',
			'situations_title'  => 'Situations où ce service aide',
			'situations'        => array(
				array(
					'title' => 'Innovation',
					'text'  => 'Projet numérique, R-D ou modernisation admissible.',
				),
				array(
					'title' => 'Export',
					'text'  => 'Développement de marchés ou commercialisation à l’extérieur.',
				),
				array(
					'title' => 'Productivité',
					'text'  => 'Équipement, automatisation ou gains d’efficacité à financer.',
				),
			),
			'pitfalls_eyebrow' => 'Attention',
			'pitfalls_title'  => 'Pièges fréquents à éviter',
			'pitfalls'        => array(
				array(
					'label' => 'Admissibilité',
					'text'  => 'Forcer un programme qui ne correspond pas au projet.',
				),
				array(
					'label' => 'Budget',
					'text'  => 'Des coûts mal ventilés ou non admissibles.',
				),
				array(
					'label' => 'Délais',
					'text'  => 'Partir trop tard par rapport aux appels ou périodes.',
				),
			),
			'for_whom_eyebrow' => 'Pour qui',
			'for_whom_title'   => 'À qui s’adresse ce service',
			'for_whom'         => 'Entreprises qui investissent, innovent, exportent ou modernisent et veulent une aide non remboursable lorsque c’est réaliste.',
			'note'             => 'Les programmes évoluent. Aucune subvention n’est garantie : chaque dossier est jugé selon les critères en vigueur et l’admissibilité de l’entreprise.',
			'cta_label'        => 'Explorer les subventions',
			'cta_text'         => 'Décrivez votre projet. Nous vous dirons quels programmes valent vraiment le détour.',
			'cta_url'          => '/contact/',
			'related'          => array( 'financements', 'credits-impot' ),
		),
		'credits-impot' => array(
			'title'            => 'Crédits d’impôt',
			'eyebrow'          => 'Services',
			'lead'             => 'Identifier et documenter les crédits d’impôt auxquels votre entreprise peut prétendre.',
			'media'            => 'credits',
			'intro'            => 'Les crédits (dont la RS&DE et certains crédits québécois) demandent une lecture nette des exigences. Nous structurons le dossier et coordonnons avec vos comptables ou fiscalistes au besoin.',
			'points_title'     => 'Une démarche claire, étape par étape.',
			'points'           => array(
				array(
					'title' => 'Repérage',
					'text'  => 'Quels crédits s’appliquent à vos activités, et lesquels ne valent pas le détour.',
				),
				array(
					'title' => 'Documentation',
					'text'  => 'Collecte des pièces, traçabilité des dépenses et narrative conforme aux attentes.',
				),
				array(
					'title' => 'Coordination',
					'text'  => 'Alignement avec votre équipe comptable ou fiscale pour un dépôt cohérent.',
				),
			),
			'outcomes_eyebrow' => 'Résultats',
			'outcomes_title'   => 'Ce que vous repartez avec',
			'outcomes'         => array(
				'Une vue claire des crédits potentiellement applicables.',
				'Un cadre de documentation pour les dépenses admissibles.',
				'Un dossier prêt à être validé avec vos spécialistes fiscaux.',
			),
			'process_eyebrow'  => 'Déroulement',
			'process_title'    => 'Comment ça se passe',
			'process'          => array(
				array(
					'title' => 'Portrait',
					'text'  => 'Activités, projets et dépenses : on isole ce qui peut ouvrir un crédit.',
				),
				array(
					'title' => 'Cadre',
					'text'  => 'Critères, preuves requises et trajectoire de dépôt.',
				),
				array(
					'title' => 'Dossier',
					'text'  => 'Narratif, pièces et structure des coûts pour résister à l’examen.',
				),
				array(
					'title' => 'Alignement',
					'text'  => 'Coordination avec comptables ou fiscalistes avant le dépôt final.',
				),
			),
			'deliverables_eyebrow' => 'Inclus',
			'deliverables_title'   => 'Ce qui est livré',
			'deliverables'         => array(
				'Lecture des crédits pertinents pour votre profil.',
				'Liste de pièces et journaux à conserver.',
				'Structure de dossier (récit + dépenses).',
				'Points de coordination avec votre équipe fiscale.',
			),
			'situations_eyebrow' => 'Cas types',
			'situations_title'  => 'Situations où ce service aide',
			'situations'        => array(
				array(
					'title' => 'RS&DE',
					'text'  => 'Travaux de recherche ou développement expérimental à documenter.',
				),
				array(
					'title' => 'Numérique',
					'text'  => 'Projets technologiques pouvant ouvrir des crédits liés.',
				),
				array(
					'title' => 'Croissance',
					'text'  => 'Investissements récurrents où la traçabilité fiscale prend du retard.',
				),
			),
			'pitfalls_eyebrow' => 'Attention',
			'pitfalls_title'  => 'Pièges fréquents à éviter',
			'pitfalls'        => array(
				array(
					'label' => 'Preuves',
					'text'  => 'Activités réelles, mais sans journal ni traçabilité.',
				),
				array(
					'label' => 'Périmètre',
					'text'  => 'Inclure des dépenses hors critères ou trop larges.',
				),
				array(
					'label' => 'Timing',
					'text'  => 'Reconstruire le dossier après coup, trop tard.',
				),
			),
			'for_whom_eyebrow' => 'Pour qui',
			'for_whom_title'   => 'À qui s’adresse ce service',
			'for_whom'         => 'Entreprises qui investissent en R-D, en numérique ou dans des activités ouvrant droit à des crédits provinciaux ou fédéraux.',
			'note'             => 'Les crédits d’impôt évoluent. Ce service ne remplace pas un avis fiscal formel : chaque dossier dépend des critères en vigueur et de l’admissibilité réelle.',
			'cta_label'        => 'Évaluer un crédit d’impôt',
			'cta_text'         => 'Parlez-nous de vos activités. Nous vous dirons ce qui mérite d’être documenté.',
			'cta_url'          => '/contact/',
			'related'          => array( 'financements', 'subventions' ),
		),
	);
}

/**
 * Get one service page by slug.
 *
 * @param string $slug Page slug.
 * @return array<string, mixed>|null
 */
function la_suite_csa_service_page( $slug ) {
	$all = la_suite_csa_service_pages();
	return isset( $all[ $slug ] ) ? $all[ $slug ] : null;
}

/**
 * Ensure service detail pages exist (safe on theme updates).
 */
function la_suite_csa_ensure_service_pages() {
	$parent    = get_page_by_path( 'services' );
	$parent_id = ( $parent instanceof WP_Post ) ? (int) $parent->ID : 0;

	foreach ( array_keys( la_suite_csa_service_pages() ) as $slug ) {
		$path     = $parent_id ? 'services/' . $slug : $slug;
		$existing = get_page_by_path( $path );

		if ( ! ( $existing instanceof WP_Post ) ) {
			$flat = get_page_by_path( $slug );
			if ( $flat instanceof WP_Post ) {
				$existing = $flat;
			}
		}

		$data = la_suite_csa_service_page( $slug );
		if ( ! $data ) {
			continue;
		}

		if ( $existing instanceof WP_Post ) {
			update_post_meta( $existing->ID, '_wp_page_template', 'page-service.php' );
			if ( $parent_id && (int) $existing->post_parent !== $parent_id ) {
				wp_update_post(
					array(
						'ID'          => $existing->ID,
						'post_parent' => $parent_id,
					)
				);
			}
			continue;
		}

		wp_insert_post(
			array(
				'post_title'   => $data['title'],
				'post_name'    => $slug,
				'post_status'  => 'publish',
				'post_type'    => 'page',
				'post_parent'  => $parent_id,
				'post_content' => '',
				'meta_input'   => array(
					'_wp_page_template' => 'page-service.php',
				),
			),
			true
		);
	}
}
add_action( 'after_switch_theme', 'la_suite_csa_ensure_service_pages', 20 );
add_action( 'init', 'la_suite_csa_maybe_ensure_service_pages', 30 );

/**
 * Run service page seed once per theme version.
 */
function la_suite_csa_maybe_ensure_service_pages() {
	$flag = 'la_suite_csa_service_pages_v161';
	if ( get_option( $flag ) ) {
		return;
	}
	if ( ! function_exists( 'get_page_by_path' ) ) {
		return;
	}
	la_suite_csa_ensure_service_pages();
	update_option( $flag, 1, false );
}
