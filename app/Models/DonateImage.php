<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DonateImage extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function donate()
    {
        return $this->belongsTo(Donate::class, 'donate_id');
    }
}
