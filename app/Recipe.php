<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    protected $table = 'recipe';

    protected $fillable = [
        'patient_id', 'employe_id', 'branch_id'
    ];

    public function employe()
    {
        return $this->belongsTo('App\Employe');
    }

    public function patient()
    {
        return $this->belongsTo('App\Person', 'patient_id');
    }

    public function treatmentR()
    {
        return $this->belongsTo('App\Treatment', 'recipe_id');
    }

    // public function medicine()
    // {
    //      return $this->belongsToMany('App\Medicine','recipe_medicine')
    //                   ->withPivot('medicine_id','id');
    // }

    public function treatment()
    {
         return $this->belongsToMany('App\Treatment','recipe_treatment')
                      ->withPivot('treatment_id','id');
    }



}
