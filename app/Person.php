<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'persons';

    protected $fillable = [ //pagos
        'type_dni', 'dni', 'name', 'lastname', 'address', 'phone', 'email', 'branch_id'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function employe()
    {
        return $this->belongsTo('App\Employe');
    }

    public function patient()
    {
        return $this->belongsTo('App\Patient');
    }

    public function visitor()
    {
        return $this->belongsTo('App\Visitor');
    }
    public function branch()
    {
        return $this->belongsToMany('App\Branch');
    }

      public function reservation()
    {
        return $this->belongsTo('App\Reservation');
    }
}
