@extends('base')

@section('title', 'Game de Simulação da Prova Prática')

@push('styles')
    <style>
        /* Estilos Gerais do Game */
        .game-container {
            padding: 40px; /* Mais padding para respiro */
            background-color: #ffffff; /* Fundo branco limpo */
            border-radius: 12px; /* Bordas mais suaves */
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1); /* Sombra mais pronunciada */
        }
        .game-section {
            border-bottom: 1px dashed #e0e0e0; /* Linha divisória mais sutil */
            padding-bottom: 30px;
            margin-bottom: 40px;
            text-align: center; /* Centralizar conteúdo da seção */
        }
        .game-section:last-of-type { /* Remove a borda da última seção */
            border-bottom: none;
            margin-bottom: 0;
            padding-bottom: 0;
        }
        .section-title {
            color: #2c3e50; /* Azul escuro para títulos */
            font-weight: 700; /* Mais negrito */
            margin-bottom: 25px;
            display: flex; /* Para alinhar ícone e texto */
            align-items: center;
            justify-content: center; /* Centraliza o título */
        }
        .section-title i {
            font-size: 1.5em; /* Ícones maiores */
            margin-right: 10px;
            color: #3498db; /* Cor de destaque para ícones */
        }
        .feedback-message {
            font-size: 1.1em;
            margin-bottom: 20px;
            font-weight: 500;
        }
        /* Estilo dos botões */
        .game-button {
            padding: 12px 25px;
            font-size: 1.05em;
            border-radius: 8px; /* Botões mais arredondados */
            min-width: 180px; /* Largura mínima para botões */
            margin: 5px; /* Pequena margem entre botões */
            transition: all 0.2s ease-in-out; /* Suavizar transições */
        }
        .game-button i {
            margin-right: 8px;
        }
        .btn-action { /* Botões secundários da fase 1 e baliza */
            background-color: #b0c4de; /* Azul acinzentado suave */
            color: #333;
            border-color: #a0b8d0;
        }
        .btn-action:hover:not(:disabled) {
            background-color: #9ab0c8;
            border-color: #8c9eb5;
            color: #fff;
        }
        .btn-success-active { /* Botão clicado com sucesso */
            background-color: #28a745 !important;
            border-color: #28a745 !important;
            color: #fff !important;
        }
        .btn-primary-start { /* Botão "Dar Partida" */
            background-color: #3498db;
            border-color: #3498db;
            color: #fff;
            font-weight: bold;
        }
        .btn-primary-start:hover:not(:disabled) {
            background-color: #217dbb;
            border-color: #217dbb;
        }
        .btn-info-active { /* Botão da etapa atual na baliza */
            background-color: #17a2b8 !important;
            border-color: #17a2b8 !important;
            color: #fff !important;
        }

        /* Estilo para a barra de nervosismo */
        .progress-bar-warning { /* Renomeado para evitar conflito com bg-warning padrão */
            background-color: #ffc107; /* Amarelo */
            color: #343a40; /* Texto escuro */
        }
        .progress-bar-danger {
            background-color: #dc3545 !important; /* Vermelho */
        }
        /* Estilo do minigame de embreagem */
        .embreagem-box {
            background-color: #e9ecef; /* Fundo cinza para a área da embreagem */
            border-radius: 5px;
            height: 35px; /* Um pouco mais alto */
            width: 90%; /* Mais largo */
            margin: 0 auto 20px auto;
            position: relative;
        }
        .embreagem-target-zone {
            background-color: #28a745; /* Zona verde (Sucesso) */
            position: absolute;
            left: 35%; /* Posição da zona verde */
            width: 30%; /* Largura da zona verde */
            height: 100%;
            border-radius: 3px;
        }
        #indicadorEmbreagem {
            background-color: #e53935; /* Vermelho inicial */
            position: absolute;
            left: 50%; /* Posição inicial do indicador */
            width: 12px; /* Indicador um pouco mais visível */
            height: 100%;
            cursor: pointer;
            border-radius: 2px;
            transition: background-color 0.2s ease-in-out, left 0.1s ease-in-out; /* Transição suave */
        }
        /* Feedback de status */
        .alert-game-success {
            background-color: #d4edda;
            color: #155724;
            border-color: #c3e6cb;
        }
        .alert-game-danger {
            background-color: #f8d7da;
            color: #721c24;
            border-color: #f5c6cb;
        }


        @keyframes shake-intensity {
            0% { transform: translate(0, 0) rotate(0deg); }
            10% { transform: translate(var(--x), var(--y)) rotate(var(--r)); }
            20% { transform: translate(calc(var(--x) * -1), calc(var(--y) * -1)) rotate(calc(var(--r) * -1)); }
            30% { transform: translate(var(--x), calc(var(--y)/2)) rotate(var(--r)); }
        }

        #container {
            animation: shake-intensity 0.3s infinite;
            transform: translate3d(0,0,0);
            backface-visibility: hidden;
            perspective: 1000px;
        }

    </style>
