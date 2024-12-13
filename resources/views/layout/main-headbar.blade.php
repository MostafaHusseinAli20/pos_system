<header class="main-header">

  <!-- Logo -->
  {{-- <a href="{{ asset('dashboard') }}/index2.html" class="logo">
      <span class="logo-mini"><b>A</b>LT</span>
      <span class="logo-lg"><b>Admin</b>LTE</span>
  </a> --}}

  <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
      </a>

      <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">

              {{--<!-- Notifications: style can be found in dropdown.less -->--}}
              @can('notifications')
                <li class="dropdown notifications-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-bell-o"></i>
                        <span class="label label-warning">{{auth()->user()->unreadNotifications->count()}}</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="header">You Have {{auth()->user()->unreadNotifications->count()}} Notifications</li>
                        <li>
                            {{--<!-- inner menu: contains the actual data -->--}}
                            <ul class="menu">
                                @foreach (auth()->user()->unreadNotifications as $notification)
                                
                                    <li>
                                        <a href="{{ $notification->data['url'] }}">
                                            <i class="fa fa-users text-aqua"></i> @lang('site.body_Add_notifications') {{ $notification->data['user']}}
                                        </a>
                                    </li>

                                @endforeach

                            </ul>
                        </li>
                        <li class="footer">
                            <a href="{{ route('MarkAsRead') }}">@lang('site.read_all')</a>
                        </li>
                    </ul>
                </li>
              @endcan
              
              {{--<!-- Tasks: style can be found in dropdown.less -->--}}
              <li class="dropdown tasks-menu">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-flag-o"></i></a>
                  <ul class="dropdown-menu">
                      <li>
                          {{--<!-- inner menu: contains the actual data -->--}}
                          <ul class="menu">
                              @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                  <li>
                                      <a rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                          {{ $properties['native'] }}
                                      </a>
                                  </li>
                              @endforeach
                          </ul>
                      </li>
                  </ul>
              </li>

              {{--<!-- User Account: style can be found in dropdown.less -->--}}
              <li class="dropdown user user-menu">

                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                      <img src="{{ asset('dashboard_files/img/avatar5.png') }}" class="user-image" alt="User Image">
                      <span class="hidden-xs">{{ auth()->user()->first_name }} {{ auth()->user()->last_name }}</span>
                  </a>
                  <ul class="dropdown-menu">

                      {{--<!-- User image -->--}}
                      <li class="user-header">
                          <img src="{{ asset('dashboard_files/img/avatar5.png') }}" class="img-circle" alt="User Image">

                          <p style="color: black">
                              {{ auth()->user()->first_name }} {{ auth()->user()->last_name }}
                              <small>{{auth()->user()->created_at}}</small>
                          </p>
                      </li>

                      {{--<!-- Menu Footer-->--}}
                      <li class="user-footer">


                          <a href="{{ route('logout') }}" class="btn btn-default btn-flat" onclick="event.preventDefault();
                                           document.getElementById('logout-form').submit();">@lang('site.logout')</a>

                          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                              @csrf
                          </form>

                      </li>
                  </ul>
              </li>
          </ul>
      </div>
  </nav>

</header>