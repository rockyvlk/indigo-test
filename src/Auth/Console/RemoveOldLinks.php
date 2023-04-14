<?php

declare(strict_types=1);

namespace App\Auth\Console;

use App\Auth\Services\Link\LinkCleanerInterface;
use Exception;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[
    AsCommand('auth:links:remove-old')
]
final class RemoveOldLinks extends Command
{
    public function __construct(private readonly LinkCleanerInterface $linkCleaner)
    {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        try {
            $this->linkCleaner->clean();
            return Command::SUCCESS;
        } catch (Exception $e) {
            return Command::FAILURE;
        }
    }
}
