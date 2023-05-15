<?php

namespace gift\app\actions;

use Slim\Psr7\Request;
use Slim\Psr7\Response;


class FormBoxesAction
{
    public function __invoke (Request $request, Response $response, array $args) : Response {
        $html = <<<HTML
            <!DOCTYPE html>
            <html lang="fr">
                <head>
                    <meta charset="UTF-8">
                    <title>Ajout boxes</title>
                </head>
                <body>
                    <form>
                        <label for="libelle">Libelle</label>
                        <input type="text" id="libelle" name="libelle"><br>
                        
                        <label for="description">description</label>
                        <input type="text" id="description" name="description"><br>
                        
                        <label for="montant">montant</label>
                        <input type="text" id="montant" name="montant"><br>
                        
                        <label for="kdo">kdo</label>
                        <input type="text" id="kdo" name="kdo"><br>     
                        
                        <label for="message_kdo">message du kdo</label>
                        <input type="text" id="message_kdo" name="message_kdo"><br>
                        
                        <label for="status">Status</label>
                        <input type="text" id="status" name="status"><br>
                        
                        <input type="submit" value="Envoyer">
                    </form>
                </body>
            </html>
HTML;
        $response->getBody()->write($html);
        return $response;
    }
}
