<div class="vertical-menu">

<div data-simplebar class="h-100">

    <!--- Sidemenu -->
    <div id="sidebar-menu">
        <!-- Left Menu Start -->
        <ul class="metismenu list-unstyled" id="side-menu">
            <li class="menu-title" key="t-menu">{{trans('general.dashboard')}}</li>

            <li>
                <a href="{{route('dashboard')}}" class="waves-effect">
                    <i class="bx bx-home-circle"></i>
                    <span key="t-dashboards">{{trans('general.dashboard')}}</span>
                </a>
            </li>

            <li class="menu-title" key="t-apps">{{trans('general.user')}}</li>
            <li>
                <a href="{{route('users')}}" class="waves-effect">
                    <i class="bx bx-user-circle"></i>
                    <span key="t-user">{{trans('general.users')}}</span>
                </a>
            </li>
            <li>
                <a href="{{route('endusers')}}" class="waves-effect">
                    <i class="bx bx-user-pin"></i>
                    <span key="t-user">{{trans('general.endusers')}}</span>
                </a>
            </li>
            <li>
                <a href="{{route('usertypes')}}" class="waves-effect">
                    <i class="bx bx-user-check"></i>
                    <span key="t-user">{{trans('general.usertype')}}</span>
                </a>
            </li>
            <li class="menu-title" key="t-apps">{{trans('general.event')}}</li>
            <li>
                <a href="{{route('event')}}" class="waves-effect">
                    <i class="bx bx bx-calendar-event"></i>
                    <span key="t-user">{{trans('general.events')}}</span>
                </a>
            </li>
        </ul>
    </div>
    <!-- Sidebar -->
</div>
</div>