<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\Fleet;
use Illuminate\Console\Command;
use App\Report\CreateAlarmReport;

class CreateAlarmReportCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'report:alarm {fleetId} {date?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Alarm report';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        $id = $this->argument('fleetId');
        $to = $this->argument('date');

        $to = $to ? Carbon::parse($to)->format('Y-m-d H:i:s') : Carbon::now()->format('Y-m-d 13:00:00');
        $fleet = Fleet::findOrFail($id);

        (new CreateAlarmReport($fleet, $to))->handle();

        return Command::SUCCESS;
    }
}
