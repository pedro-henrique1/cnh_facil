<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request; // Boa prática ter o Request, mesmo que não usado.
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View; // Importar a View para tipagem de retorno

class DashboardController extends Controller
{
    /**
     * Exibe a página principal do dashboard do usuário.
     */
    public function showMyAccount(): View
    {
        $user = Auth::user()->load([
            'userMissions.mission'
        ]);

        // 2. Calcula a pontuação total (método eficiente de banco de dados).
        $totalScore = $user->histories()->sum('score');

        $simulations = $user->histories()->latest()->get();

        // Se fosse usar Paginação (melhor para grandes volumes de dados):
        // $simulations = $user->histories()->latest()->paginate(10);

        // A variável $activeMissions não precisa mais ser definida, pois
        // ela está disponível em $user->userMissions após o Eager Loading.

        return view('home.myAccount', [
            'user' => $user,
            'totalScore' => $totalScore,
            'simulations' => $simulations,
            // $user->userMissions é usado diretamente no Blade para as missões
            'activeMissions' => $user->userMissions,
        ]);
    }
}
