<?php

namespace gift\app\actions;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Views\Twig;

class AccueilAction {
    public function __invoke (ServerRequestInterface $request, ResponseInterface $response, $args) : ResponseInterface {
        $basePath = '/ArchitectureLogiciel/MyGiftBox_Guiffault_Vavasseur/gift/gift.appli/public/';


        $view = Twig::fromRequest($request);
        return $view->render($response, 'home.twig', [
            'basePath' => $basePath
        ]);
    }
}