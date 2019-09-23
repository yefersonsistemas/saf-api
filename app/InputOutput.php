<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InputOutput extends Model //control de personas en E/S
{
    protected $fillable = [
        'person_id', 'status', 'branchoffice_id'
    ];

    public function visitors()
    {
        return $this->hasmany('App\Visitor');
    }
}
