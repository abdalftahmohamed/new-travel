<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Invitation extends Model
{
    use HasFactory,Notifiable;
    protected $guarded;

    public function Files()
    {
        return $this->hasMany(File::class);
    }
}
