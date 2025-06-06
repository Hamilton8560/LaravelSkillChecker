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

    protected static function booted()
    {
        //==Question?===
        static::creating(function ($training) {
            if (! isset($training->score)) {
                $training->score = round($training->RPE * sqrt($training->duration), 2);
            }
        });
        static::updating(function ($training) {
            //==Question?===
            if ($training->isDirty(['RPE', 'duration'])) {
                $training->score = round($training->RPE * sqrt($training->duration), 2);
            }
        });
    }
}
