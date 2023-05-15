<?php

namespace gift\app\actions;

use gift\app\models\Box;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class NewBoxesPostAction
{
    function __invoke(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        $params = $request->getParsedBody();
        $name = $params['name'] ?? '';
        $description = $params['description'] ?? '';
        $html = <<<HTML
                <h1>Nouvelle box créée</h1>
                <p>Nom : {$name}</p>
                <p>Description : {$description}</p>
            HTML;
        $box = new Box();
        $box->libelle = $name;
        $box->description = $description;

        $box->save();
        $response->getBody()->write($html);
        return $response;
    }
}