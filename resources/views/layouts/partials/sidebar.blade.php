<aside id="sidebar" class="sidebar break-point-lg has-bg-image">
<a id="btn-collapse" class="sidebar-collapser"><i class="ri-arrow-left-s-line"></i></a>
  <div class="sidebar-layout">
    <div class="sidebar-header">
      <!-- Header content here -->
      <img src="{{asset('img/logo-smartship.png')}}" alt="" />
      <h5 class="m-0">PIS SmartShip</h5>
    </div>
    <div class="sidebar-content">
      <!-- Content here -->
      <nav class="menu open-current-submenu">
            <ul>
                <li class="menu-item">
                  <a href="/">
                    <span class="menu-icon">
                        <img src="{{asset('img/icons/home.svg')}}" height="26" alt="" />
                    </span>
                    <span class="menu-title">Home</span>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="{{route('overview.index')}}">
                    <span class="menu-icon">
                        <img src="{{asset('img/icons/overview-backup-svgrepo-com.svg')}}" height="26" alt="" />
                    </span>
                    <span class="menu-title">Overview</span>
                  </a>
                </li>
                <li class="menu-item sub-menu">
                  <a href="#">
                    <span class="menu-icon">
                        <img src="{{asset('img/icons/ship-tanker.svg')}}" height="26" alt="" />
                    </span>
                    <span class="menu-title">My Fleets</span>
                  </a>
                  <div class="sub-menu-list">
                    <ul class="scroller" style="heigth: 400px;">
                      @foreach (\App\Models\Fleet::active()->get() as $item)
                      <li class="menu-item">
                        <a href="{{ route('fleet', $item->id) }}">
                        <span class="menu-icon">
                            <img src="{{asset('img/icons/mini-ship.png')}}" alt="" />
                        </span>
                          <span class="menu-title">{{ $item->name }}</span>
                        </a>
                      </li>
                      @endforeach
                    </ul>
                  </div>
                </li>
                <li class="menu-item">
                  <a href="{{ route('master.fleets.index') }}">
                    <span class="menu-icon">
                    <img src="{{asset('img/icons/fleets.svg')}}" height="26" alt="" />
                    </span>
                    <span class="menu-title">Fleet Master Data</span>
                  </a>
                </li>
                {{-- <li class="menu-item">
                  <a href="{{ route('master.users.index') }}">
                    <span class="menu-icon">
                    <img src="{{asset('img/icons/help.png')}}" alt="" />
                    </span>
                    <span class="menu-title">User Manager</span>
                  </a>
                </li> --}}
                <li class="menu-item">
                  <a href="{{ route('master.ports.index') }}">
                    <span class="menu-icon">
                      <img src="{{asset('img/icons/dock.svg')}}" height="26" alt="" />
                    </span>
                    <span class="menu-title">Master Ports </span>
                  </a>
                </li>
                
                <li class="menu-item">
                  <a href="{{ route('master.oils.index') }}">
                    <span class="menu-icon">
                      <img src="{{ asset('img/icons/chemical-chemistry-svgrepo-com.svg') }}"  height="26" alt="">
                    </span>
                    <span class="menu-title">Upload Oil Analytic</span>
                  </a>
                </li>

                <li class="menu-item">
                  <a href="#">
                    <span class="menu-icon">
                    <img src="{{asset('img/icons/helps.svg')}}" height="26" alt="" />
                    </span>
                    <span class="menu-title">Help</span>
                  </a>
                </li>
                @if(Auth::user()->is_root)
                <li class="menu-item">
                  <a href="{{ route('master.settings.index') }}">
                    <span class="menu-icon">
                    <img src="{{asset('img/icons/setting.svg')}}" alt="" height="26" />
                    </span>
                    <span class="menu-title">Settings</span>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="#">
                    <span class="menu-icon">
                    <img src="{{asset('img/icons/users.svg')}}" height="26" alt="" />
                    </span>
                    <span class="menu-title">Account</span>
                  </a>
                    <div class="sub-menu-list">
                        <ul>
                            <li class="menu-item">
                                <a href="{{ route('master.user.index') }}">
                                    <span class="menu-icon"></span>
                                    <span class="menu-title">List User</span>
                                </a>
                            </li>
                            {{-- <li class="menu-item">
                              <a href="{{ route('master.roles.index') }}">
                                  <span class="menu-icon">
                                  </span>
                                  <span class="menu-title">List Roles</span>
                              </a>
                            </li> --}}
                            <li class="menu-item">
                                <a href="{{ route('master.permission.index') }}">
                                    <span class="menu-icon">
                                    </span>
                                    <span class="menu-title">List Permission</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                @endif
            </ul>
        </nav>
    </div>
  </div>
</aside>
