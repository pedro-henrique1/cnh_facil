<?php

namespace App\Filament\Resources\Missions\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class MissionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                Textarea::make('description')
                    ->required()
                    ->columnSpanFull(),
                Select::make('type')
                    ->options(['daily' => 'Daily', 'weekly' => 'Weekly', 'time' => 'Time', 'score' => 'Score'])
                    ->required(),
                TextInput::make('target_value')
                    ->numeric(),
                TextInput::make('reward_xp')
                    ->required()
                    ->numeric()
                    ->default(0),
            ]);
    }
}
