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

    protected $appends = ['category_count'];

    public function getCategoryCountAttribute($id)
    {
        return $this->kpis()->count();
    }

    public function kpis()
    {
        return $this->belongsTo(Kpi::class, 'id', 'kpi_category_id');
    }
}
