<?php
use gift\app\services\utils\Eloquent;

$app = \Slim\Factory\AppFactory::create();
$app->addBodyParsingMiddleware();
//gestionnaire d'erreur
$app->addErrorMiddleware(true, false, false);

// Initialisation de Eloquent
Eloquent::init(__DIR__ . DIRECTORY_SEPARATOR .'gift.db.conf.ini');

// Retourner l'application configurée
return $app;