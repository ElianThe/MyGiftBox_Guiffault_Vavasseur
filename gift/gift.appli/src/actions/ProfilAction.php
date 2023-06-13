<?php

namespace gift\app\actions;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Views\Twig;

class ProfilAction
{
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, $args): ResponseInterface
    {

        $user = $_SESSION['user'];


        $view = Twig::fromRequest($request);
        return $view->render($response, 'box_created.twig', [
            'user' => $user,
        ]);
    }
}