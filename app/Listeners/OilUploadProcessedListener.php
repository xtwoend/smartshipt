<?php

namespace App\Listeners;

use App\Models\OilLube;
use App\Models\FleetOilLube;
use App\Events\OilUploadProcessed;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class OilUploadProcessedListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\OilUploadProcessed  $event
     * @return void
     */
    public function handle(OilUploadProcessed $event)
    {
        $oils = OilLube::whereNotNull('fleet_id')->get();
        
        foreach($oils as $oil) {
            FleetOilLube::table($oil->fleet_id)->insert([
                'fleet_id' => $oil->fleet_id,
                'sample_date' => $oil->Sample_Date,
                'component' => $oil->Component,
                'lube' => $oil->Lube,
                'manufacture' => $oil->Manufacture,
                'application' => $oil->Application,
                'model' => $oil->Model,
                'Equipment_Description' => $oil->Equipment_Description,
                'Equipment_Number' => $oil->Equipment_Number,
                'RH_Oil' => $oil->RH_Oil,
                'RH_Engine' => $oil->RH_Engine,
                'P' => $oil->P,
                'TAN' => $oil->TAN,
                'Vk_40' => $oil->Vk_40,
                'Ca' => $oil->Ca,
                'Zn' => $oil->Zn,
                'Mg' => $oil->Mg,
                'TBN_D4739' => $oil->TBN_D4739,
                'TBN' => $oil->TBN,
                'Wt' => $oil->Wt,
                'Soot' => $oil->Soot,
                'Fu' => $oil->Fu,
                'Oxi' => $oil->Oxi,
                'Nit' => $oil->Nit,
                'Ag' => $oil->Ag,
                'Sn' => $oil->Sn,
                'Pb' => $oil->Pb,
                'Fe' => $oil->Fe,
                'Cu' => $oil->Cu,
                'Cr' => $oil->Cr,
                'Al' => $oil->Al,
                'Vk_100' => $oil->Vk_100,
                'ISO_4406' => $oil->ISO_4406,
                'NAS_1638' => $oil->NAS_1638,
                'Colour' => $oil->Colour,
                'Si' => $oil->Si,
                'Na' => $oil->Na,
                'V' => $oil->V,
                'CSC' => $oil->CSC,
                'Density' => $oil->Density,
                'FP_COC' => $oil->FP_COC,
                'Sq_I' => $oil->Sq_I,
                'Sq_II' => $oil->Sq_II,
                'Sq_III' => $oil->Sq_III,
                'PI' => $oil->PI,
                'TI' => $oil->TI,
                'PP' => $oil->PP,
                'Sulf_Ash' => $oil->Sulf_Ash,
                'Wt_D_95' => $oil->Wt_D_95,
                'Wt_KF' => $oil->Wt_KF,
                'Gly' => $oil->Gly,
                'Sulf' => $oil->Sulf,
                'Mo' => $oil->Mo,
                'wt_Karl_Fi' => $oil->wt_Karl_Fi,
                'Ni' => $oil->Ni,
                'B' => $oil->B,
                'VI' => $oil->VI,
                'PI_D4055' => $oil->PI_D4055,
                'RBOT' => $oil->RBOT,
                'Air_Release' => $oil->Air_Release,
                'Ba' => $oil->Ba,
                'PQ_Index' => $oil->PQ_Index,
                'Status' => $oil->Status,
                'Recomendation' => $oil->Recomendation
            ]);
        }
    }
}
