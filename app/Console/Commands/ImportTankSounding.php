<?php

namespace App\Console\Commands;

use App\Jobs\ImportTankSoundingJob;
use Illuminate\Console\Command;

class ImportTankSounding extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sounding:import {fleetId} {tankId}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $file = storage_path('app/import/Panjang.xlsx');
        dispatch_sync(new ImportTankSoundingJob($file, $this->argument('fleetId'), $this->argument('tankId')));

        return Command::SUCCESS;
    }
}
