<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $table = 'notifications';

    protected $fillable = [
        'user_id', 'person_id', 'users_id', 'branch_id'
    ];

    public function person()
    {
        return $this->belongsTo('App\Person', 'person_id');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
