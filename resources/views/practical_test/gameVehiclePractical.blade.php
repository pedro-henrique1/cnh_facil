@extends('base')

@section('content')
    <div class="container mt-5">
        <h2 class="text-center mb-4">Escolha seu Simulado</h2>
        <p class="text-center text-muted">Prepare-se para a prova teórica ou teste seus conhecimentos práticos de manutenção veicular.</p>

        <div class="row justify-content-center mt-5">

            <div class="col-md-5 mb-4">
                <div class="card shadow-lg border-success h-100">
                    <div class="card-body text-center">
                        <h4 class="card-title text-success">🔧 Teste Prático: Conheça o Carro</h4>
                        <p class="card-text">
                            Foco em diagnóstico, identificação de peças visuais e manutenção de segurança.
                            Ideal para estudar para a prova prática do DETRAN.
                        </p>

                        <form action="{{ route('practical.simulation.generate') }}" method="POST">
                            @csrf

                                <input type="hidden" name="category_uuid" >
                                <input type="hidden" name="num_questions" value="10">
                                <button type="submit" class="btn btn-success btn-lg mt-3">
                                    Iniciar Teste Prático
                                </button>

                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-5 mb-4">
                <div class="card shadow-lg border-info h-100">
                    <div class="card-body text-center">
                        <h4 class="card-title text-info">📚 Simulado Teórico Padrão</h4>
                        <p class="card-text">
                            Questões aleatórias sobre Legislação, Direção Defensiva, Primeiros Socorros e Cidadania.
                            Simulação completa do exame teórico (30 Questões / 40 min).
                        </p>

                        <form action="{{ route('theoretical.simulation.generate') }}" method="POST">
                            @csrf
                            <input type="hidden" name="num_questions" value="30">
                            <button type="submit" class="btn btn-info btn-lg mt-3">
                                Iniciar Simulado Padrão
                            </button>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
