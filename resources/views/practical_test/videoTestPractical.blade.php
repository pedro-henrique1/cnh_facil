@extends('base')

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
            transition: all 0.3s;
            cursor: pointer;
        }
        .video-card-thumb:hover {
            background-color: #fce5d4;
            transform: translateX(5px);
        }
        .video-card-thumb.active {
            background-color: #ffd4b3;
            border-left-color: #1e90ff;
            border-left-width: 8px;
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
                <h3 class="text-danger mb-3" id="mainVideoTitle">Vídeo Destaque: As Faltas ELIMINATÓRIAS</h3>
                <div class="ratio ratio-16x9 mb-3">
                    <iframe
                        id="mainVideoFrame"
                        src="https://www.youtube.com/embed/HA7E7s9W95w"
                        title="YouTube video player"
                        frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                        allowfullscreen>
                    </iframe>
                </div>
                <p class="mb-0" id="mainVideoDescription">Este vídeo detalha os erros que causam reprovação imediata: subir meio-fio, avançar o balizamento e desobedecer ao "Pare".</p>
                <a href="https://www.youtube.com/watch?v=HA7E7s9W95w" id="mainVideoLink" target="_blank" class="video-link mt-2 d-block">
                    <i class="bi bi-box-arrow-up-right me-1"></i> Ver no YouTube
                </a>
            </div>
        </div>

        <div class="col-12 col-lg-5">
            <h4 class="text-secondary mb-3">Galeria Essencial</h4>

            {{-- Vídeo Destaque --}}
            <div class="video-card-thumb active"
                 data-video-id="HA7E7s9W95w"
                 data-title="Vídeo Destaque: As Faltas ELIMINATÓRIAS"
                 data-description="Este vídeo detalha os erros que causam reprovação imediata: subir meio-fio, avançar o balizamento e desobedecer ao 'Pare'.">
                <h6 class="mb-1 text-dark">Faltas ELIMINATÓRIAS</h6>
                <small class="text-muted d-block">Erros que causam reprovação imediata.</small>
                <span class="video-link">
                    <i class="bi bi-play-circle-fill me-1"></i> Assistir Agora
                </span>
            </div>

            <div class="video-card-thumb"
                 data-video-id="yH75Gf1w7Ho"
                 data-title="1. Baliza: Pontos de Referência"
                 data-description="Controle o tempo e use as marchas corretas. Aprenda os pontos exatos para executar a baliza perfeita.">
                <h6 class="mb-1 text-dark">1. Baliza: Pontos de Referência</h6>
                <small class="text-muted d-block">Controle o tempo e use as marchas corretas.</small>
                <span class="video-link">
                    <i class="bi bi-play-circle-fill me-1"></i> Assistir Treinamento
                </span>
            </div>

            <div class="video-card-thumb"
                 data-video-id="NtQ9Gl9BH6c"
                 data-title="2. Controle em Aclives (Rampa)"
                 data-description="Técnicas para usar o freio de mão sem deixar o motor morrer (falta média). Domine o controle de embreagem.">
                <h6 class="mb-1 text-dark">2. Controle em Aclives (Rampa)</h6>
                <small class="text-muted d-block">Técnicas para usar o freio de mão sem deixar o motor morrer (falta média).</small>
                <span class="video-link">
                    <i class="bi bi-play-circle-fill me-1"></i> Assistir Aula Prática
                </span>
            </div>

            <div class="video-card-thumb"
                 data-video-id="g_ZkRWFkxDc"
                 data-title="3. Simulado de Percurso Completo"
                 data-description="Onde e quando usar a seta (falta grave) e a importância da observação. Veja um percurso real completo.">
                <h6 class="mb-1 text-dark">3. Simulado de Percurso Completo</h6>
                <small class="text-muted d-block">Onde e quando usar a seta (falta grave) e a importância da observação.</small>
                <span class="video-link">
                    <i class="bi bi-play-circle-fill me-1"></i> Assistir Simulação
                </span>
            </div>

            <div class="video-card-thumb"
                 data-video-id="XL00F_HEsWc"
                 data-title="4. Protocolo de Início e Fim"
                 data-description="Evite as faltas leves: cinto, ajustes e procedimento de desligamento. Detalhes que fazem a diferença.">
                <h6 class="mb-1 text-dark">4. Protocolo de Início e Fim</h6>
                <small class="text-muted d-block">Evite as faltas leves: cinto, ajustes e procedimento de desligamento.</small>
                <span class="video-link">
                    <i class="bi bi-play-circle-fill me-1"></i> Assistir Detalhes
                </span>
            </div>

        </div>
    </div>

@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const videoCards = document.querySelectorAll('.video-card-thumb');
            const mainVideoFrame = document.getElementById('mainVideoFrame');
            const mainVideoTitle = document.getElementById('mainVideoTitle');
            const mainVideoDescription = document.getElementById('mainVideoDescription');
            const mainVideoLink = document.getElementById('mainVideoLink');

            videoCards.forEach(card => {
                card.addEventListener('click', function() {
                    videoCards.forEach(c => c.classList.remove('active'));

                    this.classList.add('active');

                    const videoId = this.dataset.videoId;
                    const title = this.dataset.title;
                    const description = this.dataset.description;

                    mainVideoFrame.src = `https://www.youtube.com/embed/${videoId}`;
                    mainVideoTitle.textContent = title;
                    mainVideoDescription.textContent = description;
                    mainVideoLink.href = `https://www.youtube.com/watch?v=${videoId}`;

                    if (window.innerWidth < 992) {
                        document.querySelector('.main-video-box').scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                });
            });
        });
    </script>
@endpush
