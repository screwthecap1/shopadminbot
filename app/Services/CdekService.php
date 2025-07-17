<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class CdekService
{
    public function getAccessToken(): string
    {
        return Cache::remember('cdek_token', config('services.cdek.cache_ttl'), function () {
            $response = Http::asForm()->post(config('services.cdek.auth_url'), [
                'grant_type' => 'client_credentials',
                'client_id' => config('services.cdek.account'),
                'client_secret' => config('services.cdek.password')
            ]);

            if ($response->successful()) {
                return $response->json()['access_token'];
            }

            throw new \Exception('Can not get CDEK token');
        });
    }

    public function getPvzList(string $city): array
    {
        $token = $this->getAccessToken();

        $response = Http::withToken($token)->get(config('services.cdek.api_url'), [
            'city' => $city,
        ]);

        return $response->successful()
            ? $response->json()
            : [];
    }
}
