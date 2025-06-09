<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Objective extends Model
{
    /** @use HasFactory<\Database\Factories\ObjectiveFactory> */
    use HasFactory;

    protected $fillable = [
        'objectives',
        'explained',
        'how_you_learned',
        'training_category_id',
        'user_id'
    ];

    public function User()
    {
        return $this->belongsTo(User::class);
    }
    public function category()
    {
        return $this->belongsTo(TrainingCategory::class, 'training_category_id');
    }
}
