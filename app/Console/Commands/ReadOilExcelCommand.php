<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Aspera\Spreadsheet\XLSX\Reader;

class ReadOilExcelCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'oil-lube:parse';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Read file excel and insert to db';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $path = storage_path('oil-lubes.xlsx');
        
        $reader = new Reader();
        $reader->open($path);
        
        $data = [];
        $isheader = 0;
        foreach ($reader as $row) {
            if($isheader > 0){
                $data = [
                    'Lube' => (string) $row[0],
                    'pertamina_international_shipping' => (string) $row[1],
                    'Area' => (string) $row[2],
                    'Manufacture' => (string) $row[3],
                    'Component' => (string) $row[4],
                    'Application' => (string) $row[5],
                    'Model' => (string) $row[6],
                    'Equipment_Description' => (string) $row[7],
                    'Equipment_Number' => (string) $row[8],
                    'Sample_Date' => Carbon::createFromFormat('d-m-y', $row[9])->format('Y-m-d'),
                    'RH_Oil' => (float) $row[10],
                    'RH_Engine' => (float) $row[11],
                    'P' => (float) $row[12],
                    'TAN' => (float) $row[13],
                    'Vk_40' => (float) $row[14],
                    'Ca' => (float) $row[15],
                    'Zn' => (float) $row[16],
                    'Mg' => (float) $row[17],
                    'TBN_D4739' => (float) $row[18],
                    'TBN' => (float) $row[19],
                    'Wt' => (float) $row[20],
                    'Soot' => (float) $row[21],
                    'Fu' => (float) $row[22],
                    'Oxi' => (float) $row[23],
                    'Nit' => (float) $row[24],
                    'Ag' => (float) $row[25],
                    'Sn' => (float) $row[26],
                    'Pb' => (float) $row[27],
                    'Fe' => (float) $row[28],
                    'Cu' => (float) $row[29],
                    'Cr' => (float) $row[30],
                    'Al' => (float) $row[31],
                    'Vk_100' => (float) $row[32],
                    'ISO_4406' => (float) $row[33],
                    'NAS_1638' => (float) $row[34],
                    'Colour' => (float) $row[35],
                    'Si' => (float) $row[36],
                    'Na' => (float) $row[37],
                    'V' => (float) $row[38],
                    'CSC' => (float) $row[39],
                    'Density' => (float) $row[40],
                    'FP_COC' => (float) $row[41],
                    'Sq_I' => (float) $row[42],
                    'Sq_II' => (float) $row[43],
                    'Sq_III' => (float) $row[44],
                    'PI' => (float) $row[45],
                    'TI' => (float) $row[46],
                    'PP' => (float) $row[47],
                    'Sulf_Ash' => (float) $row[48],
                    'Wt_D_95' => (float) $row[49],
                    'Wt_KF' => (float) $row[50],
                    'Gly' => (float) $row[51],
                    'Sulf' => (float) $row[52],
                    'Mo' => (float) $row[53],
                    'wt_Karl_Fi' => (float) $row[54],
                    'Ni' => (float) $row[55],
                    'B' => (float) $row[56],
                    'VI' => (float) $row[57],
                    'PI_D4055' => (float) $row[58],
                    'RBOT' => (float) $row[59],
                    'Air_Release' => (float) $row[60],
                    'Ba' => (float) $row[61],
                    'PQ_Index' => (float) $row[62],
                    'Status' => (string) $row[63],
                    'Recomendation' => (string) $row[64],
                ];
                DB::table('oil_lubes')->insert($data);
            }else{
                $isheader = 1;
            }
        }
        // $data = collect($data);
        // $chunks = $data->chunk(500);
        // foreach($chunks as $chunk) {
        //     DB::table('oil_lubes')->insert($chunk->toArray());
        // }

        $reader->close();

        return Command::SUCCESS;
    }
}
