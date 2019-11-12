<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InputOutput extends Model //control de personas en E/S
{
    protected $table = 'inputoutput';

    protected $fillable = [
        'person_id', 'inside', 'outside', 'employe_id', 'branch_id'
    ];

    public function visitors()
    {
        return $this->hasmany('App\Visitor');
    }

    public function person()
    {
        return $this->hasone('App\Person', 'person_id');
    }

    public function employe()
    {
        return $this->belongsTo('App\Employe');
    }

    public function branch()
    {
        return $this->belongsTo('App\Branch');
    }
    
    public function reservation()
    {
        return $this->belongsTo('App\Reservation');
    }

}
