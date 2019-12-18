<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model //clase de doctor
{
    protected $table = 'doctors';

    protected $fillable = [
        'employe_id', 'type_doctor_id', 'price', 'branch_id'
    ];

    public function employe()
    {
        return $this->belongsTo('App\Employe');
    }

    public function typedoctor()
    {
        return $this->belongsTo('App\TypeDoctor', 'type_doctor_id');
    }

    public function branch()
    {
        return $this->belongsTo('App\Branch');
    }
    
}
