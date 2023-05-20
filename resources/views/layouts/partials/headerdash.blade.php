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
            <li>
                <a href="">
                    <img src="{{asset('img/icons/search-dark.png') }}" alt="" width="24" />
                </a>
            </li>
            <li>
                <a href="">
                    <img src="{{asset('img/icons/settings-dark.png') }}" alt="" width="24" />
                </a>
            </li>
            <li>
                <a href="">
                    <img src="{{asset('img/icons/help-dark.png') }}" alt="" width="24" />
                </a>
            </li>
            <li>
                <a href="">
                    <img src="{{asset('img/icons/message-dark.png') }}" alt="" width="24" />
                </a>
            </li>
            <li>
                <a href="">
                    <img src="{{asset('img/icons/account-dark.png') }}" alt="" width="24" />
                </a>
            </li>
        </ul>
    </nav>
</header>