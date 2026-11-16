<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peoples extends Model
{
    use HasFactory;
    protected $fillable = ['serial_no', 'name', 'designation', 'team', 'profile_photo', 'desc', 'is_active'];

    public function getTeam()
    {
        return $this->hasOne(Department::class, 'id', 'team');
    }

    public function getDesignation()
    {
        return $this->hasOne(Designation::class, 'id', 'designation');
    }
}
