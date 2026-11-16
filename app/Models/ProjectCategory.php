<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Projects;

class ProjectCategory extends Model
{
    use HasFactory;
    protected $fillable=['title'];

    public function getProjects(){
        return $this->hasMany(Projects::class,'category_id','id');

    }
}
