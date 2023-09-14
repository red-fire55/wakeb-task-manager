<?php

namespace App\Models;

use AhsanDev\Support\Optionable;
use App\Http\Filters\ProjectFilters;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Project extends Model
{
    use HasFactory, SoftDeletes, Optionable;

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'meta' => 'array',
    ];

    protected $appends = ['human_end_time'];

    /**
     * Determine if the project has remaining users.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function remainingUsers(): Attribute
    {
        return new Attribute(
            get: fn() => ($this->users->count() > 10) ? ($this->users->count() - 10) : 0,
        );
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function lists()
    {
        return $this->hasMany(ProjectList::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function members()
    {
        return $this->belongsToMany(User::class);
    }

    /**
     * Get the candidates seen by users.
     *
     * @return \Illuminate\Support\Collection
     */
    public function getIsFavoriteAttribute()
    {
        return DB::table('favorite_projects')->where('project_id', $this->id)->where('user_id', auth()->id())->first();
    }

    /**
     * Apply all relevant filters.
     *
     * @param Illuminate\Database\Eloquent\Builder $query
     * @param App\Http\Filters\ProjectFilters $filters
     * @return Builder
     */
    public function scopeFilter($query, ProjectFilters $filters)
    {
        return $filters->apply($query);
    }

    /**
     * @return HasOne
     */
    public function type(): HasOne
    {
        return $this->hasOne(ProjectType::class, 'id', 'type_id');
    }

    /**
     * @return HasOne
     */
    public function department(): HasOne
    {
        return $this->hasOne(Department::class, 'id', 'department_id');
    }

    /**
     * @return HasOne
     */
    public function status(): HasOne
    {
        return $this->hasOne(Status::class, 'id', 'status_id');
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
        return Task::where('completed_at', '!=', null)->where('project_id', $this->id)->count();
    }

    /**
     * @return int
     */
    private function getAllTasksCount(): int
    {
        return Task::where('project_id', $this->id)->count();
    }

    /**
     * @param $date
     * @return string
     */
    public function getHumanEndTimeAttribute($date): string
    {
        return Carbon::create($date)->diffForHumans();
    }
}
