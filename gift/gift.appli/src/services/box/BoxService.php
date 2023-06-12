<?php

namespace gift\app\services\box;

use gift\app\models\Prestation;
use gift\app\services\prestations\PrestationNotFoundException;
use gift\app\models\Box;
use gift\app\services\utils\CsrfService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Ramsey\Uuid\Uuid;

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

    public function getBoxById (string $id) : array {
        try {
            $box = Box::where('id', $id)->firstOrFail()->toArray();
        } catch (ModelNotFoundException $exception) {
            throw new BoxesNotFoundException('Id not found');
        }
        return $box;
    }

    public function getPrestations () {
        try {
            $box = new Box();
            $prestations = $box->prestations();
        }  catch (ModelNotFoundException $exception) {
            throw new BoxesNotFoundException();
        }
        return $prestations;
    }

    public function addBox($data): string {
        if ($data['libelle'] != filter_var($data['libelle'], FILTER_SANITIZE_SPECIAL_CHARS)){
            throw new BoxServiceBadDataException('Bad data : libelle');
        }
        if ($data['description'] != filter_var($data['description'], FILTER_SANITIZE_SPECIAL_CHARS)){
            throw new BoxServiceBadDataException('Bad data : description');
        }
        if ($data['kdo'] != filter_var($data['kdo'], FILTER_SANITIZE_NUMBER_INT)){
            throw new BoxServiceBadDataException('Bad data : kdo');
        }
        if ($data['message_kdo'] != filter_var($data['message_kdo'], FILTER_SANITIZE_SPECIAL_CHARS)){
            throw new BoxServiceBadDataException('Bad data : message_kdo');
        }

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

    public function addPrestaToBox(string $idPrestation, string $idBox): void
    {
        try {
            $prestation = Prestation::where('id', $idPrestation)->firstOrFail();
            $prestation->attach($idBox);

            $box = Box::where('id', $idBox)->firstOrFail();
            $box->montant += $prestation->tarif;
            $box->save();

        } catch (ModelNotFoundException $exception) {
            throw new PrestationNotFoundException('Prestation non trouvée', 404);
        }
    }
}