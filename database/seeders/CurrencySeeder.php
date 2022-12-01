<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Lunar\Models\Currency;

class CurrencySeeder extends AbstractSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $currencies = $this->getSeedData('currencies');

        DB::transaction(function () use ($currencies) {
            foreach ($currencies as $currency) {
                $existing = Currency::where(['code' => $currency->code])->first();

                if (! $existing) {
                    Currency::create([
                        'code' => $currency->code,
                        'name' => $currency->name,
                        'exchange_rate' => 1,
                        'decimal_places' => $currency->decimal_places,
                        'default' => false,
                        'enabled' => true,
                    ]);
                }
            }
        });
    }
}
