<?php
namespace App\Strategy;

/**
 * Class ScrapingContext
 * @package App\Strategy
 */
class ScrapingContext
{
    /**
     * @var ScrapingStrategy
     */
    private $strategy;

    /**
     * ScrapingContext constructor.
     * @param ScrapingStrategy $strategy
     */
    public function __construct(ScrapingStrategy $strategy)
    {
        $this->strategy = $strategy;
    }

    /**
     * @return array
     */
    public function scrape(): array
    {
        $this->strategy->scrape();
    }
}