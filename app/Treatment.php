<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Treatment extends Model
{
    protected $table = 'treatments';

    protected $fillable = [
        'name', 'measure', 'doses', 'duration', 'branch_id'
    ];

    public function diagnostic()
    {
        return $this->belongsTo('App\Diagnostic', 'treatment_id');
    }
}
