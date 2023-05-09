<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;


return function (Slim\App $app) {
    $app->get('/',
        function (Request $rq, Response $rs, $args) : Response{
            $html = <<<EOM
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
                <html lang="en">
                <head>
                    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
                    <title>Document</title>
                </head>
                <body>
                <p>Coucouc</p>
                </body>
                </html>
EOM;

            $rs->getBody()->write($html);
            return $rs;
        });
        };
