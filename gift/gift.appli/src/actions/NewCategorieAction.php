<?php

namespace gift\app\actions;

use gift\app\services\prestations\PrestationsService;
use gift\app\services\utils\CsrfService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Views\Twig;

class NewCategorieAction
{
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, $args)
    {

        //vérification présence token CSRF
        $csrfToken = $request->getParsedBody()['csrfToken'] ?? null;
        if (!isset($csrfToken) || !CsrfService::checkToken($csrfToken)) {
            $view = Twig::fromRequest($request);
            return $view->render($response, 'error.twig', [
                'message' => 'Erreur CSRF',
            ]);
        }

        $libelle = filter_var($request->getParsedBody()['categ_lib'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $description = filter_var($request->getParsedBody()['categ_desc'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        $data = [
            'libelle' => $libelle,
            'description' => $description,
        ];

        $prestationsService = new PrestationsService();
        $newCategorieId = $prestationsService->addCategorie($data);

        $newCategorie = $prestationsService->getCategorieById($newCategorieId);

        $view = Twig::fromRequest($request);
        return $view->render($response, 'categorie_created.twig', [
            'newCategorie' => $newCategorie,
        ]);
    }

}