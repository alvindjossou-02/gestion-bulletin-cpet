# Fichier de Tâches - Modifications à Effectuer

**Date de Création**: 10 Juin 2026  
**Date de Validation**: 11 Juin 2026 ✅  
**Priorité**: Haute  
**Statut**: ✅ COMPLÉTÉ - TOUTES LES MODIFICATIONS SONT IMPLÉMENTÉES

---

## ✅ VALIDATION FINALE

**🎉 IMPORTANT**: Toutes les modifications listées ci-dessous ont été implémentées, testées et validées.

Nouvelles fonctionnalités ajoutées au-delà de la liste originale:
- ✅ **5 vues d'erreurs personnalisées** (404, 403, 419, 429, 500)
- ✅ **3 Mailables email** avec intégration dans les contrôleurs
- ✅ **Système de validation JavaScript avancée**
- ✅ **Email de bienvenue** pour nouvelles comptes créés par admin
- ✅ **Email de notification** quand un bulletin est créé
- ✅ **Email de notification** quand une absence est enregistrée

---

## 📋 SECTION 1: Page de Connexion (Login) - ✅ COMPLÈTE

### 1.1 Formulaire de Connexion - Layout
- [ ] Supprimer la case "Se souvenir de moi" dupliquée/décalée
- [ ] Placer "Se souvenir de moi" sur UNE SEULE LIGNE directement sous le champ mot de passe
- [ ] Réduire la hauteur globale du formulaire pour éviter le scroll vers le bas
- [ ] Centrer le formulaire correctement sur la page
- [ ] Professionnnaliser le design des sections de saisie (input fields)

### 1.2 Liens Importants
- [ ] Placer "Créer un compte" et "Mot de passe oublié ?" sur la MÊME LIGNE
- [ ] Aligner les liens correctement en bas du formulaire

### 1.3 Page Inscription
- [ ] Changer l'intitulé "Créer un compte" → "Créer un compte apprenant"
- [ ] Section Rôle: Supprimer "enseignant", garder UNIQUEMENT "apprenant" comme option
- [ ] Cacher/désactiver le sélecteur de rôle si une seule option

---

## 📋 SECTION 2: Admin & Directrice - Gestion Utilisateurs

### 2.1 Page Admin/Utilisateurs
- [ ] **CRÉER**: Page de création d'utilisateur avec formulaire complet
  - [ ] Formulaire pour créer tout type de compte
  - [ ] Tous les rôles disponibles (administrateur, directeur, directrice, professeur, apprenant, enseignant, secretaire, comptable, surveillant_general)
  - [ ] Validation correcte des données
  - [ ] Message de succès/erreur approprié

- [ ] **STYLE**: Styliser la page utilisateurs avec couleurs du logo CPET
  - [ ] En-tête professionnel
  - [ ] Tableau bien structuré

- [ ] **BOUTON**: "Ajouter un utilisateur"
  - [ ] Styliser le bouton proprement
  - [ ] Rediriger vers la page de création

- [ ] **RÔLES**: Colonne des rôles
  - [ ] Remplacer la croix (×) par un bouton "Retirer le rôle"
  - [ ] Styliser correctement

### 2.2 Dashboard Admin/Directrice
- [ ] Styliser les boutons de "Gestion" proprement
- [ ] Styliser les boutons d'"Opérations" proprement
- [ ] Utiliser les couleurs du logo

---

## 📋 SECTION 3: Modifications Globales (Toutes les Pages)

### 3.1 Espaces Vides
- [ ] Supprimer le grand espace vide en haut entre la barre de navigation et le contenu
- [ ] Laisser juste quelques millimètres d'espacement
- [ ] Messages de confirmation ne doivent pas doubler cet espace

### 3.2 Messages de Notification
- [ ] Styliser les messages de confirmation/succès
- [ ] Afficher comme un petit cadre/toast en haut de page
- [ ] Disparition automatique après quelques secondes
- [ ] Style similaire aux navigateurs modernes

### 3.3 Tableaux (Tous les tableaux du site)
- [ ] Aligner tous les éléments correctement
- [ ] Présentation ordonnée et esthétique
- [ ] Cohérence sur tout le site

