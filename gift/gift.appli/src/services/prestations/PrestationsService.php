<?php

namespace gift\app\services\prestations;

use gift\app\models\Categorie;
use gift\app\models\Prestation;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Slim\Exception\HttpBadRequestException;

class PrestationsService
{
    public function getCategories(): array {
        return Categorie::get()->toArray();
    }
    public function getCategorieById(int $id): array {
        return Categorie::where('id', $id)->first()->toArray();
    }
    public function getPrestationById(string $id): array {
        $prestationsService = new PrestationsService();
        try {
            return Prestation::where('id', $id)->first()->toArray();
        } catch (\Exception $e) {
            throw new ModelNotFoundException('Prestation non trouvée', 404);
        }
    }
    public function getPrestationsbyCategorie(int $categ_id):array {
        return Prestation::categorie()->where('id', $id)->get()->toArray();
    }
}