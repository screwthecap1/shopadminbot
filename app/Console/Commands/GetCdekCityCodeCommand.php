<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class GetCdekCityCodeCommand extends Command
{
    protected $signature = 'cdek:city-code {city} {--region=}';
    protected $description = 'Получить city_code от CDEK по названию города (и опционально региону)';

    public function handle()
    {
        $city = $this->argument('city');
        $region = $this->option('region');

        $token = cache()->remember('cdek_token', config('services.cdek.cache_ttl'), function () {
            $response = Http::asForm()->post(config('services.cdek.auth_url'), [
                'grant_type' => 'client_credentials',
                'client_id' => config('services.cdek.account'),
                'client_secret' => config('services.cdek.password'),
            ]);

            if (!$response->successful()) {
                $this->error('Ошибка при получении токена CDEK');
                exit(1);
            }

            return $response->json()['access_token'];
        });

        $response = Http::withToken($token)->get(config('services.cdek.api_url') . 'location/cities', [
            'country_codes' => 'RU',
            'name' => $city,
        ]);

        if (!$response->successful()) {
            $this->error('Ошибка при запросе к CDEK API');
            return;
        }

        $results = $response->json();
        $found = collect($results)->first(function ($item) use ($city, $region) {
            $nameMatches = mb_strtolower(trim($item['city'])) === mb_strtolower(trim($city));

            if (!$nameMatches) {
                return false;
            }

            if ($region) {
                return isset($item['region']) &&
                    mb_strtolower(trim($item['region'])) === mb_strtolower(trim($region));
            }

            return true;
        });

        if ($found) {
            $this->info("Город: {$found['city']} | Регион: {$found['region']} | Код: {$found['code']}");
        } else {
            $this->warn('Город не найден. Попробуйте уточнить регион.');
        }
    }
}
