<?php
declare(strict_types=1);

use gift\app\models\Categorie;
use gift\app\models\Prestation;
use Slim\Psr7\Request;
use Slim\Psr7\Response;
use gift\app\actions\CategoriesAction;
use gift\app\actions\AccueilAction;

return function (Slim\App $app) {
    $app->get('/', AccueilAction::class);

    // Route 1 : liste des catégories
    $app->get('/categories', CategoriesAction::class);


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
            <h1>Catégorie :  {$categorie->libelle}</h1>
            <h3>Description de la catégorie</h3>
            <p>{$categorie->description}</p>
            
            <a href="{$basePath}categories">Retour à la liste des catégories</a>
HTML;

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

    $app->get('/boxes/new',
    function (Request $request, Response $response, array $args) : Response{
        $html = <<<HTML
            <!DOCTYPE html>
            <html lang="fr">
                <head>
                    <meta charset="UTF-8">
                    <title>Ajout boxes</title>
                </head>
                <body>
                    <form>
                        <label for="libelle">Libelle</label>
                        <input type="text" id="libelle" name="libelle"><br>
                        
                        <label for="description">description</label>
                        <input type="text" id="description" name="description"><br>
                        
                        <label for="montant">montant</label>
                        <input type="text" id="montant" name="montant"><br>
                        
                        <label for="kdo">kdo</label>
                        <input type="text" id="kdo" name="kdo"><br>     
                        
                        <label for="message_kdo">message du kdo</label>
                        <input type="text" id="message_kdo" name="message_kdo"><br>
                        
                        <label for="status">Status</label>
                        <input type="text" id="status" name="status"><br>
                        
                        <input type="submit" value="Envoyer">
                    </form>
                </body>
            </html>
HTML;
        $response->getBody()->write($html);

        return $response;
    });


};