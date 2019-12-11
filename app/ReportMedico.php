<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReportMedico extends Model
{
    protected $table = 'report_medicos';

    protected $fillable = [
        'patient_id', 'employe_id','descripction' ,'branch_id', 'diagnostic_id'
    ];

    public function patient()
    {
        return $this->hasOne('App\Patient');
    }

    public function employe()
    {
        return $this->hasOne('App\Employe');
    }
    
    public function diagnostic()
    {
        return $this->belongsTo('App\Diagnostic');
    }

    public function branch()
    {
        return $this->belongsTo('App\Branch');
    }
}
