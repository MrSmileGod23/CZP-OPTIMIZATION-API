<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\User;

class ApiTokenMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $header = $request->header('Authorization');
        if (!$header) {
            return response()->json(
                ['data' => [
                    'code' => 401,
                    'message' => 'Токен не дан',
                ]], 401);
        }

        $headerParts = explode(' ', $header);
        if (count($headerParts) != 2 || strtolower($headerParts[0]) !== 'bearer') {
            return response()->json(
                ['data' => [
                    'code' => 401,
                    'message' => 'Invalid authorization header',
                ]], 401);
        }

        $token = $headerParts[1];

        $apiToken = User::where('api_token', $token)->first();

        if (!$apiToken) {
            return response()->json(
                ['data' => [
                    'code' => 401,
                    'message' => 'Неправильный токен',
                ]], 401);
        }

        $request->merge(['user' => $apiToken->user]);

        return $next($request);
    }
}
