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
        
        <div class="p-3">
            @php
                $docs = $fleet->docs()->latest()->paginate(20);
            @endphp


            <table class="table">
                <thead>
                    <tr>
                        <th style="width: 50px;">No</th>
                        <th>Name</th>
                        <th style="width: 150px;">Size</th>
                        <th style="width: 200px;">Uploaded At</th>
                        @can('Document Download')
                        <th style="width: 100px;">Action</th>
                        @endcan
                    </tr>
                </thead>
                <tbody>
                    @php 
                        $no = (($docs->currentPage() - 1) * $docs->perPage()) + 1;
                    @endphp
                    @foreach($docs as $doc)
                
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $doc->name }}</td>
                        <td>{{ bytesToHuman($doc->size) }}</td>
                        <td>{{ $doc->created_at }}</td>
                        @can('Document Download')
                        <td>
                            <a href="/{{ $doc->path }}" class="d-flex" style="">
                                <img src="{{asset('icon/purple.svg')}}" width="24"/>
                            </a>
                        </td>
                        @endcan
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $docs->links() }}
        </div>
    </div>
</main>
@endsection
