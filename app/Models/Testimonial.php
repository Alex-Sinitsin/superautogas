<?php

namespace App\Models;

use Date\DateFormat;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Te7aHoudini\LaravelTrix\Traits\HasTrixRichText;

class Testimonial extends Model
{
    use HasFactory;
    use HasTrixRichText;

    protected $fillable = [
        'nickname',
        'car_model',
        'rating',
        'text',
        'is_published'
    ];

    public function getCreatedAtAttribute($attr)
    {
        return DateFormat::post($attr);
    }

    public function getIsPublishedAtAttribute($attr)
    {
        $this->attributes['is_published'] = (bool) $attr;
    }
}
