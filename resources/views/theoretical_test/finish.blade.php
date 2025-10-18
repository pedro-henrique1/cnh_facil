@extends('layouts.simulated')

@section('content')
    <main class="py-5">
        <div class="container">
            <div class="card shadow-lg border-0 rounded-4 p-4 p-md-5">
                <div class="card-body text-center">

                    @if ($passed)
                        <h2 class="fw-bold mb-3 text-success">🎉 SIMULADO APROVADO! 🎉</h2>
                        <div class="alert alert-success mt-3 p-3 fs-5" role="alert">
                            Parabéns, você atingiu a pontuação mínima!
                        </div>
                    @else
                        <h2 class="fw-bold mb-3 text-danger">⚠️ SIMULADO FINALIZADO ⚠️</h2>
                        <div class="alert alert-danger mt-3 p-3 fs-5" role="alert">
                            Infelizmente, você não atingiu a pontuação mínima.
                        </div>
                    @endif

                    <div class="my-5 p-3 rounded-3 bg-light border border-secondary border-3 d-inline-block">
                        <p class="mb-1 text-muted small">Seu resultado:</p>
                        <h3 class="display-2 fw-bolder
                            @if ($passed)
                                text-success
                            @else
                                text-primary
                            @endif
                            lh-1">{{ $percentage }}%
                        </h3>
                    </div>

                    <p class="fs-5 mb-4 text-dark">Você respondeu {{ $totalQuestions }} questões.</p>

                    <div class="row justify-content-center mb-4 g-2">
                        <div class="col-6 col-md-4">
                            <p class="mb-2 text-success"><i class="bi bi-check-circle-fill"></i> Acertos: {{ $correctAnswers }}</p>
                        </div>
                        <div class="col-6 col-md-4">
                            <p class="mb-2 text-danger"><i class="bi bi-x-circle-fill"></i> Erros: {{ $wrongAnswers }}</p>
                        </div>
                    </div>

                    <p class="mb-2 text-muted">Pontuação: {{ $score }}</p>
                    <p class="mb-4 text-muted">Tempo gasto: {{ $timeTaken }}</p>

                    <div class="d-grid gap-3 col-md-6 mx-auto mt-5">

                        @if ($wrongAnswers > 0)
                            <a href="{{ route('review_simulado', $simulado_id ?? 0) }}" class="btn btn-info btn-lg">Revisar minhas respostas</a>
                        @endif

{{--                        @if ($passed)--}}
{{--                            <a href="{{ route('next_simulado') }}" class="btn btn-success btn-lg">Avançar para o Próximo Simulado</a>--}}
{{--                        @else--}}
{{--                            <a href="{{ route('repeat_simulado') }}" class="btn btn-primary btn-lg">Refazer Simulado</a>--}}
{{--                        @endif--}}

                        <a href="{{ route('home') }}" class="btn btn-link text-muted">Voltar ao Início</a>
                    </div>

                </div>
            </div>
        </div>
    </main>
@endsection
