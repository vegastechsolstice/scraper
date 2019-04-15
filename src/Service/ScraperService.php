<?php
namespace App\Service;

use Goutte\Client;
use Symfony\Component\DomCrawler\Crawler;

/**
 * Class ScraperService
 * @package App\Service
 */
class ScraperService
{
    /**
     * @var Client
     */
    private $client;

    /**
     * @var Crawler
     */
    private $crawler;

    /**
     * @var DellProductPage
     */
    private $dellProductPage;

    /**
     * ScraperService constructor
     * @param string $url
     */
    public function __construct(string $url)
    {
        $this->client = new Client();
        $this->crawler = $this->client->request('GET', $url);
        $this->dellProductPage = new DellProductPage($this->crawler);
    }

    /**
     * @return string
     */
    public function getProductName(): string
    {
        return $this->dellProductPage->retrieveProductName();
    }
}