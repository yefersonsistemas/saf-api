<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Disease extends Model
{
    protected $table = 'diseases';

    protected $fillable = [
        'name', 'branch_id'
    ];

    public function patient()
    {
        return $this->belongsToMany('App\Patient','disease_patient')
                    ->withPivot('patient_id','id');
    }

    public function branch()
    {
        return $this->belongsTo('App\Branch');
    }

    public function person()
    {
        return $this->hasone('App\Person');
    }
}
