<?php

namespace App\Http\Controllers;

use App\Services\CurrencyApiService;
use App\Repositories\CurrencyRepository;
use Illuminate\Routing\Controller;

class CurrencyController extends Controller
{
    /**
     * @param CurrencyApiService $currencyApiService
     * @param CurrencyRepository $currencyRepository
     */
    public function index(CurrencyApiService $currencyApiService, CurrencyRepository $currencyRepository)
    {
        $currencies = $currencyApiService->getCurrencies();
        $currencyRepository->saveMany($currencies);
        return response()->json($currencies);
    }
}
