<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Offer extends Model
{
    use HasFactory;
    protected $guarded;

    use HasTranslations;

    public $translatable = ['name','offer_description'];
    public function trip()
    {
        return $this->belongsTo(Trip::class,'trip_id');
    }
    public function addresses()
    {
        return $this->hasMany(Address::class,'offer_id');
    }
    public function images()
    {
        return $this->hasMany(Image::class,'offer_id');
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

}
