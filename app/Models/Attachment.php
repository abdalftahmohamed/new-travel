<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    use HasFactory;

    protected $guarded;
    public function Images()
    {
        return $this->hasMany(AttachmentImage::class, 'attachment_id','id');
    }
    public function Videos()
    {
        return $this->hasMany(AttachmentVideo::class, 'attachment_id');
    }
    public function Documents()
    {
        return $this->hasMany(AttachmentDocument::class, 'attachment_id');
    }
}
