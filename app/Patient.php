<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $table = 'patients';

    protected $fillable = [
        'date', 'history_number', 'person_id', 'gender', 'place', 'birthdate', 'age','weight',  'occupation', 'profession', 'another_phone', 'previous_surgery', 'employe_id', 'branch_id', 'another_email',
    ];

    public function diseases()
    {
        return $this->belongsToMany('App\Disease');
    }

    public function medicines()
    {
        return $this->belongsToMany('App\Medicine');
    }

    public function diagnostics()
    {
        return $this->hasMany('App\Diagnostic');
    }
    
    public function allergies()
    {
        return $this->belongsToMany('App\Allergy');
    }

    public function doctor()
    {
        return $this->belongsTo('App\User', 'doctor_id');
    }

    public function branch()
    {
        return $this->belongsTo('App\Branch');
    }

     public function reservation()
    {
        return $this->belongsTo('App\Reservation');
    }
    /**
     * Scope a query to only include patients by dni.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeByDni($query, $dni)
    {
        return $query->when($dni, function($query) use ($dni){
            $query->where('dni', $dni);
        });
    }

    /**
     * Scope a query to only include patients by name.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeByName($query, $name)
    {
        return $query->when($name, function ($query) use ($name){
            $query->orWhere('name', 'like', '%' . $name . '%')->orWhere('lastname', 'like', '%' . $name . '%');
        });
    }
}
