<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Suspect extends Model
{
    protected $fillable = [
        'name',
        'nis'
    ];
}
