<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Translatable\HasTranslations;

class Company extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable,HasTranslations;

    public $translatable = ['name','address'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded=[];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];


    public function country()
    {
        return $this->belongsTo(Country::class);
    }
    public function city()
    {
        return $this->belongsTo(City::class);
    }
    public function trips()
    {
        return $this->hasMany(Trip::class);
    }

    public function tripsStatus()
    {
        return $this->hasMany(Trip::class)->where('status',1);
    }

    public function departments()
    {
        return $this->hasMany(Department::class);
    }


    public function blogs()
    {
        return $this->hasMany(Blog::class);
    }

    public function clients()
    {
        return $this->hasMany(Client::class);
    }

    public function reviws()
    {
        return $this->hasMany(Review::class);
    }
}
