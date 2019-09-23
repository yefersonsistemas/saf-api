<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model  //curso
{
    protected $fillable = [
        'name', 'description', 'specialitie_id', 'program_id', 'Branchoffice_id'
    ];
    
    public function users()
    {
        return $this->belongsToMany('App\User');
    }

    public function specialitie()
    {
        return $this->belongsTo('App\Speciality');
    }

    public function program()
    {
        return $this->belongsTo('App\Program');
    }

    public function educationalGuides()
    {
        return $this->belongsToMany('App\EducationalGuide');
    }
    
}
