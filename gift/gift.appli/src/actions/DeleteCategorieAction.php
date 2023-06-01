<?php

namespace gift\app\actions;

use gift\app\services\prestations\PrestationsService;
use gift\app\services\utils\CsrfService;
use Slim\Views\Twig;

class DeleteCategorieAction
{
    public function __invoke($request, $response, $args)
    {
        $prestationsService = new PrestationsService();
        $categ_id = null ?? $args['categ_id'];

        if (!isset($categ_id)) {
            $view = Twig::fromRequest($request);
            return $view->render($response, 'error.twig', [
                'message' => 'Categorie non trouvé',
            ]);
        }

        $prestationsService->deleteCategorie($categ_id);

        $view = Twig::fromRequest($request);
        return $view->render($response, 'categories_list.twig', [
            'categories' => $prestationsService->getCategories(),
        ]);

    }
}