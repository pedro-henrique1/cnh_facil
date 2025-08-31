<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'question',
        'category_id',
        'type',
        'images',
        'video',
        'common_mistakes',
    ];

    // Define que as colunas 'images' e 'video' devem ser tratadas como arrays
    // Essa é uma convenção do Laravel para colunas JSON
    protected $casts = [
        'images' => 'array',
        'video' => 'array',
    ];

    // Relacionamento com a categoria da pergunta
    // Uma 'Question' pertence a uma 'Category'
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function histories(): HasMany
    {
        return $this->hasMany(History::class);
    }
}
