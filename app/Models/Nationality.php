<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations;

class Nationality extends Model
{
    use HasFactory;

    public function players(): Relations\HasMany
    {
        return $this->hasMany(Player::class);
    }
}
