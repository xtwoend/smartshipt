<?php

namespace App\Jobs;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use App\Mail\AlarmReportEmail;
use App\Report\CreateAlarmReport;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use App\Report\CreateSensorConditionReport;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class CreateAlarmReportJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $fleet;
    protected $date;

    /**
     * The number of seconds the job can run before timing out.
     *
     * @var int
     */
    public $timeout = 600;

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
        $attachment1 = (new CreateAlarmReport($this->fleet, $this->date))->handle();
        $attachment2 = (new CreateSensorConditionReport($this->fleet, $this->date))->handle();

        $pics = collect($this->fleet->pic);

        $to = $pics->sortByDesc('primary')->first();
        $mores = $pics->where('primary', 0)->all();
        $emails = [];
        foreach($mores as $cc) {
            $emails[] = $cc->pic_email;
        }

        $to = $to ?? json_decode(json_encode(['pic_email' => 'aris.yulianto@pertamina.com', 'pic_name' => 'Aris Yulianto']));

        $mail = Mail::to($to->pic_email, $to->pic_name)->cc($emails)->send(new AlarmReportEmail($this->fleet, [$attachment1, $attachment2], $this->date));

        // foreach($this->fleet->pic as $pic) {
        //     Mail::to($pic->pic_email, $pic->pic_name)->send(new AlarmReportEmail($this->fleet, [$attachment1, $attachment2], $this->date));
        // }
    }
}
