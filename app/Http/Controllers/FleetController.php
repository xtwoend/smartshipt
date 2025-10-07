<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Alarm;
use App\Models\Fleet;
use App\Models\FleetDoc;
use App\Models\FleetOilLube;
use Illuminate\Http\Request;

class FleetController extends Controller
{
    protected function accessFleet($id, Request $request)
    {
        $user = $request->user();
        if ($user->is_root || $user->can('All Fleets') || in_array($id, $user->fleets->pluck('id')->toArray())) {
        } else {
            return abort('403');
        }
    }

    public function info($id, Request $request)
    {
        $this->accessFleet($id, $request);

        $fleet =  Fleet::findOrFail($id);
        return view('fleet.info', compact('fleet'));
    }

    public function nav($id, Request $request)
    {
        $this->accessFleet($id, $request);

        $fleet =  Fleet::with('navigation')->findOrFail($id);
        return view('fleet.index', compact('fleet'));
    }

    public function track($id, Request $request)
    {
        $this->accessFleet($id, $request);

        $fleet =  Fleet::with('navigation')->findOrFail($id);
        return view('fleet.track', compact('fleet'));
    }

    public function engine($id, Request $request)
    {
        $this->accessFleet($id, $request);

        $fleet =  Fleet::findOrFail($id);
        $routeName = $request->route()->getName();
        if ($fleet->submenu()->count() > 0) {
            $page = $fleet->submenu()->where('route', 'fleet.engine')->first();
            if ($page && !is_null($page->views)) {
                return view($page->views, compact('fleet'));
            }
        }
        return view('fleet.engine', compact('fleet'));
    }

    public function cargo($id, Request $request)
    {
        $this->accessFleet($id, $request);

        $fleet =  Fleet::findOrFail($id);
        $routeName = $request->route()->getName();
        if ($fleet->submenu()->count() > 0) {
            $page = $fleet->submenu()->where('route', 'fleet.cargo')->first();
            if ($page && !is_null($page->views)) {
                return view($page->views, compact('fleet'));
            }
        }
        return view('fleet.cargo', compact('fleet'));
    }

    public function bunker($id, Request $request)
    {
        $this->accessFleet($id, $request);

        $fleet =  Fleet::findOrFail($id);
        return view('fleet.fuel', compact('fleet'));
    }

    public function balast($id, Request $request)
    {
        $this->accessFleet($id, $request);

        $fleet =  Fleet::findOrFail($id);
        return view('fleet.balast', compact('fleet'));
    }

    public function trend($id, Request $request)
    {
        $this->accessFleet($id, $request);

        $fleet = Fleet::findOrFail($id);
        return view('fleet.trend', compact('fleet'));
    }

    public function notes($id, Request $request)
    {
        $this->accessFleet($id, $request);

        $fleet = Fleet::findOrFail($id);
        return view('fleet.notes', compact('fleet'));
    }

    public function docs($id, Request $request)
    {
        $this->accessFleet($id, $request);

        $fleet = Fleet::findOrFail($id);
        return view('fleet.docs', compact('fleet'));
    }

    public function readDocs($id, Request $request)
    {
        $this->accessFleet($id, $request);

        $doc = FleetDoc::find($id);

        $fleet = $doc->fleet;

        return view('fleet.doc_read', compact('fleet', 'doc'));
    }

    public function reports($id, Request $request)
    {
        $this->accessFleet($id, $request);

        $fleet = Fleet::findOrFail($id);
        return view('fleet.reports', compact('fleet'));
    }

    public function diagnotics($id, Request $request)
    {
        $this->accessFleet($id, $request);

        $fleet = Fleet::findOrFail($id);
        return view('fleet.diagnotics', compact('fleet'));
    }

    public function alarms($id, Request $request)
    {
        $this->accessFleet($id, $request);

        $fleet = Fleet::findOrFail($id);
        $alarms = Alarm::table($fleet->id);

        // Date filter
        if ($request->has('from') || $request->has('to')) {
            $from = $request->input('from', Carbon::now()->subMonth()->format('Y-m-d'));
            $to = $request->input('to', Carbon::now()->format('Y-m-d'));
            $alarms = $alarms->whereDate('started_at', '>=', $from)->whereDate('started_at', '<=', $to);
        }

        // Status filter
        if ($request->has('status') && $request->input('status') !== '') {
            $alarms = $alarms->where('status', $request->input('status'));
        }

        // Message filter
        if ($request->has('message') && $request->input('message') !== '') {
            $alarms = $alarms->where('message', 'LIKE', '%' . $request->input('message') . '%');
        }

        $alarms = $alarms->latest()->paginate(25);

        return view('fleet.alarms', compact('fleet', 'alarms'));
    }

