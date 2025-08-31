<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Attempt extends Model
{
    use HasFactory;

    // A convenção do Laravel espera a tabela no plural, então a linha abaixo
    // é opcional, mas garante que a model 'Attempt' use a tabela 'attempts'.
     protected $table = 'attempts';

    // Define quais colunas podem ser preenchidas massivamente
    protected $fillable = [
        'history_id',
        'user_id',
        'question_id',
        'answer_id',
    ];

    // Relacionamentos:
    // Uma 'Attempt' pertence a um registro de 'History'
    public function history(): BelongsTo
    {
        return $this->belongsTo(History::class);
    }

    // Uma 'Attempt' pertence a um 'User'
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Uma 'Attempt' pertence a uma 'Question'
    public function question(): BelongsTo
    {
        return $this->belongsTo(Question::class);
    }

    // Uma 'Attempt' pertence a uma 'Answer'
    public function answer(): BelongsTo
    {
        return $this->belongsTo(Answer::class);
    }
}
