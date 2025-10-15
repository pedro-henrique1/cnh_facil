<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = ['question', 'category_id', 'image'];

    protected $casts = [
        'question' => 'string',
    ];

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

    // Accessor que garante question sempre seja string
    public function getQuestionAttribute($value)
    {
        if (is_string($value)) {
            return $value;
        }

        if (is_array($value)) {
            return implode(' ', $value);
        }

        return (string) $value;
    }
}
