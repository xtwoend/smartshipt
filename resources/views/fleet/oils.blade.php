@extends('layouts.dash')

@section('content')

<main class="content">
    <div class="bg-white">
        @if($fleet->submenu()->count() > 0)
            @include('fleet.menu', ['fleet' => $fleet])
        @else
            @include('fleet._menu', ['fleet' => $fleet])
        @endif
        
        <div class="p-3">
            <div class="table-responsive">
                <table class="table table-strip">
                    <thead>
                        <tr>
                            <tr>Date</tr>
                            <tr>Type</tr>
                            <tr>Oil Information</tr>
                            <tr>Status</tr>
                            <tr>Recomendation</tr>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($oils  as $oil)
                        <tr>
                            <td>{{ $oil->sample_date }}</td>
                            <td>{{ $oil->component }}</td>
                            <td>{{ $oil->lube }}</td>
                            <td>{{ $oil->Status }}</td>
                            <td>{{ $oil->Recomendation }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $oils->links() }}
            </div>
        </div>
    </div>
</main>
@endsection
