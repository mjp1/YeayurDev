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
      <a class="navbar-brand navbar-header-brand navbar-logo login-logo" href="{{ route('main') }}"><img src="{{ asset('images/logo_856469_web.png') }}" class="login-logo"/></a>
      @else
      <a class="navbar-brand navbar-header-brand navbar-logo login-logo" href="{{ route('home') }}"><img src="{{ asset('images/logo_856469_web.png') }}" class="login-logo"/></a>
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
            <a href="{{route('profile', ['username' => Auth::user()->username]) }}" class="navbar-right-name">{{ Auth::user()->username }}</a>
            <div class="dropdown">
                <a href="#" class="dropdown-toggle nav-settings" data-toggle="dropdown"><span class="glyphicon glyphicon-cog"></span></a>
                <ul class="dropdown-menu">
                    <li><a href="{{ route('profile.edit') }}">Edit Profile</a></li>
                    <li><a href="{{ route('support') }}">Support</a></li>
                    <li><a href="{{ route('auth.signout') }}">Sign Out</a></li>
                </ul>
            </div> 
        </div>
        @elseif (Route::current()->getName() === 'auth.signup' || Route::current()->getName() === 'forgotlogin')

        @else
        <div class="navbar-form navbar-right">
            <form role="form" method="post" action="{{ route('profile.signin') }}">
                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <input type="text" class="form-control login-input" name="email" placeholder="Enter email" value="{{ Request::old('email') ?: '' }}"/>
                </div>
                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <input type="password" class="form-control login-input" name="password" placeholder="Password"/>
                </div>
                <button type="submit" class="btn btn-default login-btn">Login</button>
                <div class="row login-options">
                    <span class="login-chkbox"><input type="checkbox" name="remember" id="stay-login"/><label for="stay-login" class="chk-label"> Keep me logged in</label></span>
                    <span><a href="/password/email" class="login-forgot-cred">Forgot Password?</a></span>
                </div>
                <!-- <div class="row login-options visible-xs">
                    <span class="visible-md visible-lg"><a href="#" class="login-forgot-cred-xs" data-toggle="modal" data-target="#forgotPass">Forgot Password?</a></span>
                    <span class="visible-xs visible-sm"><a href="/password/email" class="login-forgot-cred-xs">Forgot Password?</a></span>
                </div> -->
                <input type="hidden" name="_token" value="{{ Session::token() }}"/>
            </form>
        </div>  
        @endif
    </div>
  </div>
</nav>