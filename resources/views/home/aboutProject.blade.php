@extends('base')

@section('content')
    <main>
        {{-- Hero Section --}}
        <div class="hero-banner d-flex align-items-center justify-content-center text-center">
            <div class="container">
                <h1 class="display-4 fw-bold mb-3">Sobre o Projeto</h1>
                <p class="lead">Um site educacional para auxiliar pessoas na conquista da primeira CNH.</p>
            </div>
        </div>

        {{-- Intuito do Projeto --}}
        <section class="section-spacing section-light">
            <div class="container">
                <h2 class="fw-semibold mb-4 text-center">Qual o intuito do projeto?</h2>
                <p class="text-justify">
                    Este projeto foi desenvolvido para a disciplina <strong>Projeto Integrador</strong> e consiste em um
                    site educacional voltado para pessoas que desejam estudar para obter a primeira Carteira Nacional de
                    Habilitação (CNH). O objetivo é facilitar o aprendizado e a preparação para a prova do DETRAN,
                    reunindo conteúdos teóricos e práticos sobre legislação de trânsito, sinalização, direção defensiva e
                    primeiros socorros. O site oferece materiais de estudo, vídeos explicativos, simulados interativos e
                    jogos educativos, promovendo uma experiência de aprendizado dinâmica e prática.
                </p>
            </div>
        </section>

        {{-- ODS --}}
        <section class="section-spacing section-alt">
            <div class="container">
                <div class="row align-items-center g-5">
                    <div class="col-12 col-md-8">
                        <h2 class="fw-semibold mb-3">Qual ODS melhor se enquadra nesse projeto?</h2>
                        <p>
                            <strong>ODS 4 – Educação de Qualidade</strong> tem como objetivo garantir educação inclusiva,
                            equitativa e de qualidade, promovendo oportunidades de aprendizagem ao longo da vida para
                            todos.
                        </p>
                        <p>
                            Seu site promove aprendizado acessível e interativo sobre trânsito, ajudando pessoas a se
                            prepararem para tirar a primeira CNH de forma autônoma e eficiente.
                        </p>
                        <p>
                            Ao disponibilizar materiais, vídeos, simulados e jogos educativos, você está facilitando o
                            acesso ao conhecimento e promovendo a educação de forma tecnológica e inovadora, alinhando-se
                            diretamente com a meta do ODS 4.
                        </p>
                    </div>

                    <div class="col-12 col-md-4 text-center">
                        <img class="img-fluid rounded shadow-sm" src="{{ asset('images/SDG-4.svg') }}" alt="ODS 4"
                            style="max-width: 220px;">
                    </div>
                </div>
            </div>
        </section>

        {{-- Professora Orientadora --}}
        <section class="section-spacing section-light">
            <div class="container">
                <div class="row align-items-center g-5">
                    <div class="col-12 col-md-4 text-center">
                        <img class="img-fluid rounded-circle shadow" src="{{ asset('images/image.jpeg') }}" alt="ODS 4"
                            style="max-width: 180px;">
                    </div>
                    <div class="col-12 col-md-8 text-center">
                        <h2 class="fw-semibold">Professora Orientadora</h2>
                        <p class="lead">Monica Mara, professora da disciplina <em>Projeto Integrador</em>.</p>
                    </div>
                </div>
            </div>
        </section>

        {{-- Integrantes --}}
        <section class="section-spacing section-alt">
            <div class="container text-center">
                <h2 class="fw-semibold mb-4">Integrantes do Projeto</h2>
                <div class="row justify-content-center">
                    <div class="col-12 col-md-8">
                        <ul class="list-group list-group-flush shadow-sm rounded bg-white">
                            <li class="list-group-item">Danilo Pimentel de Andrade</li>
                            <li class="list-group-item">Luan Santos de Souza</li>
                            <li class="list-group-item">Maurilio Eufrasio dos Santos</li>
                            <li class="list-group-item">Pedro Henrique Silva Rodrigues</li>
                            <li class="list-group-item">Thalyta Mara da Silva</li>
                            <li class="list-group-item">Vitor Barbosa de Souza Silva</li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection

@push('styles')
    <style>
        .hero-banner {
            background: url('{{ asset('images/Gemini_Generated_Image_xj7ascxj7ascxj7a.png') }}') no-repeat center center;
            background-size: cover;
            min-height: 500px;
            position: relative;
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

        .hero-banner .container {
            position: relative;
            z-index: 1;
        }

        .hero-banner h1,
        .hero-banner p {
            color: white;
        }

        .text-justify {
            text-align: justify;
        }

        /* Novo espaçamento e contraste */
        .section-spacing {
            padding-top: 5rem;
            padding-bottom: 5rem;
        }

        /* Fundo branco */
        .section-light {
            background-color: #ffffff;
        }

        /* Fundo azul claro */
        .section-alt {
            background-color: #eaf2fb;
            /* tom azul bem suave */
        }

        .section-spacing h2 {
            margin-bottom: 2.5rem;
            font-size: 2rem;
            font-weight: 600;
            color: #2c3e50;
        }

        .section-spacing p {
            font-size: 1.1rem;
            line-height: 1.8;
            color: #333;
        }
    </style>
@endpush
