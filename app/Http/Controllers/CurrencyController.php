<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Client\Response;
use App\Models\Currency;
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
    }
}
