@extends('templates.default')

@section('content')
	<div class="main-wrapper"></div>
	<div class="main-welcome">
		<img src="images/logo_full.png" class="welcome-logo" />
		<h3 class="main-mission">Connecting Streamers and Viewers</h3>
		<!-- <button class="btn btn-primary btn-reg visible-md visible-lg" data-toggle="modal" data-target="#myModal">Register</button> -->
	</div>
	<div class="main-posts-public">
		<h5 class="main-posts-header">Recent Activity</h5>
		<div class="post-grid">
			@if ($posts->count())
			    @foreach ($posts as $post)
				    <div class="main-user-post col-lg-3 col-md-4 col-sm-6 col-xs-12">
				      <div class="thumbnail">
				        <div class="main-streamer-post-pic pic-responsive">
				          <a href="#">
				            @if ($post->user->getImagePath() === "")
				              <i class="fa fa-user-secret fa-3x"></i>
				            @else
				              <img src="{{ asset('images/profiles') }}/{{ $post->user->getImagePath() }}" alt="{{ $post->user->username }}"/>
				            @endif
				          </a>
				        </div>
				        <div class="streamer-post-id">
				          <a href="#">
				            <h5 class="streamer-post-name">{{ $post->user->username }}</h5>
				          </a>
				          <span class="post-time">{{ $post->created_at->diffForHumans() }}</span>
				        </div>
				        <div class="streamer-post-message-main">
				          <div class="message-content">
				            <span>{{ $post->body }}</span>
				          </div>
				        </div>
				      </div>
				    </div>
			    @endforeach
			@endif
		</div>
	</div>

	<!-- Register and Sign In Modals -->

    <div class="modal fade modal-signin" tabindex="-1" role="dialog">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	      	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title">Sign In</h4>
	      </div>
	      <div class="modal-body">
	      	<form role="form" method="post" action="{{ route('profile.signin') }}">
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

    <div class="modal fade modal-signin-redirect" tabindex="-1" role="dialog">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	      	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title">Please sign in to view this profile</h4>
	      </div>
	      <div class="modal-body">
	      	<form role="form" method="post" action="{{ route('profile.signin.redirect') }}">
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
		        <div class="redirect-url"></div>
		        <input type="hidden" name="_token" value="{{ Session::token() }}"/>
		    </form>
	      </div>
	    </div><!-- /.modal-content -->
	  </div><!-- /.modal-dialog -->
	</div><!-- /.modal -->

    <div class="modal fade modal-register" tabindex="-1" role="dialog">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	      	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title">Sign In</h4>
	      </div>
	      <div class="modal-body">
	      	<form role="form" method="post" action="{{ route('profile.signin') }}">
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

@stop