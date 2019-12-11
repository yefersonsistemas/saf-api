<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Repose extends Model
{
    protected $table = 'repose';

    protected $fillable = [
        'patient_id', 'employe_id','description','branch_id'
    ];

    public function patient()
    {
        return $this->belongsTo('App\Patient');
    }

    public function employe()
    {
        return $this->belongsTo('App\Employe');
    }

}
