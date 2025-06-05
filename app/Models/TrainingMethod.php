<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrainingMethod extends Model
{
    /** @use HasFactory<\Database\Factories\TrainingMethodFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name'
        ];

    public function User()
    {
        return $this->belongsTo(User::class);
    }

    public function trainings()
    {
        return $this->hasMany(training::class);
    }
}
