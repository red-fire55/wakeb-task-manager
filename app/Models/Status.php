<?php

namespace App\Models;

use AhsanDev\Support\Optionable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Status extends Model
{
    use HasFactory;
    use Optionable;

    protected $fillable = ['name', 'color', 'description'];


    /**
     * @return BelongsTo
     */
    public function kpis(): BelongsTo
    {
        return $this->belongsTo(Kpi::class, 'status_id', 'id');
    }
}
