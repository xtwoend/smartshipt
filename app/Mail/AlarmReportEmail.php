<?php

namespace App\Mail;

use Carbon\Carbon;
use App\Models\Sensor;
use App\Models\NavigationLog;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\DB;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Contracts\Queue\ShouldQueue;

class AlarmReportEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $fleet;
    public $attachment;
    public $status;
    public $avgSpeed;
    public $sensors;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($fleet, array $attachment, $date)
    {
        $to = $date;
        $to = $to ? Carbon::parse($to)->format('Y-m-d H:i:s'): Carbon::now()->format('Y-m-d H:i:s');
        $from = Carbon::parse($to)->subHours(24)->format('Y-m-d H:i:s');
        
        $this->fleet = $fleet;
        $this->attachment = $attachment;
        $this->status = [
            'at_port' => 'At Port',
            'underway' => 'Underway',
            'lost_connection' => 'Lost Connection',
            'at_anchorage' => 'At Anchorage',
            'other' => 'Other'
        ];
        $this->avgSpeed = NavigationLog::table($this->fleet->id, $from)
        ->whereBetween('terminal_time', [$from, $to])
        ->where('sog', '>=', 2)
        ->avg('sog');

        $this->sensors = Sensor::select(DB::raw("COUNT(IF(sensors.condition='ABNORMAL', 1, 0)) as abnormal, COUNT(*) as total"))->where('fleet_id', $this->fleet->id)->get();
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Daily Alarm Monitoring Report By PIS Smartship',
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
            view: 'emails.alarm-report',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        $attachments = [];
        foreach($this->attachment as $attachment) {
            $attachments[] = Attachment::fromPath(public_path($attachment));
        }
        
        return $attachments;
    }
}
