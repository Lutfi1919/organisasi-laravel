<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Event extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'name',
        'photo_event',
        'date'
    ];

    public function getFormattedDateAttribute()
    {
        return Carbon::parse($this->date)->translatedFormat('j F Y');
    }
}
