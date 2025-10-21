@extends('base')


@push('styles')
    <style>
        .danger-zone {
            background-color: #fce4e4; /* Vermelho muito claro */
            border-left: 5px solid #d32f2f; /* Vermelho escuro para destaque */
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 5px;
        }
        .check-list-pratica li {
            margin-bottom: 10px;
            border-bottom: 1px dashed #ccc;
            padding-bottom: 5px;
            list-style: none; /* Remove marcadores padrão */
        }
        .falta-eliminatoria {
            background-color: #d32f2f;
            color: white;
            font-weight: bold;
            padding: 5px 10px;
            border-radius: 3px;
        }
        .falta-grave {
            background-color: #fbc02d;
            color: #333;
            font-weight: bold;
            padding: 5px 10px;
            border-radius: 3px;
        }
        .falta-media {
            background-color: #64b5f6;
            color: #333;
            font-weight: bold;
            padding: 5px 10px;
            border-radius: 3px;
        }
        .falta-leve {
            background-color: #a5d6a7;
            color: #333;
            font-weight: bold;
            padding: 5px 10px;
            border-radius: 3px;
        }
    </style>
@endpush

@section('content')

    <div class="text-center mb-5">
        <h1 class="display-4 text-dark">Prova Prática: O Guia de Sobrevivência</h1>
        <p class="lead text-muted">Aprenda a pontuação das faltas para não ser reprovado por pequenos deslizes.</p>
    </div>
    <div class="p-3">

    {{-- ZONA DE REPROVAÇÃO IMEDIATA --}}
    <div class="danger-zone">
        <h2 class="text-danger mb-3">ZONA DE REPROVAÇÃO AUTOMÁTICA (Faltas Eliminatórias)</h2>
        <p class="fw-bold">Cometer qualquer um destes erros resulta em reprovação imediata, independentemente da sua pontuação.</p>

        <ul class="check-list-pratica ps-0">
            <li><span class="falta-eliminatoria">ELIMINATÓRIA</span> Desobedecer à sinalização (Sinal Vermelho, Placa de Pare).</li>
            <li><span class="falta-eliminatoria">ELIMINATÓRIA</span> Avançar sobre o meio-fio (ou calçada), comum na baliza ou curvas.</li>
            <li><span class="falta-eliminatoria">ELIMINATÓRIA</span> Não estacionar na baliza em até 3 tentativas ou tempo limite (geralmente 5 minutos).</li>
            <li><span class="falta-eliminatoria">ELIMINATÓRIA</span> Tocar ou avançar sobre o balizamento demarcado (cones/hastes).</li>
            <li><span class="falta-eliminatoria">ELIMINATÓRIA</span> Transitar em contramão ou avançar a via preferencial.</li>
            <li><span class="falta-eliminatoria">ELIMINATÓRIA</span> Provocar acidente ou dirigir ameaçando pedestres/outros veículos.</li>
        </ul>
    </div>

    {{-- PONTUAÇÃO E DETALHES --}}
    <h2 class="text-secondary mb-3 mt-5">Pontos de Atenção (3 Pontos Máximo)</h2>
    <div class="alert alert-info text-center">
        Você será reprovado se cometer uma falta eliminatória OU se a soma das suas faltas ultrapassar 3 pontos.
    </div>

    <div class="row row-cols-1 row-cols-md-3 g-4">

        {{-- FALTAS GRAVES (3 PONTOS) --}}
        <div class="col">
            <div class="card h-100 border-warning shadow-sm">
                <div class="card-body">
                    <h5 class="card-title"><span class="falta-grave">FALTA GRAVE</span> - 3 Pontos</h5>
                    <p class="card-text text-muted">Um erro de 3 pontos reprova automaticamente se for a primeira falta.</p>
                    <ul class="check-list-pratica ps-0">
                        <li><i class="bi bi-x-octagon-fill text-warning me-2"></i> Esquecer o Cinto de Segurança.</li>
                        <li><i class="bi bi-x-octagon-fill text-warning me-2"></i> Não Sinalizar a manobra (seta) ou sinalizar incorretamente/tarde demais.</li>
                        <li><i class="bi bi-x-octagon-fill text-warning me-2"></i> Perder o controle da direção (direção brusca/errática).</li>
                        <li><i class="bi bi-x-octagon-fill text-warning me-2"></i> Desobedecer a sinalização da via (ex: exceder velocidade levemente).</li>
                    </ul>
                </div>
            </div>
        </div>

        {{-- FALTAS MÉDIAS (2 PONTOS) --}}
        <div class="col">
            <div class="card h-100 border-primary shadow-sm">
                <div class="card-body">
                    <h5 class="card-title"><span class="falta-media">FALTA MÉDIA</span> - 2 Pontos</h5>
                    <p class="card-text text-muted">Dois erros médios (4 pontos) já levam à reprovação.</p>
                    <ul class="check-list-pratica ps-0">
                        <li><i class="bi bi-dash-circle-fill text-primary me-2"></i> Deixar o motor "morrer" (interromper o funcionamento) sem justa razão.</li>
                        <li><i class="bi bi-dash-circle-fill text-primary me-2"></i> Fazer conversão incorretamente (abrir demais ou fechar demais a curva).</li>
                        <li><i class="bi bi-dash-circle-fill text-primary me-2"></i> Usar o pedal da embreagem antes de usar o freio nas frenagens.</li>
                        <li><i class="bi bi-dash-circle-fill text-primary me-2"></i> Colocar o veículo em movimento sem observar as cautelas necessárias.</li>
                    </ul>
                </div>
            </div>
        </div>

        {{-- FALTAS LEVES (1 PONTO) --}}
        <div class="col">
            <div class="card h-100 border-success shadow-sm">
                <div class="card-body">
                    <h5 class="card-title"><span class="falta-leve">FALTA LEVE</span> - 1 Ponto</h5>
                    <p class="card-text text-muted">Quatro erros leves (4 pontos) levam à reprovação.</p>
                    <ul class="check-list-pratica ps-0">
                        <li><i class="bi bi-check-circle-fill text-success me-2"></i> Não ajustar devidamente os retrovisores (antes de iniciar).</li>
                        <li><i class="bi bi-check-circle-fill text-success me-2"></i> Ajustar incorretamente o banco.</li>
                        <li><i class="bi bi-check-circle-fill text-success me-2"></i> Provocar movimentos irregulares (pequenos trancos).</li>
                        <li><i class="bi bi-check-circle-fill text-success me-2"></i> Apoiar o pé na embreagem com o veículo em movimento.</li>
                    </ul>
                </div>
            </div>
        </div>

    </div>

    <div class="alert alert-success text-center mt-5" role="alert">
        <h4 class="alert-heading">Controle Emocional é Prática</h4>
        <p class="mb-0">A maioria dos erros leves e médios acontece por nervosismo. O segredo é automatizar os ajustes iniciais e as setas, e praticar o controle de embreagem até que se torne um movimento natural.</p>
    </div>
    </div>
@endsection
