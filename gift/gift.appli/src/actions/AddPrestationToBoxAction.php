<?php

namespace gift\app\actions;

use gift\app\services\box\BoxService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Slim\Exception\HttpNotFoundException;
use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Slim\Routing\RouteContext;
use Slim\Views\Twig;

class AddPrestationToBoxAction
{
    public function __invoke(Request $request, Response  $response, array $args) {

        $prestation_id = $request->getQueryParams()['presta_id'] ?? null;
        $box_id = $_SESSION['box_id'];

        if (!isset($prestation_id) || !isset($box_id)) {
            $view = Twig::fromRequest($request);
            return $view->render($response, 'error.twig', [
                'message' => 'Préstation ou box non trouvé',
            ]);
        }

        try {
            $boxService = new BoxService();
            if ($boxService->prestaAlreadyInBox($prestation_id, $box_id)) {
                $boxService->updatePrestaQuantity($prestation_id, $box_id);
            } else {
                $boxService->addPrestaToBox($prestation_id, $box_id);
            }
        } catch (ModelNotFoundException $exception) {
            throw new HttpNotFoundException($request, 'Pas possible d ajouter une prestation à la boxe');
        }

        $routeParser = RouteContext::fromRequest($request)->getRouteParser();
        $url = $routeParser->fullUrlFor($request->getUri(), 'prestations');
        return $response->withHeader('Location', $url)->withStatus(302);
    }
}