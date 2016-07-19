@extends('templates.default')

@section('content')

	<!-- Show signed up alert for new users -->
	@include('templates.partials.success')
	
	<h1>Contact Us</h1>
	<form role="form" method="post" action="{{ route('post.support.public') }}" class="form-horizontal support-form col-sm-6 col-sm-offset-3">
		<div class="form-group">
				<span class="help-block">Please contact us with any questions or comments.</span>
				<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
					<input type="email" class="form-control input-global" name="email" placeholder="Email"/>
					@if ($errors->has('email'))
						<span class="help-block">{{ $errors->first('email') }}</span>
					@endif
				</div>
				<div class="form-group{{ $errors->has('support_content') ? ' has-error' : '' }}">
					<textarea class="form-control about-text" rows="5" name="support_content"></textarea>
					@if ($errors->has('support_content'))
						<span class="help-block">{{ $errors->first('support_content') }}</span>
					@endif
				</div>
		</div>
		<div class="form-group pull-right support-public-form-btn">
			<button type="submit" class="btn btn-global">Submit</button>
		</div>		
		<input type="hidden" name="_token" value="{{Session::token()}}"/>			
	</form>

@include ('auth.signinmodal')

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