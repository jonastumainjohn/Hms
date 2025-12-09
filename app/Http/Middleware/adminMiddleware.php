<?php
namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;
use Illuminate\Support\Facades\Auth;

class adminMiddleware
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
        $excludedRoutes = ['admin.login', 'admin.logout'];
        if (in_array($request->route()->getName(), $excludedRoutes)) {
            return $next($request);
        }
        $user = Auth::user();
        if ($user) {
            $RegistrationDate = Carbon::createFromFormat('d/m/Y', '29/12/2024');
            $patients = $RegistrationDate->addMonths(3);
            if (Carbon::now()->greaterThanOrEqualTo($patients)) {
                Auth::logout();
                return redirect()->route('admin.login');
            }
        }
        return $next($request);
    }
}
