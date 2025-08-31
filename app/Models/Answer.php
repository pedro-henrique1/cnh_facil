<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Answer extends Model
{
    use HasFactory;

    // Define quais colunas podem ser preenchidas massivamente
    protected $fillable = [
        'question_id',
        'answer_text',
        'is_correct',
    ];

    // Define que 'is_correct' deve ser tratado como um booleano
    protected $casts = [
        'is_correct' => 'boolean',
    ];

    // Relacionamento com a questão
    // Uma 'Answer' pertence a uma 'Question'
    public function question(): HasMany
    {
        return $this->hasMany(Question::class);
    }
}
