<?php

namespace gift\app\actions;

use gift\app\models\Categorie;

class CategorieByIdAction
{

    public function __invoke(\Slim\Psr7\Request $rq, \Slim\Psr7\Response $response, array $args) {
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
    }

}