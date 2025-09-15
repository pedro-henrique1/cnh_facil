@extends('base')

@section('content')
    <main class="py-5">
        <div class="container">
            <div class="text-center mb-5">
                <h1 class="fw-bold">Materiais Oficiais e de Apoio</h1>
                <p class="text-muted">Links e informações importantes para sua preparação</p>
            </div>

            <div class="row g-5">
                {{-- Seção de Sites Oficiais --}}
                <div class="col-12">
                    <div class="d-flex align-items-center mb-3">
                        <i class="bi bi-link-45deg fs-2 me-3 text-primary"></i>
                        <h4 class="fw-semibold mb-0">Sites Oficiais do Governo/Detran</h4>
                    </div>
                    <ul class="list-unstyled ms-5">
                        <li><a href="https://portalservicos.senatran.serpro.gov.br/#/home" target="_blank">SENATRAN</a></li>
                        <li><a href="https://www.gov.br/pt-br/temas/servicos-de-transito" target="_blank">Serviços de trânsito do Governo Federal</a></li>
                        <li><a href="https://www.gov.br/transportes/pt-br/assuntos/noticias/ultimas-noticias/novo-portal-de-servicos-do-denatran-reune-informacoes-para-facilitar-a-vida-do-cidadao" target="_blank">DENATRAN</a></li>
                        <li><a href="https://servicos.dnit.gov.br/multas/" target="_blank">DNIT</a></li>
                        <li><a href="https://www.detran.rj.gov.br" target="_blank">DETRAN-RJ</a></li>
                        <li><a href="https://www.detran.sp.gov.br/detransp" target="_blank">DETRAN-SP</a></li>
                        <li><a href="https://transito.mg.gov.br/veiculos" target="_blank">DETRAN-MG</a></li>
                    </ul>
                </div>

                <hr>

                {{-- Seção de Média de Preços --}}
                <div class="col-12">
                    <div class="d-flex align-items-center mb-3">
                        <i class="bi bi-cash-stack fs-2 me-3 text-success"></i>
                        <h4 class="fw-semibold mb-0">Média de CNH por Estado (Categoria AB)</h4>
                    </div>
                    <div class="row ms-5">
                        @php
                            $estados = [
                                ['nome' => 'Acre (AC)', 'preco' => 'R$ 3.906,60'],
                                ['nome' => 'Alagoas (AL)', 'preco' => 'R$ 2.069,14'],
                                ['nome' => 'Amapá (AP)', 'preco' => 'R$ 3.780,77'],
                                ['nome' => 'Amazonas (AM)', 'preco' => 'R$ 3.418,95'],
                                ['nome' => 'Bahia (BA)', 'preco' => 'R$ 4.120,75'],
                                ['nome' => 'Ceará (CE)', 'preco' => 'R$ 3.020,97'],
                                ['nome' => 'Distrito Federal (DF)', 'preco' => 'R$ 3.005,67'],
                                ['nome' => 'Espírito Santo (ES)', 'preco' => 'R$ 2.338,76'],
                                ['nome' => 'Goiás (GO)', 'preco' => 'R$ 2.600,39'],
                                ['nome' => 'Maranhão (MA)', 'preco' => 'R$ 2.858,01'],
                                ['nome' => 'Minas Gerais (MG)', 'preco' => 'R$ 3.968,15'],
                                ['nome' => 'Mato Grosso (MT)', 'preco' => 'R$ 2.964,04'],
                                ['nome' => 'Mato Grosso do Sul (MS)', 'preco' => 'R$ 4.477,95'],
                                ['nome' => 'Pará (PA)', 'preco' => 'R$ 2.802,45'],
                                ['nome' => 'Paraíba (PB)', 'preco' => 'R$ 1.950,40'],
                                ['nome' => 'Pernambuco (PE)', 'preco' => 'R$ 3.416,44'],
                                ['nome' => 'Piauí (PI)', 'preco' => 'R$ 2.401,00'],
                                ['nome' => 'Paraná (PR)', 'preco' => 'R$ 3.670,83'],
                                ['nome' => 'Rio de Janeiro (RJ)', 'preco' => 'R$ 2.567,82'],
                                ['nome' => 'Rio Grande do Norte (RN)', 'preco' => 'R$ 2.806,00'],
                                ['nome' => 'Rondônia (RO)', 'preco' => 'R$ 2.355,22'],
                                ['nome' => 'Roraima (RR)', 'preco' => 'R$ 3.828,40'],
                                ['nome' => 'Rio Grande do Sul (RS)', 'preco' => 'R$ 4.951,35'],
                                ['nome' => 'Santa Catarina (SC)', 'preco' => 'R$ 3.906,90'],
                                ['nome' => 'Sergipe (SE)', 'preco' => 'R$ 3.049,97'],
                                ['nome' => 'São Paulo (SP)', 'preco' => 'R$ 1.983,90'],
                                ['nome' => 'Tocantins (TO)', 'preco' => 'R$ 2.985,33'],
                            ];

                            $converterPreco = function($precoString) {
                                return (float) str_replace(['R$', ' ' ,'.', ','], ['', '', '', '.'], $precoString);
                            };

                            usort($estados, function($a, $b) use ($converterPreco) {
                                $precoA = $converterPreco($a['preco']);
                                $precoB = $converterPreco($b['preco']);
                                return $precoA <=> $precoB;
                            });
                        @endphp

                        <div class="col-12 col-md-6">
                            <ul class="list-unstyled">
                                @foreach(array_slice($estados, 0, ceil(count($estados) / 2)) as $estado)
                                    <li><i class="bi bi-geo-alt me-2 text-muted"></i>{{ $estado['nome'] }}: {{ $estado['preco'] }}</li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="col-12 col-md-6">
                            <ul class="list-unstyled">
                                @foreach(array_slice($estados, ceil(count($estados) / 2)) as $estado)
                                    <li><i class="bi bi-geo-alt me-2 text-muted"></i>{{ $estado['nome'] }}: {{ $estado['preco'] }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>

                <hr>

                {{-- Seção de Aplicativos --}}
                <div class="col-12">
                    <div class="d-flex align-items-center mb-3">
                        <i class="bi bi-phone fs-2 me-3 text-info"></i>
                        <h4 class="fw-semibold mb-0">Aplicativos que Auxiliam na Prova</h4>
                    </div>
                    <ul class="list-unstyled ms-5">
                        <li><i class="bi bi-app me-2 text-muted"></i> Simulado CNH: Prova 2025.</li>
                        <li><i class="bi bi-app-indicator me-2 text-muted"></i> Simulado Habilitação - RJ.</li>
                        <li><i class="bi bi-phone me-2 text-muted"></i> Carteira Digital de Trânsito. (Não tem simulado, mas permite acessar a CNH, infrações, pontos, etc.)</li>
                    </ul>
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
        ul a {
            text-decoration: none;
            color: var(--bs-primary);
        }
        hr {
            margin-top: 2rem;
            margin-bottom: 2rem;
            border-top: 1px solid #dee2e6;
        }
    </style>
@endpush