    public function alarmDownload($id, Request $request)
    {
        $this->accessFleet($id, $request);

        $fleet = Fleet::findOrFail($id);
        $alarms = Alarm::table($fleet->id);

        // Date filter
        if ($request->has('from') || $request->has('to')) {
            $from = $request->input('from', Carbon::now()->subMonth()->format('Y-m-d'));
            $to = $request->input('to', Carbon::now()->format('Y-m-d'));
            $alarms = $alarms->whereDate('started_at', '>=', $from)->whereDate('started_at', '<=', $to);
        }

        // Status filter
        if ($request->has('status') && $request->input('status') !== '') {
            $alarms = $alarms->where('status', $request->input('status'));
        }

        // Message filter
        if ($request->has('message') && $request->input('message') !== '') {
            $alarms = $alarms->where('message', 'LIKE', '%' . $request->input('message') . '%');
        }

        $alarms = $alarms->latest()->get();

        $filename = 'alarms_' . $fleet->name . '_' . now()->format('Ymd_His') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"$filename\"",
        ];

        $columns = ['ID', 'Fleet', 'Type', 'Parameter', 'Message', 'Status', 'Started At', 'Ended At', 'Duration'];

        $callback = function () use ($alarms, $columns, $fleet) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($alarms as $alarm) {
                $row = [
                    $alarm->id ?? '',
                    $fleet->name,
                    $alarm->property,
                    $alarm->property_key,
                    $alarm->message ?? '',
                    $alarm->status ? 'ABNORMAL' : 'NORMAL',
                    $alarm->started_at ?? '',
                    $alarm->finished_at ?? '',
                    $alarm->duration ?? '',
                ];
                fputcsv($file, $row);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function emision($id, Request $request)
    {
        $this->accessFleet($id, $request);

        $fleet = Fleet::findOrFail($id);
        return view('fleet.emision', compact('fleet'));
    }

    public function charter($id, Request $request)
    {
        $this->accessFleet($id, $request);

        $fleet = Fleet::findOrFail($id);
        return view('fleet.charter', compact('fleet'));
    }

    public function pumps($id, Request $request)
    {
        $this->accessFleet($id, $request);

        $fleet = Fleet::findOrFail($id);
        return view('fleet.pumps', compact('fleet'));
    }

    public function oils($id, Request $request)
    {
        $this->accessFleet($id, $request);

        $fleet = Fleet::findOrFail($id);
        $oils = FleetOilLube::table($id)->orderBy('sample_date', 'desc')->paginate(25);

        return view('fleet.oils', compact('fleet', 'oils'));
    }

    public function generator($id, Request $request)
    {
        $this->accessFleet($id, $request);

        $fleet = Fleet::findOrFail($id);
        return view('fleet.generator', compact('fleet'));
    }

    public function equipment($id, Request $request)
    {
        $this->accessFleet($id, $request);

        $fleet = Fleet::findOrFail($id);
        $equipments = $fleet->equipments;

        return view('fleet.equipment', compact('fleet', 'equipments'));
    }

    public function oilsDownload($id, Request $request)
    {
        $this->accessFleet($id, $request);

        $fleet = Fleet::findOrFail($id);
        $oils = FleetOilLube::table($id)->orderBy('sample_date', 'desc')->get();

        $filename = 'oil_lubes_' . $fleet->name . '_' . now()->format('Ymd_His') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"$filename\"",
        ];

        $columns = ['ID', 'Fleet', 'Sample Date', 'Oil Type', 'Parameter', 'Value', 'Unit', 'Status', 'Created At'];

        $callback = function () use ($oils, $columns, $fleet) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($oils as $oil) {
                $row = [
                    $oil->id ?? '',
                    $fleet->name,
                    $oil->sample_date ?? '',
                    $oil->oil_type ?? '',
                    $oil->parameter ?? '',
                    $oil->value ?? '',
                    $oil->unit ?? '',
                    $oil->status ?? '',
                    $oil->created_at ?? '',
                ];
                fputcsv($file, $row);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function equipmentDownload($id, Request $request)
    {
        $this->accessFleet($id, $request);

        $fleet = Fleet::findOrFail($id);
        $equipments = $fleet->equipments;

        $filename = 'equipment_' . $fleet->name . '_' . now()->format('Ymd_His') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"$filename\"",
        ];

        $columns = ['ID', 'Fleet', 'Equipment Name', 'Type', 'Model', 'Serial Number', 'Status', 'Created At'];

        $callback = function () use ($equipments, $columns, $fleet) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($equipments as $equipment) {
                $row = [
                    $equipment->id ?? '',
                    $fleet->name,
                    $equipment->name ?? '',
                    $equipment->type ?? '',
                    $equipment->model ?? '',
                    $equipment->serial_number ?? '',
                    $equipment->status ?? '',
                    $equipment->created_at ?? '',
                ];
                fputcsv($file, $row);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function docsDownload($id, Request $request)
    {
        $this->accessFleet($id, $request);

        $fleet = Fleet::findOrFail($id);
        $docs = $fleet->docs;

        $filename = 'fleet_docs_' . $fleet->name . '_' . now()->format('Ymd_His') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"$filename\"",
        ];

        $columns = ['ID', 'Fleet', 'Document Title', 'Document Type', 'File Name', 'File Size', 'Upload Date', 'Status'];

        $callback = function () use ($docs, $columns, $fleet) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($docs as $doc) {
                $row = [
                    $doc->id ?? '',
                    $fleet->name,
                    $doc->title ?? '',
                    $doc->type ?? '',
                    $doc->file_name ?? '',
                    $doc->file_size ?? '',
                    $doc->created_at ?? '',
                    $doc->status ?? 'Active',
                ];
                fputcsv($file, $row);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    /**
     * Download file from storage
     * For downloading actual files (documents, images, etc.)
     */
    public function downloadFile($id, Request $request)
    {
        $this->accessFleet($id, $request);

        $doc = FleetDoc::findOrFail($id);
        $fleet = $doc->fleet;

        // Check if user has access to this fleet
        $this->accessFleet($fleet->id, $request);

        $filePath = storage_path('app/' . $doc->file_path);

        if (!file_exists($filePath)) {
            abort(404, 'File not found');
        }

        return response()->download($filePath, $doc->original_name ?? $doc->file_name);
    }

    /**
     * General purpose download method for any fleet data in different formats
     */
    public function downloadData($id, Request $request)
    {
        $this->accessFleet($id, $request);

        $fleet = Fleet::findOrFail($id);
        $format = $request->input('format', 'csv'); // csv, json, excel
        $dataType = $request->input('type', 'fleet_info'); // fleet_info, alarms, oils, equipment, docs

        $filename = $dataType . '_' . $fleet->name . '_' . now()->format('Ymd_His');

        switch ($format) {
            case 'json':
                return $this->downloadAsJson($fleet, $dataType, $filename);
            case 'excel':
                return $this->downloadAsExcel($fleet, $dataType, $filename);
            default:
                return $this->downloadAsCsv($fleet, $dataType, $filename);
        }
    }

    private function downloadAsJson($fleet, $dataType, $filename)
    {
        $data = $this->getDataByType($fleet, $dataType);

        $headers = [
            'Content-Type' => 'application/json',
            'Content-Disposition' => "attachment; filename=\"{$filename}.json\"",
        ];

        return response()->json($data, 200, $headers);
    }

    private function downloadAsCsv($fleet, $dataType, $filename)
    {
        $data = $this->getDataByType($fleet, $dataType);

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"{$filename}.csv\"",
        ];

        $callback = function () use ($data) {
            $file = fopen('php://output', 'w');
            
            if (!empty($data)) {
                // Use first row keys as headers
                fputcsv($file, array_keys($data[0]));
                
                foreach ($data as $row) {
                    fputcsv($file, $row);
                }
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    private function getDataByType($fleet, $dataType)
    {
        switch ($dataType) {
            case 'fleet_info':
                return [
                    [
                        'id' => $fleet->id,
                        'name' => $fleet->name,
                        'type' => $fleet->type,
                        'imo' => $fleet->imo,
                        'flag' => $fleet->flag,
                        'built_year' => $fleet->built_year,
                        'gross_tonnage' => $fleet->gross_tonnage,
                        'length' => $fleet->length,
                        'beam' => $fleet->beam,
                        'draft' => $fleet->draft,
                        'created_at' => $fleet->created_at,
                    ]
                ];
            case 'alarms':
                return Alarm::table($fleet->id)->latest()->get()->map(function ($alarm) use ($fleet) {
                    return [
                        'id' => $alarm->id,
                        'fleet' => $fleet->name,
                        'type' => $alarm->property,
                        'parameter' => $alarm->property_key,
                        'message' => $alarm->message,
                        'status' => $alarm->status ? 'ABNORMAL' : 'NORMAL',
                        'started_at' => $alarm->started_at,
                        'ended_at' => $alarm->finished_at,
                        'duration' => $alarm->duration,
                    ];
                })->toArray();
            case 'oils':
                return FleetOilLube::table($fleet->id)->get()->map(function ($oil) use ($fleet) {
                    return [
                        'id' => $oil->id,
                        'fleet' => $fleet->name,
                        'sample_date' => $oil->sample_date,
                        'oil_type' => $oil->oil_type,
                        'parameter' => $oil->parameter,
                        'value' => $oil->value,
                        'unit' => $oil->unit,
                        'status' => $oil->status,
                        'created_at' => $oil->created_at,
                    ];
                })->toArray();
            case 'equipment':
                return $fleet->equipments->map(function ($equipment) use ($fleet) {
                    return [
                        'id' => $equipment->id,
                        'fleet' => $fleet->name,
                        'name' => $equipment->name,
                        'type' => $equipment->type,
                        'model' => $equipment->model,
                        'serial_number' => $equipment->serial_number,
                        'status' => $equipment->status,
                        'created_at' => $equipment->created_at,
                    ];
                })->toArray();
            default:
                return [];
        }
    }
}
