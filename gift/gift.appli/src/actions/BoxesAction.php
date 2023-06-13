<?php

namespace gift\app\actions;

use gift\app\services\box\BoxService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Views\Twig;

class BoxesAction {
    public function __invoke (ServerRequestInterface $request, ResponseInterface $response, $args) : ResponseInterface {

        $boxService = new BoxService();
        $boxes = $boxService->getBoxes();

        $view = Twig::fromRequest($request);
        return $view->render($response, 'boxes_list.twig', [
            'boxes' => $boxes,
        ]);
    }
}