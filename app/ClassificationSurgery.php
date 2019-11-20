<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClassificationSurgery extends Model
{
    protected $table = 'classification_surgery';

    protected $fillable = [
        'name', 'description', 'branch_id'
    ];


    // pertenece a 
    public function typesurgeries()
    {
        return $this->hasMany('App\TypeSurgery','classification_surgery_id');
    }

}
