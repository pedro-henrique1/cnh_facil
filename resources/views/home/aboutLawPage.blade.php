@extends('base')

@section('content')
    <style>


        .feature-box {
            background-color: #f8f9fa;
            border-radius: 10px;
            padding: 1.5rem;
            border: none;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s;
        }

        .feature-box:hover {
            transform: translateY(-5px);
        }

        .faq-box {
            text-align: center;
            padding: 1rem;
            border-radius: 10px;
            background-color: white;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .faq-icon {
            font-size: 2rem;
            color: #0d6efd; /* Exemplo de cor azul */
            margin-bottom: 0.5rem;
        }

        .step-item {
            padding-left: 20px;
            position: relative;
            margin-bottom: 1.5rem;
            border-bottom: 1px solid #eee;
            padding-bottom: 1rem;
        }

        .step-item:last-child {
            border-bottom: none;
        }
    </style>

    <main class="container my-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="hero-title-block  text-center">

                        <h1 class="display-5 fw-bold">Menos Burocracia, Mais Liberdade: Entenda a Nova Lei da CNH</h1>
                        <p class="lead">A partir de agora, o caminho para tirar sua Carteira Nacional de Habilitação (CNH) ficou mais simples e acessível. Uma nova legislação foi aprovada, eliminando a obrigatoriedade de frequentar autoescolas.</p>
                    </div>
                </div>
            </div>
        </div>

        <section class="mb-5 mt-5 pt-3">
            <h2 class="text-center mb-4">O Que Mudou?</h2>

            <div class="row justify-content-center">
                <div class="col-md-5 mb-4">
                    <div class="feature-box d-flex align-items-start">
                        <div class="me-3">
                            <i class="bi bi-book fs-2 text-success"></i>
                        </div>
                        <div>
                            <h5 class="fw-bold">Estudo Teórico</h5>
                            <p class="mb-0 text-muted">Não é mais obrigatório frequentar aulas teóricas em autoescolas. Você pode estudar o Código de Trânsito Brasileiro por conta própria.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-5 mb-4">
                    <div class="feature-box d-flex align-items-start">
                        <div class="me-3">
                            <i class="bi bi-car-front-fill fs-2 text-info"></i>
                        </div>
                        <div>
                            <h5 class="fw-bold">Aulas Práticas</h5>
                            <p class="mb-0 text-muted">Aulas de direção com instrutor de autoescola deixam de ser uma exigência. Você pode treinar com instrutor particular ou condutor habilitado.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="mb-5">
            <h2 class="text-center mb-4">Como Funciona Agora?</h2>
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="step-item">
                                <span class="badge bg-primary rounded-pill position-absolute start-0 translate-middle-y">1</span>
                                <h5 class="mb-1 ms-4">Inscrição no DETRAN</h5>
                                <p class="ms-4 text-muted">O primeiro passo continua sendo o registro no DETRAN para iniciar o processo da CNH.</p>
                            </div>
                            <div class="step-item">
                                <span class="badge bg-primary rounded-pill position-absolute start-0 translate-middle-y">2</span>
                                <h5 class="mb-1 ms-4">Exame Teórico</h5>
                                <p class="ms-4 text-muted">Após estudar por conta própria, você fará a prova teórica diretamente no DETRAN.</p>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="step-item">
                                <span class="badge bg-primary rounded-pill position-absolute start-0 translate-middle-y">3</span>
                                <h5 class="mb-1 ms-4">Preparação Prática</h5>
                                <p class="ms-4 text-muted">Você pode aprender a dirigir com instrutor particular credenciado ou familiar/amigo qualificado.</p>
                            </div>
                            <div class="step-item">
                                <span class="badge bg-primary rounded-pill position-absolute start-0 translate-middle-y">4</span>
                                <h5 class="mb-1 ms-4">Exame Prático</h5>
                                <p class="ms-4 text-muted">Após se sentir preparado, você agendará e realizará o exame prático de direção no DETRAN.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="mb-5 p-4 bg-light rounded-3 text-center">
            <h2 class="mb-4">Vantagens da Nova Lei</h2>
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <ul class="list-group list-group-horizontal-md justify-content-center">
                        <li class="list-group-item border-0 bg-transparent text-success fw-bold"><i class="bi bi-currency-dollar me-1"></i> Economia</li>
                        <li class="list-group-item border-0 bg-transparent text-info fw-bold"><i class="bi bi-clock me-1"></i> Flexibilidade</li>
                        <li class="list-group-item border-0 bg-transparent text-warning fw-bold"><i class="bi bi-person-check me-1"></i> Autonomia</li>
                    </ul>
                </div>
            </div>
        </section>


        <section class="mb-5">
            <h2 class="text-center mb-4">Dúvidas Frequentes (FAQ)</h2>
            <div class="row justify-content-center">

                <div class="col-12 text-center mb-4">
                    <i class="bi bi-flag-fill display-3 text-danger me-2"></i>
                    <i class="bi bi-flag-fill display-3 text-success"></i>
                </div>

                <div class="col-md-4 mb-4">
                    <div class="faq-box">
                        <div class="faq-icon text-primary"><i class="bi bi-question-circle"></i></div>
                        <h6 class="fw-bold">Ainda posso ir para autoescola?</h6>
                        <p class="small text-muted mb-0">Sim, a lei apenas remove a obrigatoriedade, mantendo a opção para quem prefere a estrutura tradicional.</p>
                    </div>
                </div>

                <div class="col-md-4 mb-4">
                    <div class="faq-box">
                        <div class="faq-icon text-success"><i class="bi bi-file-earmark-text"></i></div>
                        <h6 class="fw-bold">Requisitos do instrutor particular</h6>
                        <p class="small text-muted mb-0">O veículo e o instrutor (amigo/familiar) devem atender a critérios rigorosos de segurança e tempo de habilitação.</p>
                    </div>
                </div>

                <div class="col-md-4 mb-4">
                    <div class="faq-box">
                        <div class="faq-icon text-info"><i class="bi bi-laptop"></i></div>
                        <h6 class="fw-bold">Conteúdos para a prova teórica</h6>
                        <p class="small text-muted mb-0">O DETRAN disponibiliza em seu site o conteúdo programático completo para o exame teórico.</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="text-center pt-4 border-top">
            <p class="lead mb-3">Esta nova lei representa um avanço na desburocratização e modernização do processo de habilitação. Informe-se, prepare-se e conquiste sua CNH de forma mais flexível e econômica!</p>
            <div class="d-flex justify-content-center align-items-center mb-3">
                <i class="bi bi-twitter me-3 text-muted"></i>
                <i class="bi bi-facebook me-3 text-muted"></i>
                <i class="bi bi-instagram me-3 text-muted"></i>
                <span class="ms-5 text-uppercase fw-bold text-dark">DETRAN-BR</span>
            </div>
        </section>

    </main>

@endsection
