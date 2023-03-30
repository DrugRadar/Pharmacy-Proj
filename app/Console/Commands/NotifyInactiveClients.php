<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\Client;
use Illuminate\Console\Command;
use App\Mail\InactiveClientMail;
use Illuminate\Support\Facades\Mail;

class NotifyInactiveClients extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:notify-inactive-clients';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send email notifications to clients who have not logged in for a month.';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        // $clients = Client::where('last_visit', '<', Carbon::now()->subMonth())->get();
        $clients = Client::where('last_visit', '>', Carbon::now()->subMinute())->get();
        foreach ( $clients as $client ) {
            Mail::to($client->email)->send(new InactiveClientMail($client));
            $this->info('Notification sent to ' . $client->email);
        }
    }
}
