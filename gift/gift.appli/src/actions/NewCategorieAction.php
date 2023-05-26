<?php

namespace gift\app\actions;

use gift\app\services\prestations\PrestationsService;
use gift\app\services\utils\CsrfService;
use Slim\Views\Twig;

class NewCategorieAction
{
    public function __invoke($request, $response, $args)
    {
        $prestationsService = new PrestationsService();
        $csrfToken = CsrfService::generateToken();
        $newCategorie = $prestationsService->addCategorie();

        $view = Twig::fromRequest($request);
        return $view->render($response, 'new_categorie.twig', [
            'newCategorie' => $newCategorie,
            'csrfToken' => $csrfToken,
        ]);
    }

}