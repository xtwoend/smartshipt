<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\Fleet;
use Illuminate\Console\Command;
use App\Jobs\CreateAlarmReportJob;

class ResendReportDaily extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'report:resend {date}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Resend Report daily';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $date = $this->argument('date');
        foreach(Fleet::active()->get() as $fleet)
        {
            CreateAlarmReportJob::dispatch($fleet, Carbon::parse($date)->format('Y-m-d 06:00:00'));
        }
        
        return Command::SUCCESS;
    }
}
