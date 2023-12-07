<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Session extends Model
{
    use HasFactory;
    protected $fillable =
    [
        'mentor_id',
        'mentore_id',
        'date',
        'lieu',
        'theme'
        
    ];

    public function mentor(): BelongsTo
    {
        return $this->belongsTo(Mentor::class);
    }

    public function mentore(): BelongsTo
    {
        return $this->belongsTo(Mentore::class);
    }
}
