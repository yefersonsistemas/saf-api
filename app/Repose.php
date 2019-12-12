<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Repose extends Model
{
    protected $table = 'reposes';

    protected $fillable = [
        'patient_id', 'employe_id','description','branch_id'
    ];

    public function patient()
    {
        return $this->hasOne('App\Person');
    }

    public function employe()
    {
        return $this->hasOne('App\Employe');
    }

    public function branch()
    {
        return $this->belongsTo('App\Branch');
    }

}
