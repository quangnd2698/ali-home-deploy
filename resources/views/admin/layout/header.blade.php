<div class="header" id="header">
    <div class="header-left">
        <div class="menu-icon dw dw-menu"></div>
        <div class="search-toggle-icon dw dw-search2" data-toggle="header_search"></div>
        <div class="header-search">
            <form>
                <div class="form-group mb-0">
                    <i class="dw dw-search2 search-icon"></i>
                    <input type="text" class="form-control search-input" placeholder="Search Here">
                </div>
            </form>
        </div>
    </div>
    <div class="header-right">
        <div class="dashboard-setting user-notification">
            <div class="dropdown">
                <a class="dropdown-toggle no-arrow" href="javascript:;" data-toggle="right-sidebar">
                    <i class="dw dw-settings2"></i>
                </a>
            </div>
        </div>
        <div class="user-info-dropdown">
            <div class="dropdown">
                <a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                    <span class="user-icon">
                        @if (Auth::guard('admins')->check() && Auth::guard('admins')->user()->image)
                            <img src="images/admins/{{Auth::guard('admins')->user()->image}}" alt="">
                        @else
                        <img src="vendors/images/photo1.jpg" alt="">
                        @endif
                    </span>
                    <span class="user-name">{{Auth::guard('admins')->user()->name ?? null}}</span>
                </a>
                <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                    <a class="dropdown-item" href="{{route('admins.profile', Auth::guard('admins')->id())}}"><i class="dw dw-user1"></i> Profile</a>
                    <a class="dropdown-item" href="{{route('admins.edit', Auth::guard('admins')->id())}}"><i class="dw dw-settings2"></i> Setting</a>
                    <a class="dropdown-item" href="{{route('logout')}}"><i class="dw dw-logout"></i> Log Out</a>
                </div>
            </div>
        </div>
        {{-- <div class="github-link">
            <a  target="_blank"><img src="vendors/images/github.svg" alt=""></a>
        </div> --}}
    </div>
</div>
