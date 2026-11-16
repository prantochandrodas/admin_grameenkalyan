<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LandOwner extends Model
{
    use HasFactory;
    protected $fillable=['name_of_landowner','contact_person','user_email','mobile_number','address','land_address','area_of_plot','plot_dimension_in_front','plot_dimension_in_depth','width_of_road','special_feature','type_of_use','any_special_requirement','remarks'];
}
