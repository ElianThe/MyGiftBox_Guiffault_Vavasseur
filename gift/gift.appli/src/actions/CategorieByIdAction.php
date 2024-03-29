<?php

namespace gift\app\actions;

use gift\app\services\prestations\PrestationNotFoundException;
use gift\app\services\prestations\PrestationsService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Exception\HttpNotFoundException;

use Slim\Views\Twig;

class CategorieByIdAction
{

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args) {
        //gestion des erreurs
        $id = null ?? $args['id'];

        $prestationsService = new PrestationsService();

        try {
            $categorie = $prestationsService->getCategorieById($id);
            $prestations = $prestationsService->getPrestationsbyCategorie($id);
        } catch (PrestationNotFoundException $exception) {
            throw new HttpNotFoundException($request, 'Catégorie non trouvée');
        }

        $view = Twig::fromRequest($request);
        return $view->render($response, 'categorie.twig', [
            'categorie' => $categorie,
            'prestations' => $prestations,
        ]);
    }

}