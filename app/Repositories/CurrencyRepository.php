<?php

namespace App\Repositories;

use App\Models\Currency;
use Illuminate\Support\Facades\DB;

class CurrencyRepository
{
    /**
     * @param $currencies
     */
    public function saveMany($currencies)
    {
        $currenciesCollection = $this->getItems();

        if (!count($currenciesCollection)) {
            $this->insert($currencies);
            return;
        }

        $operationData = $this->operationFilter($currenciesCollection, $currencies);
        DB::transaction(function () use ($operationData) {
            $this->update($operationData['update']);
            $this->insert($operationData['insert']);
        });

        return;
    }

    /**
     * @param $array
     */
    public function insert($array)
    {
        if (count($array)) {
            DB::table(app(Currency::class)->getTable())->insert($array);
        }
    }

    /**
     * @param $array
     */
    public function update($array)
    {
        if (count($array)) {
            foreach ($array as $key => $value) {
                DB::table(app(Currency::class)->getTable())->where('currency_name', $value['currency_name'])
                    ->update($value);
            }
        }

    }

    /**
     * @return array
     */
    public function getItems()
    {
        return DB::table(app(Currency::class)->getTable())->select()->get()->all();
    }

    /**
     * @param $currenciesCollection
     * @param $currencies
     * @return array[]
     */
    public function operationFilter($currenciesCollection, $currencies)
    {
        $toUpdate = [];
        $toInsert = [];

        foreach ($currenciesCollection as $collectionKey => $collectionValue) {
            foreach ($currencies as $currencyKey => $currencyValue) {
                if ($collectionValue->currency_name === $currencyValue['currency_name']) {
                    array_push($toUpdate, $currencyValue);
                } else {
                    array_push($toInsert, $currencyValue);
                }
                unset($currencies[$currencyKey]);
                break;
            }
        }

        return ['insert' => $toInsert, 'update' => $toUpdate];
    }
}
