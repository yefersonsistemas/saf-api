<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reference extends Model
{
    protected $table = 'references';

    protected $fillable = [
        'patient_id', 'specialitie_id', 'employe_id', 'doctor', 'reason' 
    ];




}
