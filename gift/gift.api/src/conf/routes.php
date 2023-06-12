<?php

use gift\app\actions\BoxAction;
use gift\app\actions\MenuAction;

return function (\Slim\App $app) {
    $app->get('/api/categories', MenuAction::class);

    $app->get('/api/boxes/{id}', BoxAction::class);
};