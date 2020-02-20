<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Informesurgery extends Model
{
    protected $table = 'informe_surgery';

    protected $fillable = [ 
        'file_id', 'surgery_id', 'branch_id'
    ];

    public function surgery()
    {
        return $this->belongsTo('App\Surgery','surgery_id');
    }
}
