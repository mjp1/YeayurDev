@extends('templates.default')

@section('content')
	<h1>Register For Yeayur</h1>
	<div class="alert alert-warning text-center col-sm-8 col-sm-offset-2" role="alert">
		We are currently still testing the website. Please feel free to <a href="{{ route('support.public') }}" target="_blank">contact us</a> with any issues or comments you have.
	</div>
		<form role="form" method="post" action="{{ route('auth.signup') }}" class="form-horizontal col-sm-8 col-sm-offset-2">
			<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
				<label class="col-sm-3 control-label" for="email">Enter Email</label>
				<div class="col-sm-9">
					<input type="email" class="form-control input-global" name="email" value="{{ Request::old('email') ?: '' }}"/>
					@if ($errors->has('email'))
					<span class="help-block">{{ $errors->first('email') }}</span>
					@endif
				</div>
			</div>
			<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
				<label class="col-sm-3 control-label" for="password">Enter Password</label>
				<div class="col-sm-9">
					<input type="password" class="form-control input-global" name="password"/>
					@if ($errors->has('password'))
					<span class="help-block">{{ $errors->first('password') }}</span>
					@endif
				</div>
			</div>
			<div class="form-group{{ $errors->has('confirm_password') ? ' has-error' : '' }}">
				<label class="col-sm-3 control-label" for="confirm_password">Confirm Password</label>
				<div class="col-sm-9">
					<input type="password" class="form-control input-global" name="confirm_password"/>
					@if ($errors->has('confirm_password'))
					<span class="help-block">{{ $errors->first('confirm_password') }}</span>
					@endif
				</div>
			</div>
			<div class="form-group{{ $errors->has('birthdate') ? ' has-error' : '' }}">
				<label class="col-sm-3 control-label" for="birthdate">Birthdate</label>
				<div class="col-sm-9">
					<input type="date" class="form-control input-global" name="birthdate" value="{{ Request::old('birthdate') ?: '' }}"/>
					@if ($errors->has('birthdate'))
					<span class="help-block">{{ $errors->first('birthdate') }}</span>
					@endif
				</div>
			</div>
			<div class="form-group reg-terms{{ $errors->has('agreed_terms') ? ' has-error' : '' }}">
				<div class="checkbox col-sm-9 col-sm-offset-3">
					<label><input type="checkbox" name="agreed_terms" value="1">Agree to our <a href="{{ route('terms') }}" target="_blank">Terms of Service</a></label>
					@if ($errors->has('agreed_terms'))
					<span class="help-block">You must accept the Terms and Conditions</span>
					@endif
				</div>
			</div>
			<div class="form-group mobile-register-form-btns">
				<a class="btn btn-default btn-close" href="{{ route('home') }}">Cancel</a>
				<button type="submit" class="btn btn-global">Register</button>
			</div>
			<input type="hidden" name="_token" value="{{ Session::token() }}"/>
		</form>
@stop