<?php

namespace App\Http\Middleware;

use Closure;
use View;
use App\Models\Bussiness\ProResourcePermission;

/**
 * Class AuthenticatedProResource.
 */
class AuthenticatedProResource
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (auth()->guard('proresource')->check() || auth()->guard('pro')->check()) {
            if(auth()->guard('proresource')->check()){
                $perms = ProResourcePermission::where('id', '=', auth()->guard('proresource')->user()->permission_id )->first();
                \View::share('user_permissions', $perms );
            }
            return $next($request);
        }
        return redirect()->route('frontend.pms.login');
    }
}
