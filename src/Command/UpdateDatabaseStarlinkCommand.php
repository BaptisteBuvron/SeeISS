<?php

namespace App\Command;

use App\Service\UpdateDatabaseService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class UpdateDatabaseStarlinkCommand extends Command
{
    private UpdateDatabaseService $updateService;
    protected static $defaultName = 'db:update:starlink';


    public function __construct(UpdateDatabaseService $updateDatabase)
    {
        parent::__construct();
        $this->updateService = $updateDatabase;
    }

    protected function configure()
    {
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('Updating DataBase Starlink, please wait...');
        $this->updateService->updateDatabaseStarlink();
        $output->writeln('Succes of the update of the Database');
        return Command::SUCCESS;
    }

}