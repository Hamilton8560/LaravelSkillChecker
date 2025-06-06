<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Training extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'training_category_id',
        'training_method_id',
        'duration',
        'RPE',
        'notes',
        'score',
        'task_description',
        'what_you_learned',
        'started_at',
        'ended_at',
    ];

    protected $casts = [
        'started_at' => 'datetime',
        'ended_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(TrainingCategory::class, 'training_category_id');
    }

    public function method()
    {
        return $this->belongsTo(TrainingMethod::class, 'training_method_id');
    }

    // Get started_at in user's timezone
    public function getStartedAtInUserTimezone()
    {
        $timezone = $this->user->timezone ?? config('app.timezone');
        return $this->started_at ? $this->started_at->setTimezone($timezone) : null;
    }

    // Get ended_at in user's timezone
    public function getEndedAtInUserTimezone()
    {
        $timezone = $this->user->timezone ?? config('app.timezone');
        return $this->ended_at ? $this->ended_at->setTimezone($timezone) : null;
    }

    protected static function booted()
    {
        //==Question?===
        static::creating(function ($training) {
            if (! isset($training->score)) {
                $training->score = round($training->RPE * 1.5 * ($training->duration), 2);
            }
        });
        static::updating(function ($training) {
            //==Question?===
            if ($training->isDirty(['RPE', 'duration'])) {
                $training->score = round($training->RPE * 1.5 * ($training->duration), 2);
            }
        });
    }
}
