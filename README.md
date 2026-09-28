# La Suite CSA Inc.

Thème WordPress vitrine, version **4.4.0**. Services : **Financements**, **Subventions**, **Crédits d’impôt**.

Direction visuelle sombre (encre, crème, bleu et vin), inspirée de la maquette [darkcsa.roymarketing.ca](https://darkcsa.roymarketing.ca/).

Staging : [https://lasuitecsa.wpcomstaging.com](https://lasuitecsa.wpcomstaging.com)

## Contenu éditable par le client (WP Admin)

| Où | Quoi |
|----|------|
| **Pages → Accueil** | Hero (sur-titre, 2 lignes de marque, texte, bouton, visuel), 3 cartes glass, texte de promesse |
| **Site Options** (menu) | Pied de page, téléphone, adresse, courriel, réseaux, fondateurs (nom, rôle, extrait, bio, photo) |
| **Liens ressources** (menu) | Annuaire de la page Ressources : ajouter, modifier, retirer, réordonner (champ Ordre), catégories, logo, URL |
| **Articles** | Blogue |
| **Médias** | Photos (hero, fondateurs, logos de ressources) |

Sur l’Accueil, utilisez `**mots**` dans le champ Promesse pour le gras.

Les champs laissés vides sur Site Options reprennent le texte et les photos livrés avec le thème. Les liens ressources sont créés une seule fois dans l’admin au premier chargement. S’il n’y a encore aucun lien, la page affiche les 17 entrées par défaut.

Le design (CSS, structure, animations) reste dans le code thème : le client ne casse pas la mise en page.

## Brand

| Role | Hex |
|------|-----|
| Cream | `#F2EEE4` |
| Ink | `#05060B`, `#090C14`, `#0D111C` |
| Cobalt | `#16378A` (lit `#4A7AE8`) |
| Wine | `#6E1C28` (lit `#B8334A`) |

**Type :** Plus Jakarta Sans, Archivo Black pour le nom dans l’en-tête.

## Déployer le thème (WordPress.com Business / Atomic)

1. Zip prêt : `la-suite-csa-theme.zip` (dossier `la-suite-csa` à la racine du zip).
2. WP Admin → **Apparence → Thèmes → Ajouter → Téléverser**.
3. Activer **La Suite CSA**.
4. Plugin **Advanced Custom Fields** (déjà actif sur le staging).
5. **Réglages → Lectures** : page d’accueil = Accueil (si besoin).
6. Ouvrir **Pages → Accueil** pour peupler / ajuster les champs.

SFTP (Atomic) : `sftp.wp.com` → `wp-content/themes/la-suite-csa/`.

## Après une mise à jour sur un site déjà rempli

Les champs ACF déjà enregistrés gardent leur valeur et passent avant les textes par défaut du thème. Sur un site existant, vérifiez :

- **Pages → Accueil** : sur-titre, lignes de marque, texte du hero, bouton, promesse, titres et textes des 3 cartes.
- **Site Options** : téléphone, adresse, texte du pied de page. S’ils sont vides, le thème affiche `514-830-2355` et `2011 Rue Léonard-de-Vinci, Suite 100, Sainte-Julie, QC J3E 1Z2`.
- **Fondateurs** : rien à saisir pour le premier affichage. Les trois bios et photos du thème s’affichent tant que les champs sont vides.
- **Liens ressources** : au premier passage dans l’admin après la mise à jour, les 17 liens sont créés s’il n’y en a aucun. Ensuite, la page Ressources lit cette liste.

## Local

```bash
npm install
npm start
npx wp-env run cli theme activate la-suite-csa
npx wp-env run cli plugin activate advanced-custom-fields
```

| URL | Purpose |
|-----|---------|
| http://localhost:8888 | Site |
| http://localhost:8888/wp-admin | Admin (`admin` / `password`) |

Aperçu statique : [`preview/index.html`](preview/index.html).
