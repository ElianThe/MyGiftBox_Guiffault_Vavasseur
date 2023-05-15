<?php

namespace gift\app\actions;
use gift\app\services\prestations\PrestationsService;
use Slim\Psr7\Request;
use Slim\Psr7\Response;

class CategoriesAction
{
    public function __invoke(Request $request, Response $response, array $args)
    {
        $basePath = 'http://localhost/ArchitectureLogiciel/MyGiftBox_Guiffault_Vavasseur/gift/gift.appli/public/';
        $prestationService = new PrestationsService();
        $categories = $prestationService->getCategories();
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
                <li><a href='{$basePath}categorie/{$categorie['id']}'>{$categorie['id']} - {$categorie['libelle']}</a></li>
            </ul>
        </body> 
        </html>
HTML;
        }
        $response->getBody()->write($html);
        return $response;
    }
};