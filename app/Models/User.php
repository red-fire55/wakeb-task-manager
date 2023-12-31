<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use AhsanDev\Support\Optionable;
use App\Http\Filters\UserFilters;
use AhsanDev\Support\Authorization\Authorizable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * App\Models\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string $avatar
 * @property string|null $remember_token
 * @property array|null $meta
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\FavoriteProject[] $favorites
 * @property-read int|null $favorites_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Permission[] $permissions
 * @property-read int|null $permissions_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Role[] $roles
 * @property-read int|null $roles_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Sanctum\PersonalAccessToken[] $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\UserFactory factory(...$parameters)
 * @method static Builder|User filter(\App\Http\Filters\UserFilters $filters)
 * @method static Builder|User newModelQuery()
 * @method static Builder|User newQuery()
 * @method static Builder|User query()
 * @method static Builder|User whereAvatar($value)
 * @method static Builder|User whereCreatedAt($value)
 * @method static Builder|User whereEmail($value)
 * @method static Builder|User whereEmailVerifiedAt($value)
 * @method static Builder|User whereId($value)
 * @method static Builder|User whereMeta($value)
 * @method static Builder|User whereName($value)
 * @method static Builder|User wherePassword($value)
 * @method static Builder|User whereRememberToken($value)
 * @method static Builder|User whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class User extends Authenticatable
{
    use Authorizable, HasApiTokens, HasFactory, Notifiable, Optionable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'meta' => 'array',
    ];

    /**
     * @return mixed
     */
    public function allPermissions(): mixed
    {
        if ($this->id == 1) {
            return Permission::pluck('name');
        }

        return $this->roles->first()->permissions->pluck('name');
    }

    /**
     * Get the user's avatar.
     *
     * @param string $value
     * @return string|null
     */
    public function getAvatarAttribute($value): string|null
    {
        return $value ? '/' . $value : null;
    }

    /**
     * Determine if user has admin role.
     *
     * @return bool
     */
    public function isAdmin(): bool
    {
        return $this->hasRole('Admin');
    }

    /**
     * Determine if user has user role.
     *
     * @return bool
     */
    public function isUser(): bool
    {
        return $this->hasRole('User');
    }

    /**
     * Get the user's favorite projects.
     *
     * @return HasMany
     */
    public function favorites(): HasMany
    {
        return $this->hasMany(FavoriteProject::class);
    }

    /**
     * @param $query
     * @param UserFilters $filters
     * @return Builder
     */
    public function scopeFilter($query, UserFilters $filters): Builder
    {
        return $filters->apply($query);
    }

    /**
     * The user is super admin.
     *
     * @return bool
     */
    public function isSuperAdmin(): bool
    {
        return $this->id == 1;
    }

    /**
     * The user is super admin.
     *
     * @return bool
     */
    public function isOtherUser(): bool
    {
        return true;
    }
}
