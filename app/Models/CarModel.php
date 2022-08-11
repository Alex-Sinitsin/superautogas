<?php

namespace App\Models;

use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarModel extends Model
{
    use HasFactory;
    use HasSlug;

    protected $with = ['images'];

    protected $fillable = [
        'name',
        'car_brand_id'
    ];

    public function images()
    {
        return $this->hasMany(Gallery::class);
    }

    public function brand()
    {
        return $this->belongsTo(CarBrand::class);
    }

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug')
            ->slugsShouldBeNoLongerThan(255);
    }
}
