<?php namespace App\Filament\Widgets;

use App\Models\Category;
use Filament\Widgets\ChartWidget;

class QuestionsByCategory extends ChartWidget
{
    protected ?string $heading = 'Distribuição de Perguntas por Categoria';

    protected function getData(): array
    {
        $categories = Category::withCount('questions')->get();
        return ['labels' => $categories->pluck('name')->toArray(), 'datasets' => [['label' => 'Quantidade de Perguntas', 'data' => $categories->pluck('questions_count')->toArray(),],]];
    }

    protected function getType(): string
    {
        return 'pie';
    }
}
