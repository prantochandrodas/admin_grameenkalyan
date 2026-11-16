<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PhotoSubAlbum extends Model
{
    protected $fillable = [
        'photo_album_id',
        'serial_no',
        'title',
        'sub_album_photo',
        'is_active',
    ];

    public function album()
    {
        return $this->belongsTo(PhotoAlbum::class, 'photo_album_id');
    }
}
