<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PackageDetail extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function package()
    {
        return $this->belongsTo(Package::class, 'package_id');
    }

    public function test()
    {
        return $this->belongsTo(TestName::class, 'test_id');
    }
}
