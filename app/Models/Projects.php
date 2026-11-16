<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ProjectCategory;

class Projects extends Model
{
    use HasFactory;
    protected $fillable=['title','category_id','image'];

    public function getCategory(){
        return $this->hasOne(ProjectCategory::class,'id','category_id');

    }
}
