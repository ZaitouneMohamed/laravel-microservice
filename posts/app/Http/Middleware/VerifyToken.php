<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpFoundation\Response;
use App\Services\CustomCryptoService;

class VerifyToken
{
    protected $crypto;

    public function __construct(CustomCryptoService $crypto)
    {
        $this->crypto = $crypto;
    }

    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->bearerToken();

        if (!$token) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        try {
            $cacheKey = 'auth_token_' . sha1($token);

            if (Cache::has($cacheKey)) {
                $encrypted = Cache::get($cacheKey);
                $userData = $this->crypto->decrypt($encrypted);
                $request->merge(['user_data' => $userData]);
                return $next($request);
            }

            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $token,
                'Accept' => 'application/json',
            ])->get(config('authServices.auth_service.url') . '/api/profile');

            if ($response->successful()) {
                $userData = $response->json();
                Cache::forever($cacheKey, $this->crypto->encrypt($userData));
                $request->merge(['user_data' => $userData]);
                return $next($request);
            }

            return response()->json(['message' => 'Unauthorized'], 401);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Auth service unavailable'], 503);
        }
    }
}
