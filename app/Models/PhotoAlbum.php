<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhotoAlbum extends Model
{
    use HasFactory;
    protected $fillable = ['serial_no', 'title', 'is_active', 'album_photo'];

    public function getPhotos()
    {
        return $this->hasMany(PhotoGallery::class, 'category_id', 'id');
    }
}
