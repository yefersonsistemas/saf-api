<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Itinerary extends Model  //guarda toda la informacion del paciente durante la consulta
{
    protected $table = 'itinerary';

    protected $fillable = [
        'patient_id', 'employe_id', 'procedure_id', 'surgery_id', 'exam_id', 'recipe_id', 'reservation_id', 'branch_id', 'reference_id'
    ];

    public function employe()
    {
        return $this->belongsTo('App\Employe');
    }

    // public function patient()
    // {
    //     return $this->belongsTo('App\Patient', 'patient_id');
    // }

    public function procedure()
    {
        return $this->belongsTo('App\Procedure');
    }

    public function reference()
    {
        return $this->belongsTo('App\Reference');
    }

    public function surgery()
    {
        return $this->belongsTo('App\Surgery');
    }

    public function person()
    {
        return $this->belongsTo('App\Person', 'patient_id');
    }

    public function speciality()
    {
        return $this->belongsTo('App\Specilaity');
    }

    public function exam()
    {
        return $this->belongsTo('App\Exam');
    }

    public function recipe()
    {
        return $this->belongsTo('App\Recipe');
    }

    public function reservation()
    {
        return $this->belongsTo('App\Reservation');
    }

}
