<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ApiAuthenticationMiddleware
{
    protected $except = [
       '/api/register',

    ];
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(!in_array($request->getRequestUri(),$this->except)){//if $request->getRequestUri() in except !.
            $authorizitionData = explode(' ',$request->header('authorization'));
            $decode = explode(':',base64_decode($authorizitionData[1]));
            $user = User::query()->where('email',$decode[0])->firstOrFail();
            if(!Hash::check($decode[1],$user->password)){
                abort(403);
            }
            auth()->login($user);
        }

        return $next($request);
    }
}
