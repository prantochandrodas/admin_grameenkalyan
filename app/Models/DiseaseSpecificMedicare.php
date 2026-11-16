<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiseaseSpecificMedicare extends Model
{
    use HasFactory;

    public $timestamps = true;

    protected $table = 'disease_specific_medicares';

    protected $guarded = ['id'];

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'title',
        'thumb_image',
        'banner_image',
        'body_image',
        'sub_title',
        'description',
    ];
}
