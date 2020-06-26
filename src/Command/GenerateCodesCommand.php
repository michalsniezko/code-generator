<?php

namespace App\Command;

use App\Service\CodeGenerator;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class GenerateCodesCommand extends Command
{
    /** @var string  */
    protected static $defaultName = 'generate';

    /** @var CodeGenerator */
    private $generator;

    /**
     * GenerateCodesCommand constructor.
     * @param CodeGenerator $generator
     */
    public function __construct(CodeGenerator $generator)
    {
        $this->generator = $generator;

        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->setDescription('Generates random unique codes.')
            ->addArgument('number', InputArgument::REQUIRED, '# of codes to generate')
            ->addArgument('length', InputArgument::REQUIRED, 'Length of each code')
            ->addArgument('path', InputArgument::REQUIRED, 'Filepath to save .txt file');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $path = $input->getArgument('path');
        $number = (int) $input->getArgument('number');
        $length = (int) $input->getArgument('length');

        if (!$length > 0 || !$number > 0 || !is_numeric($length) || !is_numeric($number)) {
            $output->writeln('Length of code and number of codes must be number greater than 0!');
            return Command::FAILURE;
        }

        $this->generator->getFileWithCodes($number, $length, $path);

        $output->writeln(sprintf('Saved %d codes, %d characters each to %s', $number, $length, $path));
        return Command::SUCCESS;
    }
}
