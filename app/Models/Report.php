<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Report extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'council_id',
        'suspect_id',
        'category_id',
        'photo_report',
        'date'
    ];

    public function getFormattedDateAttribute()
    {
        return Carbon::parse($this->date)->translatedFormat('j F Y');
    }

    public function council()
    {
        return $this->belongsTo(Council::class);
    }

    public function suspect()
    {
        return $this->belongsTo(Suspect::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
