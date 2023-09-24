<?php

namespace App\Jobs;

use Carbon\Carbon;
use App\Models\Fleet;
use Illuminate\Bus\Queueable;
use App\Report\CreateNoonReport;
use App\Jobs\CreateNoonReportJob;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class NoonReportFleet implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        foreach(Fleet::active()->get() as $fleet)
        {
            CreateNoonReportJob::dispatch($fleet, Carbon::now()->format('Y-m-d H:i:s'));
        }
    }
}
