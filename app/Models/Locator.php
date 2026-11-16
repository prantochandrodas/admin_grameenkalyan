<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Locator extends Model
{
    use HasFactory;
    protected $fillable=['title','address','contact_info','map_location'];
    // public function getDistrict(){
    //     return $this->hasOne(District::class,'id','district_id');
    // }
}
