@extends('templates.default')

@section('content')
	<h4 class="owner-notice" style="text-align:center;margin-bottom:20px;">Are you {{ $fan->getDisplayName() }}? If so, <a href="#">Authorize with Twitch</a> to turn this into your Yeayur profile page!</h4>
<!-- TWITCH STREAM EMBED -->		
		<div class="stream-embed">
			<div class="embed-responsive embed-responsive-16by9">
			    <iframe 
			        src="https://player.twitch.tv/?channel={{ $fan->getDisplayName() }}" 
			        frameborder="0" 
			        scrolling="no"
			        allowfullscreen="true">
			    </iframe>
			</div>
		</div>
	
<!-- MAIN STREAMER INFO AND FEED SECTION -->		

			<div class="streamer-info-main col-sm-5">
				<div class="streamer-info well">
					<div class="streamer-pic pic-responsive">
						@if ($fan->getLogoUrl() === "")
						<i class="fa fa-user-secret fa-4x img-circle"></i>
						@else
						<img src="{{ $fan->getLogoUrl() }}" class="img-circle" />
						@endif
					</div>
					<div class="streamer-id">
						<h4 class="streamer-name">{{ $fan->getDisplayName() }}
							@if (Auth::check())
								@if (Auth::user()->isFollowingFanPage($fan))
									<a href="{{ route('fan.remove', ['fan' => $fan->getDisplayName()]) }}" class="btn btn-default btn-remove" title="Unfollow"><span class="glyphicon glyphicon-minus"></span></a>
								@else
									<a href="{{ route('fan.add', ['fan' => $fan->getDisplayName()]) }}" class="btn btn-default btn-add" title="Follow"><span class="glyphicon glyphicon-plus"></span></a>
								@endif
								<span class="body-content-edit"><i class="fa fa-pencil" aria-hidden="true"></i></span>
							@endif
						</h4>
					</div>

<!-- STREAMER FANS -->		
					<div class="streamer-conn">
						<i class="fa fa-users" title="Number of followers"></i>
						<span class="fan-count">{{ $fan->followers()->count() }}</span>
					</div>
<!-- ABOUT ME SECTION -->		
					
					<div class="about-me-wrapper">
						<h5 class="about-me">About Me</h5>
						<span class="aboutme-text">{{ $fan->getBio() }}</span>
					</div>

					
				</div>

				
			</div>

<!-- STREAMER FEED SECTION -->		
					
		<div class="fan-page-info col-sm-7 well">
			@if ($fan->body)
			<div class="fan-page-body-content">
				<?php echo $fan->body ?>
			</div>
			@endif
			<form method="post" action="/fan/{{ $fan->id }}" id="fan-page-form" class="{{ $errors->has('fan-page-input') ? ' has-error' : '' }}">
				<textarea class="form-control input-global" id="fan-page-input" name="fan-page-input" rows="3"></textarea>
				@if ($errors->has('fan-page-input'))
					<span class="help-block">{{ $errors->first('fan-page-input') }}</span>
				@endif
				<div class="fan-page-form-btns">
					<button type="button" class="btn btn-default fan-page-form-btn-cancel">Cancel</button>
					<button type="submit" class="btn btn-global">Save Edits</button>
				</div>
				<input type="hidden" name="_token" value="{{ Session::token() }}"/>
			</form>
		</div>

    <div class="modal fade modal-signin" tabindex="-1" role="dialog">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	      	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title">Sign In</h4>
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
	        <h4 class="modal-title">You must sign in to perform this action</h4>
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
		        <input type="hidden" name="_token" value="{{ Session::token() }}"/>
		    </form>
	      </div>
	    </div><!-- /.modal-content -->
	  </div><!-- /.modal-dialog -->
	</div><!-- /.modal -->


		<script>
			$('#flash-overlay-modal').modal();
		</script>

	<script src='//cdn.tinymce.com/4/tinymce.min.js'></script>
	<script>
		tinymce.init({
			selector: '#fan-page-input',
			menubar: false,
			force_br_newlines : false,
        	force_p_newlines : false,
        	forded_root_block: '',
        	remove_linebreaks : false,
		});
  </script>
    <script src="{{ asset('js/sweet-alert.min.js') }}"></script>

@stop