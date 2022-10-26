<li class="nav-item dropdown dropdown-user">
    <a class="nav-link dropdown-toggle dropdown-user-link" id="dropdown-user" href="javascript:void(0);" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <div class="user-nav d-sm-flex d-none">
            <span class="user-name font-weight-bolder" style="margin-bottom: 0;">{{ auth()->guard('web')->user()->name }}</span>
            {{-- <span class="user-status">Admin</span> --}}
        </div>
        <span class="avatar">
            <img class="round" src="{{ image_or_placeholder(auth()->guard('web')->user()->avatar_full_path, 'profile') }}" alt="avatar" height="40" width="40">
            {{-- <span class="avatar-status-online"></span> --}}
        </span>
    </a>
    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-user">
        <a class="dropdown-item" href="{{ route('dashboard.profile.show') }}"><i class="mr-50" data-feather="user"></i> Profile</a>
        {{-- <a class="dropdown-item" href="page-account-settings.html"><i class="mr-50" data-feather="settings"></i> Settings</a> --}}
        <div class="dropdown-divider"></div>
        <a href="{{ route('dashboard.logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="dropdown-item"><i class="mr-50" data-feather="power"></i> Logout</a>
        <form id="logout-form" action="{{ route('dashboard.logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </div>
    </li>