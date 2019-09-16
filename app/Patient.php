<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $fillable = [
        'date', 'history_number', 'reason', 'name', 'lastname', 'type_dni', 'dni', 'gender', 'phone', 'another_phone', 'email', 'another_email', 'place', 'birthdate', 'age','weight', 'occupation', 'address', 'previous_surgery', 'profession', 'doctor_id',
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
