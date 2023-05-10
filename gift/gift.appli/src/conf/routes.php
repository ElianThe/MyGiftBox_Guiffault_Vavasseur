<?php
declare(strict_types=1);

use gift\app\models\Categorie;
use gift\app\models\Prestation;
use Slim\Psr7\Request;
use Slim\Psr7\Response;

return function (Slim\App $app) {


    $app->get('/',
        function (Request $rq, Response $rs, $args): Response {
            $basePath = 'http://localhost/ArchitectureLogiciel/MyGiftBox_Guiffault_Vavasseur/gift/gift.appli/public/';
            $html = <<<EOM
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
                <html lang="en">
                <head>
                    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
                    <title>Document</title>
                </head>
                <body>
                <p>Coucouc</p>
                <p><a href="{$basePath}categories">Aller vers la liste des catégories</a></p>
                </body>
                </html>
EOM;

            $rs->getBody()->write($html);
            return $rs;
        });


// Route 1 : liste des catégories

        $app->get('/categories',
            function (Request $request, Response $response, array $args): Response {
                $basePath = 'http://localhost/ArchitectureLogiciel/MyGiftBox_Guiffault_Vavasseur/gift/gift.appli/public/';
                $categories = Categorie::all();
                $html = <<<HTML
        <!DOCTYPE html>
        <html lang="fr">
        <head>
            <meta charset="UTF-8">
            <title>Liste des catégories</title>
        </head>
        <body>
            <a href="{$basePath}">Retour à l'accueil</a>
            <h1>Liste des catégories</h1>
            <ul>
HTML;
                foreach ($categories as $categorie) {
                    $html .= <<<HTML
                             <li><a href='{$basePath}categorie/{$categorie->id}'> {$categorie->id} - {$categorie->libelle}</a></li>
                         </ul>
                     HTML;
                }


                $response->getBody()->write($html);
                return $response;
            });

// Route 2 : Affichage d'une catégorie
    $app->get('/categorie/{id:\d+}[/]', function (Request $request, Response $response, array $args) : Response{
        $basePath = 'http://localhost/ArchitectureLogiciel/MyGiftBox_Guiffault_Vavasseur/gift/gift.appli/public/';
        $categorie = Categorie::find($args['id']);
        $html = <<<HTML
    
        <!DOCTYPE html>
        <html lang="fr">
        <head>
            <meta charset="UTF-8">
            <title>Catégorie {$categorie->id}</title>
        </head>
        <body>
            <h1>Catégorie {$categorie->id}</h1>
            <ul>
                <li>{$categorie->id} - {$categorie->libelle}</li>
            </ul>
            
            <a href="{$basePath}categories">Retour à la liste des catégories</a>
HTML;

        // ajout du lien vers les prestations de la catégorie grace à un formulaire select

        $html.= <<<HTML
                    <select name="prestation" id="prestation">               
                HTML;

        foreach ($categorie->prestations as $prestation) {
            $html .= <<<HTML
                            <option value="{$prestation->id}">{$prestation->libelle}</option>
                        HTML;
        }



        $response->getBody()->write($html);
        return $response;
    });

// Route 3 : Affichage d'une prestation si l'ID est présent en paramètre
    $app->get('/prestation', function (Request $request, Response $response, array $args): Response {
        $id = $request->getQueryParams()['id'] ?? null;
        $html = null;
        if ($id === null) {
            $response->withStatus(400, "Paramètre absent");
        } else {
            $prestation = Prestation::find($id);
            $html = <<<HTML
            <!DOCTYPE html>
            <html lang="fr">
            <head>
                <meta charset="UTF-8">
                <title>Prestation</title>
            </head>
            <body>
                <h1>Prestation : {$prestation->libelle} </h1>
                <ul>
                    <li>ID : {$prestation->id}</li>
                    <li>Libellé : {$prestation->libelle}</li>
                    <li>Description : {$prestation->description}</li>
                    <li>Contenu : {$prestation->unite}</li>
                    <li>Tarif : {$prestation->tarif}</li>
                </ul>
            </body>
            </html>
HTML;
        }
        $response->getBody()->write($html);
        return $response;
    });
};