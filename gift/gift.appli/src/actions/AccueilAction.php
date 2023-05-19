<?php

namespace gift\app\actions;
use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Slim\Views\Twig;

class AccueilAction {
    public function __invoke (Request $request, Response $response, $args) : Response {
        $basePath = '/ArchitectureLogiciel/MyGiftBox_Guiffault_Vavasseur/gift/gift.appli/public/';


        $view = Twig::fromRequest($request);
        return $view->render($response, 'home.twig', [
            'basePath' => $basePath
        ]);
    }
}