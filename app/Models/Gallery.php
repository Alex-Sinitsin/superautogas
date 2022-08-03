<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;

    protected $fillable = [
        'car_model_id',
        'image'
    ];

    public function model() {
        return $this->belongsTo(CarModel::class);
    }
}
