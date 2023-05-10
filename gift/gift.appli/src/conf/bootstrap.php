<?php


// Autres instructions et initialisations nécessaires

// Définition de la fonction bootstrap

// Code de configuration et d'initialisation de l'application
$app = \Slim\Factory\AppFactory::create();
$app->addRoutingMiddleware();
$app->setBasePath('/ArchitectureLogiciel/MyGiftBox_Guiffault_Vavasseur/gift/gift.appli/public');
// Retourner l'application configurée
return $app;