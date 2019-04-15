<?php
namespace App\Service;

use Goutte\Client;
use Symfony\Component\DomCrawler\Crawler;

/**
 *
 * To modify this for a different site altogether, simply instantiate (or instead pass in via constructor, depending on your use case)
 * a different Page that implements ScrapingStrategy.  Create as many as you need for different stores/pages.
 * The details of what is needed for any generic page exist at that class level, meanwhile these services can handle
 * any ScrapingStrategy page, especially if it is refactored to allow passing in that interface
 *
 */

/**
 * Class StoreScraperService
 * @package App\Service
 */
class StoreScraperService
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
     * @var StoreProductPage
     */
    private $productPage;

    /**
     * ScraperService constructor
     * @param string $url
     */
    public function __construct(string $url)
    {
        $this->client = new Client();
        $this->crawler = $this->client->request('GET', $url);
        $this->productPage = new StoreProductPage($this->crawler);
    }

    /**
     * @return array
     */
    public function getItems(): array
    {
        return $this->productPage->scrape();
    }

    /**
     * @return StoreProduct
     */
    public function getStoreProduct(): StoreProduct
    {
        $productDetails = $this->getItems();

        return new StoreProduct($productDetails['name'], $productDetails['model'], $productDetails['price']);
    }
}