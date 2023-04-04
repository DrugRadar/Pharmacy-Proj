<?php

namespace App\Console\Commands;

use App\Models\Doctor;
use Illuminate\Console\Command;

class UnbanUserCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:unban-doctor';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $doctorsToUnban = Doctor::where('banned_at', '<=', now()->subDays(3))
                         ->get();

    foreach ($doctorsToUnban as $doctor) {
        $doctor->banned_at = Null;
        $doctor->save();
    }

    $this->info(count($doctorsToUnban) . ' users have been unbanned.');
    }
}
