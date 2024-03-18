<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class City extends Model
{
    use HasFactory;
    protected $guarded=[];
    use HasTranslations;

    public $translatable = ['name','description'];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function trips()
    {
        return $this->hasMany(Trip::class);
    }

    public function companies()
    {
        return $this->hasMany(Company::class);
    }
}
