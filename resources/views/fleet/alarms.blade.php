@extends('layouts.dash')

@section('content')
<main class="content">
    <div class="bg-white">
        @if($fleet->submenu()->count() > 0)
            @include('fleet.menu', ['fleet' => $fleet])
        @else
            <slider-submenu :fleet="{{ json_encode($fleet) }}" active="alarms"></slider-submenu>
        @endif
        <div class="container">
            <div class="row mt-3">
                <div class="col-12">
                    <div class="table-title">
                        <h6>Alarm Information</h6>
                    </div>
                    <table class="table table-sm">
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
                            <tr>
                                <td>{{ $alarm->started_at }}</td>
                                <td>{{ $alarm->message }}</td>
                                <td>{{ $alarm->duration }}</td>
                                <td>{{ $alarm->status ? 'OPEN' : 'CLOSE'}}</td>
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
