<?php

namespace gift\app\actions;

use gift\app\services\box\BoxService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class BoxAction
{
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response,$args) {

        $id = null ?? $args['id'];

        $boxService = new BoxService();
        $box = $boxService->getBoxById($id);

        $data = [ 'type' => 'resource',
            'box' => $box ];

        $response->getBody()->write(json_encode($data));
        return
            $response->withHeader('Content-Type','application/json')
                ->withStatus(200);
    }


}