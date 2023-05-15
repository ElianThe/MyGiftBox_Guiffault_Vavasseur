<?php

namespace gift\app\actions;

use gift\app\services\prestations\PrestationsService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Slim\Psr7\Request;
use Slim\Psr7\Response;

class CategorieByIdAction
{

    public function __invoke(Request $request, Response $response, array $args) {
        //gestion des erreurs
        $id = null ?? $args['id'];

        $basePath = '/ArchitectureLogiciel/MyGiftBox_Guiffault_Vavasseur/gift/gift.appli/public/';
        $prestationsService = new PrestationsService();
        

        try {
            $categorie = $prestationsService->getCategorieById($id);
        } catch (\Exception $exception) {
            throw new ModelNotFoundException("Categorie non trouvée", 404);
        }

        $prestations = $prestationsService->getPrestationsbyCategorie($args['id']);

        $html = <<<HTML
    
        <!DOCTYPE html>
        <html lang="fr">
        <head>
            <meta charset="UTF-8">
            <title>Catégorie {$categorie['id']}</title>
        </head>
        <body>
            <h1>Catégorie :  {$categorie['libelle']}</h1>
            <h3>Description de la catégorie</h3>
            <p>{$categorie['description']}</p>
            
            <a href="{$basePath}categories">Retour à la liste des catégories</a>
HTML;

        $html.= <<<HTML
                    <select name="prestation" id="prestation">               
                HTML;

        foreach ($prestations as $prestation) {
            $html .= <<<HTML
                            <option value="{$prestation['id']}">{$prestation['libelle']}</option>
                        HTML;
        }

        $response->getBody()->write($html);
        return $response;
    }

}