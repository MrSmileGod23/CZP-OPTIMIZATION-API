<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    public function handle($request, Closure $next, $role)
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

        $user = User::where('api_token', $token)->first();

        if ($user && $user->role === $role) {
            return $next($request);
        }

        return response()->json(['errors' => [
            'code' => 403,
            'message' => 'Вы не имеете прав',
        ]], 403);
    }
}
