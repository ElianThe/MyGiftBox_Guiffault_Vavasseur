<?php

namespace gift\app\actions;

use gift\app\services\prestations\PrestationNotFoundException;
use gift\app\services\prestations\PrestationsService;
use Slim\Exception\HttpNotFoundException;
use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Slim\Views\Twig;

class PrestationsFromCategorie
{
    public function __invoke(Request $request, Response  $response, array $args) {
        $prestationService = new PrestationsService();
        $categ_id = null ?? $args['categ_id'];

        try {
            $prestations = $prestationService->getPrestationsbyCategorie($categ_id);
        } catch (PrestationNotFoundException $exception) {
            throw new HttpNotFoundException('prestation non trouvé');
        }

        $view = Twig::fromRequest($request);
        return $view->render($response, 'prestations_from_categorie.twig', [
            'prestations' => $prestations
        ]);
    }
}