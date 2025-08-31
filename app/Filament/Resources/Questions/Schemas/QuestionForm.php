<?php

namespace App\Filament\Resources\Questions\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class QuestionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('question')
                    ->required(),
                Select::make('category_id')
                    ->relationship('category', 'id')
                    ->required(),
                Select::make('type')
                    ->options(['teorico' => 'Teorico', 'pratico' => 'Pratico'])
                    ->default('teorico')
                    ->required(),
                    \Filament\Forms\Components\Repeater::make('images')
                        ->schema([
                            TextInput::make('url')->label('Imagem URL'),
                        ])
                        ->label('Imagens'),
                    \Filament\Forms\Components\Repeater::make('video')
                        ->schema([
                            TextInput::make('url')->label('Vídeo URL'),
                        ])
                        ->label('Vídeos'),
                Toggle::make('pergunta que muitas pessoas erram')
                    ->required(),
            ]);
    }
}
