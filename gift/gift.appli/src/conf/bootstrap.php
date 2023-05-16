<?php
use gift\app\services\utils\Eloquent;

$app = \Slim\Factory\AppFactory::create();
$app->addRoutingMiddleware();
$app->setBasePath('/ArchitectureLogiciel/MyGiftBox_Guiffault_Vavasseur/gift/gift.appli/public');

//Create Twig
$twig = \Slim\Views\Twig::create( __DIR__ . '/../views/template',
                                    ['cache' => __DIR__ . 'views/cache',
                                    'auto_reload' => true]);

$app->add(
\Slim\Views\TwigMiddleware::create($app, $twig)) ;

//gestionnaire d'erreur
$app->addErrorMiddleware(true, false, false);

// Initialisation de Eloquent
Eloquent::init(__DIR__ . DIRECTORY_SEPARATOR .'gift.db.conf.ini');

// Retourner l'application configurée
return $app;