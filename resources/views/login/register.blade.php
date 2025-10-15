@extends('layouts.app')

@section('content')
    <style>
        .card {
            background-color: rgba(255, 255, 255, 0.6);
            border-radius: 15px;
            border: none;
            padding: 2rem;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
        }

        .card-header {
            background-color: transparent;
            border-bottom: 1px solid #ddd;
        }

        .btn-primary {
            background-color: #0d6efd;
            border: none;
        }

        .btn-primary:hover {
            background-color: #0b5ed7;
            transform: scale(1.05);
        }
    </style>

    <!-- Formulário de Cadastro -->
    <div class="container ">
        <div class="row justify-content-center ">
            <div class="col-md-6">
                <div class="card shadow-sm border-0 rounded-4 mt-5">
                    <div class="card-header bg-transparent border-bottom text-center">
                        <h3 class="fw-bold text-black">{{ __('Cadastro') }}</h3>
                        <p class="text-black small">Crie sua conta para acessar o sistema</p>
                    </div>

                    <div class="card-body p-4">
                        @if ($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show rounded-3" role="alert">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('register.store') }}" class="needs-validation" novalidate>
                            @csrf

                            <!-- Campo de Nome -->
                            <div class="mb-3">
                                <label for="name" class="form-label fw-medium text-black ">Nome Completo</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0"><i class="fas fa-user text-primary"></i></span>
                                    <input type="text" class="form-control form-control-lg border-start-0 @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required autofocus placeholder="Ex.: João Silva">
                                </div>
                                @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Campo de Email -->
                            <div class="mb-3">
                                <label for="email" class="form-label fw-medium text-black">Email</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0"><i class="fas fa-envelope text-primary"></i></span>
                                    <input type="email" class="form-control form-control-lg border-start-0 @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required placeholder="Ex.: joao.silva@email.com">
                                </div>
                                @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>


                            <!-- Campo de Senha -->
                            <div class="mb-3">
                                <label for="password" class="form-label fw-medium text-black">Senha</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0"><i class="fas fa-lock text-primary"></i></span>
                                    <input type="password" class="form-control form-control-lg border-start-0 @error('password') is-invalid @enderror" id="password" name="password" required placeholder="Mínimo de 8 caracteres">
                                </div>
                                @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="password_confirmation" class="form-label fw-medium text-black">Confirmar Senha</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0"><i class="fas fa-lock text-primary"></i></span>
                                    <input type="password" class="form-control form-control-lg border-start-0" id="password_confirmation" name="password_confirmation" required placeholder="Repita sua senha">
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary btn-lg w-100 rounded-pill mt-3">
                                <i class="fas fa-user-plus me-2"></i> Cadastrar
                            </button>
                        </form>
                    </div>

                    <!-- Rodapé -->
                    <div class="card-footer bg-transparent border-top text-center py-3">
                        <p class="small mb-0 text-muted">
                            Já tem uma conta?
                            <a href="{{ route('login') }}" class="text-black fw-medium text-decoration-none">
                                Entrar <i class="fas fa-sign-in-alt ms-1"></i>
                            </a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
