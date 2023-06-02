<?php

namespace gift\app\actions;

use gift\app\services\box\BoxService;
use gift\app\services\prestations\PrestationsService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Views\Twig;

class NewBoxesPostAction
{
    function __invoke(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        $params = $request->getParsedBody();

        $data = [
        'libelle' =>  $params['libelle'],
        'description' => $params['description'] ?? '',
        'kdo' => $params['kdo'],
        'message_kdo' => $params['message_kdo'],
        ];

        $box = new BoxService();
        $newBox = $box->addBox($data);

        $prestationsService = new PrestationsService();
        $prestations = $prestationsService->getPrestations();

        $view = Twig::fromRequest($request);
        return $view->render($response, 'box_created.twig', [
            'newBox' => $newBox,
            'prestations' => $prestations,
        ]);
    }
}