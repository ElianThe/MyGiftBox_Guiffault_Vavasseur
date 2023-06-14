<?php

namespace gift\app\actions;

use gift\app\services\prestations\PrestationNotFoundException;
use gift\app\services\prestations\PrestationsService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Exception\HttpNotFoundException;

use Slim\Views\Twig;

class PrestationAction
{

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args)
    {
        $id = $request->getQueryParams()['id'];

        try {
            $prestationsService = new PrestationsService();
            $prestation = $prestationsService->getPrestationById($id);
        } catch (PrestationNotFoundException $exception) {
            throw new HttpNotFoundException($request, 'Prestation non trouvée');
        }

        $view = Twig::fromRequest($request);
        return $view->render($response, 'prestation.twig', [
            'prestation' => $prestation
        ]);


    }


}