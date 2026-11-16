<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserComments extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'module', 'content_id', 'comment', 'is_active'];

    public function getUser()
    {
        return $this->hasOne(AnonymousUser::class, 'id', 'user_id');
    }

    public function user()
    {
        return $this->belongsTo(AnonymousUser::class, 'user_id');
    }

    public function story()
    {
        return $this->belongsTo(Story::class, 'content_id');
    }
}
