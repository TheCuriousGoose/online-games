<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CreditLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'game_name',
        'credits_deducted'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
