<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class History extends Model
{
    protected $table = 'history';

    use HasFactory;

    // Define quais colunas podem ser preenchidas massivamente
    protected $fillable = [
        'user_id',
        'question_id',
        'category_id',
        'score',
        'time_spent',
    ];

    // Relacionamento com o usuário que respondeu a pergunta
    // Uma 'History' pertence a um 'User'
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Relacionamento com a pergunta que foi respondida
    // Uma 'History' pertence a uma 'Question'
    public function question(): BelongsTo
    {
        return $this->belongsTo(Question::class);
    }

    // Relacionamento com a categoria da pergunta
    // Uma 'History' pertence a uma 'Category'
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
