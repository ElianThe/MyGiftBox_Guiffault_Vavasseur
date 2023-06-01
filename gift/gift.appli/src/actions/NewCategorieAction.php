<?php

namespace gift\app\actions;

use gift\app\services\prestations\PrestationsService;
use gift\app\services\utils\CsrfService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Exception\HttpBadRequestException;
use Slim\Routing\RouteContext;
use Slim\Views\Twig;

class NewCategorieAction
{
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, $args)
    {

        //vérification présence token CSRF
        $csrfToken = $request->getParsedBody()['csrfToken'] ?? null;

        if (!CsrfService::checkToken($csrfToken)) {
            $view = Twig::fromRequest($request);
            return $view->render($response, 'error.twig', [
                'message' => 'Erreur CSRF',
            ]);
        }

        $data = [
            'libelle' => $request->getParsedBody()['categ_lib'] ??
                throw new HttpBadRequestException($request, 'Libellé manquant'),
            'description' => $request->getParsedBody()['categ_desc'] ??
                throw new HttpBadRequestException($request, 'Description manquante'),
        ];

        $prestationsService = new PrestationsService();
        $newCategorieId = $prestationsService->addCategorie($data);

        $newCategorie = $prestationsService->getCategorieById($newCategorieId);

        $routeParser = RouteContext::fromRequest($request)->getRouteParser();
        $url = $routeParser->urlFor('categories');
        return $response->withHeader('Location', $url)->withStatus(302);
    }

}