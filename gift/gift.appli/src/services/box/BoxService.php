<?php

namespace gift\app\services\box;

use Ramsey\Uuid\Uuid;
use gift\app\models\Box;
use gift\app\services\utils\CsrfService;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class BoxService
{
    public function getBoxes () : array {
        try {
            $boxes = Box::all()->toArray();
        } catch (ModelNotFoundException $exception) {
            throw new BoxesNotFoundException();
        }
        return $boxes;
    }

    public function getBoxById ($id) : array {
        try {
            $box = Box::where('id', $id)->first()->toArray();
        } catch (ModelNotFoundException $exception) {
            throw new BoxesNotFoundException();
        }
        return $box;
    }

    public function addBox($data): int {
        $box = new Box();
        $box->id =  Uuid::uuid4()->toString();
        $box->token = CsrfService::generateToken();
        $box->libelle = $data['libelle'];
        $box->description = $data['description'];
        $box->montant = 0;
        $box->kdo = $data['kdo'];
        $box->message_kdo = $data['message_kdo'];
        $box->statut = Box::CREATED;
        $box->save();
        return $box->id;
    }
}