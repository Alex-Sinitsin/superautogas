<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Te7aHoudini\LaravelTrix\Traits\HasTrixRichText;

class Page extends Model
{
    use HasFactory;
    use HasTrixRichText;

    protected $fillable = [
        'title',
        'content'
    ];

    protected static function boot()
    {
        parent::boot();

        static::deleted(function ($page) {
            $page->trixRichText->each->delete();
            $page->trixAttachments->each->purge();
        });
    }
}
