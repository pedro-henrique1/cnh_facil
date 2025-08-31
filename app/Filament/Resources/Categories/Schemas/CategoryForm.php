<?php

namespace App\Filament\Resources\Categories\Schemas;

use Filament\Forms\Components\Select;
use Filament\Schemas\Schema;

class CategoryForm
{
    /**
     * @throws \Exception
     */
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('category')
                    ->options([
            'legislacao' => 'Legislacao',
            'direcao_defensiva' => 'Direcao defensiva',
            'nocoes_mecanica' => 'Nocoes mecanica',
            'primeiros_socorros' => 'Primeiros socorros',
            'meio_ambiente' => 'Meio ambiente',
            'simulado_geral' => 'Simulado geral',
        ])
                    ->default('simulado_geral')
                    ->required(),
            ]);
    }
}
