@extends('base')

@section('content')
    <?php
    $secoes = [
        [
            'titulo' => 'Conheça a prova teórica',
            'cards' => [
                [
                    'titulo' => 'Estude o código de trânsito',
                    'texto' => 'Adquira conhecimento profundo das leis de trânsito, sinalização, direção defensiva e primeiros socorros.',
                    'link' => route('theoretical.information')
                ],
                [
                    'titulo' => 'Simulados online',
                    'texto' => 'Pratique com testes similares aos aplicados pelo DETRAN. Existem diversos sites e aplicativos disponíveis.',
                    'link' => route('theoretical.simulation')
                ],
                [
                    'titulo' => 'Material de estudo',
                    'texto' => 'Utilize manuais digitais, videoaulas e apostilas especializadas para se preparar adequadamente.',
                    'link' => route('home.materials')
                ],
            ]
        ],
        [
            'titulo' => 'Conheça a prova prática',
            'cards' => [
                [
                    'titulo' => 'Quizz: conheça o veículo',
                    'texto' => 'Nesse quizz, você vai conhecer as partes essenciais do carro para tirar a sua habilitação.',
                    'link' => route('practical.vehicle')
                ],
                [
                    'titulo' => 'Quizz: simulado passo-a-passo prova prática',
                    'texto' => 'Pratique os passos da prova de uma forma divertida.',
                    'link' => route('practical.questions')
                ],
                [
                    'titulo' => 'Conheça o percurso',
                    'texto' => 'Veja o percurso a ser feito durante a prova.',
                    'link' => route('practical.information')
                ],
            ]
        ],
        [
            'titulo' => 'Materiais de estudo',
            'cards' => [
                [
                    'titulo' => 'Manual do condutor',
                    'texto' => 'Conheça as boas práticas do trânsito.',
                    'link' => route('home.materials')
                ]
            ]
        ]
    ];
    ?>

    <main>
        <div class="hero-banner  d-flex align-items-center justify-content-center text-center">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h1 class="display-4 fw-bold mb-3">Como passar no Detran sem Autoescola</h1>
                        <p class="lead mt-md-5 ">Guia completo para obter sua primeira CNH de forma independente, caso a
                            obrigatoriedade da autoescola seja removida.</p>
                        <a href="#" class="btn btn-warning text-black btn-lg px-5 mt-md-5">Comece Agora</a>
                    </div>
                </div>
            </div>
        </div>

        @foreach($secoes as $secao)
            <div class="container w-100 mt-custom-lg align-items-center justify-content-center text-center"><h1
                    class="color-text">{{ $secao['titulo'] }}</h1>
                <div class="row g-4 mt-lg-5  justify-content-center"
                     style="margin-top: 8rem !important;"> @foreach($secao['cards'] as $card)
                        <div class="col-md-4"><a href="{{ $card['link'] }}" class="card shadow-sm border border-secondary text-decoration-none h-100">
                                <div class="card-body p-4 rounded-3"><h4
                                        class="card-title text-center color-text mb-3">{{ $card['titulo'] }}</h4>
                                    <p class="card-text text-center text-black mt-xl-5"> {{ $card['texto'] }} </p></div>
                            </a></div>
                    @endforeach </div>
            </div>
        @endforeach
    </main>

@endsection

@push('styles')
    <style>
        .hero-banner {
            background: url('{{asset("images/mulher-segura-cartao-credito.jpg")}}') no-repeat center center;
            background-size: cover;
            min-height: 500px;
            position: relative;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .hero-banner::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.4);
            z-index: 0;
        }

        .hero-banner > .container {
            position: relative;
            z-index: 1;
        }

        .hero-banner h1,
        .hero-banner p,
        .hero-banner .btn {
            color: white;
        }

        .hero-banner .btn-warning {
            background-color: #ffc107;
            border-color: #ffc107;
        }

        .hero-banner .btn-warning:hover {
            background-color: #e0a800;
            border-color: #e0a800;
        }

        .mt-custom-lg {
            margin-top: 8rem;
        }

        .color-text {
            color: #1155cc;
        }


    </style>
@endpush

