<?php

namespace App;

use Illuminate\Database\Eloquent\Model;



class Allergy extends Model
{
    protected $fillable = [
        'name', 'Branchoffice_id'
    ];
    public function patients()
    {
        return $this->belongsToMany('App\Patient');
    }
}
