<?php

namespace App\Console\Commands;

use App\Models\Currency;
use App\Models\CurrencyHistory;
use GuzzleHttp\Psr7\Request;
use http\Client;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;


class UpdateCurrency extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'currency:update {char_code?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update currency to actual';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return array
     * @throws \Artisaninweb\SoapWrapper\Exceptions\ServiceAlreadyExists
     */
    public function handle()
    {
        $charCode = $this->argument('char_code');

        $file = simplexml_load_file('https://www.cbr.ru/scripts/XML_daily.asp');
        $date = Carbon::parse((string)$file->attributes()['Date'])->format('Y-m-d');
        $currencies = [];
        foreach ($file as $currency) {
            if ($charCode && $charCode == $currency->CharCode) {
                $currencies[] = [
                    'id' => (string)$currency->attributes()['ID'],
                    'char_code' => (string)$currency->CharCode,
                    'name' => (string)$currency->Name,
                    'rate' => $currency->Value / $currency->Nominal,
                    'date' => $date,
                ];
                break;
            } elseif (!$charCode) {
                $currencies[] = [
                    'id' => (string)$currency->attributes()['ID'],
                    'char_code' => (string)$currency->CharCode,
                    'name' => (string)$currency->Name,
                    'rate' => $currency->Value / $currency->Nominal,
                    'date' => $date,
                ];
            }
        }
        foreach ($currencies as $currencyInfo) {
            $currency = Currency::find($currencyInfo['id']);
            if ($currency) {
                $history = new CurrencyHistory();
                $history->currency_id = $currencyInfo['id'];
                $history->date = \Carbon\Carbon::now()->format('Y-m-d');
                $history->rate = $currency->rate;
                $history->save();
                $success = $currency->update($currencyInfo);
                $success ? $this->info("Валюта $currency->char_code успешно обновлена") : $this->error("Ошибка при обновлении валюты $currency->char_code");
            } else {
                Currency::create($currencyInfo);
            }
        }
    }
}
