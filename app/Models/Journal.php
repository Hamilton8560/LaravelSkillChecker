<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Journal extends Model
{
    /** @use HasFactory<\Database\Factories\JournalFactory> */
    use HasFactory;
    protected $fillable = [
        'user_id',
        'title',
        'content',
        'date',
    ];
    public function User()
    {
        return $this->belongsTo(User::class);
    }
}
