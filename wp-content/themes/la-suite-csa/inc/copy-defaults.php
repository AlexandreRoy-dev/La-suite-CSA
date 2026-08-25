<?php
/**
 * Default marketing copy (fr-CA) for La Suite CSA Inc.
 * Services: Financements, Subventions, Crédits d'impôt.
 *
 * @package La_Suite_CSA
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Return the site copy map.
 *
 * @return array<string, mixed>
 */
function la_suite_csa_copy() {
	static $copy = null;

	if ( null !== $copy ) {
		return $copy;
	}

	$copy = array(
		'nav'     => array(
			'accueil'    => 'Accueil',
			'services'   => 'Services',
			'entreprise' => 'Entreprise',
			'ressources' => 'Ressources',
			'outils'     => 'Outils',
			'contact'    => 'Contact',
			'blog'       => 'Blogue',
		),
		'footer'  => array(
			'blurb' => 'La Suite CSA Inc. accompagne les entreprises du Québec en financements, subventions et crédits d’impôt.',
		),
		'home'    => array(
			'hero_headline'     => 'Le financement et les aides, clarifiés.',
			'hero_eyebrow'      => 'Suite financière pour PME québécoises',
			'hero_brand_line_1' => 'La Suite',
			'hero_brand_line_2' => 'CSA',
			'hero_text'         => 'Structurer vos demandes de financement, subventions et crédits d’impôt, clairement.',
			'hero_cta_label'    => 'Réserver un appel',
			'hero_cta_url'      => '/contact/',
			'promise_text'      => 'Quand vous voulez avancer, nous structurons **financement, subventions et crédits d’impôt** autour d’une méthode claire, sans jargon.',
			'lever_1_title'     => 'Financements',
			'lever_1_text'      => 'Structuration et accompagnement de vos démarches…',
			'lever_2_title'     => 'Subventions',
			'lever_2_text'      => 'Programmes adaptés à votre réalité d’entreprise…',
			'lever_3_title'     => 'Crédits d’impôt',
			'lever_3_text'      => 'Repérage et optimisation des crédits pertinents…',
			'hero_meta'         => array(
				'Entreprises du Québec',
				'Trois leviers, une suite',
				'Approche concrète',
			),
			'pulse'             => array(
				'Investissement Québec',
				'BDC',
				'Revenu Québec',
				'ARC',
				'clicSÉQUR',
				'EDC',
				'Innovation Canada',
				'Registre des entreprises',
			),
			'problem_eyebrow'   => 'Contexte',
			'problem_title'     => 'Les occasions existent. Encore faut-il les saisir.',
			'problem_text'      => 'Entre les programmes publics, les critères changeants et la paperasse, beaucoup d’entreprises passent à côté d’argent auquel elles auraient droit. Notre rôle : tracer le chemin et accélérer les dossiers.',
			'problem_points'    => array(
				array(
					'label' => 'Programmes',
					'text'  => 'Des aides dispersées, peu lisibles au quotidien.',
				),
				array(
					'label' => 'Critères',
					'text'  => 'Des exigences qui bougent et freinent les dossiers.',
				),
				array(
					'label' => 'Décision',
					'text'  => 'Une suite claire pour passer à l’action.',
				),
			),
			'expertise_eyebrow' => 'Nos services',
			'services_title'    => 'Trois leviers pour avancer.',
			'services_intro'    => 'Financements, subventions et crédits d’impôt : une suite claire pour soutenir vos projets de croissance, d’innovation ou d’investissement.',
			'services'          => array(
				array(
					'title' => 'Financements',
					'text'  => 'Structuration et accompagnement dans vos démarches de financement, pour présenter un dossier solide aux bons interlocuteurs.',
					'link'  => '/services/financements/',
				),
				array(
					'title' => 'Subventions',
					'text'  => 'Identification des programmes adaptés à votre réalité, préparation des demandes et suivi jusqu’à la décision.',
					'link'  => '/services/subventions/',
				),
				array(
					'title' => 'Crédits d’impôt',
					'text'  => 'Repérage et optimisation des crédits d’impôt auxquels votre entreprise peut prétendre, avec une lecture nette des exigences.',
					'link'  => '/services/credits-impot/',
				),
			),
			'service_chips'     => array(),
			'trust'             => array(
				array(
					'label' => 'Focus',
					'value' => 'Entreprises. Pas de jargon inutile.',
				),
				array(
					'label' => 'Méthode',
					'value' => 'Diagnostic, dossier, suivi',
				),
				array(
					'label' => 'Résultat',
					'value' => 'Des démarches qui aboutissent',
				),
			),
			'method_eyebrow'    => 'Déroulement',
			'method_title'      => 'Comment ça se passe',
			'method_steps'      => array(
				array(
					'title' => 'Vous nous parlez du projet',
					'text'  => 'Un échange court pour comprendre votre entreprise, vos échéances et ce qui est réaliste à viser.',
				),
				array(
					'title' => 'On cartographie les leviers',
					'text'  => 'Financement, subventions, crédits d’impôt : on identifie ce qui colle vraiment à votre situation.',
				),
				array(
					'title' => 'On bâtit le dossier',
					'text'  => 'Documents, arguments, critères : un dossier clair, prêt à présenter aux bons interlocuteurs.',
				),
				array(
					'title' => 'Dépôt et échanges',
					'text'  => 'Nous accompagnons le dépôt et les allers-retours, pour éviter les angles morts administratifs.',
				),
				array(
					'title' => 'Suivi jusqu’à la réponse',
					'text'  => 'Vous gardez le fil. On reste dans le dossier jusqu’à obtenir des réponses concrètes.',
				),
			),
			'quote_text'        => 'L’argent disponible pour votre entreprise ne sert à rien s’il reste enfoui dans des programmes mal compris.',
			'quote_attr'        => 'La Suite CSA Inc.',
			'perspectives_eyebrow' => 'Blogue',
			'perspectives_title'   => 'Des notes pour vos prochaines démarches.',
			'perspectives_intro'   => 'Articles à venir : programmes, critères et conseils pour les entreprises du Québec.',
			'cta_title'         => 'Votre projet mérite d’être financé correctement.',
			'cta_text'          => 'Parlez-nous de votre situation. Nous vous dirons rapidement ce qui est réaliste : financement, subvention, crédit d’impôt, ou une combinaison.',
			'cta_label'         => 'Nous contacter',
			'cta_url'           => '/contact/',
		),
		'services'=> array(
			'title'       => 'Services',
			'intro'       => 'Trois services. Un même objectif : ouvrir l’accès au capital et aux aides dont votre entreprise a besoin.',
			'sections'    => array(
				array(
					'title' => 'Financements',
					'text'  => 'Nous vous aidons à préparer et à présenter vos demandes de financement. Analyse de besoin, montages possibles, interlocuteurs pertinents et dossier argumenté pour maximiser vos chances.',
					'link'  => '/services/financements/',
				),
				array(
					'title' => 'Subventions',
					'text'  => 'Cartographie des programmes (fédéraux, provinciaux, régionaux) adaptés à votre secteur et à votre projet. Rédaction et dépôt des demandes, réponses aux questions des organismes, suivi administratif.',
					'link'  => '/services/subventions/',
				),
				array(
					'title' => 'Crédits d’impôt',
					'text'  => 'Identification des crédits d’impôt applicables à vos activités. Collecte des pièces, structure du dossier et coordination avec vos comptables ou fiscalistes au besoin.',
					'link'  => '/services/credits-impot/',
				),
			),
			'note'        => 'Les programmes et crédits d’impôt évoluent. Chaque dossier est évalué selon les critères en vigueur et l’admissibilité de votre entreprise.',
			'cta_label'   => 'Discuter de votre dossier',
			'cta_url'     => '/contact/',
		),
		'about'   => array(
			'title'        => 'Entreprise',
			'lead'         => 'La Suite CSA Inc. est un cabinet québécois dédié aux financements, aux subventions et aux crédits d’impôt pour les entreprises.',
			'body'         => array(
				'Nous travaillons avec des dirigeants qui veulent avancer sans se perdre dans la complexité administrative. Notre valeur : clarifier ce qui est accessible, prioriser, et accompagner le dossier jusqu’au bout.',
				'« La Suite », parce que le financement d’entreprise se joue rarement en un seul geste. C’est un enchaînement de décisions, de demandes et de suivis. CSA, c’est notre signature d’exigence et de rigueur.',
				'Que votre priorité soit d’obtenir du capital, de débloquer une subvention ou de récupérer des crédits d’impôt, nous structurons le parcours avec vous.',
			),
			'values_title' => 'Ce qui nous guide',
			'values'       => array(
				array(
					'title' => 'Clarté',
					'text'  => 'Vous savez ce qui est réaliste, ce qui ne l’est pas, et pourquoi.',
				),
				array(
					'title' => 'Rigueur',
					'text'  => 'Des dossiers préparés pour passer les filtres, pas pour « essayer ».',
				),
				array(
					'title' => 'Proximité',
					'text'  => 'Un accompagnement humain, ancré dans les réalités des entreprises du Québec.',
				),
			),
			'team_eyebrow' => 'Équipe',
			'team_title'   => 'Trois fondateurs. Une même exigence.',
			'team_intro'   => 'L’équipe fondatrice porte la vision, les dossiers et la relation client. Remplacez les noms et photos par les vôtres quand vous serez prêts.',
			'team'         => array(
				array(
					'name'  => 'Fondateur 1',
					'role'  => 'Cofondateur · Direction',
					'bio'   => 'Vision, priorisation des dossiers et relation avec les dirigeants.',
					'photo' => 'founder-1',
				),
				array(
					'name'  => 'Fondateur 2',
					'role'  => 'Cofondateur · Financements',
					'bio'   => 'Montages, interlocuteurs et dossiers prêts pour les prêteurs.',
					'photo' => 'founder-2',
				),
				array(
					'name'  => 'Fondateur 3',
					'role'  => 'Cofondateur · Aides & crédits',
					'bio'   => 'Subventions, crédits d’impôt et conformité des demandes.',
					'photo' => 'founder-3',
				),
			),
			'cta_label'    => 'Entrer en contact',
			'cta_url'      => '/contact/',
		),
		'contact' => array(
			'title'       => 'Contact',
			'intro'       => 'Parlez-nous de votre entreprise et de votre projet. Nous vous répondons rapidement.',
			'form_note'   => 'Les champs marqués d’un astérisque sont obligatoires. Vos renseignements restent confidentiels.',
			'label_name'  => 'Nom complet *',
			'label_email' => 'Courriel *',
			'label_phone' => 'Téléphone',
			'label_msg'   => 'Votre projet en quelques mots *',
			'submit'      => 'Envoyer le message',
			'success'     => 'Merci. Nous vous contactons sous peu.',
			'aside_title' => 'Autres moyens',
			'aside_text'  => 'Préférez écrire ou téléphoner directement ? Utilisez les coordonnées ci-dessous.',
		),
		'blog'    => array(
			'title'      => 'Blogue',
			'eyebrow'    => 'Perspectives',
			'intro'      => 'Conseils et mises à jour sur les financements, subventions et crédits d’impôt au Québec.',
			'empty'      => 'Le blogue ouvrira bientôt. En attendant, explorez nos ressources et outils, ou parlez-nous de votre dossier.',
			'empty_note' => 'Sujets à venir',
			'topics'     => array(
				'Nouveaux programmes et critères',
				'Crédits d’impôt et RS&DE',
				'Dossiers qui passent les filtres',
				'Erreurs fréquentes à éviter',
			),
			'read_more'  => 'Lire l’article',
			'back'       => 'Retour au blogue',
		),
		'meta'    => array(
			'home_title'     => 'La Suite CSA Inc. | Financements, subventions et crédits d’impôt',
			'home_desc'      => 'La Suite CSA Inc. accompagne les entreprises du Québec : financements, subventions et crédits d’impôt.',
			'services_title' => 'Services | La Suite CSA Inc.',
			'services_desc'  => 'Financements, subventions et crédits d’impôt pour les entreprises québécoises.',
			'about_title'    => 'Entreprise | La Suite CSA Inc.',
			'about_desc'     => 'Découvrez La Suite CSA Inc., cabinet québécois en financements, subventions et crédits d’impôt.',
			'contact_title'  => 'Contact | La Suite CSA Inc.',
			'contact_desc'   => 'Contactez La Suite CSA Inc. pour discuter de votre dossier de financement, de subvention ou de crédit d’impôt.',
			'blog_title'         => 'Blogue | La Suite CSA Inc.',
			'blog_desc'          => 'Articles à venir sur les financements, subventions et crédits d’impôt au Québec.',
			'ressources_title'   => 'Ressources | La Suite CSA Inc.',
			'ressources_desc'    => 'Annuaire des portails officiels : ARC, Revenu Québec, clicSÉQUR, Investissement Québec, subventions et plus.',
		),
		'404'     => array(
			'title' => 'Page introuvable',
			'text'  => 'Cette page n’existe pas ou a été déplacée.',
			'cta'   => 'Retour à l’accueil',
		),
	);

	return $copy;
}

