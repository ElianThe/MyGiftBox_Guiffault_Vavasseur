<?php

namespace gift\app\actions;

use gift\app\models\Prestation;

class PrestationAction
{

    public function __invoke(\Slim\Psr7\Request $request, \Slim\Psr7\Response $response, array $args) {
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
    }


}