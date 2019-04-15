<?php

namespace App\Service;

use App\Strategy\ScrapingStrategy;
use NumberFormatter;
use Symfony\Component\DomCrawler\Crawler;
use Throwable;

/**
 * Class DellProductPage
 * @package App\Service
 */
class DellProductPage implements ScrapingStrategy
{
    private const CURRENCY_FORMAT = 'en_US';

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
    private function retrieveProductName(): ?string
    {
        try {
            return $this->crawler->filter('#sharedPdPageProductTitle')->text();
        } catch (Throwable $t) {
            return null;
        }
    }

    /**
     * @return string|null
     */
    private function retrieveMfrPartNumber(): ?string
    {
        try {
            $clob = $this->crawler->filter('.uProductInfo')->text();
        } catch (Throwable $t) {
            return null;
        }

        if ($partialClob = stristr($clob, 'Manufacturer Part')) {
            $sectionArray = explode(' ', $partialClob);
            $partNumber   = trim($sectionArray[2]);
        }

        return $partNumber ?? null;
    }

    /**
     * @return float|null
     */
    private function retrievePrice(): ?float
    {
        try {
            $price = $this->crawler->filter('span[data-testid="sharedPSPDellPrice"]')->text();
        } catch (Throwable $t) {
            return null;
        }

        $formatter = new NumberFormatter(self::CURRENCY_FORMAT, NumberFormatter::CURRENCY);
        return $formatter->parse(trim($price));
    }

    /**
     * @return string|null
     */
    private function retrieveCashBack(): ?string
    {
        try {
            return trim($this->crawler->filter('.rewards-popover')->text());
        } catch (Throwable $t) {
            return null;
        }
    }

    /**
     * @return string|null
     */
    private function retrieveCouponCode(): ?string
    {
        try {
            return trim($this->crawler->filter('.message-bar-content > .mb-long-message')->text());
        } catch (Throwable $t) {
            return null;
        }
    }

    /**
     * @return array
     */
    public function scrape(): array
    {
        return [
            'productName' => $this->retrieveProductName(),
            'partNumber'  => $this->retrieveMfrPartNumber(),
            'price'       => $this->retrievePrice(),
            'cashBack'    => $this->retrieveCashBack(),
            'couponCode'  => $this->retrieveCouponCode(),
        ];
    }
}