<?php

namespace gift\app\actions;

use gift\app\services\box\BoxService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Routing\RouteContext;
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

        $routeParser = RouteContext::fromRequest($request)->getRouteParser();
        $url = $routeParser->urlFor('categories');
        return $response->withHeader('Location', $url)->withStatus(302);
    }
}