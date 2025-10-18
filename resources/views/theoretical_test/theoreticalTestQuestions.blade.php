@extends('base')

{{-- Define o título da página --}}
@section('title', 'Dicas Essenciais para o Teste Teórico CNH')

@section('content')

    {{-- A classe 'p-3' ou 'px-3' adiciona o padding horizontal ao conteúdo, forçando o espaçamento --}}
    <div class="p-3">

        <div class="card shadow-sm mb-4">
            <div class="card-body bg-light">
                <h1 class="card-title text-center text-primary mb-0">
                    <i class="bi bi-patch-check-fill me-2"></i> Dicas Essenciais para o Teste Teórico da CNH
                </h1>
                <p class="card-text text-center text-muted">Aprenda a evitar os erros que mais reprovam e garanta sua aprovação.</p>
            </div>
        </div>

        <h2 class="mb-3 text-secondary">Principais Erros e Como Evitá-los:</h2>

        <div class="row row-cols-1 row-cols-md-2 g-4">

            {{-- DICA 1: PREFERÊNCIA E PRIORIDADE --}}
            <div class="col">
                <div class="card h-100 border-danger shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title text-danger"><i class="bi bi-sign-stop-fill me-2"></i> Erro Crítico: Preferência em Cruzamentos</h5>
                        <p class="card-text">
                            <strong>O que erram:</strong> Confundir as regras de quem deve passar primeiro em cruzamentos não sinalizados.
                        </p>
                        <hr>
                        <p class="fw-bold">
                            <i class="bi bi-lightbulb-fill me-1"></i> Dica de Ouro (CTB):
                        </p>
                        <p class="alert alert-danger p-2">
                            Memorize as 3 regras: A preferência é de quem estiver em Rodovia, depois quem estiver na Rotatória, e por último, de quem vier pela Direita do condutor. A regra "quem chega primeiro" não é oficial para a prova!
                        </p>
                    </div>
                </div>
            </div>

            {{-- DICA 2: VELOCIDADE E NERVOSISMO --}}
            <div class="col">
                <div class="card h-100 border-warning shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title text-warning"><i class="bi bi-speedometer2 me-2"></i> Erro Comum: Limites de Velocidade Padrão</h5>
                        <p class="card-text">
                            <strong>O que erram:</strong> Não saber os limites padrão do CTB quando não há placa indicando.
                        </p>
                        <hr>
                        <p class="fw-bold">
                            <i class="bi bi-lightbulb-fill me-1"></i> Dica de Ouro (CTB):
                        </p>
                        <p class="alert alert-warning p-2">
                            Vias Urbanas: 30 km/h (Vias Locais), 40 km/h (Vias Coletoras), 60 km/h (Vias Arteriais) e 80 km/h (Vias de Trânsito Rápido). Rodovias de pista simples: 100/90 km/h (veículos leves/outros). Rodovias de pista dupla: 110/90 km/h (veículos leves/outros).
                        </p>
                    </div>
                </div>
            </div>

            {{-- DICA 3: DISTÂNCIA DE SEGURANÇA --}}
            <div class="col">
                <div class="card h-100 border-info shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title text-info"><i class="bi bi-car-front-fill me-2"></i> Erro Típico: Cálculo da Distância</h5>
                        <p class="card-text">
                            <strong>O que erram:</strong> Subestimar a distância ou usar métodos não reconhecidos no teste teórico.
                        </p>
                        <hr>
                        <p class="fw-bold">
                            <i class="bi bi-lightbulb-fill me-1"></i> Dica de Ouro (CTB):
                        </p>
                        <p class="alert alert-info p-2">
                            Use sempre a Regra dos Dois Segundos. Escolha um ponto fixo e comece a contar "51, 52" (dois segundos) quando o veículo à frente passar por ele. Você só deve passar por esse ponto após terminar a contagem.
                        </p>
                    </div>
                </div>
            </div>

            {{-- DICA 4: ÁLCOOL E DIREÇÃO --}}
            <div class="col">
                <div class="card h-100 border-success shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title text-success"><i class="bi bi-exclamation-triangle-fill me-2"></i> Erro de Conceito: Lei Seca</h5>
                        <p class="card-text">
                            <strong>O que erram:</strong> Confundir tolerância e as penalidades.
                        </p>
                        <hr>
                        <p class="fw-bold">
                            <i class="bi bi-lightbulb-fill me-1"></i> Dica de Ouro (CTB):
                        </p>
                        <p class="alert alert-success p-2">
                            A tolerância é ZERO para a prova teórica. Dirigir sob a influência de álcool é uma Infração Gravíssima (sujeita a multa e suspensão da CNH). Se houver crime de trânsito, a situação é mais grave ainda.
                        </p>
                    </div>
                </div>
            </div>

        </div>

        <div class="card mt-4 border-secondary">
            <div class="card-body">
                <h5 class="card-title text-secondary">Outros Pontos de Atenção</h5>
                <ul class="list-unstyled">
                    <li><i class="bi bi-chevron-right me-2"></i> Uso de Faróis: Lembre-se que o Farol Baixo é obrigatório de dia em rodovias de pista simples (salvo regulamentação) e à noite em qualquer via.</li>
                    <li><i class="bi bi-chevron-right me-2"></i> Sinalização Manual: Embora cobrada, a prioridade é sempre para as setas do veículo. Use o gesto apenas em caso de falha da luz.</li>
                    <li><i class="bi bi-chevron-right me-2"></i> Documentação: O Certificado de Registro e Licenciamento do Veículo (CRLV) e a CNH são os documentos de porte obrigatório.</li>
                </ul>
            </div>
        </div>

    </div> {{-- Fechamento da div com p-3 --}}

@endsection
