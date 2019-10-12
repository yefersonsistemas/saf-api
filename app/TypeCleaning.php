<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TypeCleaning extends Model //tipo de limpieza
{
    protected $table = 'type_cleaning';

    protected $fillable = [ //pagos
        'name', 'description', 'branch_id'
    ];

    public function person()
    {
        return $this->belongsTo('App\Person');
    }

    public function branch()
    {
        return $this->belongsTo('App\Branch');
    }

    public function employe() //relacion  con la tabla m:m 
    {
        return $this->belongsToMany('App\Employe','employe_cleaning')
       ->withPivot('employe_id','id');
    }

    public function position()
    {
        return $this->belongsTo('App\Position');
    }

    public function recordcleaning()
    {
        return $this->belongsTo('App\CleaningRecord');
    }
}
