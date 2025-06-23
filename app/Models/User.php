<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int,string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'timezone',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int,string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string,string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * Get the user's initials.
     */
    public function initials(): string
    {
        return Str::of($this->name)
            ->explode(' ')
            ->map(fn(string $part) => Str::of($part)->substr(0, 1))
            ->implode('');
    }

    /**
     * One-to-many: a user owns many training categories.
     */
    public function trainingCategories()
    {
        return $this->hasMany(TrainingCategory::class);
    }

    /**
     * One-to-many: a user owns many training methods.
     */
    public function trainingMethods()
    {
        return $this->hasMany(TrainingMethod::class);
    }

    /**
     * One-to-many: a user has many training records.
     */
    public function trainings()
    {
        return $this->hasMany(Training::class);
    }

    /**
     * Many-to-many: a user can have many active buffs.
     */
    public function buffs()
    {
        return $this->belongsToMany(Buff::class, 'user_buffs')
            ->withPivot(['starts_at', 'ends_at', 'consumed_session_id'])
            ->withTimestamps();
    }

    public function activeBuffFor(string $categoryType): ?\App\Models\UserBuff
    {
        return $this->buffs()
            ->active() // calls UserBuff::scopeActive()
            ->where(function ($q) use ($categoryType) {
                $q->whereJsonContains('applies_to', $categoryType)
                    ->orWhereJsonContains('applies_to', '*');
            })
            ->orderBy('multiplier', 'desc')
            ->first();
    }

    public function objectives()
    {
        return $this->hasMany(Objective::class);
    }

    public function journals(): HasMany
    {
        return $this->hasMany(Journal::class);
    }
}
