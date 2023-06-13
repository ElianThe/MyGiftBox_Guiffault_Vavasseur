<?php

namespace gift\app\actions;

use gift\app\services\user\UserService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Routing\RouteContext;
use Slim\Views\Twig;

class ConnexionPostAction
{
    public function __invoke (ServerRequestInterface $request, ResponseInterface $response, $args) : ResponseInterface {

        $params = $request->getParsedBody();

        $data = [
            'email' => $params['email'],
            'password' => $params['password'],
        ];

        // verification que l'utilisateur existe dans la base de données et que le mot de passe est correct
        $userService = new UserService();
        $user = $userService->getUserFromEmail($data['email']);
        if (empty($user) || !password_verify($data['password'], $user['password'])) {
            $view = Twig::fromRequest($request);
            return $view->render($response, 'connexion.twig', [
                'error' => 'Identifiants incorrects',
            ]);
        }

        // si l'utilisateur existe, on le connecte
        $_SESSION['user'] = $user;


        $routeParser = RouteContext::fromRequest($request)->getRouteParser();
        $url = $routeParser->urlFor('home');
        return $response->withHeader('Location', $url)->withStatus(302);
    }

}