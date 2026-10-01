# La Suite CSA Inc.

Thème WordPress vitrine, version **5.0.2**. Services : **Financements**, **Subventions**, **Crédits d’impôt**.

Direction éditoriale claire, proche du rythme de [versa.roymarketing.ca](https://versa.roymarketing.ca/) : hero plein écran, texte découpé, section services épinglée, défilement horizontal du déroulement. La palette reste celle de La Suite CSA (bleu `#1C3B6B`, gris `#F1F2F2`, noir `#231F20`, blanc). La version 4.5.0 est conservée sur le tag `v4.5.0-backup`.

Staging : [https://lasuitecsa.wpcomstaging.com](https://lasuitecsa.wpcomstaging.com)

## Contenu éditable par le client (WP Admin)

| Où | Quoi |
|----|------|
| **Pages → Accueil** | Hero (sur-titre, 2 lignes de marque, texte, bouton, visuel), 3 services (piliers), texte de promesse |
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
| Blue (marque, boutons, orbes) | `#1C3B6B` |
| Light grey / text | `#F1F2F2` |
| Text soft | `#D3D8DF` |
| Muted | `#B1BBC9` |
| Links and focus | `#99A7BC` |
| Blue pale | `#BFC8D6` |
| Ink | `#0B1629`, `#0E1E36`, `#122644` |
| Near black | `#231F20` |
| White | `#FFFFFF` |

**Type :** Inter (texte) et Syne (titres), fichiers locaux dans `assets/fonts/`.

**Motion :** GSAP 3.12.5, ScrollTrigger, Lenis 1.1.20 et SplitType 0.3.4, dans `assets/vendor/`. Aucune étape de build à l’installation. `prefers-reduced-motion` et `?static` désactivent l’épinglage et les animations.

**Logo :** paire blanc / bleu dans l’en-tête, logo blanc dans le pied de page. Un logo défini dans l’outil de personnalisation remplace cette paire. Le favicon du thème s’affiche tant qu’aucune icône de site WordPress n’est enregistrée.

**Photos :** voir `wp-content/themes/la-suite-csa/CREDITS.md`.

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
