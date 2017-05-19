<?php

namespace App\Http\Middleware;

use Closure;
use Response;
use App\Util\ApiToken;

class ApiTokenVerifier
{
    use ApiToken;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if($request->hasHeader('authtoken') && $this->validateHash($request->header('authtoken'),$request->except('_token')))
        {
            return $next($request);
        }
        $response   =   array(
            'status'    =>  (string)'error',
            'code'      =>  (int)\Symfony\Component\HttpFoundation\Response::HTTP_UNAUTHORIZED,
            'message'   =>  (string)'Unauthorized'
        );

        return Response::json($response,\Symfony\Component\HttpFoundation\Response::HTTP_UNAUTHORIZED);
    }
}
