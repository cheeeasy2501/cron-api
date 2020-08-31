<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use App\DataObjects\Currency as CurrencyDTO;

class CurrencyApiService
{
    const URL = 'https://blockchain.info/ticker';

    protected $currencies = [];

    private function getCurrencyJson()
    {
        $response = Http::get(self::URL);
        return $response->json();
    }

    private function prepareData($data)
    {
        foreach ($data as $currencyName => $currencyData) {
            $array = [];
            $array['currency_name'] = $currencyName;
            $array['currency_symbol'] = $currencyData['symbol'];
            $array['buy'] = $currencyData['buy'];
            $array['sell'] = $currencyData['sell'];

            $this->currencies[] = $array;
        }
    }

    public function getCurrencies()
    {
        $json = $this->getCurrencyJson();
        $this->prepareData($json);
        return $this->currencies;
    }

}
