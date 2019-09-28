<?php

namespace App;

use Illuminate\Database\Eloquent\Model;



class Allergy extends Model //alergia
{
    protected $table = 'allergies';

    protected $fillable = [
        'name', 'branch_id'
    ];
    public function patients()
    {
        return $this->belongsToMany('App\Patient');
    }

    public function branch()
    {
        return $this->belongsToMany('App\Branch');
    }
}
