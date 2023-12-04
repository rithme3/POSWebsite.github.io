<?php

namespace App\Http\Middleware;

use Closure;
use App;
class checkApiKey
{
  
    public function handle($request, Closure $next)
    {
        $key ='@bC123';
        if($key != $request->header('apikey')){
            return response()->json([
                'status' => 'Invalite API key!',
                'sms' => 'error'
            ]);
        }
        
        return $next($request);
    }
}
