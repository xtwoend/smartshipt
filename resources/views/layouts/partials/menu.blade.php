<ul class="navbar-nav">
    <li class="nav-item">
        <a class="nav-link" href="{{ route('home') }}" >
            <span class="nav-link-icon d-md-none d-lg-inline-block">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><polyline points="5 12 3 12 12 3 21 12 19 12"></polyline><path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7"></path><path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6"></path></svg>
            </span>
            <span class="nav-link-title">
                Home
            </span>
        </a>
    </li>
    @if(isset($fleet))
    <li class="nav-item">
        <a class="nav-link" href="{{ route('fleet', $fleet->id) }}" >
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-layout-dashboard" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                <path d="M4 4h6v8h-6z"></path>
                <path d="M4 16h6v4h-6z"></path>
                <path d="M14 12h6v8h-6z"></path>
                <path d="M14 4h6v4h-6z"></path>
            </svg>
            <span class="nav-link-title">
                Dashboard
            </span>
        </a>
    </li>
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#navbar-base" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false" >
            <span class="nav-link-icon d-md-none d-lg-inline-block">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-map-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <line x1="18" y1="6" x2="18" y2="6.01"></line>
                    <path d="M18 13l-3.5 -5a4 4 0 1 1 7 0l-3.5 5"></path>
                    <polyline points="10.5 4.75 9 4 3 7 3 20 9 17 15 20 21 17 21 15"></polyline>
                    <line x1="9" y1="4" x2="9" y2="17"></line>
                    <line x1="15" y1="15" x2="15" y2="20"></line>
                </svg>
            </span>
            <span class="nav-link-title">
                Navigation
            </span>
        </a>
        <div class="dropdown-menu">
            <a class="dropdown-item" href="{{ route('navigation.trends', $fleet->id    ) }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-timeline" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M4 16l6 -7l5 5l5 -6"></path>
                    <circle cx="15" cy="14" r="1"></circle>
                    <circle cx="10" cy="9" r="1"></circle>
                    <circle cx="4" cy="16" r="1"></circle>
                    <circle cx="20" cy="8" r="1"></circle>
                </svg>
                Trends
            </a>

            <a class="dropdown-item" href="{{ route('navigation.track', $fleet->id    ) }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-map-pins" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M10.828 9.828a4 4 0 1 0 -5.656 0l2.828 2.829l2.828 -2.829z"></path>
                    <line x1="8" y1="7" x2="8" y2="7.01"></line>
                    <path d="M18.828 17.828a4 4 0 1 0 -5.656 0l2.828 2.829l2.828 -2.829z"></path>
                    <line x1="16" y1="15" x2="16" y2="15.01"></line>
                </svg>
                Track Histories
            </a>

            <a class="dropdown-item" href="#">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-report-analytics" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M9 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-12a2 2 0 0 0 -2 -2h-2"></path>
                    <rect x="9" y="3" width="6" height="4" rx="2"></rect>
                    <path d="M9 17v-5"></path>
                    <path d="M12 17v-1"></path>
                    <path d="M15 17v-3"></path>
                </svg>
                Report
            </a>
        </div>
    </li>
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#navbar-base" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false" >
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-gas-station" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                <path d="M14 11h1a2 2 0 0 1 2 2v3a1.5 1.5 0 0 0 3 0v-7l-3 -3"></path>
                <path d="M4 20v-14a2 2 0 0 1 2 -2h6a2 2 0 0 1 2 2v14"></path>
                <line x1="3" y1="20" x2="15" y2="20"></line>
                <path d="M18 7v1a1 1 0 0 0 1 1h1"></path>
                <line x1="4" y1="11" x2="14" y2="11"></line>
            </svg>
            <span class="nav-link-title">
                Fuel Tank
            </span>
        </a>
        <div class="dropdown-menu">
            <a class="dropdown-item" href="{{ route('fuel.trends', $fleet->id    ) }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-timeline" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M4 16l6 -7l5 5l5 -6"></path>
                    <circle cx="15" cy="14" r="1"></circle>
                    <circle cx="10" cy="9" r="1"></circle>
                    <circle cx="4" cy="16" r="1"></circle>
                    <circle cx="20" cy="8" r="1"></circle>
                </svg>
                Trends
            </a>
        </div>
    </li>
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#navbar-base" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false" >
            <span class="nav-link-icon d-md-none d-lg-inline-block">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-engine" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M3 10v6"></path>
                    <path d="M12 5v3"></path>
                    <path d="M10 5h4"></path>
                    <path d="M5 13h-2"></path>
                    <path d="M6 10h2l2 -2h3.382a1 1 0 0 1 .894 .553l1.448 2.894a1 1 0 0 0 .894 .553h1.382v-2h2a1 1 0 0 1 1 1v6a1 1 0 0 1 -1 1h-2v-2h-3v2a1 1 0 0 1 -1 1h-3.465a1 1 0 0 1 -.832 -.445l-1.703 -2.555h-2v-6z"></path>
                 </svg>
            </span>
            <span class="nav-link-title">
                Engine
            </span>
        </a>
        <div class="dropdown-menu">
            <a class="dropdown-item" href="{{ route('navigation.trends', $fleet->id    ) }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-timeline" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M4 16l6 -7l5 5l5 -6"></path>
                    <circle cx="15" cy="14" r="1"></circle>
                    <circle cx="10" cy="9" r="1"></circle>
                    <circle cx="4" cy="16" r="1"></circle>
                    <circle cx="20" cy="8" r="1"></circle>
                </svg>
                Trends
            </a>
        </div>
    </li>

    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#navbar-base" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false" >
            <span class="nav-link-icon d-md-none d-lg-inline-block">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-package" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <polyline points="12 3 20 7.5 20 16.5 12 21 4 16.5 4 7.5 12 3"></polyline>
                    <line x1="12" y1="12" x2="20" y2="7.5"></line>
                    <line x1="12" y1="12" x2="12" y2="21"></line>
                    <line x1="12" y1="12" x2="4" y2="7.5"></line>
                    <line x1="16" y1="5.25" x2="8" y2="9.75"></line>
                </svg>
            </span>
            <span class="nav-link-title">
                Cargo
            </span>
        </a>
        <div class="dropdown-menu">
            <a class="dropdown-item" href="{{ route('cargo.trends', $fleet->id    ) }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-timeline" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M4 16l6 -7l5 5l5 -6"></path>
                    <circle cx="15" cy="14" r="1"></circle>
                    <circle cx="10" cy="9" r="1"></circle>
                    <circle cx="4" cy="16" r="1"></circle>
                    <circle cx="20" cy="8" r="1"></circle>
                </svg>
                Trends
            </a>
        </div>
    </li>
    @endif
</ul>