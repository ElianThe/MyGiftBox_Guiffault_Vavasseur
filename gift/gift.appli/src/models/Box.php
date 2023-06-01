<?php

namespace gift\app\models;

use Illuminate\Database\Eloquent\Model;

class Box extends Model
{
    protected $table = 'box';
    protected $primaryKey = 'id';
    public $timestamps = true;

    const CREATED = 1;
    const NOT_CREATED = 0;
    const STATUT = [
        self::CREATED => 'Créée',
        self::NOT_CREATED => 'Non créée',
    ];

    public function prestations () {
        return $this->belongsToMany('gift\app\models\Prestation', 'box2presta', 'box_id', 'presta_id')->withPivot(['quantite']);
    }
}