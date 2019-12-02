<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Treatment extends Model
{
    protected $table = 'treatments';

    protected $fillable = [
        'medicine_id', 'measure', 'doses', 'duration', 'branch_id', 'indications',
    ];

    public function diagnostic()
    {
        return $this->belongsTo('App\Diagnostic', 'treatment_id');
    }

    public function medicine()
    {
        return $this->belongsTo('App\Medicine','medicine_id');
    }
}
