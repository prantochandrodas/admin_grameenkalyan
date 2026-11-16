<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnonymousUser extends Model
{

    use HasFactory;
    protected $fillable = ['name', 'email', 'profile_image', 'is_active'];
}
