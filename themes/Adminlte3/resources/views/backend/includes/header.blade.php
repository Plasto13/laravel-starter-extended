<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav">
     <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
            <a class="nav-link" href="{{ route('frontend.index') }}" target="_blank">
                <i class="c-icon cil-external-link"></i>&nbsp;
                {{ app_name() }}
            </a>
        </li>
    </ul>
    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#">
                {{strtoupper(App::getLocale())}}
            </a>
            <div class="dropdown-menu dropdown-menu-md dropdown-menu-right">
                <span class="dropdown-item dropdown-header">@lang('Change language')</span>
                <div class="dropdown-divider"></div>

                 @foreach($locales as $key => $locale)
                <a class="dropdown-item" rel="alternate" hreflang="{{ $key }}" href="{{ LaravelLocalization::getLocalizedURL($key, null, [], true) }}">
                {{ strtoupper($key) }}
                </a>
                @endforeach
            </div>
        </li>

        <li class="nav-item dropdown">
            <?php
            $notifications = optional(auth()->user())->unreadNotifications;
            $notifications_count = optional($notifications)->count();
            $notifications_latest = optional($notifications)->take(5);
            $notifiClass = ($notifications_count) ? "badge-warning" : "badge-info" ;
            ?>
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-bell"></i>&nbsp;
                <span class="badge {{$notifiClass}} navbar-badge">{{$notifications_count}}</span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <span class="dropdown-item dropdown-header">@lang("You have :count notifications", ['count'=>$notifications_count])</span>
                @if($notifications_latest)


                    @foreach($notifications_latest as $notification)
                    @php
                    $notification_text = isset($notification->data['title'])? $notification->data['title'] : $notification->data['module'];
                    @endphp
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{route("backend.notifications.show", $notification)}}">
                        <i class="c-icon {{isset($notification->data['icon'])? $notification->data['icon'] : 'cil-bullhorn'}} "></i>&nbsp;{{$notification_text}}
                    </a>
                    @endforeach
                @endif
            </div>
        </li>

        <li class="nav-item dropdown">
            <a class="nav-link " data-toggle="dropdown" href="#" role="button">
                <div class="image">
                    <img class="img-size-32 mr-3 img-circle elevation-2" src="{{ asset(auth()->user()->avatar) }}" alt="{{ auth()->user()->name }}">
                </div>
            </a>
            <div class="dropdown-menu dropdown-menu-right pt-0">
                <div class="dropdown-header bg-light py-2"><strong>@lang('Account')</strong>
                </div>

                <a class="dropdown-item" href="{{route('backend.users.profile', Auth::user()->id)}}">
                    <i class="c-icon cil-user"></i>&nbsp;
                    {{ Auth::user()->name }}
                </a>
                <a class="dropdown-item" href="{{route('backend.users.profile', Auth::user()->id)}}">
                    <i class="c-icon cil-at"></i>&nbsp;
                    {{ Auth::user()->email }}
                </a>
                <a class="dropdown-item" href="{{ route("backend.notifications.index") }}">
                    <i class="c-icon cil-bell"></i>&nbsp;
                    @lang('Notifications') <span class="badge badge-danger ml-auto">{{$notifications_count}}</span>
                </a>

                <div class="dropdown-header bg-light py-2"><strong>@lang('Settings')</strong>
                </div>

                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="c-icon cil-account-logout"></i>&nbsp;
                    @lang('Logout')
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;"> @csrf </form>
            </div>
        </li>
    </ul>
</nav>