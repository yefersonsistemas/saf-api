<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model  //guarda todos los examennes realizados acada paciente
{
    protected $table = 'file';

    protected $fillable = [
        'path', 'fileeable_id', 'fileable_type', 'branch_id'
    ];
}
