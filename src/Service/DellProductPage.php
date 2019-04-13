<?php
namespace App\Service;

use Symfony\Component\DomCrawler\Crawler;

/**
 * Class DellProductPage
 * @package App\Service
 */
class DellProductPage
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
     * @return string
     */
    public function retrieveProductName(): string
    {
//        return $this->crawler->filter('.fsr')->text();
        return $this->crawler->filter('#sharedPdPageProductTitle')->text();
    }
}