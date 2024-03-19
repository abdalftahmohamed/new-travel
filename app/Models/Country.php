<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Country extends Model
{
    use HasFactory,HasTranslations;
    protected $guarded=[];

    public $translatable = ['name','description'];

    public function cities()
    {
        return $this->hasMany(City::class);
    }

    public function companies()
    {
        return $this->hasMany(Company::class);
    }
}
