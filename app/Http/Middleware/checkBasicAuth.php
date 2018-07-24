<?php

namespace App\Http\Middleware;
use App\Helpers\CommonHelper;
use Closure;

class checkBasicAuth
{
    /**
     * HThis middleware is used to check basic authentication for every api request
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
     
         {
      if($request->header('PHP_AUTH_USER') == Config('AppConstant.BASIC_AUTH_USER') && $request->header('PHP_AUTH_PW') == Config('AppConstant.BASIC_AUTH_PASSWORD')){
       // if Basic Authentication success,Request allowes to go in controller
            return $next($request);
        }
       //If basic authentication fail then it return request 
         return response()->json(CommonHelper::displayMessage(Config('ErrorCodes.BASIC_AUTH_FAIL'),trans('apiMessages.basicAuthfail')));
    }
    }
}
