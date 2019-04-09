<?php

namespace App\Command;

use App\Drink\DrinkFactory;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class MakeDrinkCommand extends Command
{
    protected static $defaultName = 'make:drink';

    public function __construct($name = null)
    {
        parent::__construct($name);
    }

    protected function configure()
    {
        $this
            ->setDescription('This now will make you a drink. A nice! I like!')
            ->addArgument('type', InputArgument::OPTIONAL, 'Which drink do you want?')
            ->addOption('sugar', null, InputOption::VALUE_OPTIONAL, 'Do you want sugar?')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $type = $input->getArgument('type');
        $sugarAmount = $input->getOption('sugar');
        $factory = new DrinkFactory($type);
        $output->writeln((string)$factory->make((int)$sugarAmount));

    }
}
