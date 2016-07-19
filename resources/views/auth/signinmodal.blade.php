<!-- Register and Sign In Modals -->

<div class="modal fade modal-signin" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
      	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Sign In</h4>
      </div>
      <div class="modal-body">
      	<a href="{{ route('oauth_twitch') }}" class="btn btn-default twitch-oauth col-sm-8 col-sm-offset-2"><img src="{{ asset('images/twitch_logo_small.png') }}" />Login with Twitch</a>
      	<br><br>
      	<form role="form" method="post" action="{{ route('profile.signin') }}">
      		<h5 style="text-align:center;">Or sign in with an email address.</h5>
	        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
	            <input type="email" class="form-control input-global input-lg" name="email" placeholder="Enter email" value="{{ Request::old('email') ?: '' }}"/>
	        </div>
	        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
	            <input type="password" class="form-control input-global input-lg" name="password" placeholder="Password"/>
	        </div>
	        <button type="submit" class="btn btn-default btn-global login-btn">Login</button>
	        <div class="login-options">
	            <span class="login-chkbox"><input type="checkbox" name="remember" id="stay-login"/><label for="stay-login" class="chk-label"> Keep me logged in</label></span>
	        </br>
	            <a href="/password/email" class="login-forgot-cred">Forgot Password?</a>
	        </div>
	        <input type="hidden" name="_token" value="{{ Session::token() }}"/>
	    </form>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->