<?php
namespace App\Command;

use App\Service\ScraperService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ScrapeCommand extends Command
{
    /**
     * @var string
     */
    protected static $defaultName = 'app:scrape';

    /**
     * @var ScraperService
     */
    private $scraperService;

    /**
     * ScrapeCommand constructor.
     * @param string|null $name
     */
    public function __construct(string $name = null)
    {
        parent::__construct($name);
    }

    protected function configure()
    {
        $this->setDescription('Scrapes a website');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('Test this message');
        $this->scraperService = new ScraperService('https://www.dell.com/en-us/shop/accessories/apd/210-agnk?c=us&l=en&s=dhs&cs=19&sku=210-AGNK');
//        $this->scraperService = new ScraperService('https://google.com');
        $output->write($this->scraperService->getProductName());
        $output->writeln('Success');
    }
}