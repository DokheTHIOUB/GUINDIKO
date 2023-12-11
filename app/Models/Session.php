<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Session extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected $fillable =
    [
        'mentor_id',
        'mentore_id',
        'date',
        'lieu',
        'theme',
        'archives'
        
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
