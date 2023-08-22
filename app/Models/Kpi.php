<?php

namespace App\Models;

use AhsanDev\Support\Optionable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\DB;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;


class Kpi extends Model
{
    use HasFactory, Optionable, LogsActivity;


    protected $fillable = ['measure', 'owner_id', 'notes', 'status', 'target', 'kpi_category_id', 'frequency', 'sub_weight'];

    protected $appends = ['weight'];

    /**
     * @return BelongsTo
     */
    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'owner_id', 'id');
    }

    /**
     * @return HasOne
     */
    public function category(): HasOne
    {
        return $this->hasOne(KpiCategory::class, 'id', 'kpi_category_id');
    }

    /**
     * @return HasMany
     */
    public function resultHistory(): HasMany
    {
        return $this->hasMany(KpiResult::class);
    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopeOptions($query): mixed
    {
        return $query->get(['id as value', 'measure as label']);
    }

    /**
     * @return float
     */
    public function getWeightAttribute(): float
    {
        $sub_weight = 0;
        if (array_key_exists('sub_weight', $this->attributes)) {
            $sub_weight = $this->attributes['sub_weight'];
        }
        return $this->getWeightColumn($sub_weight);
    }

    /**
     * @param $sub_weight
     * @return float
     */
    private function getWeightColumn($sub_weight): float
    {
        return number_format(($sub_weight / max(1, $this->getTotalWeightForMeasure())) * 100, 2);
    }

    /**
     * @return mixed
     */
    private static function getTotalWeightForMeasure(): mixed
    {
        return DB::table('kpis')->select(DB::raw('SUM(sub_weight) as weight'))->groupBy('kpi_category_id')->value('weight');
    }

    /**
     * @return LogOptions
     */
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logFillable();
    }

    /**
     * @return HasOne
     */
    public function status(): HasOne
    {
        return $this->hasOne(Status::class, 'id', 'status_id');
    }
}
