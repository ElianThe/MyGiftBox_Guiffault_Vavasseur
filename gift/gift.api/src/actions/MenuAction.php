<?php

namespace gift\app\actions;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class MenuAction
{
    public function __invoke(ServerRequestInterface $response, ResponseInterface $request, $args) {

        $html = <<<HTML
                <h1>Accueil</h1>
HTML;
        $response->getBody()->write($html);
        return $response;
    }
}