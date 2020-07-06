<?php

namespace App\Http\Middleware;

use Closure;

class Writer
{

    public function handle($request, Closure $next)
    {
        if(auth()->user()->permissions != 'WRITER'){
            return redirect()->to('/');
        }
        
        return $next($request);
    }
}
