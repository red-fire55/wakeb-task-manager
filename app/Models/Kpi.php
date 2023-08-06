<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;


class Kpi extends Model
{
    use HasFactory;


    protected $fillable = ['measure', 'owner_id', 'notes', 'status', 'target', 'kpi_category_id', 'frequency', 'sub_weight'];

    /**
     * @return BelongsTo
     */
    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'kpi_category_id', 'id');
    }

    /**
     * @return HasOne
     */
    public function category(): HasOne
    {
        return $this->hasOne(KpiCategory::class, 'id', 'kpi_category_id');
    }
}
