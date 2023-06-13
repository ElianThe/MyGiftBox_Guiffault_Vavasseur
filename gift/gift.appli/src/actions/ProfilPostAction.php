<?php

namespace gift\app\actions;

use gift\app\services\user\UserService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Views\Twig;

class ProfilPostAction
{
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, $args): ResponseInterface
    {
        $param = $request->getParsedBody();

        if (empty($param['nom']) || empty($param['prenom']) || empty($param['email'])) {
            $user = $_SESSION['user'];
            $view = Twig::fromRequest($request);
            return $view->render($response, 'profil.twig', [
                'user' => $user,
                'error' => 'Veuillez remplir tous les champs',
            ]);
        }

        $data = [
            'nom' => $param['nom'],
            'prenom' => $param['prenom'],
            'email' => $param['email'],
        ];

        $userService = new UserService();
        $userService->updateUser($data);

        $view = Twig::fromRequest($request);
        return $view->render($response, 'profil.twig', [
            'user' => $data,
            'success' => 'Vos informations ont bien été modifiées',
        ]);
    }
}