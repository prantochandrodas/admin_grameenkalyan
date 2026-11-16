<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\StoryCategory;

class Story extends Model
{
    use HasFactory;
    protected $fillable = ['title','thumb_image','banner_image','desc','is_active','category_id'];

    public function getCategory(){
        return $this->hasOne(StoryCategory::class,'id','category_id');

    }
}
