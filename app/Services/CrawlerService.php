<?php

namespace App\Services;

use Symfony\Component\DomCrawler\Crawler;
use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;

class CrawlerService
{
    public function getValueFromURL($code)
    {
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