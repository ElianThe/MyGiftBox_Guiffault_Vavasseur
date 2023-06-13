<?php

namespace gift\app\actions;

use gift\app\services\user\UserService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Routing\RouteContext;

class DeconnexionAction
{
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, $args) : ResponseInterface
    {
        $userService = new UserService();
        $userService->disconnect();

        $routeParser = RouteContext::fromRequest($request)->getRouteParser();
        $url = $routeParser->urlFor('home');
        return $response->withHeader('Location', $url)->withStatus(302);

    }

}