<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buff extends Model
{
    /** @use HasFactory<\Database\Factories\BuffFactory> */
    use HasFactory;
    /** 
     * Allow casting `applies_to` to/from array automatically
     */
    //===Question?===
    protected $casts = [
        'applies_to' => 'array',
    ];
    /**
     * which attributes are mass-assignable
     */
    protected $fillable = [
        'code',
        'name',
        'description',
        'multiplier',
        'duration',
        'applies_to',
        'stackable',
        'max_stacks',
        'cooldown',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_buffs')
            ->withPivot([
                'starts_at',
                'ends_at',
                'consumed_session_id',
            ])
            ->withTimestamps();
    }

    /**
     * Get all user buff instances for this buff.
     */
    public function userBuffs()
    {
        return $this->hasMany(UserBuff::class);
    }
}
