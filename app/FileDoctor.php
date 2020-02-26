<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FileDoctor extends Model
{
    protected $table = 'file_doctor';

    protected $fillable = [
        'path', 'fileeable_id', 'fileable_type', 'branch_id'
    ];
}
