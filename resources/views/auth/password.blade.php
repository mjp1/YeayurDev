@extends('templates.default')

@section('content')
	<h1>Forgot Password</h1>
	<div class="col-sm-6 col-sm-offset-3">
		@include('templates.partials.success')
		<form role="form" method="post" action="/password/email" class="form-horizontal">
			<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
				<input type="email" class="form-control input-global" name="email" placeholder="Enter email" />
				@if ($errors->has('email'))
					<span class="help-block">{{ $errors->first('email') }}</span>
				@endif
			</div>
			<div class="form-group form-button-global">
				<a class="btn btn-default" href="{{ route('index.public') }}">Cancel</a>
				<button type="submit" class="btn btn-global">Send Email</button>
			</div>
			<input type="hidden" name="_token" value="{{ Session::token() }}"/>
		</form>
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

@stop