<?php
declare(strict_types=1);

use gift\app\actions\AddPrestationToBoxAction;
use gift\app\actions\CategorieByIdAction;
use gift\app\actions\DeleteCategorieAction;
use gift\app\actions\FormCategorieAction;
use gift\app\actions\NewBoxesPostAction;
use gift\app\actions\NewCategorieAction;
use gift\app\actions\PrestationAction;
use gift\app\actions\CategoriesAction;
use gift\app\actions\AccueilAction;
use gift\app\actions\FormBoxesAction;
use gift\app\actions\PrestationsFromCategorie;

return function (Slim\App $app) {
    //accueil
    $app->get('/', AccueilAction::class)->setName('home');

    // Route 1 : liste des catégories
    $app->get('/categories', CategoriesAction::class)->setName('categories');

    // Route 2 : Affichage d'une catégorie
    $app->get('/categorie/{id:\d+}[/]', CategorieByIdAction::class)->setName('categorie');

    // Route 3 : Affichage d'une prestation si l'ID est présent en paramètre
    $app->get('/prestation', PrestationAction::class)->setName('prestation');

    // Route 3 : Affichage des prestations d'une catégorie
    $app->get('/categorie/{categ_id:\d+}/prestations', PrestationsFromCategorie::class)->setName('prestationsFromCategorie');

    //Route 5 : Affichage d'un formulaire qui permet d'ajouter une catégorie
    $app->get('/categories/new', FormCategorieAction::class)->setName('newCategorieForm');

    //Route 6 : Création d'une catégorie
    $app->post('/categories/new', NewCategorieAction::class)->setName('newCategorie');

    //Route 4 : affiche un formulaire qui permet d'ajouter une boxe
    $app->get('/boxes/new', FormBoxesAction::class)->setName('newBox');

    //Route y :
    $app->post('/boxes/new', NewBoxesPostAction::class)->setName('newBox');
    
    //Route 7 : Suppression d'une catégorie
    $app->delete('/categories/{id:\d+}/delete', DeleteCategorieAction::class)->setName('deleteCategorie');

    //Route 8 : Liéer une prestation à une boxe
    $app->post('/addPrestaToBox/boxes_id/prest_id', AddPrestationToBoxAction::class)->setName('addPrestationToBox');

    //Route 9 : Inscription d'un utilisateur
    $app->get('/inscription', \gift\app\actions\InscriptionAction::class)->setName('inscription');

    //Route 9bis
    $app->post('/inscription', \gift\app\actions\InscriptionPostAction::class)->setName('inscriptionPost');

    //Route 10 : Connexion d'un utilisateur
    $app->get('/connexion', \gift\app\actions\ConnexionAction::class)->setName('connexion');

    //Route 10bis
    $app->post('/connexion', \gift\app\actions\ConnexionPostAction::class)->setName('connexionPost');

    //Route 11 : Déconnexion d'un utilisateur
    $app->get('/deconnexion', \gift\app\actions\DeconnexionAction::class)->setName('deconnexion');

    //Route 12 : Affichage du profil d'un utilisateur
    $app->get('/profil', \gift\app\actions\ProfilAction::class)->setName('profil');


};