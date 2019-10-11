<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = ['path', 'imageable_id', 'imageable_type', 'branch_id'];
    /**
     * Get all of the owning imageable models.
     */
    public function imageable()
    {
        return $this->morphTo();
    }

    public function branch()
    {
        return $this->belongsTo('App\Branch');
    }

}
