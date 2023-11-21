<?php


namespace App\Command;


use App\Service\UpdateTLEService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class UpdateTLEISSCommand extends Command
{
    protected static $defaultName = 'tle:iss:update';
    private ParameterBagInterface $params;
    private UpdateTLEService $updateIssTle;

    public function __construct(ParameterBagInterface $params, UpdateTLEService $updateIssTle)
    {
        parent::__construct();
        $this->params = $params;
        $this->updateIssTle = $updateIssTle;
    }

    protected function configure()
    {
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('Updating ISS TLE');

        // Only once per day
        $this->updateIssTle->updateIssTleFile();
        $output->writeln('Succes of the update of the ISS TLE');

        return Command::SUCCESS;
    }


}