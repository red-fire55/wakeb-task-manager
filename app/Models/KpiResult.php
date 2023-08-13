<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class KpiResult extends Model
{
    use HasFactory;

    protected $table = 'kpi_result_histories';
    protected $fillable = ['description', 'status', 'kpi_id', 'creator_id', 'title'];

    /**
     * @return HasOne
     */
    public function creator(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'creator_id');
    }
}
