<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InputOutput extends Model //control de personas en E/S
{
    protected $table = 'inputoutput';

    protected $fillable = [
        'person_id', 'status', 'branch_id'
    ];

    public function visitors()
    {
        return $this->hasmany('App\Visitor');
    }

    public function branch()
    {
        return $this->belongsTo('App\Branch');
    }
}
