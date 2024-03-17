<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $guarded;

    public function trip()
    {
        return $this->belongsTo(Trip::class);
    }


    public function blog()
    {
        return $this->belongsTo(Blog::class);
    }

    public function offer()
    {
        return $this->belongsTo(Offer::class);
    }
}
