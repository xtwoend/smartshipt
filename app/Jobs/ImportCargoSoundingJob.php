<?php

namespace App\Jobs;

use App\Models\CargoSounding;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Carbon;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class ImportCargoSoundingJob implements ShouldQueue
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
                $headers = array_diff($row, [null]);
            }
            if ($key >= 2) {
                // data
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
                            'ullage' => $row[0],
                            'mt' => is_numeric($row[$key]) ? $row[$key] : 0,
                            'created_at' => Carbon::now(),
                            'updated_at' => Carbon::now(),
                        ];
                    }
                }
            }
        }

        $sounding = (new CargoSounding())->table($this->fleetId);
        $sounding->where('fleet_id', $this->fleetId)->delete();
        return $sounding->insert($meterCubics);
    }
}
