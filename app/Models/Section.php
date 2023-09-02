<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Section extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description'];


    /**
     * @return BelongsToMany
     */
    public function levels(): BelongsToMany
    {
        return $this->belongsToMany(Level::class, 'section_level')->withPivot('level_order')->orderBy('level_order');
    }
}
