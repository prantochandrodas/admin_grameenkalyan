<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\PhotoAlbum;

class PhotoGallery extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'serial_no', 'sub_album_id', 'category_id', 'view_count', 'thumb_image', 'is_active'];

    public function getPhotoAlbum()
    {
        return $this->hasOne(PhotoAlbum::class, 'id', 'category_id');
        return $this->hasOne(District::class, 'id', 'district_id');
    }

    public function getPhotoSubAlbum()
    {
        return $this->belongsTo(PhotoSubAlbum::class, 'sub_album_id');
    }
}
