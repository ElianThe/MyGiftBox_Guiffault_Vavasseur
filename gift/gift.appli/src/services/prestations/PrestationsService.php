<?php

namespace gift\app\services\prestations;

use gift\app\models\Categorie;
use gift\app\models\Prestation;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class PrestationsService
{
    public function getCategories(): array {
        try {
            $categories = Categorie::get()->toArray();
        } catch (\Exception $exception) {
            throw new ModelNotFoundException('Categorie non trouvée', 404);
        }
        return $categories;
    }

    public function getCategorieById(int $id): array {
        try {
            $categorie = Categorie::where('id', $id)->firstOrFail()->toArray();
        } catch (\Exception $exception) {
            throw new ModelNotFoundException('Categorie non trouvée', 404);
        }
        return $categorie;
    }

    public function getPrestationById(string $id): array {
        try {
            return Prestation::where('id', $id)->first()->toArray();
        } catch (\Exception $exception) {
            throw new ModelNotFoundException('Prestation non trouvée', 404);
        }
    }

    public function getPrestationsbyCategorie(int $categ_id):array {
        try {
            return Prestation::where('cat_id', $categ_id)->get()->toArray();
        } catch (\Exception $exception) {
            throw new ModelNotFoundException('Prestation non trouvée', 404);
        }

    }
}