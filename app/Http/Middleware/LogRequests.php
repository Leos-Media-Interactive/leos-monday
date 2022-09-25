<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Log;

class LogRequests
{
    public function handle($request, Closure $next)
    {
        $request->start = microtime(true);
        return $next($request);
    }

    public function terminate($request, $response)
    {
        $request->end = microtime(true);
        $this->log($request, $response);
    }

    protected function log($request, $response)
    {
        $duration = $request->end - $request->start;
        $url = $request->fullUrl();
        $method = $request->getMethod();
        $ip = $request->getClientIp();
        $log = "{$ip}: {$method}@{$url} - {$duration}ms \n" .
            "Request : {[$request->collect()]} \n" .
            "Response : {$response->getContent()} \n";
        $log_n = print_r($request->collect(), true);
        Log::info($log_n);
    }
}
