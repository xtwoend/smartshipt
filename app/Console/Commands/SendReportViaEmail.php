<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use App\Jobs\CreateAlarmReportJob;

class SendReportViaEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'report:send {fleetId}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send Report via Email';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $id = $this->argument('fleetId');
        $fleet = Fleet::find($id);
        
        CreateAlarmReportJob::dispatch($fleet, Carbon::now()->format('Y-m-d H:i:s'));
        
        return Command::SUCCESS;
    }
}
