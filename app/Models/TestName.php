<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestName extends Model
{
    use HasFactory;
    protected $guarded = [];


    public function packageDetails()
    {
        return $this->hasMany(PackageDetail::class, 'test_id');
    }
}
