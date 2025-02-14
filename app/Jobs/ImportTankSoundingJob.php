<?php

namespace App\Jobs;

use App\Models\CargoTankSounding;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Carbon;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class ImportTankSoundingJob implements ShouldQueue
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
        $meterCubics = [];
        foreach ($payload as $key => $row) {
            if ($key == 1) {
                $header = array_diff($row, [null]);
            }
            if ($key >= 2) {
                // data
                $row = array_diff($row, [null]);
                if (!isset($row[0])) {
                    continue;
                }
                foreach ($header as $khdr => $hdr) {
                    $meterCubics[] = [
                        'fleet_id' => $this->fleetId,
                        'tank_id' => $this->tankId,
                        'trim_index' => $hdr,
                        'sounding_cm' => $row[0],
                        'volume' => $row[$khdr],
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),
                    ];
                }
            }
        }
        
        $sounding = (new CargoTankSounding())->table($this->fleetId);
        $sounding->where('fleet_id', $this->fleetId)->delete();
        $sounding->insert($meterCubics);
    }
}
