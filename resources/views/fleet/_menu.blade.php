@php
$active = request()->route()->getName();  
@endphp

<nav class="navbar navbar-expand-lg navbar-dark bg-primary submenu">
    <div class="collapse navbar-collapse">
        <ul class="navbar-nav">
            <li class="nav-item {{ $active == 'fleet' ? 'active': '' }}">
                <a class="nav-link" href="{{ route('fleet', $fleet->id) }}">SHIP INFO</a>
            </li>
            <li class="nav-item {{ $active == 'fleet.nav' ? 'active': '' }}">
                <a class="nav-link" href="{{ route('fleet.nav', $fleet->id) }}">NAVIGASI</a>
            </li>
            <li class="nav-item {{ $active == 'fleet.engine' ? 'active': '' }}">
                <a class="nav-link" href="{{ route('fleet.engine', $fleet->id) }}">MAIN ENGINE</a>
            </li>
            <li class="nav-item {{ $active == 'fleet.generator' ? 'active': '' }}">
                <a class="nav-link" href="{{ route('fleet.generator', $fleet->id) }}">GENERATOR</a>
            </li>
            <li class="nav-item {{ $active == 'fleet.pumps' ? 'active': '' }}">
                <a class="nav-link" href="{{ route('fleet.pumps', $fleet->id) }}">PUMPS</a>
            </li>
            <li class="nav-item {{ $active == 'fleet.cargo' ? 'active': '' }}">
                <a class="nav-link" href="{{ route('fleet.cargo', $fleet->id) }}">CARGO TANK</a>
            </li>
            <li class="nav-item {{ $active == 'fleet.bunker' ? 'active': '' }}">
                <a class="nav-link" href="{{ route('fleet.bunker', $fleet->id) }}">BUNKER TANK</a>
            </li>
            <li class="nav-item {{ $active == 'fleet.balast' ? 'active': '' }}">
                <a class="nav-link" href="{{ route('fleet.balast', $fleet->id) }}">BALAST TANK</a>
            </li>
            <li class="nav-item {{ $active == 'fleet.alarms' ? 'active': '' }}">
                <a class="nav-link" href="{{ route('fleet.alarms', $fleet->id) }}">ALARMS</a>
            </li>
            <li class="nav-item {{ $active == 'fleet.oils' ? 'active': '' }}">
                <a class="nav-link" href="{{ route('fleet.oils', $fleet->id) }}">OILS</a>
            </li>
            <li class="nav-item {{ $active == 'fleet.equipment' ? 'active': '' }}">
                <a class="nav-link" href="{{ route('fleet.equipment', $fleet->id) }}">EQUIPMENT MAINTENANCE</a>
            </li>
            <li class="nav-item {{ $active == 'fleet.docs' ? 'active': '' }}">
                <a class="nav-link" href="{{ route('fleet.docs', $fleet->id) }}">DOCUMENTS</a>
            </li>
        </ul>
    </div>
</nav>