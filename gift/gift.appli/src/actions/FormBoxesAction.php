<?php

namespace gift\app\actions;

use gift\app\services\utils\CsrfService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Views\Twig;


class FormBoxesAction
{
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, $args) {
        $view = Twig::fromRequest($request);
        return $view->render($response, 'box_form.twig');
    }
}
