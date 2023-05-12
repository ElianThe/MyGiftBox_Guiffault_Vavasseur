<?php
declare(strict_types=1);

use gift\app\actions\CategorieByIdAction;
use gift\app\actions\PrestationAction;;
use gift\app\actions\CategoriesAction;
use gift\app\actions\AccueilAction;
use gift\app\actions\FormBoxesAction;

return function (Slim\App $app) {
    //accueil
    $app->get('/', AccueilAction::class);

    // Route 1 : liste des catégories
    $app->get('/categories', CategoriesAction::class);


    // Route 2 : Affichage d'une catégorie
    $app->get('/categorie/{id:\d+}[/]', CategorieByIdAction::class);



// Route 3 : Affichage d'une prestation si l'ID est présent en paramètre
    $app->get('/prestation', PrestationAction::class);

    //Route 4 : affiche un formulaire qui permet d'ajouter une boxe
    $app->get('/boxes/new', FormBoxesAction::class);

};