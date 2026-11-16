<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AboutUs extends Model
{
    use HasFactory;

    public $timestamps = true;

    protected $table = 'about_us';

    protected $guarded = ['id'];

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'title',
        'banner_image',
        'mission',
        'vision',
        'company_intro_title',
        'company_intro_description',
        'inception_banner_image',
        'inception_title',
        'inception_details',
        'presence_title',
        'presence_sub_title',
        'presence_banner_image',
        'presence_details',
    ];
}
