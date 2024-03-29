<?php

namespace gift\app\actions;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Views\Twig;
use function Symfony\Component\String\s;

class ProfilAction
{
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, $args): ResponseInterface
    {

        $user = $_SESSION['user'];
        $user = unserialize(serialize($user));


        $view = Twig::fromRequest($request);
        return $view->render($response, 'profil.twig', [
            'user' => $user,
        ]);
    }
}