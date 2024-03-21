<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Seccion extends Model
{
    use HasFactory;
    public function series(): HasMany
    {
        return $this->hasMany(Serie::class);
    }
}
