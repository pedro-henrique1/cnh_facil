@extends('base')

@section('title', 'Game de Simulação da Prova Prática — Versão Aprimorada')

@push('styles')
    <style>
        /* Estilos Gerais do Game */
        .game-container {
            padding: 28px;
            background: linear-gradient(180deg,#ffffff 0%, #f8fbff 100%);
            border-radius: 12px;
            box-shadow: 0 10px 35px rgba(15,23,42,0.08);
            max-width: 980px;
            margin: 0 auto;
        }

        .game-section {
            border-bottom: 1px dashed #e6eef9;
            padding-bottom: 28px;
            margin-bottom: 36px;
            text-align: center;
        }

        .section-title { color: #243b55; font-weight: 700; margin-bottom: 18px; display:flex; align-items:center; justify-content:center }
        .section-title i { font-size:1.4em; margin-right:10px; color:#3b82f6 }

        .feedback-message { font-size:1.05em; margin-bottom:14px; font-weight:500 }

        .game-button { padding:10px 20px; font-size:1em; border-radius:8px; min-width:150px; margin:6px; transition:all .18s ease-in-out }
        .game-button i{ margin-right:8px }
        .btn-action { background:#e6f0fb; color:#1f2d3d; border:1px solid #cfe3fb }
        .btn-action:hover:not(:disabled){ transform:translateY(-2px) }
        .btn-success-active{ background:#28a745 !important; color:#fff !important; border-color:#28a745 }
        .btn-primary-start{ background:#0ea5e9; color:#fff; border-color:#0ea5e9; font-weight:700 }
        .btn-info-active{ background:#06b6d4 !important; color:#fff !important }

        .progress { height:20px; border-radius:10px }
        .progress-bar-warning { background:#f59e0b }
        .progress-bar-danger { background:#dc2626 }

        .embreagem-box { background:#eef2f7; border-radius:6px; height:38px; width:92%; margin:0 auto 14px; position:relative }
        .embreagem-target-zone { background:#10b981; position:absolute; left:36%; width:28%; height:100%; border-radius:3px }
        #indicadorEmbreagem { background:#ef4444; position:absolute; left:50%; width:14px; height:100%; cursor:pointer; border-radius:2px; transition:background-color .18s,left .08s }

        /* Tremor mais realista */
        @keyframes car-shake {
            0%{ transform: translate(0,0) rotate(0deg) }
            25%{ transform: translate(-6px,6px) rotate(-1deg) }
            50%{ transform: translate(6px,-6px) rotate(1deg) }
            75%{ transform: translate(-3px,3px) rotate(-0.5deg) }
            100%{ transform: translate(0,0) rotate(0deg) }
        }
        .shake { animation: car-shake 0.45s; }

        /* Fade-in */
        .fade-in { animation: fadeIn .45s forwards }
        @keyframes fadeIn { from { opacity:0; transform:translateY(8px) } to { opacity:1; transform:none } }

        /* Tela final */
        .end-screen { padding:28px }

        /* Pequeno ajuste responsivo */
        @media (max-width:576px){ .game-button{ min-width:unset; width:100% } }
    </style>
@endpush

@section('content')
    <div class="container mt-4" id="container">
        <div class="game-container">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <h1 class="h4 text-primary mb-0">Simulador de Prova Prática — Aprimorado</h1>
                <div class="text-end">
                    <div class="mb-1">Nível:
                        <select id="nivel" class="form-select d-inline-block w-auto">
                            <option value="facil">Fácil</option>
                            <option value="medio" selected>Médio</option>
                            <option value="dificil">Difícil</option>
                        </select>
                    </div>
                    <div><small id="pontuacaoText">Pontuação: <strong id="pontuacao">100</strong></small></div>
                </div>
            </div>

            <div class="progress mb-3">
                <div id="barraProgressoGeral" class="progress-bar bg-success" style="width:0%">Fase 0/3</div>
            </div>

            <p class="lead text-center text-secondary mb-3">Teste sua atenção e controle nas três áreas críticas do exame. Boas manobras!</p>

            <div id="game-status" class="alert alert-game-success text-center fw-bold d-none"></div>
            <div id="game-fail" class="alert alert-game-danger text-center fw-bold d-none"></div>

            {{-- FASE 1 --}}
            <div id="fase1" class="game-section">
                <h3 class="section-title"><i class="bi bi-person-check"></i> Fase 1: Check-list de Início</h3>
                <p id="feedbackCheckList" class="feedback-message text-info">Prepare o carro para iniciar a jornada. Não pule etapas!</p>

                <button id="btnBanco" class="btn game-button btn-action me-2" data-checked="0"><i class="bi bi-chair"></i> Ajustar Banco</button>
                <button id="btnRetrovisores" class="btn game-button btn-action me-2" data-checked="0"><i class="bi bi-mirror"></i> Ajustar Retrovisores</button>
                <button id="btnCinto" class="btn game-button btn-action me-2" data-checked="0"><i class="bi bi-person-bounding-box"></i> Colocar Cinto <span class="badge bg-danger ms-2">GRAVE!</span></button>

                <div class="mt-3">
                    <button id="btnPartida" class="btn game-button btn-primary-start" disabled><i class="bi bi-key"></i> Dar Partida e Sair</button>
                    <button id="btnReiniciar" class="btn game-button btn-action ms-2"><i class="bi bi-arrow-counterclockwise"></i> Reiniciar</button>
                </div>
            </div>

            {{-- FASE 2 --}}
            <div id="fase2" class="game-section d-none">
                <h3 class="section-title"><i class="bi bi-bezier2"></i> Fase 2: Baliza Perfeita</h3>
                <p class="progress-title">Nervosismo Acumulado:</p>
                <div class="progress mb-3" style="height:28px; border-radius:6px;">
                    <div id="barraNervosismo" class="progress-bar progress-bar-warning" style="width:0%" role="progressbar">Nervosismo: 0%</div>
                </div>
                <p id="feedbackBaliza" class="feedback-message alert alert-info">Siga a sequência para estacionar sem erros e sem nervosismo.</p>

                <div id="botoesBaliza" class="mb-2">
                    <button id="btnSeta" class="btn game-button btn-info-active me-2" data-step="1"><i class="bi bi-arrow-left-right"></i> 1. Ligar Seta</button>
                    <button id="btnRe" class="btn game-button btn-action me-2" data-step="2" disabled><i class="bi bi-arrow-counterclockwise"></i> 2. Engatar Ré</button>
                    <button id="btnVolante" class="btn game-button btn-action me-2" data-step="3" disabled><i class="bi bi-arrow-repeat"></i> 3. Virar Volante</button>
                    <button id="btnAjuste" class="btn game-button btn-action me-2" data-step="4" disabled><i class="bi bi-sliders"></i> 4. Ajustar</button>
                    <button id="btnFinalizarBaliza" class="btn game-button btn-primary-start mt-3" data-step="5" disabled><i class="bi bi-check-circle"></i> 5. Finalizar Baliza</button>
                </div>
            </div>

            {{-- FASE 3 --}}
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

    {{-- SONS (substitua os src pelos arquivos reais) --}}
    <audio id="sound-success" src="/sounds/success.mp3" preload="auto"></audio>
    <audio id="sound-fail" src="/sounds/fail.mp3" preload="auto"></audio>
    <audio id="sound-engine" src="/sounds/engine.mp3" preload="auto"></audio>

    @push('scripts')
        <script>
            // Parâmetros configuráveis por dificuldade
            const DIFFICULTY_SETTINGS = {
                facil:   { INCREMENTO_NERVOSISMO: 5, TEMPO_INCREMENTO_MS: 2500, TEMPO_EMBREAGEM_MS: 3500, SCORE_BONUS: 40 },
                medio:   { INCREMENTO_NERVOSISMO: 7, TEMPO_INCREMENTO_MS: 2000, TEMPO_EMBREAGEM_MS: 3000, SCORE_BONUS: 25 },
                dificil: { INCREMENTO_NERVOSISMO: 10, TEMPO_INCREMENTO_MS: 1500, TEMPO_EMBREAGEM_MS: 2500, SCORE_BONUS: 10 }
            };

            let itensChecados = 0;
            let nervosismo = 0;
            let passoBalizaAtual = 1;
            let timerNervosismo = null;
            let tempoNoPonto = 0;
            let intervaloCheck = null;
            let pontuacao = 100;
            let nivel = 'medio';

            function playSound(id){
                const s = document.getElementById(id);
                if(!s) return; s.currentTime = 0; s.play().catch(()=>{});
            }

            function setGameStatus(message, isSuccess){
                const statusBox = isSuccess ? document.getElementById('game-status') : document.getElementById('game-fail');
                const otherBox = isSuccess ? document.getElementById('game-fail') : document.getElementById('game-status');
                otherBox.classList.add('d-none');
                statusBox.textContent = message;
                statusBox.classList.remove('d-none');
                statusBox.classList.remove(isSuccess ? 'alert-game-danger' : 'alert-game-success');
                statusBox.classList.add(isSuccess ? 'alert-game-success' : 'alert-game-danger');
                // play sound
                if(isSuccess) playSound('sound-success'); else playSound('sound-fail');
            }

            function atualizarProgresso(fase){
                const barra = document.getElementById('barraProgressoGeral');
                const porcentagem = Math.min(100, Math.round((fase/3)*100));
                barra.style.width = porcentagem + '%';
                barra.textContent = `Fase ${fase}/3`;
            }

            function penalizar(pontos){ pontuacao = Math.max(0, pontuacao - pontos); atualizarPontuacaoUI(); }
            function premiar(pontos){ pontuacao += pontos; atualizarPontuacaoUI(); }
            function atualizarPontuacaoUI(){ document.getElementById('pontuacao').textContent = pontuacao; }

            function reiniciarGame(){
                clearInterval(timerNervosismo); clearInterval(intervaloCheck);
                // reinicia valores
                itensChecados = 0; nervosismo = 0; passoBalizaAtual = 1; tempoNoPonto = 0;
                // UI Reset fases
                document.getElementById('fase1').classList.remove('d-none');
                document.getElementById('fase2').classList.add('d-none');
                document.getElementById('fase3').classList.add('d-none');
                document.getElementById('game-status').classList.add('d-none');
                document.getElementById('game-fail').classList.add('d-none');

                // Check-list
                document.querySelectorAll('#fase1 button:not(#btnPartida,#btnReiniciar)').forEach(btn=>{
                    btn.setAttribute('data-checked','0');
                    btn.classList.remove('btn-success-active'); btn.classList.add('btn-action');
                });
                document.getElementById('btnPartida').disabled = true;
                document.getElementById('feedbackCheckList').className = 'feedback-message text-info';
                document.getElementById('feedbackCheckList').textContent = 'Prepare o carro para iniciar a jornada. Não pule etapas!';

                // Baliza
                document.getElementById('barraNervosismo').style.width = '0%';
                document.getElementById('barraNervosismo').textContent = 'Nervosismo: 0%';
                document.getElementById('barraNervosismo').classList.remove('progress-bar-danger');
                document.getElementById('barraNervosismo').classList.add('progress-bar-warning');
                document.getElementById('feedbackBaliza').textContent = 'Inicie a baliza seguindo os passos.';
                document.getElementById('feedbackBaliza').className = 'feedback-message alert alert-info';
                document.querySelectorAll('#botoesBaliza button').forEach(btn=>{ btn.disabled = (btn.id !== 'btnSeta'); btn.classList.remove('btn-success-active','btn-info-active'); btn.classList.add('btn-action'); if(btn.id === 'btnSeta'){ btn.classList.remove('btn-action'); btn.classList.add('btn-info-active') } if(btn.id === 'btnFinalizarBaliza') btn.classList.add('btn-primary-start'); });

                // Embreagem
                document.getElementById('feedbackEmbreagem').textContent = 'Clique e segure o indicador para manter a embreagem no ponto certo.';
                document.getElementById('feedbackEmbreagem').className = 'feedback-message alert alert-info mt-3';
                document.getElementById('indicadorEmbreagem').style.backgroundColor = '#ef4444'; document.getElementById('indicadorEmbreagem').style.left = '50%';

                // pontuação inicial depende do nível
                pontuacao = 100; atualizarPontuacaoUI();
                atualizarProgresso(1);
            }

            function atualizarTremer(){
                const body = document.getElementById('container');
                const intensidade = nervosismo/100;
                if(intensidade > 0.05){
                    body.classList.add('shake');
                    setTimeout(()=> body.classList.remove('shake'), 450);
                }
            }

            // BALIZA: função de atualização de nervosismo
            function atualizarNervosismo(){
                const settings = DIFFICULTY_SETTINGS[nivel];
                nervosismo += settings.INCREMENTO_NERVOSISMO;
                const barra = document.getElementById('barraNervosismo');
                if(nervosismo >= 100){
                    clearInterval(timerNervosismo);
                    document.getElementById('feedbackBaliza').textContent = 'REPROVADO! Nervosismo esgotado, você encostou no balizamento.';
                    setGameStatus('Reprovado na Fase 2 por falta Eliminatória!', false);
                    barra.style.width = '100%'; barra.classList.remove('progress-bar-warning'); barra.classList.add('progress-bar-danger');
                    atualizarTremer(); penalizar(30);
                    setTimeout(reiniciarGame, 2800);
                    return;
                }
                barra.style.width = nervosismo + '%'; barra.textContent = 'Nervosismo: ' + nervosismo.toFixed(0) + '%';
                if(nervosismo > 70){ barra.classList.remove('progress-bar-warning'); barra.classList.add('progress-bar-danger'); }
                atualizarTremer();
            }

            function iniciarFaseBaliza(){
                const settings = DIFFICULTY_SETTINGS[nivel];
                nervosismo = 0;
                if(timerNervosismo) clearInterval(timerNervosismo);
                timerNervosismo = setInterval(atualizarNervosismo, settings.TEMPO_INCREMENTO_MS);

                document.querySelectorAll('#botoesBaliza button').forEach(btn=>{
                    btn.onclick = null;
                    if(btn.id === 'btnSeta'){ btn.classList.remove('btn-action'); btn.classList.add('btn-info-active'); }

                    btn.addEventListener('click', function(){
                        const passoDoBotao = parseInt(btn.getAttribute('data-step'));
                        const settings = DIFFICULTY_SETTINGS[nivel];

                        if(passoDoBotao === passoBalizaAtual){
                            clearInterval(timerNervosismo);
                            document.getElementById('feedbackBaliza').textContent = `Passo ${passoBalizaAtual} OK! Próximo passo.`;
                            document.getElementById('feedbackBaliza').className = 'feedback-message alert alert-success';

                            btn.disabled = true; btn.classList.remove('btn-info-active','btn-action'); btn.classList.add('btn-success-active');
                            premiar(settings.SCORE_BONUS);

                            passoBalizaAtual++;
                            if(passoBalizaAtual <= 5){
                                const proximoBotao = document.querySelector(`#botoesBaliza button[data-step="${passoBalizaAtual}"]`);
                                proximoBotao.disabled = false; proximoBotao.classList.remove('btn-action'); proximoBotao.classList.add('btn-info-active');
                                timerNervosismo = setInterval(atualizarNervosismo, settings.TEMPO_INCREMENTO_MS);
                            } else {
                                document.getElementById('feedbackBaliza').textContent = 'Baliza Completa! Sucesso!';
                                setGameStatus('Fase 2 Concluída. Próxima: Controle de Rampa!', true);
                                atualizarProgresso(2);
                                setTimeout(()=> avancarFase(2), 1200);
                            }

                        } else if(passoDoBotao < passoBalizaAtual){
                            // já clicado
                        } else {
                            nervosismo += 15; document.getElementById('feedbackBaliza').textContent = 'Ordem Incorreta! Penalidade de Nervosismo!';
                            document.getElementById('feedbackBaliza').className = 'feedback-message alert alert-danger';
                            clearInterval(timerNervosismo); timerNervosismo = setInterval(atualizarNervosismo, settings.TEMPO_INCREMENTO_MS);
                            atualizarNervosismo(); penalizar(10); playSound('sound-fail');
                        }
                    });
                });
            }

            function avancarFase(faseAtual){
                document.getElementById(`fase${faseAtual}`).classList.add('d-none');
                const proximaFase = faseAtual + 1;
                const nextElement = document.getElementById(`fase${proximaFase}`);
                if(nextElement){ nextElement.classList.remove('d-none'); nextElement.classList.add('fade-in'); document.getElementById('game-status').classList.add('d-none'); if(proximaFase===2) iniciarFaseBaliza(); if(proximaFase===3) atualizarProgresso(3);
                } else {
                    // fim do jogo
                    premiar(50);
                    mostrarFimDeJogo();
                }
            }

            function mostrarFimDeJogo(){
                const container = document.querySelector('.game-container');
                container.innerHTML = `
                    <div class="end-screen text-center">
                        <h2 class="mb-3">🎉 Simulação Concluída</h2>
                        <p class="mb-2">Sua pontuação final foi <strong>${pontuacao}</strong>.</p>
                        <p class="text-muted">Nível: <strong>${nivel}</strong></p>
                        <div class="mt-3">
                            <button class="btn btn-primary" id="btnJogarNovamente">Jogar Novamente</button>
                        </div>
                    </div>
                `;
                playSound('sound-success');
                document.getElementById('btnJogarNovamente').addEventListener('click', function(){ location.reload(); });
            }

            // EMBREAGEM: gerenciamento dentro do DOMContentLoaded (evita acessar elementos antes de existirem)
            document.addEventListener('DOMContentLoaded', function(){
                // Elementos
                const btnsCheck = document.querySelectorAll('#fase1 button:not(#btnPartida,#btnReiniciar)');
                const btnPartida = document.getElementById('btnPartida');
                const btnReiniciar = document.getElementById('btnReiniciar');
                const feedbackCheckList = document.getElementById('feedbackCheckList');
                const indicadorEmbreagem = document.getElementById('indicadorEmbreagem');
                const feedbackEmbreagem = document.getElementById('feedbackEmbreagem');

                // nível
                document.getElementById('nivel').addEventListener('change', function(e){ nivel = e.target.value; reiniciarGame(); });

                // Check-list
                btnsCheck.forEach(btn=>{
                    btn.addEventListener('click', function(){
                        if(btn.getAttribute('data-checked') === '0'){
                            btn.setAttribute('data-checked','1'); btn.classList.remove('btn-action'); btn.classList.add('btn-success-active'); itensChecados++; playSound('sound-success');
                        }
                        if(itensChecados === 3){ btnPartida.disabled = false; feedbackCheckList.classList.remove('text-info'); feedbackCheckList.classList.add('text-success'); feedbackCheckList.textContent = 'Protocolo OK! Clique em "Dar Partida e Sair".'; }
                    });
                });

                btnPartida.addEventListener('click', function(){
                    if(itensChecados < 3){ feedbackCheckList.classList.remove('text-success','text-info'); feedbackCheckList.classList.add('text-danger'); feedbackCheckList.textContent = 'REPROVADO! FALTAS GRAVES: Você esqueceu o Cinto de Segurança. Tente novamente.'; setGameStatus('Reprovado na Fase 1 por falta Grave!', false); penalizar(50); setTimeout(reiniciarGame, 2200);
                    } else {
                        setGameStatus('Fase 1 Concluída. Boa sorte na Baliza!', true); playSound('sound-engine'); atualizarProgresso(1); premiar(15);
                        setTimeout(()=> avancarFase(1), 900);
                    }
                });

                btnReiniciar.addEventListener('click', reiniciarGame);

                indicadorEmbreagem.addEventListener('mousedown', iniciarControleEmbreagem);
                document.addEventListener('mouseup', pararControleEmbreagem);
                indicadorEmbreagem.addEventListener('touchstart', iniciarControleEmbreagem);
                document.addEventListener('touchend', pararControleEmbreagem);

                reiniciarGame();
                atualizarProgresso(1);
            });

            function iniciarControleEmbreagem(e){
                e.preventDefault();
                const settings = DIFFICULTY_SETTINGS[nivel];
                const indicador = document.getElementById('indicadorEmbreagem');
                const feedbackEmbreagem = document.getElementById('feedbackEmbreagem');
                if(intervaloCheck) return;
                playSound('sound-engine');
                indicador.style.backgroundColor = '#0ea5e9'; indicador.style.left = '45%';

                intervaloCheck = setInterval(()=>{
                    tempoNoPonto += 100; feedbackEmbreagem.textContent = `Mantendo Ponto... (${(tempoNoPonto/1000).toFixed(1)}s)`; feedbackEmbreagem.className = 'feedback-message alert alert-success';
                    if(tempoNoPonto >= settings.TEMPO_EMBREAGEM_MS){
                        clearInterval(intervaloCheck); intervaloCheck = null; tempoNoPonto = 0; indicador.style.backgroundColor = '#10b981'; feedbackEmbreagem.textContent = 'Ponto de Embreagem Atingido! Sucesso na Rampa!'; playSound('sound-success'); premiar(30);
                        setGameStatus('Fase 3 Concluída. Você é um mestre da embreagem!', true);
                        atualizarProgresso(3);
                        setTimeout(()=> avancarFase(3), 1000);
                    }
                }, 100);
            }

            function pararControleEmbreagem(){
                const indicador = document.getElementById('indicadorEmbreagem');
                const feedbackEmbreagem = document.getElementById('feedbackEmbreagem');
                if(intervaloCheck){ clearInterval(intervaloCheck); intervaloCheck = null; indicador.style.backgroundColor = '#ef4444';
                    feedbackEmbreagem.textContent = `REPROVADO! O motor morreu (Falta Média). Tente novamente.`; feedbackEmbreagem.className = 'feedback-message alert alert-danger';
                    penalizar(20); playSound('sound-fail'); setTimeout(reiniciarGame, 1800);
                }
            }
        </script>
    @endpush

@endsection
