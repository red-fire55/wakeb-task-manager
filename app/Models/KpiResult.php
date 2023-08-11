<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KpiResult extends Model
{
    use HasFactory;

    protected $table = 'kpi_result_histories';
    protected $fillable = ['description', 'status', 'kpi_id'];
}
