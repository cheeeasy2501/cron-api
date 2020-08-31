<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class CurrencyApiService
{
    const URL = 'https://blockchain.info/ticker';

    /**
     * @var array
     */
    protected $currencies = [];

    /**
     * @return array|mixed
     */
    private function getCurrencyJson()
    {
        $response = Http::get(self::URL);
        return $response->json();
    }

    /**
     * @param $data
     */
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

    /**
     * @return array
     */
    public function getCurrencies()
    {
        $json = $this->getCurrencyJson();
        $this->prepareData($json);
        return $this->currencies;
    }

}
