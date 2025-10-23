@extends('layouts.simulated')

@section('content')
    <main class="py-5">
        <div class="container">
            <div class="card shadow-lg border-0 rounded-4 overflow-hidden">

                {{-- Header colorido baseado no resultado --}}
                <div class="card-header text-white text-center py-4 {{ $passed ? 'bg-success' : 'bg-danger' }}">
                    @if ($passed)
                        <i class="bi bi-trophy-fill display-1 mb-3 d-block"></i>
                        <h1 class="fw-bold mb-2">PARABÉNS!</h1>
                        <p class="mb-0 fs-5">Você foi aprovado no simulado</p>
                    @else
                        <i class="bi bi-emoji-frown display-1 mb-3 d-block"></i>
                        <h1 class="fw-bold mb-2">NÃO FOI DESSA VEZ</h1>
                        <p class="mb-0 fs-5">Continue treinando, você vai conseguir!</p>
                    @endif
                </div>

                <div class="card-body p-4 p-md-5">

                    {{-- Círculo de progresso animado --}}
                    <div class="text-center mb-5">
                        <div class="position-relative d-inline-block">
                            <svg width="200" height="200" viewBox="0 0 200 200">
                                {{-- Círculo de fundo --}}
                                <circle cx="100" cy="100" r="90" fill="none"
                                        stroke="#e9ecef" stroke-width="20"/>

                                {{-- Círculo de progresso --}}
                                <circle cx="100" cy="100" r="90" fill="none"
                                        stroke="{{ $passed ? '#198754' : '#dc3545' }}"
                                        stroke-width="20"
                                        stroke-dasharray="{{ $percentage * 5.65 }} 565"
                                        stroke-linecap="round"
                                        transform="rotate(-90 100 100)"
                                        style="transition: stroke-dasharray 1s ease-in-out"/>
                            </svg>

                            {{-- Porcentagem no centro --}}
                            <div class="position-absolute top-50 start-50 translate-middle">
                                <h2 class="display-3 fw-bold mb-0 {{ $passed ? 'text-success' : 'text-danger' }}">
                                    {{ $percentage }}%
                                </h2>
                                <small class="text-muted">aproveitamento</small>
                            </div>
                        </div>
                    </div>

                    {{-- Cards de estatísticas --}}
                    <div class="row g-3 mb-5">
                        <div class="col-md-3 col-6">
                            <div class="card border-0 bg-light h-100">
                                <div class="card-body text-center">
                                    <i class="bi bi-question-circle fs-2 text-primary mb-2"></i>
                                    <h3 class="h2 fw-bold mb-0">{{ $totalQuestions }}</h3>
                                    <small class="text-muted">Questões</small>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3 col-6">
                            <div class="card border-0 bg-success-subtle h-100">
                                <div class="card-body text-center">
                                    <i class="bi bi-check-circle-fill fs-2 text-success mb-2"></i>
                                    <h3 class="h2 fw-bold mb-0">{{ $correctAnswers }}</h3>
                                    <small class="text-muted">Acertos</small>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3 col-6">
                            <div class="card border-0 bg-danger-subtle h-100">
                                <div class="card-body text-center">
                                    <i class="bi bi-x-circle-fill fs-2 text-danger mb-2"></i>
                                    <h3 class="h2 fw-bold mb-0">{{ $wrongAnswers }}</h3>
                                    <small class="text-muted">Erros</small>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3 col-6">
                            <div class="card border-0 bg-info-subtle h-100">
                                <div class="card-body text-center">
                                    <i class="bi bi-clock-fill fs-2 text-info mb-2"></i>
                                    <h3 class="h5 fw-bold mb-0">{{ $timeTaken }}</h3>
                                    <small class="text-muted">Tempo</small>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Pontuação detalhada --}}
                    <div class="alert {{ $passed ? 'alert-success' : 'alert-danger' }} mb-4" role="alert">
                        <div class="d-flex align-items-center">
                            <i class="bi {{ $passed ? 'bi-check-circle-fill' : 'bi-info-circle-fill' }} fs-3 me-3"></i>
                            <div>
                                <h5 class="alert-heading mb-1">
                                    @if ($passed)
                                        Você atingiu a pontuação mínima!
                                    @else
                                        Pontuação insuficiente para aprovação
                                    @endif
                                </h5>
                                <p class="mb-0">
                                    Sua pontuação: <strong>{{ $score }}</strong> pontos
                                    @if (!$passed)
                                        <br>
                                        <small>Continue praticando! Cada tentativa te deixa mais perto da aprovação.</small>
                                    @endif
                                </p>
                            </div>
                        </div>
                        </alert>

                        {{-- Mensagem motivacional --}}
                        <div class="card border-0 bg-light mb-4">
                            <div class="card-body text-center py-4">
                                @if ($passed)
                                    <i class="bi bi-star-fill text-warning fs-1 mb-3 d-block"></i>
                                    <h5 class="fw-bold mb-2">Excelente trabalho!</h5>
                                    <p class="text-muted mb-0">
                                        Continue assim e você estará pronto para a prova oficial.
                                    </p>
                                @else
                                    <i class="bi bi-lightbulb-fill text-warning fs-1 mb-3 d-block"></i>
                                    <h5 class="fw-bold mb-2">Não desista!</h5>
                                    <p class="text-muted mb-0">
                                        A prática leva à perfeição. Revise o conteúdo e tente novamente.
                                    </p>
                                @endif
                            </div>
                        </div>

                        {{-- Botão único de voltar --}}
                        <div class="d-grid gap-3 mt-5">
                            <a href="{{ route('home') }}" class="btn btn-primary btn-lg shadow">
                                <i class="bi bi-house-fill me-2"></i>
                                Voltar ao Início
                            </a>


                        </div>
                    </div>
                </div>
    </main>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const card = document.querySelector('.card');
                card.style.opacity = '0';
                card.style.transform = 'translateY(20px)';

                setTimeout(() => {
                    card.style.transition = 'all 0.5s ease';
                    card.style.opacity = '1';
                    card.style.transform = 'translateY(0)';
                }, 100);
            });
        </script>
    @endpush

    @push('styles')
        <style>
            /* Animação suave para os cards */
            .card {
                transition: transform 0.3s ease, box-shadow 0.3s ease;
            }

            /* Efeito hover nos botões */
            .btn {
                transition: all 0.3s ease;
            }

            .btn:hover {
                transform: translateY(-2px);
            }

            /* Animação do círculo de progresso */
            @keyframes fillCircle {
                from {
                    stroke-dasharray: 0 565;
                }
            }

            circle:last-of-type {
                animation: fillCircle 1.5s ease-in-out;
            }

            /* Responsividade melhorada */
            @media (max-width: 576px) {
                .display-3 {
                    font-size: 2.5rem;
                }

                .h2 {
                    font-size: 1.5rem;
                }
            }

            /* Efeito de brilho no header de sucesso */
            .bg-success {
                background: linear-gradient(135deg, #198754 0%, #20c997 100%) !important;
            }

            .bg-danger {
                background: linear-gradient(135deg, #dc3545 0%, #e35d6a 100%) !important;
            }
        </style>
    @endpush
@endsection
