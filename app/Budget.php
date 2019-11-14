<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Budget extends Model
{
    protected $table = 'budget';

    protected $fillable = [
        'employe_id', 'surgery_id', 'procedure_id', 'hospitalization_id', 'equipment_id', 'branch_id'
    ];

    public function employe()
    {
        return $this->belongsTo('App\Employe');
    }

    public function surgery()
    {
        return $this->belongsTo('App\Surgery');
    }

    public function procedure()
    {
        return $this->belongsTo('App\Procedure');
    }

    public function hospitalization()
    {
        return $this->belongsTo('App\Hospitalization');
    }

    public function equipment()
    {
        return $this->belongsTo('App\Equipment');
    }
}
