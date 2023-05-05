<?php

namespace gift\app\models;

use Illuminate\Database\Eloquent\Model;

class Box extends Model
{
    protected $table = 'box';
    protected $primaryKey = 'id';
    public $timestamps = true;

    public function prestations () {
        return $this->belongsToMany('gift\app\models\Prestation', 'box2presta', 'box_id', 'presta_id')->withPivot(['quatite']);
    }
}