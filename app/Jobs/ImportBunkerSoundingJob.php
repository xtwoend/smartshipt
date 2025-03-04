<?php

namespace App\Jobs;
set_time_limit(0);

use App\Models\BunkerSounding;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Carbon;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class ImportBunkerSoundingJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected $filePath;
    protected $fleetId;
    protected $tankId;
    public function __construct($filePath, $fleetId, $tankId)
    {
        $this->filePath = $filePath;
        $this->fleetId = $fleetId;
        $this->tankId = $tankId;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $spreadsheet = new Spreadsheet();
        $reader = new Xlsx();

        $spreadsheet = $reader->load($this->filePath);
        $payload = $spreadsheet->getActiveSheet()->toArray();

        /** Remove Legend */
        if (is_array($payload)) {
            $payload = array_slice($payload, 2);
        }

        $meterCubics = [];
        foreach ($payload as $key => $row) {
            /** Header */
            if ($key == 0) {
                $headers = array_diff($row, [null]);
            }

            /** Field */
            if ($key > 0) {
                $row = array_diff($row, [null]);
                if (!isset($row[0])) {
                    continue;
                }

                foreach ($headers as $key => $header) {
                    if (is_numeric($header)) {
                        $meterCubics[] = [
                            'fleet_id' => $this->fleetId,
                            'tank_id' => $this->tankId,
                            'trim_index' => $header,
                            'sounding_cm' => (double)$row[0]?? 0,
                            'volume' => is_numeric($row[$key]) ? (double)$row[$key] : 0,
                            'created_at' => Carbon::now(),
                            'updated_at' => Carbon::now()
                        ];
                    }
                }
            }
        }

        $meterCubics = array_chunk($meterCubics, 1000);

        $sounding = (new BunkerSounding())->table($this->fleetId);
        $sounding->where('fleet_id', $this->fleetId)->where('tank_id', $this->tankId)->delete();
        foreach($meterCubics as $data) {
            $sounding->insert($data);
        }

        return true;
    }
}
