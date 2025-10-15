<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Question extends Model
{
    protected $fillable = ['question', 'category_id', 'image'];

    protected $casts = [
        'question' => 'string',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->uuid)) {
                $model->uuid = (string) Str::uuid();
            }
        });
    }

    public function getRouteKeyName()
    {
        return 'uuid';
    }

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
