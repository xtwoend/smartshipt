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
            
        </div>
    </div>
</main>
@endsection
