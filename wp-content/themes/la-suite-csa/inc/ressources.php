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
function la_suite_csa_resource_catalog() {
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

/**
 * Page copy plus categories from the admin, or the bundled catalog.
 *
 * @return array<string, mixed>
 */
function la_suite_csa_ressources() {
	$data = la_suite_csa_resource_catalog();
	$live = la_suite_csa_resource_categories_from_db();

	if ( ! empty( $live ) ) {
		$data['categories'] = $live;
	} else {
		$data['categories'] = la_suite_csa_resource_categories_with_urls( $data['categories'] );
	}

	return $data;
}

/**
 * Normalize catalog items so templates always receive logo_url.
 *
 * @param array<int, array<string, mixed>> $categories Categories.
 * @return array<int, array<string, mixed>>
 */
function la_suite_csa_resource_categories_with_urls( $categories ) {
	foreach ( $categories as $index => $category ) {
		if ( empty( $category['items'] ) || ! is_array( $category['items'] ) ) {
			continue;
		}
		foreach ( $category['items'] as $item_index => $item ) {
			$file = isset( $item['logo'] ) ? (string) $item['logo'] : '';
			$categories[ $index ]['items'][ $item_index ]['logo_url'] = $file ? la_suite_csa_logo_uri( $file ) : '';
		}
	}
	return $categories;
}

/**
 * Read a resource field from ACF or post meta.
 *
 * @param int    $post_id Post ID.
 * @param string $key Field name.
 * @return mixed
 */
function la_suite_csa_resource_meta( $post_id, $key ) {
	if ( function_exists( 'get_field' ) ) {
		$value = get_field( $key, $post_id );
		if ( is_string( $value ) && '' !== trim( $value ) ) {
			return $value;
		}
		if ( ! is_string( $value ) && ! empty( $value ) ) {
			return $value;
		}
	}

	return get_post_meta( $post_id, $key, true );
}

/**
 * Logo URL for a resource: uploaded image, then a bundled file.
 *
 * @param int $post_id Post ID.
 * @return string
 */
function la_suite_csa_resource_logo_src( $post_id ) {
	if ( function_exists( 'get_field' ) ) {
		$image = get_field( 'resource_logo', $post_id );
		if ( is_array( $image ) && ! empty( $image['url'] ) ) {
			return $image['url'];
		}
		if ( is_numeric( $image ) ) {
			$url = wp_get_attachment_image_url( (int) $image, 'medium' );
			if ( $url ) {
				return $url;
			}
		}
	}

	$file = la_suite_csa_resource_meta( $post_id, 'resource_logo_file' );
	$file = is_string( $file ) ? basename( $file ) : '';
	if ( $file && file_exists( LA_SUITE_CSA_DIR . '/assets/images/logos/' . $file ) ) {
		return la_suite_csa_logo_uri( $file );
	}

	$thumb = get_the_post_thumbnail_url( $post_id, 'medium' );
	return $thumb ? $thumb : '';
}

/**
 * Published resources grouped by category, ordered for the front end.
 *
 * @return array<int, array<string, mixed>>
 */
function la_suite_csa_resource_categories_from_db() {
	if ( ! post_type_exists( 'csa_ressource' ) ) {
		return array();
	}

	$posts = get_posts(
		array(
			'post_type'      => 'csa_ressource',
			'post_status'    => 'publish',
			'posts_per_page' => -1,
			'orderby'        => array(
				'menu_order' => 'ASC',
				'title'      => 'ASC',
			),
		)
	);

	if ( empty( $posts ) ) {
		return array();
	}

	$buckets = array();

	foreach ( $posts as $post ) {
		$terms = get_the_terms( $post, 'csa_ressource_cat' );
		$term  = ( is_array( $terms ) && ! empty( $terms[0] ) && ! is_wp_error( $terms ) ) ? $terms[0] : null;
		$key   = $term ? (string) $term->term_id : '0';

		if ( ! isset( $buckets[ $key ] ) ) {
			$buckets[ $key ] = array(
				'title' => $term ? $term->name : __( 'Ressources', 'la-suite-csa' ),
				'intro' => $term ? $term->description : '',
				'sort'  => $term ? (int) get_term_meta( $term->term_id, 'csa_sort', true ) : 999,
				'items' => array(),
			);
			$buckets[ $key ]['intro'] = trim( wp_strip_all_tags( (string) $buckets[ $key ]['intro'] ) );
		}

		$url = la_suite_csa_resource_meta( $post->ID, 'resource_url' );
		if ( ! is_string( $url ) || '' === trim( $url ) ) {
			continue;
		}

		$short = la_suite_csa_resource_meta( $post->ID, 'resource_short' );

		$buckets[ $key ]['items'][] = array(
			'name'        => get_the_title( $post ),
			'short'       => is_string( $short ) ? $short : '',
			'description' => (string) la_suite_csa_resource_meta( $post->ID, 'resource_description' ),
			'tag'         => (string) la_suite_csa_resource_meta( $post->ID, 'resource_tag' ),
			'url'         => $url,
			'logo_url'    => la_suite_csa_resource_logo_src( $post->ID ),
		);
	}

	$categories = array_values( $buckets );
	usort(
		$categories,
		static function ( $a, $b ) {
			return $a['sort'] <=> $b['sort'];
		}
	);

	return array_values(
		array_filter(
			$categories,
			static function ( $category ) {
				return ! empty( $category['items'] );
			}
		)
	);
}

/**
 * Bundled logo filenames for the admin select.
 *
 * @return array<string, string>
 */
function la_suite_csa_bundled_logo_choices() {
	$choices = array(
		'' => __( 'Aucune (utiliser l’image téléversée)', 'la-suite-csa' ),
	);
	$files   = glob( LA_SUITE_CSA_DIR . '/assets/images/logos/*.{svg,png,jpg,jpeg,webp}', GLOB_BRACE );

	if ( ! is_array( $files ) ) {
		return $choices;
	}

	sort( $files );
	foreach ( $files as $file ) {
		$base = basename( $file );
		$choices[ $base ] = $base;
	}

	return $choices;
}

/**
 * Register the resource link library.
 */
function la_suite_csa_register_resource_types() {
	register_post_type(
		'csa_ressource',
		array(
			'labels'          => array(
				'name'          => __( 'Liens ressources', 'la-suite-csa' ),
				'singular_name' => __( 'Lien ressource', 'la-suite-csa' ),
				'add_new_item'  => __( 'Ajouter un lien', 'la-suite-csa' ),
				'edit_item'     => __( 'Modifier le lien', 'la-suite-csa' ),
				'menu_name'     => __( 'Liens ressources', 'la-suite-csa' ),
			),
			'public'          => false,
			'show_ui'         => true,
			'show_in_menu'    => true,
			'menu_icon'       => 'dashicons-admin-links',
			'menu_position'   => 22,
			'supports'        => array( 'title', 'page-attributes', 'thumbnail' ),
			'capability_type' => 'post',
			'map_meta_cap'    => true,
		)
	);

	register_taxonomy(
		'csa_ressource_cat',
		'csa_ressource',
		array(
			'labels'            => array(
				'name'          => __( 'Catégories', 'la-suite-csa' ),
				'singular_name' => __( 'Catégorie', 'la-suite-csa' ),
				'add_new_item'  => __( 'Ajouter une catégorie', 'la-suite-csa' ),
			),
			'public'            => false,
			'show_ui'           => true,
			'show_admin_column' => true,
			'hierarchical'      => true,
		)
	);
}
add_action( 'init', 'la_suite_csa_register_resource_types' );

/**
 * Order field on resource categories.
 *
 * @param string $taxonomy Taxonomy.
 */
function la_suite_csa_resource_cat_add_fields( $taxonomy ) {
	unset( $taxonomy );
	echo '<div class="form-field"><label for="csa_sort">' . esc_html__( 'Ordre', 'la-suite-csa' ) . '</label>';
	echo '<input name="csa_sort" id="csa_sort" type="number" value="0" min="0" step="1">';
	echo '<p>' . esc_html__( 'Plus petit en premier. La description de la catégorie s’affiche sous le titre.', 'la-suite-csa' ) . '</p></div>';
}
add_action( 'csa_ressource_cat_add_form_fields', 'la_suite_csa_resource_cat_add_fields' );

/**
 * Edit screen for the category order.
 *
 * @param WP_Term $term Term.
 */
function la_suite_csa_resource_cat_edit_fields( $term ) {
	$value = (int) get_term_meta( $term->term_id, 'csa_sort', true );
	echo '<tr class="form-field"><th scope="row"><label for="csa_sort">' . esc_html__( 'Ordre', 'la-suite-csa' ) . '</label></th><td>';
	echo '<input name="csa_sort" id="csa_sort" type="number" value="' . esc_attr( (string) $value ) . '" min="0" step="1">';
	echo '</td></tr>';
}
add_action( 'csa_ressource_cat_edit_form_fields', 'la_suite_csa_resource_cat_edit_fields' );

/**
 * Save category order.
 *
 * @param int $term_id Term ID.
 */
function la_suite_csa_save_resource_cat_order( $term_id ) {
	if ( ! current_user_can( 'manage_categories' ) ) {
		return;
	}
	// phpcs:ignore WordPress.Security.NonceVerification.Missing
	if ( ! isset( $_POST['csa_sort'] ) ) {
		return;
	}
	// phpcs:ignore WordPress.Security.NonceVerification.Missing
	update_term_meta( $term_id, 'csa_sort', (int) wp_unslash( $_POST['csa_sort'] ) );
}
add_action( 'created_csa_ressource_cat', 'la_suite_csa_save_resource_cat_order' );
add_action( 'edited_csa_ressource_cat', 'la_suite_csa_save_resource_cat_order' );

/**
 * ACF fields for each resource link. Free ACF, no repeater.
 */
function la_suite_csa_register_resource_fields() {
	if ( ! function_exists( 'acf_add_local_field_group' ) ) {
		return;
	}

	acf_add_local_field_group(
		array(
			'key'    => 'group_la_suite_csa_resource',
			'title'  => __( 'Lien', 'la-suite-csa' ),
			'fields' => array(
				array(
					'key'      => 'field_la_suite_csa_resource_url',
					'label'    => __( 'URL', 'la-suite-csa' ),
					'name'     => 'resource_url',
					'type'     => 'url',
					'required' => 1,
				),
				array(
					'key'   => 'field_la_suite_csa_resource_description',
					'label' => __( 'Description', 'la-suite-csa' ),
					'name'  => 'resource_description',
					'type'  => 'textarea',
					'rows'  => 3,
				),
				array(
					'key'   => 'field_la_suite_csa_resource_tag',
					'label' => __( 'Étiquette', 'la-suite-csa' ),
					'name'  => 'resource_tag',
					'type'  => 'text',
				),
				array(
					'key'   => 'field_la_suite_csa_resource_short',
					'label' => __( 'Nom court', 'la-suite-csa' ),
					'name'  => 'resource_short',
					'type'  => 'text',
				),
				array(
					'key'           => 'field_la_suite_csa_resource_logo',
					'label'         => __( 'Logo téléversé', 'la-suite-csa' ),
					'name'          => 'resource_logo',
					'type'          => 'image',
					'return_format' => 'array',
					'preview_size'  => 'medium',
					'library'       => 'all',
					'instructions'  => __( 'Prioritaire sur le logo du thème. Les logos foncés restent lisibles sur le fond clair de la carte.', 'la-suite-csa' ),
				),
				array(
					'key'           => 'field_la_suite_csa_resource_logo_file',
					'label'         => __( 'Logo du thème', 'la-suite-csa' ),
					'name'          => 'resource_logo_file',
					'type'          => 'select',
					'choices'       => la_suite_csa_bundled_logo_choices(),
					'allow_null'    => 1,
					'ui'            => 1,
					'return_format' => 'value',
				),
			),
			'location' => array(
				array(
					array(
						'param'    => 'post_type',
						'operator' => '==',
						'value'    => 'csa_ressource',
					),
				),
			),
			'active'   => true,
			'position' => 'normal',
		)
	);
}
add_action( 'acf/init', 'la_suite_csa_register_resource_fields' );

/**
 * One-time seed of the 17 bundled links. Skipped once any link exists.
 */
function la_suite_csa_seed_resources() {
	if ( get_option( 'la_suite_csa_ressources_seeded_v440' ) ) {
		return;
	}

	if ( ! post_type_exists( 'csa_ressource' ) ) {
		return;
	}

	$existing = get_posts(
		array(
			'post_type'      => 'csa_ressource',
			'post_status'    => 'any',
			'posts_per_page' => 1,
			'fields'         => 'ids',
		)
	);

	if ( ! empty( $existing ) ) {
		update_option( 'la_suite_csa_ressources_seeded_v440', 1, false );
		return;
	}

	$catalog = la_suite_csa_resource_catalog();
	$sort    = 0;

	foreach ( $catalog['categories'] as $category ) {
		$sort++;
		$slug = sanitize_title( $category['title'] );
		$term = term_exists( $slug, 'csa_ressource_cat' );

		if ( ! $term ) {
			$term = wp_insert_term(
				$category['title'],
				'csa_ressource_cat',
				array(
					'slug'        => $slug,
					'description' => $category['intro'],
				)
			);
		}

		if ( is_wp_error( $term ) ) {
			continue;
		}

		$term_id = is_array( $term ) ? (int) $term['term_id'] : (int) $term;
		update_term_meta( $term_id, 'csa_sort', $sort );

		$order = 0;
		foreach ( $category['items'] as $item ) {
			$order++;
			$post_id = wp_insert_post(
				array(
					'post_type'   => 'csa_ressource',
					'post_status' => 'publish',
					'post_title'  => $item['name'],
					'menu_order'  => $order,
				),
				true
			);

			if ( is_wp_error( $post_id ) ) {
				continue;
			}

			wp_set_object_terms( $post_id, array( $term_id ), 'csa_ressource_cat' );

			$meta = array(
				'resource_url'         => $item['url'],
				'resource_description' => $item['description'],
				'resource_tag'         => $item['tag'],
				'resource_short'       => $item['short'],
				'resource_logo_file'   => $item['logo'],
			);

			foreach ( $meta as $key => $value ) {
				if ( function_exists( 'update_field' ) ) {
					update_field( $key, $value, $post_id );
				} else {
					update_post_meta( $post_id, $key, $value );
				}
			}
		}
	}

	update_option( 'la_suite_csa_ressources_seeded_v440', 1, false );
}
add_action( 'init', 'la_suite_csa_seed_resources', 40 );

/**
 * Show the manual order in the resource list.
 *
 * @param array<string, string> $columns Columns.
 * @return array<string, string>
 */
function la_suite_csa_resource_columns( $columns ) {
	$columns['menu_order'] = __( 'Ordre', 'la-suite-csa' );
	return $columns;
}
add_filter( 'manage_csa_ressource_posts_columns', 'la_suite_csa_resource_columns' );

/**
 * Render the order column.
 *
 * @param string $column Column key.
 * @param int    $post_id Post ID.
 */
function la_suite_csa_resource_column( $column, $post_id ) {
	if ( 'menu_order' === $column ) {
		echo esc_html( (string) (int) get_post_field( 'menu_order', $post_id ) );
	}
}
add_action( 'manage_csa_ressource_posts_custom_column', 'la_suite_csa_resource_column', 10, 2 );

/**
 * Default the admin list to menu order.
 *
 * @param WP_Query $query Query.
 */
function la_suite_csa_resource_admin_order( $query ) {
	if ( ! is_admin() || ! $query->is_main_query() ) {
		return;
	}
	if ( 'csa_ressource' !== $query->get( 'post_type' ) ) {
		return;
	}
	if ( ! $query->get( 'orderby' ) ) {
		$query->set( 'orderby', 'menu_order title' );
		$query->set( 'order', 'ASC' );
	}
}
add_action( 'pre_get_posts', 'la_suite_csa_resource_admin_order' );
