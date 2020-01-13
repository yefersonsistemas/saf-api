<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Diagnostic extends Model
{
    protected $table = 'diagnostics';

    protected $fillable = [
        'patient_id', 'description', 'reason', 'treatment_id', 'indications', 'enfermedad_actual', 'examen_fisico', 'employe_id', 'report_medico_id', 'repose_id', 'branch_id'
    ];

    public function patient()
    {
        return $this->belongsTo('App\Patient');
    }

    public function payment()
    {
        return $this->hasOne('App\Payment');
    }

    public function repose()
    {
        return $this->belongsTo('App\Repose');
    }

    public function reportMedico()
    {
        return $this->belongsTo('App\ReportMedico');
    }

    public function employe()
    {
        return $this->belongsTo('App\Employe', 'employe_id');
    }

    public function branch()
    {
        return $this->belongsTo('App\Branch');
    }

     public function reservation()
    {
        return $this->belongsTo('App\Reservation');
    }

    public function treatment()
    {
        return $this->belongsTo('App\Treatment');
    }

    public function speciality()
    {
        return $this->belongsTo('App\Speciality');
    }
    
    public function exams()
    {
        return $this->belongsTo('App\Exam');
    }
    
    public function exam() 
    {
        return $this->belongsToMany('App\Exam','diagnostic_exam')
       ->withPivot('exam_id','id');
    }

    public function procedures() 
    {
        return $this->belongsToMany('App\Procedure','diagnostic_procedure')
       ->withPivot('procedure_id','id');
    }

}