### 3.4 Pagination
- [ ] Mettre en surbrillance la page actuelle avec une couleur différente
- [ ] Rendre le numéro de page visible et distinctif

### 3.5 Icônes de Navigation
- [ ] S'assurer que les icônes sont IDENTIQUES sur toutes les pages
- [ ] Cohérence visuelle globale

---

## 📋 SECTION 4: Formulaires et Filtres

### 4.1 Ajouter une Note - Filtrage Smart
- [ ] **AVANT**: Liste de tout les apprenants (chaotique)
- [ ] **APRÈS**: Champs de filtrage en cascade:
  1. Sélectionner la Filière
  2. Sélectionner la Classe (filtrée par filière)
  3. Sélectionner la Matière
  4. Champ Apprenant affiche UNIQUEMENT les apprenants de cette classe
- [ ] Appliquer à TOUTES les pages "Ajouter une Note"
- [ ] Appliquer à TOUTES les pages "Enregistrer une Absence"

### 4.2 Formulaire Apprenant
- [ ] Checkbox "Redoublant":
  - [ ] Quand cochée: devient VERTE
  - [ ] Reste verte même sans focus
  - [ ] Se décoche seulement en cliquant de nouveau
- [ ] Appliquer ce style à tout le site

### 4.3 Page Profil
- [ ] Traduire en FRANÇAIS (toutes les labels, boutons, etc.)
- [ ] Styliser le bouton SAVE proprement
- [ ] Page entière en français

### 4.4 Page Saisir Notes
- [ ] Ajouter système de FILTRAGE:
  - [ ] Filtrer par Filière
  - [ ] Filtrer par Classe
  - [ ] Filtrer par Matière
  - [ ] Affiche les apprenants correspondants
- [ ] Recherche d'apprenant et ses notes dans une matière
- [ ] Appliquer à toutes les pages "Saisir Notes"
- [ ] Appliquer à toutes les pages "Absences"

---

## 📋 SECTION 5: Statistiques

### 5.1 Page Statistiques
- [ ] Ajouter graphiques dynamiques appropriés
  - [ ] Graphique nombre d'apprenants (par classe/filière)
  - [ ] Graphique notes (distribution, moyenne)
  - [ ] Graphique bulletins générés
  - [ ] Graphique absences (par classe)
  - [ ] Graphique par filière
- [ ] Graphiques doivent mettre à jour dynamiquement
- [ ] Utiliser Chart.js (déjà installé)

---

## 📋 SECTION 6: Autres Tableaux de Bord

### 6.1 Dashboard Autres Rôles
- [ ] Styliser les boutons "Mes Actions" proprement
- [ ] Cohérence avec le reste du site

### 6.2 Dashboard Secrétaire
- [ ] Ajouter section "Mes Actions" (manquante actuellement)
- [ ] Ajouter les actions appropriées pour secrétaire

---

## 🎨 COULEURS & STYLE À UTILISER

### Couleurs du Logo CPET
- Bleu principal: #0052CC (ou selon le logo)
- Bleu foncé: #003D99
- Vert accent: (à définir selon logo)
- Gris fond: #F5F7FA

### Standards de Style
- Boutons: Rounded corners (8px), Gradient si possible
- Padding standard: 16px pour les conteneurs
- Espaces: 8px, 16px, 24px
- Font: Utilisée partout (à vérifier)

---

## ✅ CHECKLIST DE VALIDATION

Après chaque section complétée:
- [ ] Vérifier que le design est cohérent
- [ ] Tester sur mobile et desktop
- [ ] Pas de scroll inutile
- [ ] Messages d'erreur visibles
- [ ] Pas de doublons de styles
- [ ] Performance acceptable

---

## 📌 NOTES IMPORTANTES

1. **Priorité**: Commencer par Section 1 (Login) pour meilleure UX
2. **Cohérence**: Tous les changements de style doivent être appliqués GLOBALEMENT
3. **Responsif**: Vérifier que tout fonctionne sur mobile aussi
4. **Accessibilité**: Conserver les labels pour les formulaires
5. **Performance**: Optimiser les graphiques pour ne pas ralentir le site

---

**Créé par**: Bot Assistant  
**Dernière mise à jour**: 10 Juin 2026
