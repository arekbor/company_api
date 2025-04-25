<?php

declare(strict_types=1);

namespace App\Api\Command;

use App\Application\Shared\CommandBusInterface;
use App\Application\User\Command\RegisterAdmin\RegisterAdminCommand;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

#[AsCommand(
    name: 'app:register-admin',
    description: 'Creates admin user.'
)]
final class RegisterAdmin extends Command
{
    public function __construct(
        private readonly CommandBusInterface $commandBus,
        private readonly ParameterBagInterface $parameter
    ) {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        try {
            $email = $this->parameter->get('app.admin.email');
            $password = $this->parameter->get('app.admin.password');

            $this->commandBus->handle(new RegisterAdminCommand($email, $password));
        } catch (\Throwable $ex) {
            $io->error($ex->getMessage());
            return Command::FAILURE;
        }

        $io->success("Admin successfully registered.");

        return Command::SUCCESS;
    }
}
