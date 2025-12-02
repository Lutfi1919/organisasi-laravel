<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Council extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'name',
        'nis',
        'photo_council',
        'updated_at',
        'created_at'
    ];
}
