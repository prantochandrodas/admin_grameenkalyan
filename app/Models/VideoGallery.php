<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VideoGallery extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'serial_no', 'short_description', 'video_link', 'is_recommended', 'view_count', 'thumb_image'];
}