@extends('base')

@section('title', 'Vídeos Essenciais para a Prova Prática')

@push('styles')
    <style>
        .video-gallery-header {
            background-color: #f0f8ff;
            padding: 30px;
            border-radius: 10px;
            margin-bottom: 40px;
            text-align: center;
            border-bottom: 3px solid #1e90ff;
        }
        .main-video-box {
            background-color: #ffffff;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
        .video-card-thumb {
            border-left: 5px solid #ff4500;
            margin-bottom: 15px;
            padding: 10px;
            background-color: #fffaf0;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        .video-card-thumb:hover {
            background-color: #fce5d4;
        }
        .video-link {
            color: #1e90ff;
            font-weight: 500;
            text-decoration: none;
        }
        .video-link:hover {
            text-decoration: underline;
        }
    </style>
@endpush

@section('content')

    <div class="video-gallery-header">
        <h1 class="display-6 text-dark">Treinamento Visual: Prova Prática</h1>
        <p class="lead text-muted">Aprenda com quem já passou. Foco em Baliza, Rampa e Percurso de Rua.</p>
    </div>

    <div class="row g-4 p-5">

        <div class="col-12 col-lg-7">
            <div class="main-video-box">
                <h3 class="text-danger mb-3">Vídeo Destaque: As Faltas ELIMINATÓRIAS</h3>
                <div class="ratio ratio-16x9 mb-3">
                    <div class="bg-dark text-white d-flex align-items-center justify-content-center">
                        [BOX: EMBED DO VÍDEO PRINCIPAL AQUI]
                    </div>
                </div>
                <p class="mb-0">Este vídeo detalha os erros que causam reprovação imediata: subir meio-fio, avançar o balizamento e desobedecer ao "Pare".</p>
                <a href="[LINK_VIDEO_ELIMINATORIAS_YOUTUBE]" target="_blank" class="video-link mt-2 d-block">
                    <i class="bi bi-box-arrow-up-right me-1"></i> Ver no YouTube
                </a>
            </div>
        </div>

        {{-- COLUNA LATERAL - GALERIA DE VÍDEOS SECUNDÁRIOS --}}
        <div class="col-12 col-lg-5">
            <h4 class="text-secondary mb-3">Galeria Essencial</h4>

            {{-- Vídeo 1: Baliza Passo a Passo --}}
            <div class="video-card-thumb">
                <h6 class="mb-1 text-dark">1. Baliza: Pontos de Referência</h6>
                <small class="text-muted d-block">Controle o tempo e use as marchas corretas.</small>
                <a href="[LINK_VIDEO_BALIZA_YOUTUBE]" target="_blank" class="video-link">
                    <i class="bi bi-play-circle-fill me-1"></i> Assistir Treinamento
                </a>
            </div>

            {{-- Vídeo 2: Rampa/Controle de Embreagem --}}
            <div class="video-card-thumb">
                <h6 class="mb-1 text-dark">2. Controle em Aclives (Rampa)</h6>
                <small class="text-muted d-block">Técnicas para usar o freio de mão sem deixar o motor morrer (falta média).</small>
                <a href="[LINK_VIDEO_RAMPA_YOUTUBE]" target="_blank" class="video-link">
                    <i class="bi bi-play-circle-fill me-1"></i> Assistir Aula Prática
                </a>
            </div>

            {{-- Vídeo 3: Percurso de Rua --}}
            <div class="video-card-thumb">
                <h6 class="mb-1 text-dark">3. Simulado de Percurso Completo</h6>
                <small class="text-muted d-block">Onde e quando usar a seta (falta grave) e a importância da observação.</small>
                <a href="[LINK_VIDEO_PERCURSO_YOUTUBE]" target="_blank" class="video-link">
                    <i class="bi bi-play-circle-fill me-1"></i> Assistir Simulação
                </a>
            </div>

            {{-- Vídeo 4: Ajustes e Desembarque --}}
            <div class="video-card-thumb">
                <h6 class="mb-1 text-dark">4. Protocolo de Início e Fim</h6>
                <small class="text-muted d-block">Evite as faltas leves: cinto, ajustes e procedimento de desligamento.</small>
                <a href="[LINK_VIDEO_PROTOCOLO_YOUTUBE]" target="_blank" class="video-link">
                    <i class="bi bi-play-circle-fill me-1"></i> Assistir Detalhes
                </a>
            </div>

        </div>
    </div>

@endsection
