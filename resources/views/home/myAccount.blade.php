@extends('base')

@section('content')

    <div class="container py-4">
        <h1 class="display-6 fw-bold text-dark mb-4">Olá, {{ $user->name }}!</h1>

        {{-- Seção de Conquistas --}}
        <h3 class="fs-4 fw-bold mb-3">🏅 Conquistas</h3>
        <div class="d-flex flex-wrap gap-2 mb-4">
            @if($simulations->count() >= 1)
                <span class="badge rounded-pill bg-success p-2">🥇 1º Simulado Feito</span>
            @endif

            @if($simulations->count() >= 5)
                <span class="badge rounded-pill bg-primary p-2">🏅 5 Simulados Feitos</span>
            @endif

            @if($simulations->count() >= 10)
                <span class="badge rounded-pill bg-warning text-dark p-2">🏆 10 Simulados Feitos</span>
            @endif

            @if($simulations->max('score') == 100)
                <span class="badge rounded-pill bg-info text-dark p-2">💯 Sem Errar</span>
            @endif

            @if($simulations->count() >= 3 && $simulations->take(-3)->pluck('created_at')->map->format('Y-m-d')->unique()->count() == 1)
                <span class="badge rounded-pill bg-danger p-2">🔥 Resiliência (3 seguidos no mesmo dia)</span>
            @endif

            @if($simulations->count() >= 7 && $simulations->groupBy(fn($s) => $s->created_at->format('Y-m-d'))->count() >= 7)
                <span class="badge rounded-pill bg-dark p-2">📆 Maratona (7 dias seguidos)</span>
            @endif

            @if(floor($totalScore / 100) >= 1)
                <span class="badge rounded-pill bg-secondary p-2">🌱 Iniciante (Nível 1)</span>
            @endif

            @if(floor($totalScore / 100) >= 10)
                <span class="badge rounded-pill bg-success p-2">🧙 Veterano (Nível 10)</span>
            @endif

            @if(isset($user->has_social_achievement) && $user->has_social_achievement)
                <span class="badge rounded-pill" style="background-color: #f06292; color: white; padding: 0.5rem;">🤝 Conquista Social</span>
            @endif
        </div>

        {{-- Card de Pontuação e Nível --}}
        <div class="card bg-light-blue border-0 shadow-sm p-4 text-center mb-4" style="background-color: #e6f0ff;">
            <h3 class="card-title text-muted fw-bold">Pontuação Total</h3>
            <span class="display-1 fw-bolder" style="color: #0066ff;">{{ $totalScore }}</span>

            <div class="mt-4">
                @php
                    $nivel = floor($totalScore / 100);
                    $xpAtual = $totalScore % 100;
                @endphp
                <h4 class="h5 fw-bold mb-2">Nível {{ $nivel }}</h4>
                <div class="progress" style="height: 25px;">
                    <div class="progress-bar bg-success" role="progressbar"
                         style="width: {{ $xpAtual }}%;"
                         aria-valuenow="{{ $xpAtual }}" aria-valuemin="0" aria-valuemax="100">
                        {{ $xpAtual }}/100 XP
                    </div>
                </div>
            </div>
        </div>

        {{-- Seção de Missões Ativas (já otimizada) --}}
        @if($activeMissions->isNotEmpty())
            <h2 class="fs-4 fw-bold mb-4">Missões Ativas</h2>
            <div class="row g-4">
                @foreach($activeMissions as $userMission)
                    <div class="col-12 col-md-4">
                        <div class="card h-100 shadow-sm border-0">
                            <div class="card-body text-center">
                                <h5 class="card-title fw-bold text-primary">{{ $userMission->mission->name }}</h5>
                                <p class="card-text text-muted" style="min-height: 40px;">{{ $userMission->mission->description }}</p>

                                <div class="progress mt-3" style="height: 15px;">
                                    <div class="progress-bar bg-success" role="progressbar"
                                         style="width: {{ $userMission->current_progress }}%;"
                                         aria-valuenow="{{ $userMission->current_progress }}"
                                         aria-valuemin="0"
                                         aria-valuemax="100">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        {{-- Seção de Simulados Realizados --}}
        <h2 class="fs-4 fw-bold mt-5 mb-4">Simulados Realizados</h2>
        <div class="row g-4">
            @foreach($simulations as $index => $simulation)
                <div class="col-12 col-md-4">
                    <div class="card h-100 shadow-sm border-0">
                        <div class="card-body text-center">
                            <h4 class="card-title fw-bold" style="color: #0b5ed7;">Simulado {{ $index + 1 }}</h4>
                            <p class="card-text text-muted mb-1">Pontuação:</p>
                            <h5 class="fs-4 fw-bold">{{ $simulation->score }}</h5>
                            <p class="card-text text-muted">Feito em: {{ $simulation->created_at->format('d/m/Y') }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

@endsection
