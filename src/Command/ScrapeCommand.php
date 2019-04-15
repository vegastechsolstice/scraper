<?php
namespace App\Command;

use App\Service\DellScraperService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class ScrapeCommand
 * @package App\Command
 */
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

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|void|null
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $urls = [
            'https://www.dell.com/en-us/shop/accessories/apd/210-agnk?c=us&l=en&s=dhs&cs=19&sku=210-AGNK',
            'http://www.dell.com/en-us/shop/accessories/apd/341-2939?c=us&l=en&s=dhs&cs=19&sku=341-2939',
            'http://www.dell.com/en-us/shop/accessories/apd/580-agjp?c=us&l=en&s=dhs&cs=19&sku=580-AGJP',
        ];

        foreach ($urls as $url) {
            $output->writeln('Scraped Page Items:');
            $this->scraperService = new DellScraperService($url);

            foreach ($this->scraperService->getItems() as $item) {
                $output->writeln($item);
            }
            $output->writeln('');
        }
    }
}
