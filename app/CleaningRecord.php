<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CleaningRecord extends Model //registro de limpieza
{
    protected $table = 'cleaning_record';

    protected $fillable = [ 
        'employe_id', 'area_id', 'type_cleaning_id', 'branch_id'
    ];

    public function branch()
    {
        return $this->belongsTo('App\Branch');
    }
}
