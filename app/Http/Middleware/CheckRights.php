<?php

namespace App\Http\Middleware;

use Closure;

/**
 * Class Authenticate.
 */
class CheckRights
{
   /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $right)
    {
        if (auth()->user()->isAdmin()) {
            return $next($request);
        } else {
            foreach (json_decode(auth()->user()->rights) as $key => $value) {
                if ($right == $value) {
                    return $next($request);
                }
            } 
        }   
        return redirect('home');
    }
}
