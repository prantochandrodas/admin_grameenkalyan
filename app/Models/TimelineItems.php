<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimelineItems extends Model
{
    use HasFactory;

    public $timestamps = true;

    protected $table = 'timeline_items';

    protected $guarded = ['id'];

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'timeline_id',
        'timeline_item',
    ];
}
