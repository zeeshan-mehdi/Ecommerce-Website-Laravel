<?php
namespace App\Http\Middleware;
use Closure;
class IsAdmin
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
        if(auth()->check()) {
            if (auth()->user()->isAdmin()) {
                return $next($request);
            }
            return redirect('/posts');
        }else{
            return redirect('/login');
        }

    }
}
