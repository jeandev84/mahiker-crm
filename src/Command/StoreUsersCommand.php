<?php

namespace App\Command;

use App\Manager\UserManager;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'app:users:store',
    description: 'Добавление пользователей',
)]
class StoreUsersCommand extends Command
{

    /**
     * @param UserManager $userManager
    */
    public function __construct(protected UserManager $userManager)
    {
        parent::__construct('app:users:store');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $count = $this->userManager->createFakeUsers();

        /* $io->success("User admin [{$user->getEmail()}] successfully created!"); */

        $io->success("({$count}) пользователей успешно добавлены.");

        return Command::SUCCESS;
    }
}
