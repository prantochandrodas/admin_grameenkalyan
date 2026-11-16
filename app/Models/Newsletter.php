<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Newsletter extends Model
{
    use HasFactory;

    public $timestamps = true;

    protected $table = 'newsletters';

    protected $guarded = ['id'];

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'title',
        'link',
    ];
}
