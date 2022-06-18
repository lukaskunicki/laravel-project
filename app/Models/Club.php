<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations;

class Club extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'foundation_date', 'trainer_id', 'league_id'];

    public function players(): Relations\HasMany
    {
        return $this->hasMany(Player::class);
    }

    public function trainer(): Relations\HasOne
    {
        return $this->hasOne(User::class);
    }

    public function league(): Relations\BelongsTo
    {
        return $this->belongsTo(League::class);
    }
}
