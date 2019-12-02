<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    protected $table = 'recipe';

    protected $fillable = [
        'patient_id', 'employe_id', 'medicine_id', 'branch_id'
    ];

    public function employe()
    {
        return $this->belongsTo('App\Employe');
    }

    public function patient()
    {
        return $this->belongsTo('App\Person', 'patient_id');
    }

    public function medicine()
    {
        return $this->belongsTo('App\Medicine');
    }

}
