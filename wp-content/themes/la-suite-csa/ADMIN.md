# Après l’installation du thème 5.1.0

Le thème applique déjà les textes par défaut, retire Outils du menu affiché, et met à jour une fois les contenus qui ont encore les anciennes valeurs par défaut. Les étapes ci-dessous sont celles qui restent dans l’admin WordPress, surtout sur un site déjà rempli (staging).

## À vérifier tout de suite

1. **Apparence → Thèmes** : activer La Suite CSA Inc. 5.1.0 (ou remplacer les fichiers du thème, puis recharger une page publique pour lancer la mise à jour automatique).
2. **Réglages → Permaliens** : enregistrer une fois, sans changer la structure, pour rafraîchir les adresses.
3. **Site Options** : le courriel public. S’il était vide, le thème a inscrit `charles.brassard@lasuitecsa.com`. Le remplacer si l’adresse publique est une autre.
4. **Pages → Accueil** : le bouton du hero doit lire **Planifier un appel**. S’il a été personnalisé autrement que « Réserver un appel », le thème ne l’a pas écrasé.
5. **Pages → Entreprise** (slug `entreprise`) : le titre doit être **Notre équipe**. L’adresse reste `/entreprise/` tant que le slug n’est pas changé. Le thème retrouve la page par son modèle, donc un slug `notre-equipe` fonctionne après enregistrement.
6. **Apparence → Menus** : l’item qui pointait vers Entreprise doit s’appeler **Notre équipe**. L’item **Outils** peut rester dans le menu : le thème ne l’affiche pas tant que `LA_SUITE_CSA_ENABLE_OUTILS` est à `false`. On peut aussi le retirer du menu.
7. **Pages → Outils** : la page doit être en **brouillon** (ou dépubliée). Une page encore publiée redirige vers l’accueil tant que le drapeau est éteint.
8. **Liens ressources** : deux rubriques visibles, dans cet ordre.
   - Subventions et crédits d’impôt (Musicaction, Fonds Radiostar, SODEC, Conseil des Arts du Canada, CALQ, puis les anciens liens de subventions et d’innovation s’ils étaient déjà là).
   - Financements (Investissement Québec, BDC, EDC, DEC, et les programmes IQ déjà présents).
   Les fiches des rubriques Fiscalité et authentification et Registres et démarrage passent en brouillon. Elles ne s’affichent plus. Pour les revoir, il faudrait les republier, ce que la demande ne demande pas.
9. **Pages → Notre équipe** : relire les cinq textes (Personnalisation, Créativité, Proactivité, Authenticité, Solidarité). Ce sont des propositions à valider avec le client. Les modifier dans le code du thème (`inc/copy-defaults.php`, clé `about.values`) : ces textes ne sont pas des champs ACF.

## Textes que l’admin ne remplace pas tout seul

Ces contenus vivent dans le thème. Un champ ACF déjà rempli sur l’accueil ou dans Site Options passe avant le texte du thème.

- Libellé **Plus de détails** sur la page Services.
- Sections retirées des pages de service (ce que vous repartez avec, ce qui est livré, démarche étape par étape, à qui s’adresse ce service, pièges fréquents).
- Titre **Contexte de financement**.
- Les trois mentions légales des services, inchangées.
- Bouton **Contact** sur Notre équipe.
- Lien **Voir la page Services** dans la section Nos services de l’accueil.
- Photos de ville et photos du déroulement (fichiers du thème, voir `CREDITS.md`). Si un visuel a été téléversé dans le champ « Visuel central » de l’accueil, il remplace la photo de ville du thème. Le retirer s’il montre une enseigne.

## Remettre la page Outils

1. Dans `functions.php`, mettre `LA_SUITE_CSA_ENABLE_OUTILS` à `true`.
2. **Pages → Outils** : statut Publié, modèle **Outils**.
3. **Apparence → Menus** : l’item Outils redevient visible. S’il a été supprimé, le rajouter vers la page Outils.

Les fichiers `page-outils.php`, `inc/outils.php` et `assets/js/outils.js` n’ont pas été effacés.
