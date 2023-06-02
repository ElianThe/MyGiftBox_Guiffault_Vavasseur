<?php

namespace gift\app\actions;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Views\Twig;

class AccueilAction {
    public function __invoke (ServerRequestInterface $request, ResponseInterface $response, $args) : ResponseInterface {


        $view = Twig::fromRequest($request);
        return $view->render($response, 'home.twig');
    }
}