@php
$active = request()->route()->getName();  
@endphp

<nav class="navbar navbar-expand-lg navbar-dark bg-primary submenu">
    <div class="collapse navbar-collapse">
        <ul class="navbar-nav">
            <li class="nav-item {{ $active == 'fleet' ? 'active': '' }}">
                <a class="nav-link" href="{{ route('fleet') }}">NAVIGASI</a>
            </li>
            <li class="nav-item {{ $active == 'fleet.engine' ? 'active': '' }}">
                <a class="nav-link" href="{{ route('fleet.engine') }}">MAIN ENGINE</a>
            </li>
            <li class="nav-item {{ $active == 'fleet.pumps' ? 'active': '' }}">
                <a class="nav-link" href="{{ route('fleet.pumps') }}">PUMPS</a>
            </li>
            <li class="nav-item {{ $active == 'fleet.cargo' ? 'active': '' }}">
                <a class="nav-link" href="{{ route('fleet.cargo') }}">CARGO TANK</a>
            </li>
            <li class="nav-item {{ $active == 'fleet.bunker' ? 'active': '' }}">
                <a class="nav-link" href="{{ route('fleet.bunker') }}">BUNKER TANK</a>
            </li>
            <li class="nav-item {{ $active == 'fleet.balast' ? 'active': '' }}">
                <a class="nav-link" href="{{ route('fleet.balast') }}">BALAST TANK</a>
            </li>
            <li class="nav-item {{ $active == 'fleet.alarms' ? 'active': '' }}">
                <a class="nav-link" href="{{ route('fleet.alarms') }}">ALARM</a>
            </li>
        </ul>
    </div>
</nav>