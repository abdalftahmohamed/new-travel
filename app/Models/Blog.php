<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    protected $guarded;

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function attachments()
    {
        return $this->hasMany(Attachment::class);
    }

    public function addresses()
    {
        return $this->hasMany(Address::class,'blog_id');
    }
    public function images()
    {
        return $this->hasMany(Image::class,'blog_id');
    }
}
