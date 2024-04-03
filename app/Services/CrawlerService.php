<?php

namespace App\Services;

use Symfony\Component\DomCrawler\Crawler;
use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use Illuminate\Support\Facades\Log;

class CrawlerService
{
    public function getValueFromURL($code)
    {
        Log::debug('check code: ' . $code);
        if($code == 'BTCI11') {
            return 9.9;
        }
        $url = "https://www.google.com/finance/quote/$code:BVMF";

        $client = new Client([
            RequestOptions::VERIFY => false, // Desabilitar a verificação do certificado SSL
        ]);

        $response = $client->request('GET', $url);
        $html = $response->getBody()->getContents();

        $crawler = new Crawler($html);
        $value = $crawler->filter('.kf1m0')->text();

        return $value;
    }
}