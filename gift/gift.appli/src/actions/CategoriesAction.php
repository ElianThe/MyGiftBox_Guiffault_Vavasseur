<?php

namespace gift\app\actions;

use gift\app\services\prestations\PrestationNotFoundException;
use gift\app\services\prestations\PrestationsService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Exception\HttpNotFoundException;

use Slim\Views\Twig;

class CategoriesAction
{
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args)
    {
        $basePath = 'http://localhost/ArchitectureLogiciel/MyGiftBox_Guiffault_Vavasseur/gift/gift.appli/public/';
        $prestationService = new PrestationsService();
        try {
            $categories = $prestationService->getCategories();
        } catch (PrestationNotFoundException $exception) {
            throw new HttpNotFoundException($request, 'Catégorie non trouvée');
        }

        $view = Twig::fromRequest($request);
        return $view->render($response, 'categories_list.twig', [
            'categories' => $categories,
            'basePath' => $basePath
        ]);
    }
};