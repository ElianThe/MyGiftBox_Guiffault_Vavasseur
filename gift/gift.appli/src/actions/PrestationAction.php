<?php

namespace gift\app\actions;

use gift\app\services\prestations\PrestationsService;
use Slim\Psr7\Request;
use Slim\Psr7\Response;

class PrestationAction
{

    public function __invoke(Request $request, Response $response, array $args) {
        $id = $request->getQueryParams()['id'] ?? null;
        $prestationsService = new PrestationsService();
        $prestation = $prestationsService->getPrestationById($id);

        $html = <<<HTML
        <!DOCTYPE html>
          <html lang="fr">
          <head>
              <meta charset="UTF-8">
              <title>Prestation</title>
          </head>
          <body>
              <h1>Prestation : {$prestation['libelle']} </h1>
              <ul>
                  <li>ID : {$prestation['id']}</li>
                  <li>Libellé : {$prestation['libelle']}</li>
                  <li>Description : {$prestation['description']}</li>
                  <li>Contenu : {$prestation['unite']}</li>
                  <li>Tarif : {$prestation['tarif']}</li>
              </ul>
          </body>
          </html>
HTML;

        $response->getBody()->write($html);
        return $response;
    }


}