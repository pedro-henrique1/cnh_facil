<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Simulation extends Model
{

    protected $fillable = [
        'user_id',
        'title',
        'question_ids',
        'score',
        'started_at',
        'finished_at',
    ];

    protected $casts = [
        'question_ids' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function questions()
    {
        return $this->belongsToMany(Question::class, 'question_simulation');
    }
}
