<?php

namespace App\Jobs;

use App\Repositories\CurrencyRepository;
use App\Services\CurrencyApiService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class UpdateCurrencyJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(CurrencyApiService $currencyApiService, CurrencyRepository $currencyRepository)
    {
        $currencies = $currencyApiService->getCurrencies();
        $currencyRepository->saveMany($currencies);
    }
}
