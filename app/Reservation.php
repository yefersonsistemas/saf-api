<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use App\Diagnostic;

class Reservation extends Model
{
    protected $table = 'reservations';

    protected $fillable = [
        'date', 'description', 'patient_id', 'approved', 'reschedule', 'cancel', 'discontinued', 'person_id', 'schedule_id', 'specialitie_id', 'branch_id', 
    ];

    public function employe()
    {
        return $this->belongsTo('App\Employe', 'person_id');
    }

    public function consultationType()
    {
        return $this->belongsTo('App\ConsultationType');
    }

    public function schedule()
    {
        return $this->belongsTo('App\Schedule','schedule_id');
    }

    public function person()
    {
        return $this->belongsTo('App\Person');
    }

    public function patient()
    {
        return $this->belongsTo('App\Person');
    }

    public function historyPatient()  //relacion con paciente
    {
        return $this->belongsTo('App\Patient', 'person_id');
    }

    public function branch()
    {
        return $this->belongsTo('App\Branch');
    }
    
    public function assistance()
    {
        return $this->belongsTo('App\Assistance');
    }

    public function cite()
    {
        return $this->hasMany('App\Cite', 'reservation_id');
    }

    public function speciality()
    {
        return $this->belongsTo('App\Speciality', 'specialitie_id');
    }

    public function inputoutput()
    {
        return $this->hasmany('App\InputOutput','person_id');
    }

    public function diagnostic($id)
    {
        $reservations = $this->where('patient_id', $id)->get();
        $diagnostics = collect([]);
        foreach ($reservations as $reservation) {
            $fecha = Carbon::parse($reservation->date)->format('Y-m-d');
            $diagnostic = Diagnostic::where('employe_id', $reservation->person_id)
            ->whereDate('created_at', $fecha)->where('patient_id' , $id)->get();
            $diagnostics->push($diagnostic);
        }
        return $diagnostics;
    }

}
