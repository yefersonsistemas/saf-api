<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $fillable = [
        'date', 'description', 'status', 'schedule_id', 'branchoffice_id'
    ];

    public function employe()
    {
        return $this->belongsTo('App\Emplopye','employe_id');
    }

    public function consultationType()
    {
        return $this->belongsTo('App\ConsultationType');
    }

    public function schedule()
    {
        return $this->belongsTo('App\Schedule','schedule_id');
    }

    public function patient()
    {
        return $this->belongsTo('App\Patient');
    }


}
