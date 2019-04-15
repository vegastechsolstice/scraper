<?php

namespace App\Service;

use App\Strategy\ScrapingStrategy;
use NumberFormatter;
use Symfony\Component\DomCrawler\Crawler;
use Throwable;

/**
 * Class StoreProductPage
 * @package App\Service
 */
class StoreProductPage implements ScrapingStrategy
{
    /**
     * @var Crawler
     */
    private $crawler;

    /**
     * DellProductPage constructor.
     * @param Crawler $crawler
     */
    public function __construct(Crawler $crawler)
    {
        $this->crawler = $crawler;
    }

    /**
     * @return string|null
     */
    private function retrieveName(): ?string
    {
        // Implementation details go here for generic store product name
        return null;
    }

    /**
     * @return string|null
     */
    private function retrieveModel(): ?string
    {
        // Implementation details go here for generic store product model
        return null;
    }

    /**
     * @return float|null
     */
    private function retrievePrice(): ?float
    {
        // Implementation details go here for generic store product price
        return null;
    }

    /**
     * @return array
     */
    public function scrape(): array
    {
        return [
            'name'  => $this->retrieveName(),
            'model' => $this->retrieveModel(),
            'price' => $this->retrievePrice(),
        ];
    }
}