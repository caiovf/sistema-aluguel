<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Contract;
use Carbon\Carbon;

class DisableExpiredContracts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'contracts:disable-expired-contracts';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Desativa contratos cuja data de já passou';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $today = Carbon::today();

        $expiredContracts = Contract::where('active_contract', true)
            ->where('end_date', '<', $today)
            ->update(['active_contract' => false]);

        $this->info("{$expiredContracts} contratos desativados.");
    }
}
