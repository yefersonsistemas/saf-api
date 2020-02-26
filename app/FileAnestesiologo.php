<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FileAnestesiologo extends Model
{
    protected $table = 'file_anestesiologo';

    protected $fillable = [
        'path', 'fileeable_id', 'fileable_type', 'branch_id'
    ];
}
