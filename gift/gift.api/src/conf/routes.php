<?php

use gift\app\actions\MenuAction;

return function (\Slim\App $app) {
    $app->get('/route', MenuAction::class);
};