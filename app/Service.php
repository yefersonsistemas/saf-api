<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{//esta tabla es para la pagina donde colocan todos los servicios operaciones, cirugias, etc
    
    protected $table = 'services';

    protected $fillable = [
        'name', 'description', 'branch_id'
    ];

    public function specialitie()
    {
        return $this->belongsTo('App\Speciality');
    }
}
