<?php


namespace App\Command;


use App\Predict\UpdateIssTle;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class UpdateTLEISSCommand extends Command
{
    protected static $defaultName = 'tle:iss:update';
    private ParameterBagInterface $params;

    public function __construct(ParameterBagInterface $params)
    {
        parent::__construct();
        $this->params = $params;
    }

    protected function configure()
    {
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('Updating ISS TLE');
        $rootPath = $this->params->get('kernel.project_dir');

        // Only once per day
        UpdateIssTle::updateIssTleFile();
        $output->writeln('Succes of the update of the ISS TLE');

        return Command::SUCCESS;
    }


}