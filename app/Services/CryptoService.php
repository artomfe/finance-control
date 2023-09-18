<?php

namespace App\Services;

use App\Repositories\CryptoRepository;
use GuzzleHttp\Client;
use Exception;
use Illuminate\Support\Facades\Log;

class CryptoService
{
    protected $cryptoRepository;
    private $apiKey;

    public function __construct(CryptoRepository $cryptoRepository)
    {
        $this->cryptoRepository = $cryptoRepository;
        $this->apiKey = "a9f7f3ac-a92d-41ba-89a7-b9b566cc8cee";
    }

    public function getAllCryptos()
    {
        return $this->cryptoRepository->getAllWithPagination();
    }

    public function updateCryptoPrices()
    {
        $cryptos = $this->cryptoRepository->getAll();

        foreach ($cryptos as $crypto) {
            $currentQuote = $this->getCryptoValueBySlug($crypto->slug);

            Log::debug('crypto: '. $crypto->slug);
            Log::debug('value: '. $currentQuote);

            $crypto->update(['current_quote' => $currentQuote]);

            sleep(3);
        }
    }

    public function deleteCrypto($id)
    {
        $crypto = $this->cryptoRepository->find($id);

        if (!$crypto) {
            throw new Exception('Crypto não encontrada', 404);
        }

        try {
            $this->cryptoRepository->delete($crypto);
        } catch (Exception $e) {
            throw new Exception('Erro ao remover Crypto', 500);
        }
    }

    protected function getCryptoValueBySlug($slug)
    {
        $client = new Client();

        try {
            $response = $client->get('https://pro-api.coinmarketcap.com/v1/cryptocurrency/quotes/latest', [
                'query' => [
                    'slug' => $slug,
                    'convert' => 'BRL',
                ],
                'headers' => [
                    'X-CMC_PRO_API_KEY' => $this->apiKey,
                ],
            ]);

            $data = json_decode($response->getBody(), true);

            $cryptoData = reset($data['data']);

            if (isset($cryptoData['quote']['BRL']['price'])) {
                $priceBRL = $cryptoData['quote']['BRL']['price'];

                return $priceBRL;
                
            } else {
                throw new Exception('Criptomoeda não encontrada.');
            }
        } catch (Exception $e) {
            throw new Exception('Erro ao buscar dados da criptomoeda pelo slug: ' . $e->getMessage());
        }
    }
}
