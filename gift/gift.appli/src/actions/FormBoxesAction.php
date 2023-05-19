<?php

namespace gift\app\actions;

use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Slim\Views\Twig;


class FormBoxesAction
{
    public function __invoke (Request $request, Response $response, array $args) : Response {


        $view = Twig::fromRequest($request);
        return $view->render($response, 'box_form.twig');
    }
}