/**
 * Get a nested copy string by dot path.
 *
 * @param string $path Dot path, e.g. home.hero_headline.
 * @param string $default Default.
 * @return string|array|mixed
 */
function la_suite_csa_copy_get( $path, $default = '' ) {
	$parts = explode( '.', $path );
	$node  = la_suite_csa_copy();

	foreach ( $parts as $part ) {
		if ( ! is_array( $node ) || ! array_key_exists( $part, $node ) ) {
			return $default;
		}
		$node = $node[ $part ];
	}

	return $node;
}

/**
 * ACF field with French default fallback.
 *
 * @param string $key Field key.
 * @param string $copy_path Path in copy map.
 * @param int|null $post_id Post ID.
 * @return string
 */
function la_suite_csa_field_or_copy( $key, $copy_path, $post_id = null ) {
	$value = la_suite_csa_get_field( $key, $post_id );

	if ( is_string( $value ) && '' !== trim( $value ) ) {
		return $value;
	}

	$fallback = la_suite_csa_copy_get( $copy_path, '' );
	return is_string( $fallback ) ? $fallback : '';
}

/**
 * Escape copy and convert **bold** markers to <strong>.
 *
 * @param string $text Raw text.
 * @return string Safe HTML.
 */
function la_suite_csa_format_marked_text( $text ) {
	$escaped = esc_html( (string) $text );
	return (string) preg_replace( '/\*\*(.+?)\*\*/u', '<strong>$1</strong>', $escaped );
}
