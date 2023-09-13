<?php

namespace App\Models;

use AhsanDev\Support\Optionable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany as MorphMany;
use Illuminate\Support\Facades\DB;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Milestone extends Model
{
    protected static $recordEvents = ['deleted'];
    protected $appends = ['progress'];
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
     * @return float
     */
    public function getProgressAttribute(): float
    {
        $completedTasks = $this->getCompletedTasksCount();
        $total = $this->getAllTasksCount();
        return number_format(($completedTasks / (max($total, 1))) * 100, 2);
    }

    /**
     * @return int
     */
    private function getCompletedTasksCount(): int
    {
        return DB::table('tasks')
            ->join('projects', 'projects.id', '=', 'tasks.project_id')
            ->where('tasks.milestone_id', '=', $this->id)
            ->whereColumn('tasks.completed_at', '<=', 'projects.end_time')
            ->count();
    }

    /**
     * @return int
     */
    private function getAllTasksCount(): int
    {
        return Task::where('milestone_id', $this->id)->count();
    }
}
