<?php

namespace App\Http\Middleware;

use Closure;

class UserHasStoreMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(auth()->user()->store()->count())
        {
            
        flash('Voce já possui uma loja cadastrada!')->warning();
        return redirect()->route('admin.stores.index');
        }
        return $next($request);
    }

    // public function handle($request, Closure $next)
    // {
    //     $condition = auth()->user()->store;
    //     if(!is_null($condition)){
    //         flash('Você ja possui uma loja!')->warning();
    //         return redirect()->route('admin.stores.index');
    //     }
        
    //     return $next($request);
    // }
}
