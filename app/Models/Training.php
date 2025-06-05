<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class training extends Model
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
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(TrainingCategory::class);
    }

    public function method()
    {
        return $this->belongsTo(TrainingMethod::class);
    }

    protected static function booted()
    {
        static::creating(function ($training) {
            if (! isset($training->score)) {
                $training->score = round($training->RPE * sqrt($training->duration), 2);
            }
        });
        static::updating(function ($training) {
            if($training->isDirty(['RPE', 'duration'])) {
                $training->score = round($training->RPE * sqrt($training->duration), 2);
            }
        });


    }
}
