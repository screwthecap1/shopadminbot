<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\CdekService;
use App\Http\Requests\StorePvzRequest;

class CdekController extends Controller
{
    protected CdekService $cdekService;

    public function __construct(CdekService $cdek)
    {
        $this->cdek = $cdek;
    }

    public function pvz(StorePvzRequest $request)
    {
        $city = $request->query('city');

        if (!$city) {
            return response()->json(['error' => 'Город обязателен (city = ...)'], 422);
        }

        $points = $this->cdek->getPvzList($city);

        return response()->json($points);
    }
}
