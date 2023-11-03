<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;
use App\Models\EventMember;
use App\Models\User;

class Event extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'user_id'];

    public function members(): HasMany
    {
        return $this->hasMany(EventMember::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
