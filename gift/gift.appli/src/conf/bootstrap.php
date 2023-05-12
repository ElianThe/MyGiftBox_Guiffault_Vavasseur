<?php
use gift\app\services\utils\Eloquent;


// Autres instructions et initialisations nécessaires

// Définition de la fonction bootstrap

// Code de configuration et d'initialisation de l'application

$app = \Slim\Factory\AppFactory::create();
$app->addRoutingMiddleware();
$app->setBasePath('/ArchitectureLogiciel/MyGiftBox_Guiffault_Vavasseur/gift/gift.appli/public');

//gestionnaire d'erreur
$app->addErrorMiddleware(true, false, false);

// Initialisation de Eloquent
Eloquent::init(__DIR__ . DIRECTORY_SEPARATOR .'gift.db.conf.ini.dist');

// Retourner l'application configurée
return $app;