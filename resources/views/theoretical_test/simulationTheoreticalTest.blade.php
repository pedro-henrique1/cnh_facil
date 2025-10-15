@extends('base')

@section('content')
    <main class="py-5">
        <div class="container">
            <div class="text-center mb-5">
                <h1 class="fw-bold">Simulados Detran</h1>
                <p class="text-muted">Prepare-se para a prova teórica com nossos simulados!</p>
            </div>

            <div class="row g-4 justify-content-center">
                {{-- Card de Simulado de Sinalização --}}
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="card h-100 shadow-sm border-0 rounded-4">
                        <div class="card-body p-4 text-center">
                            <i class="bi bi-sign-turn-right fs-1 text-info mb-3"></i>
                            <h5 class="card-title fw-bold mb-2">Sinalização</h5>
                            <p class="card-text text-muted mb-4">Teste seus conhecimentos sobre placas e sinais de trânsito.
                            </p>
                            <span class="badge bg-info-subtle text-info mb-3"><i class="bi bi-question-circle me-1"></i> 20
                                Questões</span>
                            <span class="badge bg-info-subtle text-info mb-3 ms-2"><i class="bi bi-clock me-1"></i> 30
                                Minutos</span>
                            <form action="{{ route('theoretical.simulation.generate') }}" method="POST">
                                @csrf
                                <input type="hidden" name="num_questions" value="10">
                                <input type="hidden" name="category_id" value="6">
                            <a href="#" class="btn btn-info w-100 mt-3 rounded-pill">Iniciar Simulado <i
                                    class="bi bi-arrow-right ms-2"></i></a>
                            </form>
                        </div>
                    </div>
                </div>

                {{-- Card de Simulado de Legislação de Trânsito --}}
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="card h-100 shadow-sm border-0 rounded-4">
                        <div class="card-body p-4 text-center">
                            <i class="bi bi-book fs-1 text-primary mb-3"></i>
                            <h5 class="card-title fw-bold mb-2">Legislação de Trânsito</h5>
                            <p class="card-text text-muted mb-4">Teste seus conhecimentos sobre as leis e normas de
                                trânsito.</p>
                            <span class="badge bg-primary-subtle text-primary mb-3"><i
                                    class="bi bi-question-circle me-1"></i> 30 Questões</span>
                            <span class="badge bg-info-subtle text-info mb-3 ms-2"><i class="bi bi-clock me-1"></i> 40
                                Minutos</span>
                            <form action="{{ route('theoretical.simulation.generate') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="num_questions" value="10">
                                    <input type="hidden" name="category_id" value="2">
                                <a href="#" class="btn btn-primary w-100 mt-3 rounded-pill">Iniciar Simulado <i
                                        class="bi bi-arrow-right ms-2"></i></a>
                            </form>
                        </div>
                    </div>
                </div>

                {{-- Card de Simulado de Direção Defensiva --}}
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="card h-100 shadow-sm border-0 rounded-4">
                        <div class="card-body p-4 text-center">
                            <i class="bi bi-car-front fs-1 text-success mb-3"></i>
                            <h5 class="card-title fw-bold mb-2">Direção Defensiva</h5>
                            <p class="card-text text-muted mb-4">Aprenda a conduzir com segurança e evitar acidentes.</p>
                            <span class="badge bg-success-subtle text-success mb-3"><i
                                    class="bi bi-question-circle me-1"></i> 15 Questões</span>
                            <span class="badge bg-info-subtle text-info mb-3 ms-2"><i class="bi bi-clock me-1"></i> 20
                                Minutos</span>
                            <form action="{{ route('theoretical.simulation.generate') }}" method="POST">
                                @csrf
                                <input type="hidden" name="num_questions" value="10">
                                <input type="hidden" name="category_id" value="3">
                                <a href="#" class="btn btn-success w-100 mt-3 rounded-pill">Iniciar Simulado <i
                                        class="bi bi-arrow-right ms-2"></i></a>
                            </form>
                        </div>
                    </div>
                </div>

                {{-- Card de Simulado de Mecânica Básica --}}
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="card h-100 shadow-sm border-0 rounded-4">
                        <div class="card-body p-4 text-center">
                            <i class="bi bi-tools fs-1 text-warning mb-3"></i>
                            <h5 class="card-title fw-bold mb-2">Mecânica Básica</h5>
                            <p class="card-text text-muted mb-4">Conheça o funcionamento do seu veículo e previna problemas.
                            </p>
                            <span class="badge bg-warning-subtle text-warning mb-3"><i
                                    class="bi bi-question-circle me-1"></i> 10 Questões</span>
                            <span class="badge bg-info-subtle text-info mb-3 ms-2"><i class="bi bi-clock me-1"></i> 15
                                Minutos</span>
                            <form action="{{ route('theoretical.simulation.generate') }}" method="POST">
                                @csrf
                                <input type="hidden" name="num_questions" value="10">
                                <input type="hidden" name="category_id" value="4">
                            <a href="#" class="btn btn-warning w-100 mt-3 rounded-pill">Iniciar Simulado <i
                                    class="bi bi-arrow-right ms-2"></i></a>

                            </form>
                        </div>
                    </div>
                </div>

                {{-- Card de Simulado de Primeiros Socorros --}}
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="card h-100 shadow-sm border-0 rounded-4">
                        <div class="card-body p-4 text-center">
                            <i class="bi bi-heart-pulse fs-1 text-danger mb-3"></i>
                            <h5 class="card-title fw-bold mb-2">Primeiros Socorros</h5>
                            <p class="card-text text-muted mb-4">Saiba como agir em situações de emergência no trânsito.</p>
                            <span class="badge bg-danger-subtle text-danger mb-3"><i class="bi bi-question-circle me-1"></i>
                                10 Questões</span>
                            <span class="badge bg-info-subtle text-info mb-3 ms-2"><i class="bi bi-clock me-1"></i> 15
                                Minutos</span>
                            <form action="{{ route('theoretical.simulation.generate') }}" method="POST">
                                @csrf
                                <input type="hidden" name="num_questions" value="10">
                                <input type="hidden" name="category_id" value="5">

                                <button type="submit" class="btn btn-danger w-100 mt-3 rounded-pill">
                                    Iniciar Simulado <i class="bi bi-arrow-right ms-2"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-center mt-5 pt-4 border-top">
                <p class="lead text-muted mb-3">Pronto para testar seus conhecimentos?</p>
                <a href="#" class="btn btn-outline-primary btn-lg rounded-pill px-4">Ver Todos os Simulados</a>
            </div>
        </div>
    </main>
@endsection

@push('styles')
    <style>
        body {
            background-color: #f8f9fa;
        }

        .card {
            transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
            cursor: pointer;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
        }

        .rounded-4 {
            border-radius: 1rem !important;
        }

        .rounded-pill {
            border-radius: 50rem !important;
        }

        .badge {
            padding: 0.5em 0.8em;
            font-size: 0.85em;
            font-weight: 600;
        }

        .bg-primary-subtle {
            background-color: #cfe2ff !important;
        }

        .bg-success-subtle {
            background-color: #d1e7dd !important;
        }

        .bg-danger-subtle {
            background-color: #f8d7da !important;
        }

        .bg-info-subtle {
            background-color: #cff4fc !important;
        }

        .bg-warning-subtle {
            background-color: #fff3cd !important;
        }
    </style>
@endpush
