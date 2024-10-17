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
            
            <div class="table-title d-flex align-items-center justify-content-between">
                <h6>{{ $doc->name }}</h6>
                <div>
                    <a href="{{ route('fleet.docs', $fleet->id) }}" class="btn btn btn-danger">Close</a>
                </div>
            </div>
            <br>
            <pdf-viewer url="/docs/{{ $doc->path }}"></pdf-viewer>
        </div>
    </div>
</main>
@endsection
