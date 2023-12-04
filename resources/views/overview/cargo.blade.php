@extends('layouts.dash')

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
            <div class="nav-button">
                <a href="{{ route('overview.cargo', ['type' => 'last-week']) }}" class="btn btn-default">Last week</a>
                <a href="{{ route('overview.cargo', ['type' => 'last-month']) }}" class="btn btn-default">Last Month</a>
            </div>
            <table class="table table-sm table-dark">
                <tbody>
                    <tr>
                        <th  class="align-middle text-center">No.</th>
                        <th>Fleet Name</th>
                        <th>IMO</th>
                        <th class="align-middle text-end">Cargo Capacity (%)</th>
                    </tr>
                    @php
                        $no = 1;
                    @endphp
                    @foreach($fleets->sortBy([['capacity', 'desc']])->values()->all() as $f)
                    <tr>
                        <td class="align-middle text-center">{{ $no++ }}</td>
                        <td class="align-middle">{{ $f->name }}</td>
                        <td class="align-middle">{{ $f->imo_number }}</td>
                        <td class="align-middle text-end">{{ is_string($f->capacity) ? $f->capacity : number($f->capacity * 100) }} %</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</main>
@endsection