<?php
// app/Services/CurrencyConverter.php
namespace App\Services;

use GuzzleHttp\Client;

class CurrencyConverter
{
    protected $client;
    protected $apiKey;

    public function __construct()
    {
        $this->client = new Client();
        $this->apiKey = env('CURRENCY_API_KEY'); // Store your API key in the .env file
    }

    public function convertToNGN($amount, $currency = 'USD')
    {
        $response = $this->client->get("https://v6.exchangerate-api.com/v6/{$this->apiKey}/latest/{$currency}");

        $data = json_decode($response->getBody(), true);

        if (isset($data['conversion_rates']['NGN'])) {
            $rate = $data['conversion_rates']['NGN'];
            return $amount * $rate;
        }

        return null;
    }
}
?>
