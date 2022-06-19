<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations;

class Position extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'shortcut'];

    public function players(): Relations\BelongsToMany
    {
        return $this->belongsToMany(Player::class, 'player_position');
    }
}
