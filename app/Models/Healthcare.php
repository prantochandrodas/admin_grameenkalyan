<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Healthcare extends Model
{
    use HasFactory;

    public $timestamps = true;

    protected $table = 'healthcares';

    protected $guarded = ['id'];

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'title',
        'banner_image',
    ];
}
