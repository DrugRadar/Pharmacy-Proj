<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Spatie\Permission\Models\Role;

class CreateAdminCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:admin {--email= : The admin email address} {--password= : The admin password}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new admin user';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $email = $this->option('email');
        $password = $this->option('password');

        $user = new User;
        $user->name = 'Admin';
        $user->email = $email;
        $user->password = bcrypt($password);
        $user->is_admin = true;
        // $role=Role::findByName('admin', 'web');
        // $user->assignRole(['admin']);
        $user->save();

        $this->info('Admin user created successfully!');
    }
}
