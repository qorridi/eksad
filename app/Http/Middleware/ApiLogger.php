<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ApiLogger
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        return $next($request);
    }

    /**
     * Log terminating api response
     * @param Request $request
     * @param JsonResponse $response
     */
    public function terminate(Request $request, JsonResponse $response){
        // Get response json
        $json = json_decode($response->getContent(), true);

        $log = [
            'uri' => $request->fullUrl(),
            'request_id' => $json['request_id'] ?? '',
            'method' => $request->getMethod(),
            'json_request' => $request->getContent(),
            'json_response' => $response->getContent(),
            'created_at' => Carbon::now('Asia/Jakarta')->toDateTimeString()
        ];

        // Plain text logging
        Log::channel('api_log')->info(json_encode($log));

        // Save to database
        DB::connection('log')->table('api_logs')
            ->insert($log);
    }
}
