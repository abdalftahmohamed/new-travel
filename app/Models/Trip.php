<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function addresses()
    {
        return $this->hasMany(Address::class,'trip_id');
    }
    public function images()
    {
        return $this->hasMany(Image::class,'trip_id');
    }

    public function cartClients()
    {
        return $this->belongsToMany(Client::class,'carts','trip_id','client_id')
            ->withPivot(['id','quantity_old','quantity_young','description','subtotal_old','subtotal_child','total', 'status', 'date','coupon_amount']);
    }

    public function reviewClients()
    {
        return $this->belongsToMany(Client::class,'reviews','trip_id','client_id')
            ->withPivot(['name', 'stars_numbers', 'description','image_path']);
    }

    public function favoriteClients()
    {
        return $this->belongsToMany(Client::class,'trips_clients_favorites','trip_id','client_id');
    }

}
