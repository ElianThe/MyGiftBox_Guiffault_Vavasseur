<?php

namespace gift\app\actions;

use gift\app\services\prestations\PrestationNotFoundException;
use gift\app\services\prestations\PrestationsService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Slim\Exception\HttpNotFoundException;
use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Slim\Views\Twig;

class PrestationAction
{

    public function __invoke(Request $request, Response $response, array $args) {
        $id = $request->getQueryParams()['id'] ?? null;
        $prestationsService = new PrestationsService();
        try {
            $prestation = $prestationsService->getPrestationById($id);
        } catch (PrestationNotFoundException $exception) {
            throw new HttpNotFoundException( $request, 'Prestation non trouvée');
        }

        $html = 'bla';
        $view = Twig::fromRequest($request);


        //$response->getBody()->write($html);
        return $view->render($response, 'prestation.twig', [
            'prestation' => $prestation
        ]);
    }


}