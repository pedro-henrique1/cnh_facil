<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Authenticate
{
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            // Adiciona a mensagem de erro antes de redirecionar
            return route('login') . '?error=Você precisa estar logado para acessar esta página';
        }
    }

}
