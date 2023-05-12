<?php

namespace gift\app\actions;

use Slim\Psr7\Request;
use Slim\Psr7\Response;

class AccueilAction {
    public function __invoke (Request $rq, Response $rs, $args) : \Slim\Psr7\Response {
        $basePath = 'http://localhost/ArchitectureLogiciel/MyGiftBox_Guiffault_Vavasseur/gift/gift.appli/public/';
        $html = <<<EOM
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
                <html lang="en">
                <head>
                    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
                    <title>Eliareg</title>
                </head>
                <body>
                <h1>Bienvenue sur notre page d'accueil Eliareg</h1>
                <a href="{$basePath}categories">Aller vers la liste des catégories</a>
                </body>
                </html>
EOM;
        $rs->getBody()->write($html);
        return $rs;
    }
}