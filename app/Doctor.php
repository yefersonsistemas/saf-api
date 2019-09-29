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
        return $this->hasmany('App\Employe');
    }

    public function typedoctor()
    {
        return $this->belongsTo('App\TypeDoctor');
    }
    
    public function branch()
    {
        return $this->belongsTo('App\Branch');
    }
}
