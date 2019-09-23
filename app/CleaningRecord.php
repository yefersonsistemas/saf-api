<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CleaningRecord extends Model //registro de limpieza
{
    protected $fillable = [ 
        'employe_id', 'area_id', 'type_cleaning_id', 'branchoffice_id'
    ];
}
