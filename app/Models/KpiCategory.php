<?php

namespace App\Models;

use AhsanDev\Support\Optionable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KpiCategory extends Model
{
    use HasFactory;
    use Optionable;

    protected $fillable = ['name', 'description'];
}
