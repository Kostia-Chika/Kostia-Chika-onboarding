<?php

namespace Alva\Training2CLI\Console;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class StoresInfo extends Command
{
    public function __construct(
        \Magento\Store\Model\ResourceModel\Store\CollectionFactory $storeCollectionFactory,
    )
    {
        $this->storeCollectionFactory = $storeCollectionFactory;
        parent::__construct();
    }

    protected function configure(): void
    {
        $this->setName('store:info');
        $this->setDescription('Displays a list of Magento store ');
        parent::configure();

    }

    /**
     * Get a list of stores
     *
     * @return string return array of store as string
     */
    public function getStore(): string
    {
        $collection = $this->storeCollectionFactory->create();
        $result = '';
        foreach ($collection as $store) {
            $result .= print_r($store->getData(), true);
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

        $output->writeln('<info>' . $this->getStore() . '</info>');

        return $exitCode;
    }
}
