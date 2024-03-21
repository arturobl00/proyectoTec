<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Serie extends Model
{
    use HasFactory;

    public function seccions(): BelongsTo{
        return $this->belongsTo(Seccion::class);
    }
}
