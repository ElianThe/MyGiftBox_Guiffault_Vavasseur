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
        } catch (ModelNotFoundException $exception) {
            throw new PrestationNotFoundException('Categorie non trouvée', 404);
        }
        return $categories;
    }

    public function getCategorieById(int $id): array {
        try {
            $categorie = Categorie::where('id', $id)->firstOrFail()->toArray();
        } catch (ModelNotFoundException $exception) {
            throw new PrestationNotFoundException('Categorie non trouvée', 404);
        }
        return $categorie;
    }

    public function getPrestationById(string $id): ?Prestation {
        try {
            return Prestation::where('id', $id)->firstOrFail();
        } catch (ModelNotFoundException $exception) {
            throw new PrestationNotFoundException('Prestation non trouvée', 404);
        }
    }

    public function getPrestationsbyCategorie(int $categ_id):array {
        try {
            return Prestation::where('cat_id', $categ_id)->get()->toArray();
        } catch (ModelNotFoundException $exception) {
            throw new PrestationNotFoundException('Prestation non trouvée', 404);
        }
    }

    public function updatePrestation(array $attributs) {
        try {
            $prestation = Prestation::where('id', $attributs['id'])->firstOrFail();

            if (isset($attributs['libelle']))
            $prestation->libelle = $attributs['libelle'];

            if (isset($attributs['description']))
            $prestation->description = $attributs['description'];

            if (isset($attributs['unite']))
            $prestation->unite = $attributs['unite'];

            if (isset($attributs['tarif']))
            $prestation->tarif = $attributs['tarif'];

            $prestation->save();
        } catch (ModelNotFoundException $exception) {
            throw new PrestationNotFoundException('Prestation non trouvée', 404);
        }
    }

    public function updateCatOfPrestation(string $idPrestation, int $idCategorie) {
        try {
            $prestation = Prestation::where('id', $idPrestation)->firstOrFail();
            $prestation->attach($idCategorie);
        } catch (ModelNotFoundException $exception) {
            throw new PrestationNotFoundException('Prestation non trouvée', 404);
        }
    }

    public function addCategorie($data) : int {
        if($data['libelle'] != filter_var($data['libelle'], FILTER_SANITIZE_FULL_SPECIAL_CHARS))
            throw new PrestationNotFoundException('Libelle invalide');
        if($data['description'] != filter_var($data['description'], FILTER_SANITIZE_FULL_SPECIAL_CHARS))
            throw new PrestationNotFoundException('Description invalide');

        $categorie = new Categorie();
        $categorie->libelle = $data['libelle'];
        $categorie->description = $data['description'];
        $categorie->save();
        return $categorie->id;
    }

    public function deleteCategorie(int $id) {
        try {
            $categorie = Categorie::where('id', $id)->firstOrFail();
            $categorie->delete();
        } catch (ModelNotFoundException $exception) {
            throw new PrestationNotFoundException('Categorie non trouvée', 404);
        }
    }

    public function getPrestations() {
        try {
            $prestations = Prestation::all()->toArray();
        } catch (ModelNotFoundException $exception) {
            throw new PrestationNotFoundException('Prestation non trouvée', 404);
        }
        return $prestations;
    }
}