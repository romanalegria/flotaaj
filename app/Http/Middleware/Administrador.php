<?php

namespace App\Http\Middleware;
use Illuminate\Contracts\Auth\Guard;
use Closure;

class Administrador
{
    protected $auth;
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    public function handle($request, Closure $next)
    {
        switch ($this-auth->user()->idrol) {
            case '1':
                // Administrador
                break;
            
            default:
                // code...
                break;
        }

        return $next($request);
    }
}
