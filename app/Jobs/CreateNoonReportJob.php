<?php

namespace App\Jobs;

use Carbon\Carbon;
use App\Mail\NoonReportEmail;
use Illuminate\Bus\Queueable;
use App\Report\CreateNoonReport;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class CreateNoonReportJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $fleet;
    protected $date;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($fleet, $date)
    {
        $this->fleet = $fleet;
        $this->date = $date;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $path = (new CreateNoonReport($this->fleet, $this->date))->handle();
        Mail::to(['aris.yulianto@pertamina.com', 'aristo.yulianto@gmail.com', 'aditans88@gmail.com'])
            ->send(new NoonReportEmail($this->fleet, $path));
    }
}
