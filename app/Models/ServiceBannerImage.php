<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceBannerImage extends Model
{
    protected $fillable = ['service_id', 'image'];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
