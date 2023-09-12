<?php

namespace App\Models;

use AhsanDev\Support\Optionable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany as MorphMany;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Milestone extends Model
{
    use HasFactory;
    use Optionable, LogsActivity;

    protected $fillable = ['name', 'start_date', 'end_date', 'project_id', 'order'];


    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class);
    }

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
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
     * @return MorphMany
     */
    public function notes(): MorphMany
    {
        return $this->morphMany('App\Models\Note', 'notable')->latest();
    }
}
