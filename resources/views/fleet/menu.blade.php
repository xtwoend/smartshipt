@php
$active = $fleet->submenu()->where('route', request()->route()->getName())->first();  
@endphp

<nav class="navbar navbar-expand-lg navbar-dark bg-primary submenu">
    <div class="collapse navbar-collapse">
        <ul class="navbar-nav">
            @foreach($fleet->submenu()->whereNull('parent_id')->get() as $menu)
                @if($menu->childs()->count() > 0)
                    <li class="nav-item dropdown {{ $active->route == $menu->route ? 'active': '' }}">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            {{ $menu->name }}
                        </a>
                        <ul class="dropdown-menu">
                            @foreach($menu->childs as $submenu)
                            <li><a class="dropdown-item" href="{{ route($submenu->route, $submenu->params) }}">{{ $submenu->name }}</a></li>
                            @endforeach
                        </ul>
                    </li>
                @else
                <li class="nav-item {{ $active->route == $menu->route ? 'active': '' }}">
                    <a class="nav-link" href="{{ route($menu->route, $menu->params) }}">{{ $menu->name }}</a>
                </li>
                @endif
            @endforeach
        </ul>
    </div>
</nav>