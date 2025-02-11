<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Book extends Model
{

    use HasUuids;

    protected $fillable = ['title', 'description', 'release_year', 'author'];

    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }

    public function review(): HasMany {
        return $this->hasMany(Review::class);
    }
}
