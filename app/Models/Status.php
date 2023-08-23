<?php

namespace App\Models;

use AhsanDev\Support\Optionable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Status extends Model
{
    use HasFactory;
    use Optionable;

    protected $fillable = ['name', 'color', 'description'];


    /**
     * @return HasMany
     */
    public function kpis(): HasMany
    {
        return $this->hasMany(Kpi::class, 'status_id', 'id');
    }
}
