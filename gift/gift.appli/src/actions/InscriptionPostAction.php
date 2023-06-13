<?php

namespace gift\app\actions;

use gift\app\services\user\UserService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Routing\RouteContext;
use Slim\Views\Twig;

class InscriptionPostAction
{
    public function __invoke (ServerRequestInterface $request, ResponseInterface $response, $args) : ResponseInterface {

        $params = $request->getParsedBody();

        $data = [
            'nom' =>  $params['nom'],
            'prenom' => $params['prenom'] ?? '',
            'email' => $params['email'],
            'password' => $params['password'],
        ];

        $userService = new UserService();
        $userService->addUser($data);

        $user = $userService->getUserFromEmail($data['email']);
        $_SESSION['user'] = $user;

        $routeParser = RouteContext::fromRequest($request)->getRouteParser();
        $url = $routeParser->urlFor('home');
        return $response->withHeader('Location', $url)->withStatus(302);
    }


}