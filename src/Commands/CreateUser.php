<?php

namespace Library\Commands;

use Illuminate\Console\Command;
use Library\Persisters\UserPersister;

class CreateUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'library:createuser';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates a new user';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(UserPersister $userPersister)
    {
        parent::__construct();
        $this->userPersister = $userPersister;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $name = $this->ask('Type the user name');
        $email = $this->ask('Type the user email');
        $password = $this->secret('Type the user password');
        $passwordMatch = $this->secret('Type the password again');

        if($password != $passwordMatch) {
            $this->error('Passwords do not match!');
            return Command::FAILURE;
        }

        if(!isset($name) or !isset($email) or !isset($password)) {
            $this->error('Error creating the user. Some fields are empty');
            return Command::FAILURE;
        }

        $this->userPersister->insert([
            'name' => $name,
            'email' => $email,
            'password' => $password
        ]);

        $this->info('User created successfully!');

        return Command::SUCCESS;
    }
}
