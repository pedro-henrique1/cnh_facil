@extends("layouts.simulated")

@section('content')
    <main class="py-5 bg-light" style="min-height: 100vh;">
        <div class="container">
            <div class="px-3 px-md-5 py-4">

                <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 pb-3 border-bottom">
                    <span class="fs-6 fw-bold text-primary mb-2 mb-md-0">
                        <i class="bi bi-clock me-2"></i>
                        Tempo Restante:
                        <span id="timer" data-time="{{ $remainingTime }}">{{ $remainingTime }}</span>
                    </span>
                    <span class="fs-6 fw-bold text-muted">
                        Questão <span id="currentQuestion">{{ $currentQuestionNumber }}</span>
                        de <span id="totalQuestions">{{ $totalQuestions }}</span>
                    </span>
                </div>

                {{-- Pergunta --}}
                <div class="mb-4">
                    <h4 class="fw-bold text-dark" id="questionText">
                        {{ $question->question }}
                    </h4>

                    {{-- Imagem --}}
                    @if ($question->image)
                        <div class="text-center my-4">
                            <img src="{{ asset('storage/' . $question->image) }}"
                                 class="img-fluid rounded shadow-sm"
                                 alt="Imagem da questão"
                                 style="max-height: 400px; object-fit: contain;">
                        </div>
                    @endif
                </div>

                <form id="answerForm" method="POST" action="{{ route('simulated.submit', $question->id_question) }}">
                    @csrf
                    <input type="hidden" name="answer_index" id="selectedAnswerIndex" value="{{ old('answer_index') }}">

                    <div class="list-group mb-4">
                        @php
                            $firstAnswer = $question->answers->first();
                            $allAnswers = [];

                            if ($firstAnswer) {
                                $raw = $firstAnswer->getAttributes()['answer_text'] ?? null;
                                if (is_string($raw)) {
                                    $decoded = json_decode($raw, true);
                                    if (is_array($decoded)) {
                                        $allAnswers = $decoded;
                                    }
                                }
                            }
                        @endphp

                        @forelse ($allAnswers as $index => $answerData)
                            <button type="button"
                                    class="list-group-item list-group-item-action d-flex align-items-center gap-2 py-3 mb-2 rounded-3 answer-option"
                                    data-answer="{{ $index }}"
                                    data-index="{{ $index }}">
                                <span class="fw-bold text-primary answer-letter">{{ chr(65 + $index) }})</span>
                                <span class="answer-text">{{ $answerData['answer_text'] ?? '' }}</span>
                            </button>
                        @empty
                            <div class="alert alert-warning" role="alert">
                                Nenhuma resposta encontrada para esta questão.
                            </div>
                        @endforelse
                    </div>
                </form>

                {{-- Botão --}}
                <div class="d-grid gap-2">
                    <button class="btn btn-success btn-lg rounded-pill shadow-sm" id="nextQuestionBtn" type="button">
                        @if ($currentQuestionNumber == $totalQuestions)
                            Finalizar Simulado
                        @else
                            Próxima Questão
                        @endif
                    </button>
                </div>

                {{-- Progresso --}}
                <div class="mt-5 text-center">
                    <div class="progress rounded-pill" style="height: 22px;">
                        @php
                            $progress = ($currentQuestionNumber / $totalQuestions) * 100;
                        @endphp
                        <div class="progress-bar bg-success fw-bold d-flex align-items-center justify-content-center"
                             style="width: {{ $progress }}%">
                            {{ round($progress) }}%
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const answerButtons = document.querySelectorAll('.answer-option');
            const selectedAnswerIndex = document.getElementById('selectedAnswerIndex');
            const answerForm = document.getElementById('answerForm');
            const nextButton = document.getElementById('nextQuestionBtn');
            const timerElement = document.getElementById('timer');

            // Pega o tempo inicial do data-time, formato "MM:SS"
            let [minutes, seconds] = timerElement.dataset.time.split(':').map(Number);
            let totalSeconds = minutes * 60 + seconds;

            function updateTimer() {
                if (totalSeconds <= 0) {
                    // Redireciona para finalizar simulado quando o tempo acabar
                    window.location.href = "{{ route('theoretical.simulated.finish') }}";
                    return;
                }

                const displayMinutes = Math.floor(totalSeconds / 60).toString().padStart(2, '0');
                const displaySeconds = (totalSeconds % 60).toString().padStart(2, '0');

                timerElement.textContent = `${displayMinutes}:${displaySeconds}`;

                totalSeconds--;
            }

            updateTimer();
            setInterval(updateTimer, 1000);


            answerButtons.forEach(btn => {
                btn.addEventListener('click', function() {
                    answerButtons.forEach(b => b.classList.remove('active'));
                    this.classList.add('active');
                    selectedAnswerIndex.value = this.getAttribute('data-index');
                });
            });


            nextButton.addEventListener('click', function() {
                if (!selectedAnswerIndex.value) {
                    return;
                }
                answerForm.submit();
            });
        });
    </script>
@endsection

@push('styles')
    <style>
        body {
            background-color: #f8f9fa;
        }
        .list-group-item {
            transition: all 0.2s ease-in-out;
            cursor: pointer;
            border: 2px solid transparent;
        }

        .answer-option.active .answer-letter {
            color: #fff !important;
        }
        .answer-text {
            flex: 1;
            word-wrap: break-word;
        }
    </style>
@endpush
