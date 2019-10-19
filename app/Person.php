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
        return $this->hasOne('App\User');
    }

    public function employe()
    {
        return $this->hasOne('App\Employe');
    }

    public function patient()
    {
        return $this->hasmany('App\Patient');
    }

    public function visitor()
    {
        return $this->belongsTo('App\Visitor');
    }
    public function branch()
    {
        return $this->belongsTo('App\Branch');
    }

      public function reservation()
    {
        return $this->belongsTo('App\Reservation');
    }

    public function position()
    {
        return $this->belongsTo('App\Position');
    }
}
