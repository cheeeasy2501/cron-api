<?php

namespace App\Repositories;

use App\Models\Currency;
use Illuminate\Support\Facades\DB;

class CurrencyRepository
{
    public function saveMany($currencies)
    {
        DB::transaction(function () use ($currencies) {
            DB::table(app(Currency::class)->getTable())->updateOrInsert($currencies, $currencies);
        });
    }
}
