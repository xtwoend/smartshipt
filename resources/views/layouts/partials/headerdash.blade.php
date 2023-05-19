<header class="header">
    <div class="breadcrumbs">
        <h5>My Fleet</h5>
        <img src="{{asset('img/icons/chevron-right.png')}}" alt="" />
        <h5>{{ isset($fleet) ? $fleet->name : "" }}</h5>
    </div>
    <nav class="menu-header">
        <ul>
            <li>
                <a href="">
                    <img src="img/icons/search-dark.png" alt="" width="24" />
                </a>
            </li>
            <li>
                <a href="">
                    <img src="img/icons/settings-dark.png" alt="" width="24" />
                </a>
            </li>
            <li>
                <a href="">
                    <img src="img/icons/help-dark.png" alt="" width="24" />
                </a>
            </li>
            <li>
                <a href="">
                    <img src="img/icons/message-dark.png" alt="" width="24" />
                </a>
            </li>
            <li>
                <a href="">
                    <img src="img/icons/account-dark.png" alt="" width="24" />
                </a>
            </li>
        </ul>
    </nav>
</header>