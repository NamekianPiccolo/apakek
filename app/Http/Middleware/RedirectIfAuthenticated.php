<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        $guards = empty($guards) ? [null] : $guards;

       if($request->user()){
        if($request->user()->role == 'customer'){
            return redirect()->route('customer.index');
        }
         else if($request->user()->role == 'bank'){
            return redirect()->route('bank.index');
        }
        else if($request->user()->role == 'kantin'){
            return redirect()->route('kantin.index');
        }
        else{
            return redirect('/');
        }
        
       }
       else{
        return $next($request);
       }

        
    }
}
