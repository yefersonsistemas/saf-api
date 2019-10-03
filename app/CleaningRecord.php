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

    public function person()
    {
        return $this->belongsTo('App\Person');
    }

    public function position()
    {
        return $this->belongsTo('App\Position');
    }

    public function employe()
    {
        return $this->belongsTo('App\Employe');
    }

    public function typecleaning()
    {
        return $this->belongsTo('App\TypeCleaning');
    }
}
