@extends('layouts.dash')

@section('content')
<main class="content">
    <div class="bg-white">
        @if($fleet->submenu()->count() > 0)
            @include('fleet.menu', ['fleet' => $fleet])
        @else
            @include('fleet._menu', ['fleet' => $fleet])
            {{-- <slider-submenu :fleet="{{ json_encode($fleet) }}" active="balast"></slider-submenu> --}}
        @endif
        <div class="container">
            <div class="row mt-3">
                <div class="col-12">
                    <div class="table-title">
                        <h6>Alarm Information</h6>
                    </div>
                    <div class="nav-button d-flex justify-content-end py-2">
                        <form method="GET" class="d-flex justify-content-start">
                            <date-range from="{{ request()->input('from', null) }}" to="{{ request()->input('to', null) }}"></date-range>
                            <button class="ms-2 btn btn-primary" type="submit"><i class="fa fa-filter me-2"></i> Filters</button>
                        </form>
                    </div>
                    <table class="table table-sm alarm">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Message</th>
                                <th>Duration</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($alarms  as $alarm)
                            <tr class="{{ $alarm->status ? 'warning': '' }}">
                                <td>{{ $alarm->started_at }}</td>
                                <td>{{ $alarm->message }}</td>
                                <td>{{ $alarm->duration }}</td>
                                <td>{{ $alarm->status ? 'ABNORMAL' : 'NORMAL'}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $alarms->links() }}
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
