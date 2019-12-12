<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reference extends Model
{
    protected $table = 'references';

    protected $fillable = [
        'patient_id', 'specialitie_id', 'employe_id', 'doctor', 'reason' 
    ];

    public function patient()
    {
        return $this->belongsTo('App\Person');
    }

    public function employe()
    {
        return $this->belongsTo('App\Employe');
    }
    
    public function speciality()
    {
        return $this->belongsTo('App\Speciality','specialitie_id');
    }

}
