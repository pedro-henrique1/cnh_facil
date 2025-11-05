<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cnh fácil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="icon" type="image/png" href="public/favicon.ico" />
    @stack('styles')

    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
        }

        .hero-section h1 {
            font-size: 4rem;
            font-weight: bold;
            margin-bottom: 20px;
            animation: fadeIn 2s ease-in-out;
        }

        .hero-section p {
            font-size: 1.5rem;
            margin-bottom: 30px;
            animation: fadeIn 3s ease-in-out;
        }

        .bgcolor {
            background-color: #1155cc;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        .mt-footer {
            margin-top: 8rem;
        }

        .dropdown-menu .dropdown-item:hover,
        .dropdown-menu .dropdown-item:focus,
        .dropdown-menu .dropdown-item.active {
            background-color: transparent !important;
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark bgcolor">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold" href="/">CNH Fácil</a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link @if (request()->routeIs('home')) active fw-bold @endif"
                            href="/">Home</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link @if (request()->routeIs('about')) active fw-bold @endif" href="/about">Sobre
                            a
                            lei</a>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle @if (request()->routeIs('theoretical.*')) active fw-bold @endif"
                            href="#" role="button" data-bs-toggle="dropdown">Prova Teórica</a>
                        <ul class="dropdown-menu text-white border-0" style="background-color: #1155cc;">
                            <li>
                                <a class="dropdown-item text-white @if (request()->routeIs('theoretical.information')) active fw-bold @endif"
                                    href="{{ route('theoretical.information') }}">Informações da prova teórica</a>
                            </li>
                            <li>
                                <a class="dropdown-item text-white @if (request()->routeIs('theoretical.questions')) active fw-bold @endif"
                                    href="{{ route('theoretical.questions') }}">Questões</a>
                            </li>
                            <li>
                                <a class="dropdown-item text-white @if (request()->routeIs('theoretical.simulation')) active fw-bold @endif"
                                    href="{{ route('theoretical.simulation') }}">Simulados</a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle @if (request()->routeIs('practical.*')) active fw-bold @endif"
                            href="#" role="button" data-bs-toggle="dropdown">
                            Prova Prática
                        </a>
                        <ul class="dropdown-menu border-0" style="background-color: #1155cc;">
                            <li>
                                <a class="dropdown-item" href="{{ route('practical.information') }}"
                                    style="color: #fff;">
                                    Informações
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('practical.video') }}" style="color: #fff;">
                                    Vídeos
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('practical.vehicle') }}" style="color: #fff;">
                                    Game: Conheça o veículo
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('practical.questions') }}" style="color: #fff;">
                                    Game: Simulado passo-a-passo
                                </a>
                            </li>
                        </ul>
                    </li>


                    <li class="nav-item">
                        <a class="nav-link @if (request()->routeIs('home.materials')) active fw-bold @endif"
                            href="{{ route('home.materials') }}">Materiais Oficiais</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if (request()->routeIs('home.aboutProject')) active fw-bold @endif"
                            href="{{ route('home.aboutProject') }}">Sobre o projeto</a>
                    </li>

                    @auth
                        <li class="nav-item">
                            <a class="nav-link @if (request()->routeIs('home.minhaconta')) active fw-bold @endif"
                                href="{{ route('home.minhaconta') }}">Meu perfil</a>
                        </li>
                    @endauth

                    @guest
                        <li class="nav-item">
                            <a class="nav-link @if (request()->routeIs('login')) active fw-bold @endif"
                                href="{{ route('login') }}">Login</a>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>
    @yield('content')

    <footer class="footer bg-dark text-light py-4 mt-footer">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h5 class="text-warning">Links Úteis</h5>
                    <ul class="list-unstyled">
                        <li><a href="https://www.gov.br/pt-br/temas/servicos-de-transito"
                                class="text-light text-decoration-none">Portal do DETRAN</a></li>
                        <li><a href="https://www.legislacaodetransito.com.br/"
                                class="text-light text-decoration-none">Legislação de Trânsito</a></li>
                        <li><a href="https://www.simuladodetranmg.com.br/#"
                                class="text-light text-decoration-none">Simulados Oficiais</a></li>
                    </ul>
                </div>

                <div class="col-md-6">
                    <h5 class="text-warning">Contato</h5>
                    <p>Email: <a href="mailto:DetranSemAutoescola@gmail.com"
                            class="text-white">DetranSemAutoescola@gmail.com</a></p>
                </div>
            </div>

            <hr class="border-secondary">

            <div class="text-center">
                <p class="mb-0">&copy; {{ date('Y') }} DetranSemAutoescola.com - Todos os direitos reservados</p>
            </div>
        </div>
    </footer>


    @stack('scripts')
    <!-- Bootstrap 5 JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
