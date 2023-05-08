<?php

namespace gift\app\models;

use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    protected $table = 'categorie';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function prestations () {
        return $this->hasMany(Prestation::class, 'cat_id', 'id');
    }

}