<?php

namespace gift\app\actions;

use gift\app\models\User;
use gift\app\services\prestations\UserService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Views\Twig;

class InscriptionAction {
    public function __invoke (ServerRequestInterface $request, ResponseInterface $response, $args) : ResponseInterface {


        $view = Twig::fromRequest($request);
        return $view->render($response, 'inscription.twig');
    }
}