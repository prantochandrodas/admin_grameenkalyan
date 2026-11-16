<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SummaryReportSettings extends Model
{
    use HasFactory;
    protected $table='summery_report_settings';
    protected $fillable =['key','value','is_active'];
}
