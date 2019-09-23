<?php

namespace App;

use Illuminate\Database\Eloquent\Model;



class Allergy extends Model //alergia
{
    protected $fillable = [
        'name', 'branchoffice_id'
    ];
    public function patients()
    {
        return $this->belongsToMany('App\Patient');
    }
}
