<?php

namespace gift\app\actions;

use gift\app\services\box\BoxService;
use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Slim\Views\Twig;

class AddPrestationToBoxAction
{
    public function __invoke(Request $request, Response  $response, array $args) {

        $prestation_id = $request->getParsedBody()['prestation_id'] ?? null;
        $box_id = $request->getParsedBody()['box_id'] ?? null;

        if (!isset($prestation_id) || !isset($box_id)) {
            $view = Twig::fromRequest($request);
            return $view->render($response, 'error.twig', [
                'message' => 'Préstation ou box non trouvé',
            ]);
        }

        $boxService = new BoxService();
        $boxService->addPrestaToBox($prestation_id, $box_id);



        $view = Twig::fromRequest($request);
        return $view->render($response, 'prestations_from_categorie.twig', [
        ]);
    }
}