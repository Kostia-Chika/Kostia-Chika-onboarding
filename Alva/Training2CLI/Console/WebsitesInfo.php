<?php

namespace Alva\Training2CLI\Console;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class WebsitesInfo extends Command
{
    public function __construct(
        \Magento\Store\Model\ResourceModel\Website\CollectionFactory $websiteCollectionFactory,
    )
    {
        $this->websiteCollectionFactory = $websiteCollectionFactory;
        parent::__construct();
    }

    protected function configure(): void
    {
        $this->setName('website:info');
        $this->setDescription('Displays a list of Magento websites');
        parent::configure();

    }

    /**
     * Get a list of websites
     *
     * @return string return array of website as string
     */
    public function getWebsite(): string
    {
        $collection = $this->websiteCollectionFactory->create();
        $result = '';
        foreach ($collection as $website) {
            $result .= print_r($website->getData(), true);
        }
        return $result;
    }

    /**
     * Execute the command
     *
     * @param InputInterface $input
     * @param OutputInterface $output
     *
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $exitCode = 0;

        $output->writeln('<info>' . $this->getWebsite() . '</info>');

        return $exitCode;
    }
}