@endpush

@section('content')

    <div class="container mt-4" id="container">
        <div class="game-container">
            <h1 class="text-center text-primary mb-3">Simulador de Prova Prática do DETRAN</h1>
            <p class="lead text-center text-secondary mb-5">Teste sua atenção e controle nas três áreas mais críticas do exame.</p>

            <div id="game-status" class="alert alert-game-success text-center fw-bold d-none">
            </div>

            <div id="game-fail" class="alert alert-game-danger text-center fw-bold d-none">
            </div>

            {{-- ========================================================================= --}}
            {{-- FASE 1: CHECK-LIST DE INÍCIO (PROTOCOLOS) --}}
            {{-- ========================================================================= --}}
            <div id="fase1" class="game-section">
                <h3 class="section-title"><i class="bi bi-person-check"></i> Fase 1: Check-list de Início</h3>
                <p id="feedbackCheckList" class="feedback-message text-info">Prepare o carro para iniciar a jornada. Não pule etapas!</p>

                <button id="btnBanco" class="btn game-button btn-action me-2" data-checked="0"><i class="bi bi-chair"></i> Ajustar Banco</button>
                <button id="btnRetrovisores" class="btn game-button btn-action me-2" data-checked="0"><i class="bi bi-mirror"></i> Ajustar Retrovisores</button>
                <button id="btnCinto" class="btn game-button btn-action me-2" data-checked="0"><i class="bi bi-person-bounding-box"></i> Colocar Cinto <span class="badge bg-danger ms-2">GRAVE!</span></button>

                <button id="btnPartida" class="btn game-button btn-primary-start" disabled><i class="bi bi-key"></i> Dar Partida e Sair</button>
            </div>

            {{-- ========================================================================= --}}
            {{-- FASE 2: SIMULADOR DE BALIZA (SEQUÊNCIA E NERVOSISMO) --}}
            {{-- ========================================================================= --}}
            <div id="fase2" class="game-section d-none">
                <h3 class="section-title"><i class="bi bi-bezier2"></i> Fase 2: Baliza Perfeita</h3>
                <p class="progress-title">Nervosismo Acumulado:</p>
                <div class="progress mb-3" style="height: 28px; border-radius: 5px;">
                    <div id="barraNervosismo" class="progress-bar progress-bar-warning" style="width: 0%; color: #343a40;" role="progressbar">Nervosismo: 0%</div>
                </div>
                <p id="feedbackBaliza" class="feedback-message alert alert-info">Siga a sequência para estacionar sem erros e sem nervosismo.</p>

                <div id="botoesBaliza">
                    <button id="btnSeta" class="btn game-button btn-action me-2" data-step="1"><i class="bi bi-arrow-left-right"></i> 1. Ligar Seta</button>
                    <button id="btnRe" class="btn game-button btn-action me-2" data-step="2" disabled><i class="bi bi-arrow-counterclockwise"></i> 2. Engatar Ré</button>
                    <button id="btnVolante" class="btn game-button btn-action me-2" data-step="3" disabled><i class="bi bi-arrow-repeat"></i> 3. Virar Volante</button>
                    <button id="btnAjuste" class="btn game-button btn-action me-2" data-step="4" disabled><i class="bi bi-sliders"></i> 4. Ajustar</button>
                    <button id="btnFinalizarBaliza" class="btn game-button btn-primary-start mt-3" data-step="5" disabled><i class="bi bi-check-circle"></i> 5. Finalizar Baliza</button>
                </div>
            </div>

            {{-- ========================================================================= --}}
            {{-- FASE 3: CONTROLE DE EMBREAGEM (MINIGAME DE TIMING) --}}
            {{-- ========================================================================= --}}
            <div id="fase3" class="game-section d-none">
                <h3 class="section-title"><i class="bi bi-gear"></i> Fase 3: Controle de Embreagem (Rampa)</h3>
                <p class="mb-3 text-secondary">Mantenha o indicador na zona verde para dominar a rampa sem o motor "morrer".</p>

                <div class="embreagem-box">
                    <div class="embreagem-target-zone"></div>
                    <div id="indicadorEmbreagem"></div>
                </div>

                <p id="feedbackEmbreagem" class="feedback-message alert alert-info mt-3">Clique e segure o indicador para manter a embreagem no ponto certo.</p>
            </div>

        </div>
    </div>

    @push('scripts')
        <script>
            // Variáveis globais de controle
            let itensChecados = 0;
            let nervosismo = 0;
            let passoBalizaAtual = 1;
            let timerNervosismo;
            let tempoNoPonto = 0;
            let intervaloCheck;
            const MAX_NERVOSISMO = 100;
            const INCREMENTO_NERVOSISMO = 7;
            const TEMPO_INCREMENTO_MS = 2000; // 2 segundos para penalidade
            const TEMPO_EMBREAGEM_MS = 3000; // 3 segundos para sucesso

            // --- FUNÇÕES DE CONTROLE DE JOGO ---
            function setGameStatus(message, isSuccess) {
                const statusBox = isSuccess ? document.getElementById('game-status') : document.getElementById('game-fail');
                const otherBox = isSuccess ? document.getElementById('game-fail') : document.getElementById('game-status');

                otherBox.classList.add('d-none');
                statusBox.textContent = message;
                statusBox.classList.remove('d-none');
                statusBox.classList.remove(isSuccess ? 'alert-game-danger' : 'alert-game-success');
                statusBox.classList.add(isSuccess ? 'alert-game-success' : 'alert-game-danger');
            }

            function reiniciarGame() {
                // Limpa timers
                clearInterval(timerNervosismo);
                clearInterval(intervaloCheck);

                // Reset Baliza
                nervosismo = 0;
                passoBalizaAtual = 1;
                document.getElementById('barraNervosismo').style.width = '0%';
                document.getElementById('barraNervosismo').textContent = 'Nervosismo: 0%';
                document.getElementById('barraNervosismo').classList.remove('progress-bar-danger');
                document.getElementById('barraNervosismo').classList.add('progress-bar-warning');
                document.getElementById('feedbackBaliza').textContent = 'Inicie a baliza seguindo os passos.';
                document.getElementById('feedbackBaliza').classList.remove('alert-danger','alert-success');
                document.getElementById('feedbackBaliza').classList.add('alert-info');
                document.querySelectorAll('#botoesBaliza button').forEach(btn => {
                    btn.disabled = btn.id !== 'btnSeta';
                    btn.classList.remove('btn-success-active', 'btn-info-active', 'btn-primary-start');
                    btn.classList.add('btn-action');
                    if(btn.id === 'btnFinalizarBaliza') btn.classList.add('btn-primary-start');
                    if(btn.id === 'btnSeta') btn.classList.remove('btn-action'); // Seta começa ativa
                });

                // Reset Embreagem
                tempoNoPonto = 0;
                document.getElementById('indicadorEmbreagem').style.backgroundColor = '#e53935';
                document.getElementById('feedbackEmbreagem').textContent = 'Clique e segure o indicador para manter a embreagem no ponto certo.';
                document.getElementById('feedbackEmbreagem').classList.remove('alert-danger','alert-success');
                document.getElementById('feedbackEmbreagem').classList.add('alert-info');

                // Reset Check-list (Visível)
                document.getElementById('fase1').classList.remove('d-none');
                document.getElementById('fase2').classList.add('d-none');
                document.getElementById('fase3').classList.add('d-none');
                document.getElementById('game-status').classList.add('d-none');
                document.getElementById('game-fail').classList.add('d-none');

                // Reset Check-list Lógica
                itensChecados = 0;
                document.querySelectorAll('#fase1 button:not(#btnPartida)').forEach(btn => {
                    btn.setAttribute('data-checked', '0');
                    btn.classList.remove('btn-success-active');
                    btn.classList.add('btn-action');
                });
                document.getElementById('btnPartida').disabled = true;
                document.getElementById('feedbackCheckList').classList.remove('text-success', 'text-danger');
                document.getElementById('feedbackCheckList').classList.add('text-info');
                document.getElementById('feedbackCheckList').textContent = 'Prepare o carro para iniciar a jornada. Não pule etapas!';
            }


            function avancarFase(faseAtual) {
                document.getElementById(`fase${faseAtual}`).classList.add('d-none');
                const proximaFase = faseAtual + 1;
                const nextElement = document.getElementById(`fase${proximaFase}`);

                if (nextElement) {
                    nextElement.classList.remove('d-none');
                    document.getElementById('game-status').classList.add('d-none');
                    // Inicia a lógica da nova fase
                    if (proximaFase === 2) {
                        iniciarFaseBaliza();
                    } else if (proximaFase === 3) {
                        // Não há função iniciarFaseEmbreagem, o evento é no clique do indicador
                    }
                } else {
                    setGameStatus('PARABÉNS! Você concluiu todas as etapas da simulação com sucesso!', true);
                }
            }

            function atualizarTremer() {
                const body = document.getElementById('container');
                if (!body) return; // garante que o body existe

                const maxDeslocamento = 10; // pixels máximo de tremor
                const maxRotacao = 5; // graus máximo de rotação
                const intensidade = nervosismo / 100; // 0 a 1

                if(intensidade > 0) {
                    body.classList.add('shaking');
                    body.style.setProperty('--x', `${maxDeslocamento * intensidade}px`);
                    body.style.setProperty('--y', `${maxDeslocamento * intensidade}px`);
                    body.style.setProperty('--r', `${maxRotacao * intensidade}deg`);
                } else {
                    body.classList.remove('shaking');
                }
            }




            // =========================================================================
            // LÓGICA DA FASE 1: CHECK-LIST
            // =========================================================================
            document.addEventListener('DOMContentLoaded', function() {
                const btnsCheck = document.querySelectorAll('#fase1 button:not(#btnPartida)');
                const btnPartida = document.getElementById('btnPartida');
                const feedbackCheckList = document.getElementById('feedbackCheckList');

                btnsCheck.forEach(btn => {
                    btn.addEventListener('click', function() {
                        if (btn.getAttribute('data-checked') === '0') {
                            btn.setAttribute('data-checked', '1');
                            btn.classList.remove('btn-action');
                            btn.classList.add('btn-success-active');
                            itensChecados++;
                        }

                        if (itensChecados === 3) {
                            btnPartida.disabled = false;
                            feedbackCheckList.classList.remove('text-info');
                            feedbackCheckList.classList.add('text-success');
                            feedbackCheckList.textContent = 'Protocolo OK! Clique em "Dar Partida e Sair".';
                        }
                    });
                });

                btnPartida.addEventListener('click', function() {
                    if (itensChecados < 3) {
                        feedbackCheckList.classList.remove('text-success', 'text-info');
                        feedbackCheckList.classList.add('text-danger');
                        feedbackCheckList.textContent = 'REPROVADO! FALTAS GRAVES: Você esqueceu o Cinto de Segurança. Tente novamente.';
                        setGameStatus('Reprovado na Fase 1 por falta Grave!', false);
                        setTimeout(reiniciarGame, 3000);
                    } else {
                        setGameStatus('Fase 1 Concluída. Boa sorte na Baliza!', true);
                        setTimeout(() => avancarFase(1), 1500);
                    }
                });
            });

            // =========================================================================
            // LÓGICA DA FASE 2: BALIZA
            // =========================================================================
            function atualizarNervosismo() {
                nervosismo += INCREMENTO_NERVOSISMO;
                const barra = document.getElementById('barraNervosismo');

                if (nervosismo >= MAX_NERVOSISMO) {
                    clearInterval(timerNervosismo);
                    document.getElementById('feedbackBaliza').textContent = 'REPROVADO! Nervosismo esgotado, você encostou no balizamento (Eliminatória).';
                    setGameStatus('Reprovado na Fase 2 por falta Eliminatória!', false);
                    barra.style.width = '100%';
                    barra.classList.remove('progress-bar-warning');
                    barra.classList.add('progress-bar-danger');
                    document.body.classList.remove('shaking');
                    setTimeout(reiniciarGame, 3000);
                    return;
                }

                barra.style.width = nervosismo + '%';
                barra.textContent = 'Nervosismo: ' + nervosismo.toFixed(0) + '%';
                if (nervosismo > 70) {
                    barra.classList.remove('progress-bar-warning');
                    barra.classList.add('progress-bar-danger');
                }
                atualizarTremer();
            }

            function iniciarFaseBaliza() {
                nervosismo = 0;
                document.getElementById('barraNervosismo').classList.remove('progress-bar-danger');
                document.getElementById('barraNervosismo').classList.add('progress-bar-warning');

                if (timerNervosismo) clearInterval(timerNervosismo);
                timerNervosismo = setInterval(atualizarNervosismo, TEMPO_INCREMENTO_MS);

                document.querySelectorAll('#botoesBaliza button').forEach(btn => {
                    btn.onclick = null; // Remove handlers antigos
                    if (btn.id === 'btnSeta') {
                        btn.classList.remove('btn-action');
                        btn.classList.add('btn-info-active'); // Cor de destaque para o botão atual
                    }
                    btn.addEventListener('click', function() {
                        const passoDoBotao = parseInt(btn.getAttribute('data-step'));

                        if (passoDoBotao === passoBalizaAtual) {
                            clearInterval(timerNervosismo);

                            document.getElementById('feedbackBaliza').textContent = `Passo ${passoBalizaAtual} OK! Próximo passo.`;
                            document.getElementById('feedbackBaliza').classList.remove('alert-info', 'alert-danger');
                            document.getElementById('feedbackBaliza').classList.add('alert-success');

                            btn.disabled = true;
                            btn.classList.remove('btn-info-active', 'btn-action');
                            btn.classList.add('btn-success-active');

                            passoBalizaAtual++;

                            if (passoBalizaAtual <= 5) {
                                const proximoBotao = document.querySelector(`#botoesBaliza button[data-step="${passoBalizaAtual}"]`);
                                proximoBotao.disabled = false;
                                proximoBotao.classList.remove('btn-action');
                                proximoBotao.classList.add('btn-info-active');

                                timerNervosismo = setInterval(atualizarNervosismo, TEMPO_INCREMENTO_MS);
                            } else {
                                document.getElementById('feedbackBaliza').textContent = 'Baliza Completa! Sucesso!';
                                setGameStatus('Fase 2 Concluída. Próxima: Controle de Rampa!', true);
                                setTimeout(() => avancarFase(2), 1500);
                            }

                        } else if (passoDoBotao < passoBalizaAtual) {
                            // Botão já clicado, não faz nada
                        } else {
                            nervosismo += 15;
                            document.getElementById('feedbackBaliza').textContent = 'Ordem Incorreta! Penalidade de Nervosismo!';
                            document.getElementById('feedbackBaliza').classList.remove('alert-info', 'alert-success');
                            document.getElementById('feedbackBaliza').classList.add('alert-danger');
                            clearInterval(timerNervosismo);
                            timerNervosismo = setInterval(atualizarNervosismo, TEMPO_INCREMENTO_MS);
                            atualizarNervosismo();
                        }
                    });
                });
            }

            // =========================================================================
            // LÓGICA DA FASE 3: EMBREAGEM
            // =========================================================================
            const indicadorEmbreagem = document.getElementById('indicadorEmbreagem');
            const feedbackEmbreagem = document.getElementById('feedbackEmbreagem');

            // Funções de Touch/Mouse
            indicadorEmbreagem.addEventListener('mousedown', iniciarControleEmbreagem);
            document.addEventListener('mouseup', pararControleEmbreagem);
            indicadorEmbreagem.addEventListener('touchstart', iniciarControleEmbreagem);
            document.addEventListener('touchend', pararControleEmbreagem);

            function iniciarControleEmbreagem(e) {
                e.preventDefault();

                if (intervaloCheck) return;

                indicadorEmbreagem.style.backgroundColor = '#3498db'; // Azul: em ação

                // Simula o indicador na zona verde (clicou = tá no ponto)
                indicadorEmbreagem.style.left = '45%';

                intervaloCheck = setInterval(() => {
                    tempoNoPonto += 100;
                    feedbackEmbreagem.textContent = `Mantendo Ponto... (${(tempoNoPonto / 1000).toFixed(1)}s)`;
                    feedbackEmbreagem.classList.remove('alert-info', 'alert-danger');
                    feedbackEmbreagem.classList.add('alert-success');

                    if (tempoNoPonto >= TEMPO_EMBREAGEM_MS) {
                        clearInterval(intervaloCheck);
                        intervaloCheck = null;
                        feedbackEmbreagem.textContent = 'Ponto de Embreagem Atingido! Sucesso na Rampa!';
                        indicadorEmbreagem.style.backgroundColor = '#28a745'; // Verde de sucesso

                        setGameStatus('Fase 3 Concluída. Você é um mestre da embreagem!', true);
                        setTimeout(() => avancarFase(3), 1500);
                    }
                }, 100);
            }

            function pararControleEmbreagem() {
                if (intervaloCheck) {
                    clearInterval(intervaloCheck);
                    intervaloCheck = null;
                    indicadorEmbreagem.style.backgroundColor = '#e53935'; // Vermelho de falha

                    if (tempoNoPonto < TEMPO_EMBREAGEM_MS) {
                        feedbackEmbreagem.textContent = `REPROVADO! O motor morreu (Falta Média: 2 pontos). Tente novamente.`;
                        feedbackEmbreagem.classList.remove('alert-info', 'alert-success');
                        feedbackEmbreagem.classList.add('alert-danger');
                        setGameStatus('Reprovado na Fase 3 por falta Média!', false);
                        setTimeout(reiniciarGame, 3000);
                    }
                }
            }

        </script>
    @endpush

@endsection
