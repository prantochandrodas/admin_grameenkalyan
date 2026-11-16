<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    public $timestamps = true;

    protected $table = 'departments';

    protected $guarded = ['id'];

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'name',
        'is_active',
    ];
}
