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
        <div class="nav navbar-nav navbar-right">
          <div class="navbar-img-menu dropdown">
            @if (Auth::user()->getImagePath() === "")
              <i class="fa fa-user-secret fa-4x dropdown-toggle navbar-img img-circle" data-toggle="dropdown"></i>
            @else
              <img src="{{ Auth::user()->getImagePath() }}" class="dropdown-toggle navbar-img img-circle" data-toggle="dropdown"/>
            @endif
              <ul class="dropdown-menu">
                <li><a href="{{ route('profile', ['username' => Auth::user()->username]) }}">My Profile</a></li>
                <li><a href="{{ route('profile.edit') }}">My Settings</a></li>
                <li><a href="{{ route('auth.signout') }}">Sign Out</a></li>
              </ul>
          </div>
          <a href="{{ route('support') }}" class="navbar-support-icon"><i class="fa fa-question-circle fa-2x" aria-hidden="true"></i></a>
        </div>
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