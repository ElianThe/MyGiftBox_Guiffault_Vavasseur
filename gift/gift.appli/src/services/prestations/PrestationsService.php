<?php

namespace gift\app\services\prestations;

use gift\app\models\Categorie;
use gift\app\models\Prestation;

class PrestationsService
{
    public function getCategories() {
        return Categorie::get();
    }
    public function getCategorieById(int $id): array {
        return Categorie::where('id', $id)->first();
    }
    public function getPrestationById(string $id): array {
        return Prestation::where('id', $id)->first();
    }
    public function getPrestationsbyCategorie(int $categ_id):array {
        return Prestation::categorie()->where('id', $id);
    }
}