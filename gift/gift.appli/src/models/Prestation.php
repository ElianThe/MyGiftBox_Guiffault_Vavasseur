<?php

namespace gift\app\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Prestation extends Model
{

    protected $table = 'prestation';
    protected $primaryKey = 'id';
    public $timestamps = false;
    public $incrementing = false;
    public $keyType = 'string';
    public $fillable = ["id", "libelle", "description", "tarif", "unite"];

    public function categorie() : BelongsTo
    {
        return $this->belongsTo(Categorie::class, 'cat_id');
    }

}