<?php

namespace gift\app\actions;

use gift\app\services\prestations\PrestationsService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class MenuAction
{
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response,$args) {

        $prestationService = new PrestationsService();
        $categorie = $prestationService->getCategories();

        $data = [ 'type' => 'resource',
            'categorie' => $categorie ];
        $response->getBody()->write(json_encode($data));
        return
            $response->withHeader('Content-Type','application/json')
                ->withStatus(200);
    }
}