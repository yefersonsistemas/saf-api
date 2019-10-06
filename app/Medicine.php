<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{
    protected $table = 'medicines';

    protected $fillable = [
        'name', 'branch_id'
    ];
    public function patients()
    {
        return $this->belongsToMany('App\Patient','medicine_patient')
                    ->withPivot('patient_id','id');
    }

    public function branch()
    {
        return $this->belongsTo('App\Branch');
    }

    public function employe (){
        return $this->belongsTo('App\Employe', 'employe_id');
    }

    public function patient (){
        return $this->belongsTo('App\Patient', 'patient_id');
    }
}
