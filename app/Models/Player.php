<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations;

class Player extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'lastname', 'nationality', 'born_date', 'height', 'weight', 'club_id'];

    public function positions(): Relations\BelongsToMany
    {
        return $this->belongsToMany(Position::class, 'player_position');
    }

}
