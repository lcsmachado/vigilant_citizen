<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Admin;
class CheckRole
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
        if($request->user() === null){
            return redirect()->route('painel.login');//response('Insufficient permissions', 401);
        }

        $actions = $request->route()->getAction();
        $roles = isset($actions['roles']) ? $actions['roles'] : null;

        //
        $user = new Admin();
        if($user->hasAnyRole($roles) || !$roles){
            return $next($request);
        }

        return  redirect()->back();// response('Insufficient permissions', 401);
    }
}
