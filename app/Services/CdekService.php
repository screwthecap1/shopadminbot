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

        $response = Http::withToken($token)->get(config('services.cdek.api_url') . 'deliverypoints', [
            'city' => $city,
        ]);

        if (!$response->successful()) {
            return [];
        }

        $data = $response->json();

        return array_values(array_filter($data, function ($pvz) use ($city) {
            return isset($pvz['location']['city']) &&
                mb_strtolower(trim($pvz['location']['city'])) === mb_strtolower(trim($city));
        }));
    }
}
