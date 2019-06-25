<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AdminMiddleware
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

        if ( Auth::check() && Auth::user()->hasanyrole('admin|superadmin|super_admin') )
        {
            return $next($request);
        } elseif( Auth::check() )
        {
            return redirect('/dashboard')->with([
                'message' => [
                    'label' => 'danger',
                    'content' => 'You have no permission'
                ]
            ]);
        }

        return redirect(route('login'))->with([
            'message' => [
                'label' => 'danger',
                'content' => 'Session expired! please login'
            ]
        ]);

        //return $next($request);
    }
}
