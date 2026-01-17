<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Client;

class AssignSalesRepsSeeder extends Seeder
{
    public function run(): void
    {
        $clients = Client::all();
        $count = 0;

        foreach ($clients as $client) {
            // Find most frequent sales_id in invoices for this client
            $topSalesId = DB::table('tbm_invoice')
                ->where('client_id', $client->id)
                ->whereNotNull('sales_id')
                ->where('sales_id', '>', 0)
                ->select('sales_id', DB::raw('count(*) as total'))
                ->groupBy('sales_id')
                ->orderByDesc('total')
                ->value('sales_id');

            if ($topSalesId) {
                // Determine if this sales_id actually exists in tbm_sales
                $exists = DB::table('tbm_sales')->where('id', $topSalesId)->exists();
                
                if ($exists) {
                    $client->sales_rep_id = $topSalesId;
                    $client->save();
                    $count++;
                }
            }
        }

        $this->command->info("Assigned Sales Reps to {$count} clients based on invoice history.");
    }
}
