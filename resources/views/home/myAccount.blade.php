@extends('base')

@section('content')

    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="display-6 fw-bold text-dark mb-0">Olá, {{ $user->name }}!</h1>
            <div class="d-flex align-items-center">
                @if($user->is_admin)
                    <a href="/admin" class="btn btn-outline-primary btn-lg me-3 d-none d-md-block">
                        Admin
                    </a>
                @endif
                <button type="button" class="btn btn-outline-secondary me-3 btn-lg" data-bs-toggle="modal"
                        data-bs-target="#accountModal" title="Configurações da Conta">
                    <i class="bi bi-person-circle"></i> Conta
                </button>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
                <button class="btn btn-outline-danger btn-lg" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" title="Sair do Sistema">
                    <i class="bi bi-box-arrow-right"></i> Sair
                </button>
            </div>
        </div>

        <div class="row g-4 mb-5">

            <div class="col-12 col-xl-4">
                <div class="card border-0 shadow-sm p-4 h-100" style="background-color: #f7f9ff; border-left: 5px solid #007bff !important;">
                    <h3 class="card-title text-primary fw-bold mb-3">Seu Nível Atual</h3>

                    @php
                        $nivel = floor($totalScore / 100);
                        $xpAtual = $totalScore % 100;
                    @endphp

                    <div class="text-center mb-3">
                        <span class="display-2 fw-bolder text-dark">{{ $nivel }}</span>
                        <h4 class="h5 fw-bold text-muted">Nível de Estudante</h4>
                    </div>

                    <div class="mt-auto">
                        <p class="mb-1 fw-bold">Próximo Nível: {{ $xpAtual }}/100 XP</p>
                        <div class="progress" style="height: 20px;">
                            <div class="progress-bar bg-success" role="progressbar"
                                 style="width: {{ $xpAtual }}%;"
                                 aria-valuenow="{{ $xpAtual }}" aria-valuemin="0" aria-valuemax="100">
                                <small>{{ $xpAtual }} XP</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-xl-8">
                <div class="row g-4 h-100">
                    <div class="col-12 col-md-6">
                        <div class="card h-100 border-0 shadow-sm bg-primary text-white p-4">
                            <div class="card-body text-center d-flex flex-column justify-content-center">
                                <h4 class="card-title fw-bolder mb-3">PRONTO PARA O DESAFIO?</h4>
                                <p class="card-text mb-4 opacity-75">Gere um simulado rápido de 30 questões.</p>

                                <form action="{{ route('theoretical.simulation.generate') }}" method="POST" class="mt-auto">
                                    @csrf
                                    <input type="hidden" name="num_questions" value="30">
                                    <button type="submit" class="btn btn-lg btn-warning fw-bold w-100 shadow-lg py-3">
                                        <i class="bi bi-rocket-takeoff"></i> INICIAR SIMULADO AGORA
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                        <div class="card h-100 border-0 shadow-sm p-4">
                            <h4 class="card-title fw-bold mb-3 text-dark">🚀 Suas Conquistas</h4>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                    Total de Simulados:
                                    <span class="badge bg-primary fs-6">{{ $simulations->count() }}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                    Melhor Pontuação:
                                    <span class="badge bg-success fs-6">{{ $simulations->max('score') ?? 0 }}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                    Média Geral:
                                    <span class="badge bg-info text-dark fs-6">{{ round($simulations->avg('score') ?? 0, 1) }}</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <h3 class="fs-4 fw-bold mt-xl-3 mb-3 border-bottom pb-2">🏅 Suas Medalhas e Conquistas</h3>
        <div class="d-flex flex-wrap gap-3 mb-5">
            @if($simulations->count() >= 1)
                <span class="badge rounded-pill bg-success p-3 fs-6 shadow-sm">🥇 1º Simulado</span>
            @endif

            @if($simulations->count() >= 5)
                <span class="badge rounded-pill bg-primary p-3 fs-6 shadow-sm">🏅 5 Simulados</span>
            @endif

            @if($simulations->count() >= 10)
                <span class="badge rounded-pill bg-warning text-dark p-3 fs-6 shadow-sm">🏆 10 Simulados</span>
            @endif

            @if($simulations->max('score') == 100)
                <span class="badge rounded-pill bg-info text-dark p-3 fs-6 shadow-sm">💯 Perfeição</span>
            @endif

            @if($simulations->count() >= 3 && $simulations->take(-3)->pluck('created_at')->map->format('Y-m-d')->unique()->count() == 1)
                <span class="badge rounded-pill bg-danger p-3 fs-6 shadow-sm">🔥 Foco Intenso (3 no dia)</span>
            @endif

            @if($simulations->count() >= 7 && $simulations->groupBy(fn($s) => $s->created_at->format('Y-m-d'))->count() >= 7)
                <span class="badge rounded-pill bg-dark p-3 fs-6 shadow-sm">📆 7 Dias de Estudo</span>
            @endif

            @if(floor($totalScore / 100) >= 10)
                <span class="badge rounded-pill bg-success p-3 fs-6 shadow-sm">🧙 Veterano (Nível 10)</span>
            @endif

            @if(isset($user->has_social_achievement) && $user->has_social_achievement)
                <span class="badge rounded-pill p-3 fs-6 shadow-sm" style="background-color: #f06292; color: white;">🤝 Conquista Social</span>
            @endif
        </div>

        @if(isset($activeMissions) && $activeMissions->isNotEmpty())
            <h2 class="fs-4 fw-bold mt-5 mb-4 border-bottom pb-2">🎯 Missões para Fazer</h2>
            <div class="row g-3 mb-5">
                @foreach($activeMissions as $userMission)
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="card h-100 shadow-sm border-0 bg-light">
                            <div class="card-body">
                                <h5 class="card-title fw-bolder text-primary">{{ $userMission->mission->name }}</h5>
                                <p class="card-text text-muted mb-3">{{ $userMission->mission->description }}</p>

                                <span class="badge bg-warning text-dark mb-3 fw-bold">+{{ $userMission->mission->reward_xp ?? 50 }} XP de Recompensa</span>

                                <div class="progress mt-2" style="height: 18px;">
                                    <div class="progress-bar bg-success progress-bar-striped" role="progressbar"
                                         style="width: {{ $userMission->current_progress }}%;"
                                         aria-valuenow="{{ $userMission->current_progress }}"
                                         aria-valuemin="0"
                                         aria-valuemax="100">
                                        {{ $userMission->current_progress }}%
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        {{-- Seção de Simulados Realizados --}}
        <h2 class="fs-4 fw-bold mt-5 mb-4 border-bottom pb-2">📜 Histórico de Simulados ({{ $simulations->count() }})</h2>
        <div class="row g-4">
            @foreach($simulations as $index => $simulation)
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="card h-100 shadow-sm border-0">
                        <div class="card-body text-center d-flex flex-column">
                            <h4 class="card-title fw-bold text-dark">Simulado #{{ $simulations->count() - $index }}</h4>
                            <p class="card-text text-muted mb-2">Pontuação:</p>

                            {{-- Feedback Visual de Pontuação --}}
                            <h5 class="fs-2 fw-bolder mb-3 mt-auto"
                                @if($simulation->score >= 80)
                                    style="color: #198754;"
                                @elseif($simulation->score >= 50)
                                    style="color: #ffc107;"
                                @else
                                    style="color: #dc3545;"
                                @endif
                            >
                                {{ $simulation->score }}
                            </h5>
                            <p class="card-text text-muted"><small>Feito em: {{ $simulation->created_at->format('d/m/Y H:i') }}</small></p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div class="modal fade" id="accountModal" tabindex="-1" aria-labelledby="accountModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ route('account.update') }}" method="POST" class="modal-content">
                @csrf
                @method('PUT')

                <div class="modal-header">
                    <h5 class="modal-title" id="accountModalLabel">Informações da Conta</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                </div>

                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nome</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ $user->name }}" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" id="email" class="form-control" value="{{ $user->email }}" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Nova Senha</label>
                        <input type="password" name="password" id="password" class="form-control" placeholder="Deixe em branco para não alterar" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Confirme a Senha</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Confirme a nova senha" readonly>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" id="editAccountBtn" class="btn btn-warning">Editar</button>
                    <button type="submit" id="saveAccountBtn" class="btn btn-primary" style="display:none;">Salvar Alterações</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const editBtn = document.getElementById('editAccountBtn');
            const saveBtn = document.getElementById('saveAccountBtn');
            const inputs = document.querySelectorAll('#accountModal input');

            editBtn.addEventListener('click', function () {
                inputs.forEach(input => {
                    if (input.id !== 'email') {
                        input.removeAttribute('readonly');
                    }
                });
                editBtn.style.display = 'none';
                saveBtn.style.display = 'inline-block';
            });
        });
    </script>
@endsection
