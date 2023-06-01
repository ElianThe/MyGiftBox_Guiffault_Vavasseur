<?php

namespace gift\app\actions;

use gift\app\services\prestations\PrestationsService;
use gift\app\services\utils\CsrfService;
use Slim\Views\Twig;

class NewCategorieAction
{
    public function __invoke($request, $response, $args)
    {

        $libelle = $request->getParsedBody()['categ_lib'];
        $description = $request->getParsedBody()['categ_desc'];

        $data = [
            'libelle' => $libelle,
            'description' => $description,
        ];

        $prestationsService = new PrestationsService();
        $newCategorie = $prestationsService->addCategorie($data);

        $view = Twig::fromRequest($request);
        return $view->render($response, 'categorie_created.twig', [
            'newCategorie' => $newCategorie,
        ]);
    }

}