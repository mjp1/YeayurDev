<nav class="navbar navbar-header navbar-fixed-top">
  <div class="container">
    <div class="navbar-header">
        @if (Route::current()->getName() === 'auth.signup' || Route::current()->getName() === 'forgotlogin')

        @else
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>                       
          </button>
        @endif
      @if (Auth::check())
        <a class="navbar-brand navbar-header-brand navbar-logo login-logo" href="{{ route('discover.connections') }}"><img src="{{ asset('images/logo_856469_web.png') }}" class="login-logo"/></a>
        <span class="hidden user-username">{{ Auth::user()->username }}</span>
      @elseif (!Auth::check())
        <a class="navbar-brand navbar-header-brand navbar-logo login-logo" href="{{ route('index.public') }}"><img src="{{ asset('images/logo_856469_web.png') }}" class="login-logo"/></a>
      @endif
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
        @if (Auth::check())
        <form class="head-search col-sm-4" role="search" action="{{ route('search.results') }}">
            <input type="text" class="form-control head-search-input" name="query" placeholder="Search" />
            <span class="input-group-btn head-search-btn">
                <button class="btn search-icon" type="submit">
                    <span class="glyphicon glyphicon-search"></span>
                </button>
            </span>
        </form>
        <ul class="nav navbar-nav navbar-right navbar-right-menu">
          <li class="navbar-img-menu navbar-right-menu-item">
            @if (Auth::user()->getImagePath() === "")
              <i class="fa fa-user-secret fa-3x dropdown-toggle navbar-img img-circle" data-toggle="dropdown"></i>
            @else
              <img src="{{ Auth::user()->getImagePath() }}" class="dropdown-toggle navbar-img img-circle" data-toggle="dropdown"/>
            @endif
              <ul class="dropdown-menu">
                <li><a href="{{ route('profile', ['username' => Auth::user()->username]) }}">My Profile</a></li>
                <li><a href="{{ route('profile.edit') }}">My Settings</a></li>
                <li><a href="{{ route('auth.signout') }}">Sign Out</a></li>
              </ul>
          </li>

         <!-- Display the user's notifications -->

          <li class="navbar-right-menu-item user-notifications">
            <span id="user-notifications-count">{{ Auth::user()->getNewNotifications() }}</span>
            <i class="fa fa-bell fa-2x dropdown-toggle user-notifications-bell" data-toggle="dropdown" aria-hidden="true"></i>
            <ul class="dropdown-menu user-notifications-list">
              <li class="dropdown-header notification-header">Notifications<span class="clear-notifications">Clear All</span></li>
              @if (!Auth::user()->notifications->count())
              <li class="no-notifications">You have no notifications</li>
              @else
              @foreach (Auth::user()->notifications as $notification)
              <li class="user-notification-item">
                @if ($notification->pivot->notification_type === "Follow")
                    <div class="notification">
                      <span class="remove-notification"><i class="fa fa-times-circle-o" aria-hidden="true"></i></span>
                      <div class="notification-image">
                        @if ($notification->getImagePath() === "")
                          <i class="fa fa-user-secret fa-2x img-circle"></i>
                        @else
                          <img src="{{ $notification->getImagePath() }}" class="img-circle" />
                        @endif
                      </div>
                      <div class="notification-content"><a href="{{ route('profile', ['username' => $notification->username]) }}">{{ $notification->username }}</a> is following you.</div>
                      <span class="notification-time">{{ $notification->pivot->created_at->diffForHumans() }}</span>
                    </div>
                @endif
                @if ($notification->pivot->notification_type === "Post")
                    <div class="notification">
                      <span class="remove-notification"><i class="fa fa-times-circle-o" aria-hidden="true"></i></span>
                      <div class="notification-image">
                        @if ($notification->getImagePath() === "")
                          <i class="fa fa-user-secret fa-2x img-circle"></i>
                        @else
                          <img src="{{ $notification->getImagePath() }}" class="img-circle" />
                        @endif
                      </div>
                      <div class="notification-content"><a href="{{ route('profile', ['username' => $notification->username]) }}">{{ $notification->username }}</a> posted new content.</div>
                      <span class="notification-time">{{ $notification->pivot->created_at->diffForHumans() }}</span>
                    </div>
                @endif
                @if ($notification->pivot->notification_type === "Like")
                    <div class="notification">
                      <span class="remove-notification"><i class="fa fa-times-circle-o" aria-hidden="true"></i></span>
                      <div class="notification-image">
                        @if ($notification->getImagePath() === "")
                          <i class="fa fa-user-secret fa-2x img-circle"></i>
                        @else
                          <img src="{{ $notification->getImagePath() }}" class="img-circle" />
                        @endif
                      </div>
                      <div class="notification-content"><a href="{{ route('profile', ['username' => $notification->username]) }}">{{ $notification->username }}</a> liked your post.</div>
                      <span class="notification-time">{{ $notification->pivot->created_at->diffForHumans() }}</span>
                    </div>
                @endif
                @if ($notification->pivot->notification_type === "Stream")
                    <div class="notification">
                      <span class="remove-notification"><i class="fa fa-times-circle-o" aria-hidden="true"></i></span>
                      <div class="notification-image">
                        @if ($notification->getImagePath() === "")
                          <i class="fa fa-user-secret fa-2x img-circle"></i>
                        @else
                          <img src="{{ $notification->getImagePath() }}" class="img-circle" />
                        @endif
                      </div>
                      <div class="notification-content"><a href="{{ route('profile', ['username' => $notification->username]) }}">{{ $notification->username }}</a> added their stream.</div>
                      <span class="notification-time">{{ $notification->pivot->created_at->diffForHumans() }}</span>
                    </div>
                @endif
                <span class="hidden notification-id">{{ $notification->pivot->id }}</span>
              </li>
              @endforeach
              @endif

            </ul>
          </li>
          <li class="navbar-right-menu-item navbar-right-menu-support">
            <a href="{{ route('support') }}"><i class="fa fa-question-circle fa-2x" aria-hidden="true"></i></a>
          </li>
        </ul>
        @else
        <div class="navbar-form navbar-right">
          <ul class="navbar-btns-public">
            <li>
              <a href="{{ route('auth.signup') }}" class="btn btn-default register-btn">Register</a>
            </li>
            <li>
              <button class="btn btn-default signin-btn">Sign In</button>
            </li>
          </ul>
        </div>  
        @endif
    </div>
  </div>

  <!-- Keep notification menu open unless clicking the bell icon or clicking off the menu -->
  <script>
     $(document).on('click', 'body .dropdown-menu', function (e) {
        e.stopPropagation();
    });
  </script>

</nav>