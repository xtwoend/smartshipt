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

        /** Remove Legend */
        if (is_array($payload)) {
            $payload = array_slice($payload, 2);
        }

        $batches = [];
        $currentBatch = [];
        $rowCounter = 0; // Counter for rows in the current batch, excluding header
        $trims = [];
        $heel = [];
        // Process the data
        foreach ($payload as $rowKey => $row) {
            // Skip the header row
            if ($rowKey === 0) {
                $headers = array_diff($row, [null]);
                continue;
            }

            $row = array_diff($row, [null]);
            if (!isset($row[0])) {
                continue;
            }

            foreach ($headers as $headerKey => $header) {
                if (is_numeric($header) && isset($row[$headerKey])) {
                    $trims[$header] = $header;
                    $data = [
                        'fleet_id' => $this->fleetId,
                        'tank_id' => $this->tankId,
                        'trim_index' => $header,
                        'heel_index' => 0,
                        'level' => (float)($row[1] ?? 0),
                        'ullage' => (float)($row[0] ?? 0),
                        'volume' => is_numeric($row[$headerKey]) ? (float)$row[$headerKey] : 0,
                        'diff' => (float)($row[2] ?? 0),
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now()
                    ];
                    $currentBatch[] = $data;
                    $rowCounter++;
                }
            }

            // Check if the current batch is full OR if it's the last row
            if ($rowCounter >= 1000 || $rowKey === count($payload) - 1) {
                $batches[] = $currentBatch;
                $currentBatch = [];
                $rowCounter = 0;
            }
        }

        // Add the last batch if it's not empty
        if (!empty($currentBatch)) {
            $batches[] = $currentBatch;
        }

        $sounding = (new CargoSounding())->table($this->fleetId);
        $sounding->where('fleet_id', $this->fleetId)->where('tank_id', $this->tankId)->delete();
        foreach ($batches as $batch) {
            $sounding->insert($batch);
        }
        return true;
    }
}
