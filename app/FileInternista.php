<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FileInternista extends Model
{
    protected $table = 'file_internista';

    protected $fillable = [
        'path', 'fileeable_id', 'fileable_type', 'branch_id'
    ];
}
