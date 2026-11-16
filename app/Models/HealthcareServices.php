<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HealthcareServices extends Model
{
    use HasFactory;

    public $timestamps = true;

    protected $table = 'healthcare_services';

    protected $guarded = ['id'];

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'title',
        'thumb_image',
        'banner_image',
        'sub_title',
        'description',
    ];
}
