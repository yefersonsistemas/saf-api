<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Record extends Model  //guarda todos los insumos y equipps que se agreguen como inversion en c/u de esas tablas
{
    protected $table = 'record';

    protected $fillable = [
        'quantity', 'recordable_id', 'recordable_type', 'branch_id'
    ];
}
