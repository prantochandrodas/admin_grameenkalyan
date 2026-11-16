<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Home extends Model
{
    use HasFactory;

    public $timestamps = true;

    protected $table = 'homes';

    protected $guarded = ['id'];

    protected $dates = ['deleted_at'];

    /**
     * The attributes that should be hidden for arrays.
     */
    protected $hidden = ['id', 'created_at', 'updated_at'];

    protected $fillable = [
        'badge_image',
        'intro_title',
        'intro_sub_title_one',
        'intro_sub_title_two',
        'chairman_thumb_image',
        'chairman_speech',
        'chairman_name',
        'chairman_designation',
        'md_thumb_image',
        'md_speech',
        'md_name',
        'md_designation',
        'annual_report_banner_image',
        'mhi_banner_image',
    ];
}
