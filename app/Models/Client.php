<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Cashier\Billable;
use Spatie\Translatable\HasTranslations;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Client extends Authenticatable implements JWTSubject
{
    use HasFactory,Billable,Notifiable,HasTranslations;

    public $translatable = ['name','address'];

    protected $guarded;

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
    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier() {
        return $this->getKey();
    }
    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims() {
        return [];
    }

    public function generateCode()
    {
        $this->timestamps = false;
        $this->code = rand(100000, 600000);
        $this->save();
    }
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function reviws()
    {
        return $this->hasMany(Review::class);
    }

    public function carts()
    {
        return $this->hasMany(Cart::class);
    }

    public function cartTrips()
    {
        return $this->belongsToMany(Trip::class,'carts','client_id','trip_id')
            ->withPivot(['id','quantity_old','quantity_young','description','subtotal_old','subtotal_child','total', 'status', 'date','coupon_amount']);
    }

    public function reviewTrips()
    {
        return $this->belongsToMany(Trip::class,'reviews','client_id','trip_id')
            ->withPivot(['name', 'stars_numbers', 'description','image_path']);
    }


    public function favoriteTrips()
    {
        return $this->belongsToMany(Trip::class,'trips_clients_favorites','client_id','trip_id');
    }
}
