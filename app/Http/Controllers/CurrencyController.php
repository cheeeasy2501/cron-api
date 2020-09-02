<?php

namespace App\Http\Controllers;

use App\Services\CurrencyApiService;
use App\Repositories\CurrencyRepository;

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
        echo json_encode($currencies);
    }
}
