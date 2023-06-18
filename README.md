Réalisé par Elian GUIFFAULT et Régis VAVASSEUR

# Projet Coffret Cadeau
## Installation
modifier le fichier gift.db.conf.ini.dist en gift.db.conf.ini et modifier les paramètres de connexion à la base de données.
Pour les test, créer un fichier gift.db.test.ini et modifier les paramètres de connexion à la base de données.

### Lancer le serveur
- composer install dans src
- docker compose up -d dans gift

## Description des tâches détaillées

- [x] Afficher la liste des préstations (elian)
- [x] Afficher le détail d'une préstation (elian)
- [x] Liste de prestations par catégories (elian)
- [x] Liste de catégories (régis)
- Tri par prix
- [x] Création d'un coffret vide (elian)
- [x] Ajout de prestation dans un coffret (elian)
- [x] Affichage du coffret (régis)
- Validation d'un coffret
- Paiement d'un coffret
- Modification d'un coffret : Suppression de préstations
- [x] Modification d'un coffret : Modification des quantités (elian et régis)
- Génération de l'URL d'accès
- Accès au coffret avec l'URL
- [x] Signin (régis)
- [x] Register (régis)
- [x] Accéder à ses coffrets (régis)
- [x] Afficher les box prédéfinies (régis)
- Créer un coffret à partir d'une box prédéfinie
- API : Afficher la liste des préstations
- [x] API : Afficher la liste des catégories (régis)
- API : Afficher la liste des préstations d'une catégorie
- [x] API : Accès à un coffret (elian)

## Accès

### Accès à l'application
- http://localhost:5280

### Accès à l'API
- http://localhost:5380/api/categories

### Dépot git
- https://github.com/ElianThe/MyGiftBox_Guiffault_Vavasseur.git