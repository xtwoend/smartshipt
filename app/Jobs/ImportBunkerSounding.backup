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
    protected $headers;
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

        /** 
         *  correction data 
         *  status : on maintance
        */

        // if ($this->checkPayload($payload)) {
        //     $payload = $this->correction($payload);
        // }

        /** convert to payload */
        $meterCubics = $this->converter($payload);
        $meterCubics = array_chunk($meterCubics, 1000);

        $sounding = (new BunkerSounding())->table($this->fleetId);
        $sounding->where('fleet_id', $this->fleetId)->where('tank_id', $this->tankId)->delete();
        foreach($meterCubics as $data) {
            $sounding->insert($data);
        }

        return true;
    }
    

    private function checkPayload(array $payloads): Bool
    {
        $a = isset($payloads[2][0]) ? (int)$payloads[2][0] : 0;
        $b = isset($payloads[3][0]) ? (int)$payloads[3][0] : 0;
        return count(range($a, $b)) > 2;
    }

    private function correction(array $payloads): Array
    {
        $final = array();
        foreach ($payloads as $key => $row) {
            $batas_atas = is_numeric($row[0]) ? (int)$row[0] : 0;
            $batas_bawah = is_numeric($payloads[$key + 1][0]) ? (int)$payloads[$key + 1][0] : 0;
            
            $sounding_cm = range($batas_atas, $batas_bawah);
            if (is_array($sounding_cm) && !empty($sounding_cm)) {
                foreach ($sounding_cm as $index => $data) {
                    // code
                }
            }
        }
    }

    private function converter(array $payloads): Array
    {
        $meterCubics = array();
        foreach ($payloads as $key => $row) {
            
            /** Defined of Headers */
            if ($key == 1) {
                $this->headers = array_diff($row, [null]);
            }

            /** Filled of Data */
            if ($key > 1) {
                $row = array_diff($row, [null]);
                if (!isset($row[0])) {
                    continue;
                }

                $meterCubics = array_merge($meterCubics, $this->addRow($row));
            }
        }

        return $meterCubics?? array();
    }

    private function addRow(array $row): Array
    {
        foreach ($this->headers as $key => $header) {
            if (is_numeric($header)) {
                $payloads[] = [
                    'fleet_id' => $this->fleetId,
                    'tank_id' => $this->tankId,
                    'trim_index' => $header,
                    'sounding_cm' => $row[0],
                    'volume' => is_numeric($row[$key]) ? $row[$key] : 0,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ];
            }
        }

        return $payloads?? array();
    }
}
