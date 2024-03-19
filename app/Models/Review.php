<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Review extends Model
{
    use HasFactory;
    protected $guarded;
    use HasTranslations;
    public $translatable = ['name','description'];


    public function trip()
    {
        return $this->belongsTo(Trip::class);
    }

    public function offer()
    {
        return $this->belongsTo(Offer::class);
    }

    public function blog()
    {
        return $this->belongsTo(Blog::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
