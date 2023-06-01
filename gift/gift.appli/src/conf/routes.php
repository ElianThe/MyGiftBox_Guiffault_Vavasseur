<?php
declare(strict_types=1);

use gift\app\actions\CategorieByIdAction;
use gift\app\actions\FormCategoriesAction;
use gift\app\actions\NewCategorieAction;
use gift\app\actions\PrestationAction;
use gift\app\actions\CategoriesAction;
use gift\app\actions\AccueilAction;
use gift\app\actions\FormBoxesAction;

return function (Slim\App $app) {
    //accueil
    $app->get('/', AccueilAction::class)->setName('home');

    // Route 1 : liste des catégories
    $app->get('/categories', CategoriesAction::class)->setName('categories');

    // Route 2 : Affichage d'une catégorie
    $app->get('/categorie/{id:\d+}[/]', CategorieByIdAction::class)->setName('categorie');

    // Route 3 : Affichage d'une prestation si l'ID est présent en paramètre
    $app->get('/prestation', PrestationAction::class)->setName('prestation');

    $app->get('/categorie/{categ_id:\d+}/prestations', \gift\app\actions\PrestationsFromCategorie::class)->setName('prestationsFromCategorie');

    //Route 4 : affiche un formulaire qui permet d'ajouter une boxe
    $app->get('/boxes/new', FormBoxesAction::class)->setName('newBox');

    //Route 5 : Affichage d'un formulaire qui permet d'ajouter une catégorie
    $app->get('/categories/new', FormCategoriesAction::class)->setName('newCategorieForm');

    //Route 6 : Création d'une catégorie
    $app->post('/categories/new', NewCategorieAction::class)->setName('newCategorie');

};