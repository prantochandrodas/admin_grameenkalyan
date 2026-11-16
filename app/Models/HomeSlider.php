<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeSlider extends Model
{
    use HasFactory;

    public $timestamps = true;

    protected $table = 'home_sliders';

    protected $guarded = ['id'];

    protected $dates = ['deleted_at'];

    /**
     * The attributes that should be hidden for arrays.
     */
    protected $hidden = ['id', 'created_at', 'updated_at'];

    protected $fillable = [
        'title',
        'banner_image',
    ];
}
