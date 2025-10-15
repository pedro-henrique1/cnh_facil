<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function showMyAccount(): Factory|View
    {
        $user = Auth::user();

        $totalScore = $user->histories()->sum('score');

        $activeMissions = $user->userMissions()->with('mission')->get();

        $simulations = $user->histories()->latest()->limit(3)->get();

        return view('home.myAccount', compact('user', 'totalScore', 'simulations', 'activeMissions'
        ));
    }
}
