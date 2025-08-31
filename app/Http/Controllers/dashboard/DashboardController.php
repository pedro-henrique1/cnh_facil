<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Collection;

class DashboardController extends Controller
{
    public function showMyAccount(): Factory|View
    {
        $user = Auth::user();

        // Dados de simulados de teste
        $simulations = collect([
            (object)['score' => 250, 'created_at' => now()->subDays(5)],
            (object)['score' => 300, 'created_at' => now()->subDays(3)],
            (object)['score' => 180, 'created_at' => now()->subDays(1)],
            (object)['score' => 500, 'created_at' => now()->subHours(8)], // Exemplo de pontuação alta
            (object)['score' => 70, 'created_at' => now()->subHours(2)],  // Exemplo de pontuação baixa
        ]);

        // A pontuação total pode ser a soma dos simulados de teste para consistência
        $totalScore = $simulations->sum('score');

        // Dados de missões de teste, incluindo diferentes status e progresso
        $activeMissions = collect([
            (object)[
                'status' => 'in_progress',
                'current_progress' => 30, // Exemplo de progresso baixo
                'mission' => (object)[
                    'name' => 'Missão Diária',
                    'description' => 'Complete 1 simulado hoje.',
                    'reward_xp' => 50,
                ],
            ],
            (object)[
                'status' => 'in_progress',
                'current_progress' => 80, // Exemplo de progresso alto
                'mission' => (object)[
                    'name' => 'Missão Semanal',
                    'description' => 'Alcance 500 pontos totais.',
                    'reward_xp' => 150,
                ],
            ],
            (object)[
                'status' => 'completed',
                'current_progress' => 100, // 100% de progresso
                'mission' => (object)[
                    'name' => 'Consistência',
                    'description' => 'Faça um simulado por 7 dias seguidos.',
                    'reward_xp' => 300,
                ],
            ],
            (object)[
                'status' => 'in_progress',
                'current_progress' => 0, // 0% de progresso
                'mission' => (object)[
                    'name' => 'Boss Final',
                    'description' => 'Conclua o simulado "Prova Teórica".',
                    'reward_xp' => 1000,
                ],
            ],
        ]);

        return view('home.myAccount', compact('user', 'totalScore', 'simulations', 'activeMissions'));
    }
}
