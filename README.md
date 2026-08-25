# La Suite CSA Inc.

Thème WordPress vitrine. Services : **Financements**, **Subventions**, **Crédits d’impôt**.

Staging : [https://lasuitecsa.wpcomstaging.com](https://lasuitecsa.wpcomstaging.com)

## Contenu éditable par le client (WP Admin)

| Où | Quoi |
|----|------|
| **Pages → Accueil** | Hero (sur-titre, 2 lignes de marque, texte, bouton, visuel), 3 cartes glass, texte de promesse |
| **Site Options** (menu) | Pied de page, téléphone, courriel, réseaux |
| **Articles** | Blogue |
| **Médias** | Photos équipe / CTA (selon pages) |

Sur l’Accueil, utilisez `**mots**` dans le champ Promesse pour le gras.

Le design (CSS, structure, animations) reste dans le code thème : le client ne casse pas la mise en page.

## Brand

| Role | Hex |
|------|-----|
| Cream | `#F2EEE4` |
| Cobalt | `#16378A` |
| Oxblood CTA | `#6E1C28` |
| Ink | `#0C1220` |

**Type :** Plus Jakarta Sans (+ Archivo Black pour certains titres de section).

## Déployer le thème (WordPress.com Business / Atomic)

1. Zip prêt : `la-suite-csa-theme.zip` (dossier `la-suite-csa` à la racine du zip).
2. WP Admin → **Apparence → Thèmes → Ajouter → Téléverser**.
3. Activer **La Suite CSA**.
4. Plugin **Advanced Custom Fields** (déjà actif sur le staging).
5. **Réglages → Lectures** : page d’accueil = Accueil (si besoin).
6. Ouvrir **Pages → Accueil** pour peupler / ajuster les champs.

SFTP (Atomic) : `sftp.wp.com` → `wp-content/themes/la-suite-csa/`.

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
