<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Classification extends Model
{
    protected $table = 'classifications';

    protected $fillable = [
        'name', 'branch_id'
    ];

    public function area()
    {
        return $this->belongsTo('App\Area');
    }
}
