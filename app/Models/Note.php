<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Note extends Model
{
    protected $fillable = ['description', 'status'];

    /**
     * @return MorphTo
     */
    public function notable(): MorphTo
    {
        return $this->morphTo();
    }
}
