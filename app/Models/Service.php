<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    public $timestamps = true;

    protected $table = 'services';

    protected $guarded = ['id'];

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'title',
        'homepage_thumb_image',
        'servicepage_thumb_image',
        'sub_title_one',
        'sub_title_two',
        'short_description',
        'service_detail_banner_image',
        'service_detail_slogan',
        'long_description',
        'service_detail_sub_title',
    ];

    public function bannerImages()
    {
        return $this->hasMany(ServiceBannerImage::class, 'service_id');
    }
}
