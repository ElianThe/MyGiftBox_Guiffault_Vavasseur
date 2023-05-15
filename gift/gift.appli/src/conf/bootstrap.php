<?php
use gift\app\services\utils\Eloquent;

$app = \Slim\Factory\AppFactory::create();
$app->addRoutingMiddleware();
$app->setBasePath('/ArchitectureLogiciel/MyGiftBox_Guiffault_Vavasseur/gift/gift.appli/public');

//gestionnaire d'erreur
$app->addErrorMiddleware(true, false, false);

// Initialisation de Eloquent
Eloquent::init(__DIR__ . DIRECTORY_SEPARATOR .'gift.db.conf.ini');

// Retourner l'application configurée
return $app;