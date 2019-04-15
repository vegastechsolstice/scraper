<?php

namespace App\Strategy;

/**
 * Interface ScrapingStrategy
 * @package App\Strategy
 */
interface ScrapingStrategy
{
    /**
     * @return array
     */
    public function scrape(): array;
}