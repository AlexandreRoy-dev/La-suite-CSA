<?php
/**
 * Official business resource directory (gov portals + logos).
 *
 * @package La_Suite_CSA
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Absolute URI for a theme logo file.
 *
 * @param string $filename File under assets/images/logos/.
 * @return string
 */
function la_suite_csa_logo_uri( $filename ) {
	return LA_SUITE_CSA_URI . '/assets/images/logos/' . ltrim( $filename, '/' );
}

/**
 * Ressources page data: categories of government / crowning business portals.
 *
 * @return array<string, mixed>
 */
function la_suite_csa_ressources() {
	return array(
		'title'       => 'Ressources',
		'eyebrow'     => 'Annuaire',
		'lead'        => 'Portails officiels pour connecter vos dossiers fiscaux, demandes de financement, subventions et inscriptions d’entreprise au Québec et au Canada.',
		'note'        => 'Les sites et programmes évoluent. Les liens mènent aux portails officiels. La Suite CSA Inc. n’administre pas ces services : nous vous aidons à préparer les bons dossiers avant d’y déposer.',
		'cta_label'   => 'Besoin d’y voir clair ?',
		'cta_text'    => 'On cartographie avec vous ce qui s’applique, puis on structure le dépôt.',
		'cta_button'  => 'Parler à un conseiller',
		'cta_url'     => '/contact/',
		'categories'  => array(
			array(
				'title' => 'Fiscalité et authentification',
				'intro' => 'Comptes d’entreprise, déclarations et accès sécurisé aux services en ligne.',
				'items' => array(
					array(
						'name'        => 'Agence du revenu du Canada',
						'short'       => 'ARC',
						'description' => 'Mon dossier d’entreprise : TPS/TVH (hors Québec), retenues, impôt des sociétés et crédits fédéraux.',
						'url'         => 'https://www.canada.ca/fr/agence-revenu/services/services-electroniques/services-numeriques-entreprises/dossier-entreprise.html',
						'logo'        => 'canada.svg',
						'tag'         => 'Fédéral',
					),
					array(
						'name'        => 'Connexion au compte de l’ARC',
						'short'       => 'ARC Login',
						'description' => 'Page d’ouverture de session (partenaires bancaires ou clé GC) pour accéder aux services numériques de l’Agence.',
						'url'         => 'https://www.canada.ca/fr/agence-revenu/services/services-electroniques/services-ouverture-session-arc.html',
						'logo'        => 'arc.svg',
						'tag'         => 'Fédéral',
					),
					array(
						'name'        => 'Revenu Québec',
						'short'       => 'RQ',
						'description' => 'Mon dossier pour les entreprises : TVQ, retenues, impôts et correspondance avec Revenu Québec.',
						'url'         => 'https://www.revenuquebec.ca/fr/entreprises/mon-dossier-pour-les-entreprises/',
						'logo'        => 'revenu-quebec.svg',
						'tag'         => 'Québec',
					),
					array(
						'name'        => 'clicSÉQUR Entreprises',
						'short'       => 'clicSÉQUR',
						'description' => 'Authentification du gouvernement du Québec pour accéder aux services en ligne des ministères et organismes.',
						'url'         => 'https://www.info.clicsequr.gouv.qc.ca/entreprises',
						'logo'        => 'clicsequr.svg',
						'tag'         => 'Québec',
					),
				),
			),
			array(
				'title' => 'Financement et accompagnement',
				'intro' => 'Prêts, capital et expertise pour faire avancer vos projets.',
				'items' => array(
					array(
						'name'        => 'Investissement Québec',
						'short'       => 'IQ',
						'description' => 'Financement, programmes gouvernementaux (dont ESSOR) et accompagnement pour les entreprises du Québec.',
						'url'         => 'https://www.investquebec.com/fr/accueil',
						'logo'        => 'investissement-quebec.png',
						'tag'         => 'Québec',
					),
					array(
						'name'        => 'Programmes gouvernementaux IQ',
						'short'       => 'IQ Programmes',
						'description' => 'Vitrine des volets de programmes administrés avec Investissement Québec (appels, critères, préqualification).',
						'url'         => 'https://www.investquebec.com/fr/financement/programmes-gouvernementaux',
						'logo'        => 'iq-footer.svg',
						'tag'         => 'Québec',
					),
					array(
						'name'        => 'Banque de développement du Canada',
						'short'       => 'BDC',
						'description' => 'Financement flexible, capital et conseils pour les entrepreneur.es canadien.nes.',
						'url'         => 'https://www.bdc.ca/fr',
						'logo'        => 'bdc.svg',
						'tag'         => 'Fédéral',
					),
					array(
						'name'        => 'Exportation et développement Canada',
						'short'       => 'EDC',
						'description' => 'Assurance, financement et solutions pour exporter ou se développer à l’international.',
						'url'         => 'https://www.edc.ca/fr',
						'logo'        => 'edc.svg',
						'tag'         => 'Fédéral',
					),
					array(
						'name'        => 'Développement économique Canada pour les régions du Québec',
						'short'       => 'DEC',
						'description' => 'Programmes fédéraux de développement économique régional au Québec.',
						'url'         => 'https://dec.canada.ca/fr',
						'logo'        => 'dec-ced.png',
						'tag'         => 'Fédéral',
					),
				),
			),
			array(
				'title' => 'Subventions et innovation',
				'intro' => 'Aides non remboursables, crédits liés à l’innovation et guichets de découverte.',
				'items' => array(
					array(
						'name'        => 'Subventions et financement pour les entreprises',
						'short'       => 'Canada.ca',
						'description' => 'Guichet fédéral des subventions, contributions et options de financement pour les entreprises.',
						'url'         => 'https://www.canada.ca/fr/services/entreprises/subventions.html',
						'logo'        => 'subventions-canada.svg',
						'tag'         => 'Fédéral',
					),
					array(
						'name'        => 'Innovation Canada',
						'short'       => 'ISDE',
						'description' => 'Outil pour trouver des programmes d’innovation, de R-D et de croissance selon votre profil.',
						'url'         => 'https://innovation.canada.ca/fr',
						'logo'        => 'canada.svg',
						'tag'         => 'Fédéral',
					),
					array(
						'name'        => 'RS&DE (crédit d’impôt)',
						'short'       => 'RS&DE',
						'description' => 'Crédit d’impôt fédéral pour la recherche scientifique et le développement expérimental.',
						'url'         => 'https://www.canada.ca/fr/agence-revenu/services/impot/entreprises/sujets/financement-scientifique-experimental.html',
						'logo'        => 'arc.svg',
						'tag'         => 'Crédit d’impôt',
					),
					array(
						'name'        => 'Économie, Innovation et Énergie (Québec)',
						'short'       => 'MEIE',
						'description' => 'Ministère : politiques, programmes et ressources pour l’économie et l’innovation au Québec.',
						'url'         => 'https://www.economie.gouv.qc.ca/',
						'logo'        => 'economie-quebec.png',
						'tag'         => 'Québec',
					),
				),
			),
			array(
				'title' => 'Registres et démarrage',
				'intro' => 'Immatriculation, formalités et portails généraux pour les entreprises.',
				'items' => array(
					array(
						'name'        => 'Registre des entreprises du Québec',
						'short'       => 'REQ',
						'description' => 'Immatriculation, mise à jour du dossier d’entreprise et recherches au registre provincial.',
						'url'         => 'https://www.registreentreprises.gouv.qc.ca/',
						'logo'        => 'req.png',
						'tag'         => 'Québec',
					),
					array(
						'name'        => 'Québec.ca · Entreprises',
						'short'       => 'Québec.ca',
						'description' => 'Portail gouvernemental : démarrer, gérer et financer une entreprise au Québec.',
						'url'         => 'https://www.quebec.ca/entreprises-et-travailleurs-autonomes',
						'logo'        => 'quebec-apple.png',
						'tag'         => 'Québec',
					),
					array(
						'name'        => 'Gouvernement du Québec',
						'short'       => 'Gouv. QC',
						'description' => 'Accès central aux services en ligne et à l’information officielle du gouvernement du Québec.',
						'url'         => 'https://www.quebec.ca/',
						'logo'        => 'gouv-qc.svg',
						'tag'         => 'Québec',
					),
					array(
						'name'        => 'Canada.ca · Entreprises',
						'short'       => 'Canada.ca',
						'description' => 'Hub fédéral : démarrer une entreprise, taxes, embauche, propriété intellectuelle et plus.',
						'url'         => 'https://www.canada.ca/fr/services/entreprises.html',
						'logo'        => 'canada.svg',
						'tag'         => 'Fédéral',
					),
				),
			),
		),
	);
}
