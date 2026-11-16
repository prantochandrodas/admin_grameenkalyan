<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Division;
use App\Models\District;
use App\Models\Upazilla;

class HealthCenter extends Model
{
    use HasFactory;
    protected $fillable =['name','banner_image','division_id','district_id','upazilla_id','contact_info','address','map_location'];

    public function getDivision(){
        return $this->hasOne(Division::class,'id','division_id');
    }

    public function getDistrict(){
        return $this->hasOne(District::class,'id','district_id');
    }

    public function getUpazilla(){
        return $this->hasOne(Upazilla::class,'id','upazilla_id');
    }
}
