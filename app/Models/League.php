<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations;

class League extends Model
{
    use HasFactory;
    protected $fillable = ['name','start_date','end_date'];

    public function clubs(): Relations\HasMany
    {
        return $this->hasMany(Club::class);
    }

}
