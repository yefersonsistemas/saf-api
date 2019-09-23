<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model //clase de doctor
{
    protected $fillable = [
        'employe_id', 'type_doctor_id', 'price', 'branchoffice_id'
    ];

    public function employe()
    {
        return $this->hasmany('App\Employe');
    }

    public function typedoctor()
    {
        return $this->belongsTo('App\TypeDoctor');
    }
}
