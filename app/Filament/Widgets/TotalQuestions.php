<?php

namespace App\Filament\Widgets;

use App\Models\Mission;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Question;
use App\Models\Category;

class TotalQuestions extends StatsOverviewWidget
{
    protected ?string $heading = 'Resumo';

    protected function getStats(): array
    {
        return [
            Stat::make('Total de Perguntas', Question::count()),
            Stat::make('Total de Categorias', Category::count()),
            Stat::make('Total de Missões diárias', Mission::where('type', 'daily')->count()),
            Stat::make('Total de peguntas/erros comuns', Question::whereNotNull('common_mistakes')->count()),
        ];
    }
}
