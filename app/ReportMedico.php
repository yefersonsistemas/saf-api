<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReportMedico extends Model
{
    protected $table = 'reportMedicos';

    protected $fillable = [
        'patient_id', 'employe_id' ,'branch_id', 'diagnostic_id'
    ];

    public function patient()
    {
        return $this->belongsTo('App\Patient');
    }

    public function employe()
    {
        return $this->belongsTo('App\Employe');
    }
    
    public function diagnostic()
    {
        return $this->belongsTo('App\Diagnostic');
    }
}
