@extends('layouts.dash')



@section('js')
<!-- use version 0.20.0 -->
<script lang="javascript" src="https://cdn.sheetjs.com/xlsx-0.20.0/package/dist/xlsx.full.min.js"></script>
<script>
    function ExportToExcel(type, fn, dl) {
        var elt = document.getElementById('report-xls');
        var wb = XLSX.utils.table_to_book(elt, { sheet: "overview" });
        
        return dl ?
            XLSX.write(wb, { bookType: type, bookSST: true, type: 'base64' }):
            XLSX.writeFile(wb, fn || ('Speed-overview.' + (type || 'xlsx')));
    }
</script>
@endsection

@section('content')
<main class="content full fixed">
    <div class="d-flex content-scrolled">
        <div class="sidebar" id="sidebar-secondary">
            @include('overview.side', ['active' => 'speed'])
        </div>
        <button onclick="document.getElementById('sidebar-secondary').classList.toggle('collapsed')" class="btn-sidebar">
            <img src="{{asset('img/icons/chevron-prev.png')}}" alt="" width="12" />
        </button>
        <div class="side-content">
            <nav aria-label="breadcrumb" class="mb-3">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">Overview</li>
                    <li class="breadcrumb-item active" aria-current="page">Speed (knot)</li>
                </ol>
            </nav>
            <div class="nav-button d-flex justify-content-between py-2">
                <form method="GET" class="d-flex justify-content-start">
                    <a href="{{ route('overview.speed', ['type' => 'last-week']) }}" class="btn btn-default me-2">Last week</a>
                    <a href="{{ route('overview.speed', ['type' => 'last-month']) }}" class="btn btn-default me-2">Last Month</a>
                    <date-range from="{{ request()->input('from', null) }}" to="{{ request()->input('to', null) }}"></date-range>
                    <button class="ms-2 btn btn-primary" type="submit"><i class="fa fa-filter me-2"></i> Filters</button>
                </form>
                @can('Download Report')
                <button onclick="ExportToExcel('xlsx')" class="btn btn-primary float-end"><i class="fa fa-cloud-download me-2" aria-hidden="true"></i> Download</button>
                @endcan
            </div>
            <table class="table table-sm table-dark" id="report-xls">
                <tbody>
                    <tr>
                        <th  class="align-middle text-center">No.</th>
                        <th>Fleet Name</th>
                        <th>IMO</th>
                        <th class="align-middle text-end">Average Speed (knot)</th>
                        <th class="align-middle text-end">Maximum Speed (knot)</th>
                    </tr>
                    @php
                        $no = 1;
                    @endphp
                    @foreach($fleets->sortBy([['speed', 'desc']])->values()->all() as $f)
                    <tr>
                        <td class="align-middle text-center">{{ $no++ }}</td>
                        <td class="align-middle">{{ $f->name }}</td>
                        <td class="align-middle">{{ $f->imo_number }}</td>
                        <td class="align-middle text-end">{{ number($f->speed) }} KNOT</td>
                        <td class="align-middle text-end">{{ number($f->max_speed) }} KNOT</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</main>
@endsection