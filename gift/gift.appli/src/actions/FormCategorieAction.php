<?php

namespace gift\app\actions;

use gift\app\services\utils\CsrfService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Views\Twig;

class FormCategorieAction
{
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, $args)
    {
        $csrfToken = CsrfService::generateToken();

        $view = Twig::fromRequest($request);
        return $view->render($response, 'new_categorie.twig', [
            'csrfToken' => $csrfToken,
        ]);
    }

}