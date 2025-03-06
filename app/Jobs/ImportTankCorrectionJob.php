<?php

namespace App\Jobs;

use App\Models\CargoTankCorrection;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Carbon;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class ImportTankCorrectionJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected $filePath;
    protected $fleetId;
    public function __construct($filePath, $fleetId)
    {
        $this->filePath = $filePath;
        $this->fleetId = $fleetId;
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
        $payloads = [];
        foreach ($payload as $key => $row) {
            if ($key > 0) {
                $payloads[] = [
                    'fleet_id' => $this->fleetId,
                    'temp' => $row[0]?? "",
                    'correction' => $row[1]?? ""
                ];
            }
        }

        $correction = (new CargoTankCorrection())->table($this->fleetId);
        $correction->where('fleet_id', $this->fleetId)->where('tank_id', $this->tankId)->delete();
        return $correction->insert($payloads);
    }
}
