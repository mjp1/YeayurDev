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
      @if (Auth::check() && Route::current()->getName() === 'oauth.oauthconfirmation')
      <a class="navbar-brand navbar-header-brand navbar-logo login-logo" disabled="disabled"><img src="{{ asset('images/logo_856469_web.png') }}" class="login-logo"/></a>
      @elseif (Auth::check() && Route::current()->getName() === 'oauth.oauth')
      <a class="navbar-brand navbar-header-brand navbar-logo login-logo" disabled="disabled"><img src="{{ asset('images/logo_856469_web.png') }}" class="login-logo"/></a>
      @elseif (Auth::check() && Route::current()->getName() === 'oauth.error')
      <a class="navbar-brand navbar-header-brand navbar-logo login-logo" disabled="disabled"><img src="{{ asset('images/logo_856469_web.png') }}" class="login-logo"/></a>
      @elseif (Auth::check() && Route::current()->getName() != 'oauth.oauthconfirmation' && Route::current()->getName() != 'oauth.oauth' && Route::current()->getName() != 'oauth.error')
      <a class="navbar-brand navbar-header-brand navbar-logo login-logo" href="{{ route('index.discover') }}"><img src="{{ asset('images/logo_856469_web.png') }}" class="login-logo"/></a>
      @elseif (!Auth::check())
      <a class="navbar-brand navbar-header-brand navbar-logo login-logo" href="{{ route('index.public') }}"><img src="{{ asset('images/logo_856469_web.png') }}" class="login-logo"/></a>
      @endif
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
        @if (Auth::check() && Route::current()->getName() != 'oauth.oauthconfirmation' && Route::current()->getName() != 'oauth.oauth' && Route::current()->getName() != 'oauth.error')
        <form class="head-search col-sm-4" role="search" action="{{ route('search.results') }}">
            <input type="text" class="form-control head-search-input" name="query" placeholder="Search" />
            <span class="input-group-btn head-search-btn">
                <button class="btn search-icon" type="submit">
                    <span class="glyphicon glyphicon-search"></span>
                </button>
            </span>
        </form>
        <div class="nav navbar-nav navbar-right">
            <a href="{{route('profile', ['username' => Auth::user()->username]) }}" class="navbar-right-name">{{ Auth::user()->username }}</a>
            <div class="dropdown">
                <a href="#" class="dropdown-toggle nav-settings" data-toggle="dropdown"><span class="glyphicon glyphicon-cog"></span></a>
                <ul class="dropdown-menu">
                    <li><a href="{{ route('profile.edit') }}">My Settings</a></li>
                    <li><a href="{{ route('support') }}">Support</a></li>
                    <li><a href="{{ route('auth.signout') }}">Sign Out</a></li>
                </ul>
            </div> 
        </div>
        @elseif (Route::current()->getName() === 'auth.signup' || Route::current()->getName() === 'forgotlogin' || Route::current()->getName() === 'oauth.oauth' || Route::current()->getName() === 'oauth.oauthconfirmation' || Route::current()->getName() === 'oauth.error' || Route::current()->getName() === 'terms' || Route::current()->getName() === 'privacy')

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
</nav>