@extends('base')

@section('content')
    <main class="py-5">
        <div class="container">
            {{-- Título da página --}}
            <div class="text-center mb-5">
                <h1 class="fw-bold">Exame Teórico Detran</h1>
                <p class="text-muted">Informações importantes para sua prova</p>
            </div>

            <div class="row g-5 align-items-center"> {{-- Ajustado para align-items-center --}}

                {{-- Coluna para o conteúdo textual (ocupará 8 das 12 colunas em telas médias/grandes) --}}
                <div class="col-12 col-lg-8">
                    <div class="row g-4"> {{-- Este row organiza os blocos de texto --}}
                        {{-- Documentos Necessários --}}
                        <div class="col-12 col-md-6">
                            <div class="d-flex flex-column h-100">
                                <div class="d-flex align-items-center mb-3">
                                    <i class="bi bi-file-earmark-text fs-2 me-3 text-primary"></i>
                                    <h4 class="fw-semibold mb-0">Documentos Necessários</h4>
                                </div>
                                <ul class="list-unstyled mb-0 ms-5">
                                    <li><i class="bi bi-person-badge me-2 text-muted"></i> Documento de identificação com foto</li>
                                    <li><i class="bi bi-credit-card-2-front me-2 text-muted"></i> Comprovante de agendamento</li>
                                </ul>
                            </div>
                        </div>

                        {{-- Informações Necessárias --}}
                        <div class="col-12 col-md-6">
                            <div class="d-flex flex-column h-100">
                                <div class="d-flex align-items-center mb-3">
                                    <i class="bi bi-info-circle fs-2 me-3 text-info"></i>
                                    <h4 class="fw-semibold mb-0">Informações Necessárias</h4>
                                </div>
                                <ul class="list-unstyled mb-0 ms-5">
                                    <li><i class="bi bi-geo-alt me-2 text-muted"></i> Local da prova</li>
                                    <li><i class="bi bi-clock me-2 text-muted"></i> Duração: 40 a 60 minutos</li>
                                    <li><i class="bi bi-list-ol me-2 text-muted"></i> Número de questões: 30</li>
                                    <li><i class="bi bi-check2-circle me-2 text-muted"></i> Tipo: Múltipla escolha</li>
                                    <li><i class="bi bi-award me-2 text-muted"></i> Nota mínima para aprovação: 70% (21 acertos)</li>
                                    <li><i class="bi bi-eye me-2 text-muted"></i> Resultado: Disponível no dia da prova, nos autoatendimentos ou no site do Detran</li>
                                    <li><i class="bi bi-arrow-repeat me-2 text-muted"></i> Em caso de reprovação: novo exame após 15 dias mediante pagamento de taxa</li>
                                </ul>
                            </div>
                        </div>

                        {{-- Condições Eliminatórias --}}
                        <div class="col-12 col-md-6 mt-5"> {{-- Adicionado mt-5 para separar verticalmente --}}
                            <div class="d-flex flex-column h-100">
                                <div class="d-flex align-items-center mb-3">
                                    <i class="bi bi-exclamation-triangle fs-2 me-3 text-danger"></i>
                                    <h4 class="fw-semibold mb-0">Condições Eliminatórias</h4>
                                </div>
                                <ul class="list-unstyled mb-0 ms-5">
                                    <li><i class="bi bi-x-circle me-2 text-muted"></i> Não atingir a pontuação mínima de 70%</li>
                                    <li><i class="bi bi-shield-exclamation me-2 text-muted"></i> Fraude ou cópia</li>
                                </ul>
                            </div>
                        </div>

                        {{-- Dicas para Passar na Prova --}}
                        <div class="col-12 col-md-6 mt-5"> {{-- Adicionado mt-5 para separar verticalmente --}}
                            <div class="d-flex flex-column h-100">
                                <div class="d-flex align-items-center mb-3">
                                    <i class="bi bi-lightbulb fs-2 me-3 text-warning"></i>
                                    <h4 class="fw-semibold mb-0">Dicas para Passar na Prova</h4>
                                </div>
                                <ul class="list-unstyled mb-0 ms-5">
                                    <li><i class="bi bi-journal-text me-2 text-muted"></i> Estudar o material didático</li>
                                    <li><i class="bi bi-pencil-square me-2 text-muted"></i> Fazer simulados</li>
                                    <li><i class="bi bi-check-circle me-2 text-muted"></i> Ler as questões com atenção</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Coluna para a ÚNICA Imagem (ocupará 4 das 12 colunas em telas médias/grandes) --}}
                <div class="col-12 col-lg-4 d-flex align-items-center justify-content-center">
                    <img src="{{ asset('images/detran-exam-illustration.png') }}" alt="Ilustração da prova do Detran" class="img-fluid" style="max-height: 500px; object-fit: contain;">
                </div>
            </div>
        </div>
    </main>
@endsection

@push('styles')
    <style>
        body {
            background-color: #f8f9fa;
        }
        @media (max-width: 991.98px) {
            .col-lg-4.d-flex {
                margin-top: 3rem;
            }
        }
    </style>
@endpush
