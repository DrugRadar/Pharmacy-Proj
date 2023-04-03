<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ScanNewOrders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'orders:scan-new-orders';

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
        //
        $pharmacies=DB::table('pharmacies')->get();
        $new_orders = DB::table('orders')
        ->where('status', 'new')
        ->get();
        foreach ($new_orders as $order) {
            $pharmacy = null;
            foreach ($pharmacies as $p) {
                if ($p->area_id == $order->client_address_id) {
                    // if ($pharmacy == null || $p->priority > $pharmacy->priority) {
                    $pharmacy = $p;
                    // }
                }
            }
            if ($pharmacy != null) {
                DB::table('orders')
                    ->where('id', $order->id)
                    ->update(['status' => 'processing', 'assigned_pharmacy_id' => $pharmacy->id]);
            }
        }
    }
}
