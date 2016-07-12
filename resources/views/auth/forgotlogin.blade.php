@extends('templates.default')

@section('content')
	<h3>Forgot Login</h3>

	<div class="col-sm-6 col-sm-offset-3">
		<div class="alert alert-danger" role="alert">
			<h5>The email and password combination entered does not match our records.</h5>
			<hr>
			<h6>Re-enter correct combination or <a href="/password/email">Reset Password</a>.</h6>
		</div>
		<form method="post" action="{{ route('profile.signin') }}" class="form-horizontal" role="form">
			<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
				<input type="email" class="form-control input-global" name="email" placeholder="Enter email address"/>
				@if ($errors->has('email'))
					<span class="help-block">{{ $errors->first('email') }}</span>
				@endif
			</div>
			<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
				<input type="password" class="form-control input-global" name="password" placeholder="Enter password"/>
				@if ($errors->has('password'))
					<span class="help-block">{{ $errors->first('password') }}</span>
				@endif
			</div>
			<div class="form-group form-button-global">
				<a class="btn btn-default" href="{{ route('index') }}">Cancel</a>
				<button type="submit" class="btn btn-global">Login</button>
			</div>
			<input type="hidden" name="_token" value="{{ Session::token() }}"/>
		</form>
	</div>
@stop