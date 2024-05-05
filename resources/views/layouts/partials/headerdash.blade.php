<header class="header">
    <div class="breadcrumbs">
        @if(isset($fleet))
        <h5>My Fleet</h5>
        <img src="{{asset('img/icons/chevron-right.png')}}" alt="" />
        <h5>{{ $fleet->name }}</h5>
        @endif
    </div>
    <nav class="menu-header">
        <ul>
            {{-- <li>
                <a href="">
                    <img src="{{asset('img/icons/search-dark.svg')}}" alt="" width="24" />
                </a>
            </li> --}}
            {{-- <li>
                <a href="/settings">
                    <img src="{{asset('img/icons/setting-dark.svg')}}" alt="" width="24" />
                </a>
            </li> --}}
            {{-- <li>
                <a href="">
                    <img src="{{asset('img/icons/help-dark.svg')}}" alt="" width="24" />
                </a>
            </li>
            <li>
                <a href="">
                    <img src="{{asset('img/icons/message-dark.svg')}}" alt="" width="24" />
                </a>
            </li> --}}
            {{-- <li>
                <a href="">
                    <img src="{{asset('img/icons/user-dark.svg')}}" alt="" width="24" />
                </a>
            </li> --}}
        </ul>
        
    </nav>
    <div class="navbar-nav flex-row order-md-last">
        <div class="nav-item dropdown">
            <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown" aria-label="Open user menu">
            <span class="avatar avatar-sm" style="background-image: url({{asset('img/icons/user-dark.svg')}})"></span>
            <div class="d-none d-xl-block ps-2">
                <div>{{ Auth::user()->name }}</div>
                {{-- <div class="mt-1 small text-muted">{{ Auth::user()->roles }}</div> --}}
            </div>
            </a>
            <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                <a href="{{ route('user.profile') }}" class="dropdown-item">Profile</a>
                <div class="dropdown-divider"></div>
                <a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </div>
    </div>
</header>   