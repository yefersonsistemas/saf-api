<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClassificationSurgery extends Model
{
    protected $table = 'classification_surgery';

    protected $fillable = [
        'name', 'description', 'branch_id'
    ];

    public function surgery()
    {
        return $this->belongsTo('App\Surgery');
    }
}
