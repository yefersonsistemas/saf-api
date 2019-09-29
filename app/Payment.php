<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $table = 'payments';

    protected $fillable = [ //pagos
        'total_withdrawal', 'total', 'employe_id', 'branch_id'
    ];

    public function employe()
    {
        return $this->belongsTo('App\Employe');
    }
    public function branch()
    {
        return $this->belongsTo('App\Branch');
    }
}
