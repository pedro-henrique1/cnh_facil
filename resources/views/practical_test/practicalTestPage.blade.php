@extends("layouts.simulated")

@section('content')
    <main class="py-5 bg-light" style="min-height: 100vh;">
        <div class="container">
            <div class="px-3 px-md-5 py-4">
                <div
                    class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 pb-3 border-bottom">
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

                <div class="mb-4">
                    <h4 class="fw-bold text-dark" id="questionText">
                        {{ $question->question }}
                    </h4>

                    @if (!empty($question->images) && is_array($question->images))
                        <div class="text-center my-4">
                            <img src="{{ $question->images[0] ?? asset('images/default.png') }}"
                                 class="img-fluid rounded shadow-sm"
                                 alt="Imagem da questão"
                                 style="max-height: 400px; object-fit: contain;">
                        </div>
                    @endif
                </div>

                <form id="answerForm" method="POST"
                      action="{{ route('practical.submit', $encryptedQuestionId) }}">
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
                                <span class="answer-text">{{ $answerData['text'] ?? '' }}</span>
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

            // Variável para controlar envio
            let isSubmitting = false;

            // Timer
            let [minutes, seconds] = timerElement.dataset.time.split(':').map(Number);
            let totalSeconds = minutes * 60 + seconds;

            function updateTimer() {
                if (totalSeconds <= 0) {
                    window.location.href = "{{ route('practical.finish') }}";
                    return;
                }
                const displayMinutes = Math.floor(totalSeconds / 60).toString().padStart(2, '0');
                const displaySeconds = (totalSeconds % 60).toString().padStart(2, '0');
                timerElement.textContent = `${displayMinutes}:${displaySeconds}`;
                totalSeconds--;
            }

            // Inicia o timer
            updateTimer();
            setInterval(updateTimer, 1000);

            function showAlert(message, type = 'warning') {
                // Remover alertas anteriores
                const existingAlert = document.getElementById('dynamicAlert');
                if (existingAlert) {
                    existingAlert.remove();
                }

                const alertDiv = document.createElement('div');
                alertDiv.id = 'dynamicAlert';
                alertDiv.className = `alert alert-${type} alert-dismissible fade show position-fixed top-0 start-50 translate-middle-x mt-3`;
                alertDiv.style.zIndex = '9999';
                alertDiv.style.maxWidth = '90%';
                alertDiv.style.width = 'auto';
                alertDiv.innerHTML = `
                    ${message}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                `;
                document.body.appendChild(alertDiv);

                setTimeout(() => {
                    if (alertDiv.parentNode) {
                        alertDiv.remove();
                    }
                }, 4000);
            }

            answerButtons.forEach(btn => {
                btn.addEventListener('click', function () {
                    answerButtons.forEach(b => b.classList.remove('active'));
                    this.classList.add('active');
                    selectedAnswerIndex.value = this.getAttribute('data-index');
                });
            });

            // Envio da resposta
            nextButton.addEventListener('click', function () {
                if (!selectedAnswerIndex.value) return;
                isSubmitting = true;
                answerForm.submit();
            });

            // Bloquear botão voltar do navegador
            history.pushState(null, null, location.href);
            window.onpopstate = function () {
                if (!isSubmitting) {
                    history.go(1);
                    showAlert('⚠️ Você não pode voltar às questões anteriores!');
                }
            };

            // Bloquear atalhos de teclado
            document.addEventListener('keydown', function (e) {
                if (e.key === 'Backspace' && e.target.nodeName !== 'INPUT' && e.target.nodeName !== 'TEXTAREA') {
                    e.preventDefault();
                }
                if (e.altKey && e.key === 'ArrowLeft') {
                    e.preventDefault();
                    showAlert('⚠️ Atalho desabilitado durante o teste!');
                }
            });

            // Aviso ao sair da página (apenas se não estiver enviando)
            window.addEventListener('beforeunload', function (e) {
                if (!isSubmitting) {
                    e.preventDefault();
                    e.returnValue = 'Tem certeza que deseja sair? Seu progresso será perdido.';
                }
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
