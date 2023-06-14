<?php

namespace gift\app\actions;

use gift\app\services\box\BoxService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Views\Twig;

class BoxDetailsAction {
    public function __invoke (ServerRequestInterface $request, ResponseInterface $response, $args) : ResponseInterface {

        $boxService = new BoxService();
        //$box = $boxService->getBoxById($_SESSION['box_id']);

        $box = $args['id'];

        $prestations = $boxService->getPrestations($box);


        $view = Twig::fromRequest($request);
        return $view->render($response, 'box.twig', [
            'box' => $box,
            'prestations' => $prestations
        ]);
    }
}