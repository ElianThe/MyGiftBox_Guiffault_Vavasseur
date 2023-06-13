<?php

namespace gift\app\actions;

use gift\app\services\prestations\PrestationNotFoundException;
use gift\app\services\prestations\PrestationsService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Exception\HttpNotFoundException;
use Slim\Views\Twig;

class PrestationsAction
{
    function __invoke(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {

        try {
            $prestationsService = new PrestationsService();
            $prestations = $prestationsService->getPrestations();

        } catch (PrestationNotFoundException $exception) {
            throw new HttpNotFoundException('Prestation ou box non trouvée');
        }

        $view = Twig::fromRequest($request);
        return $view->render($response, 'prestations.twig', [
            'prestations' => $prestations,
        ]);
    }
}