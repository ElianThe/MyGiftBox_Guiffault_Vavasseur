<?php

namespace gift\app\actions;

use gift\app\services\user\UserService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Views\Twig;

class ResetPasswordPostAction
{
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, $args): ResponseInterface
    {

        $param = $request->getParsedBody();

        $data = [
            'password' => $param['password'],
            'confirm_password' => $param['confirm_password'],
        ];


        $userService = new UserService();
        $userService->updatePassword($data);


        $view = Twig::fromRequest($request);
        return $view->render($response, 'profil.twig', [
            'success' => 'Votre mot de passe a bien été modifié',
        ]);
    }
}