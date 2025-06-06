<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserBuff extends Model
{
    /** @use HasFactory<\Database\Factories\UserBuffFactory> */
    use HasFactory;

    protected $table = 'user_buffs';

    protected $fillable = [
        'user_id',
        'buff_id',
        'starts_at',
        'ends_at',
        'consumed_session_id',
    ];

    protected $casts = [
        'starts_at' => 'datetime',
        'ends_at' => 'datetime',
    ];

    /**
     * Scope to only the "active" buffs for a user (not yet consumed, within time window).
     */
    public function scopeActive($query)
    {
        return $query->whereNull('consumed_session_id')
            ->where('starts_at', '<=', now())
            ->where('ends_at', '>=', now());
    }

    /**
     * Relationship to the user who owns this buff.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relationship to the buff definition.
     */
    public function buff()
    {
        return $this->belongsTo(Buff::class);
    }

    /**
     * Relationship to the training session where this buff was consumed.
     */
    public function training()
    {
        return $this->belongsTo(Training::class, 'consumed_session_id');
    }
}
