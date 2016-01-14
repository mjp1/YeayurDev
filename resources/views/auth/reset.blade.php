@extends('templates.default')

@section('content')
	<h1>Reset Password</h1>
	<form role="form" method="post" action="/password/reset" class="form-horizontal">
		{!! csrf_field() !!}
   		<input type="hidden" name="token" value="{{ $token }}">
		<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
			<label class="col-sm-3 control-label" for="email">Enter Email</label>
			<div class="col-sm-5">
				<input type="email" class="form-control input-global" name="email" value="{{ Request::old('email') ?: '' }}"/>
				@if ($errors->has('email'))
				<span class="help-block">{{ $errors->first('email') }}</span>
				@endif
			</div>
		</div>
		<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
			<label class="col-sm-3 control-label" for="password">Enter Password</label>
			<div class="col-sm-5">
				<input type="password" class="form-control input-global" name="password"/>
				@if ($errors->has('password'))
				<span class="help-block">{{ $errors->first('password') }}</span>
				@endif
			</div>
		</div>
		<div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
			<label class="col-sm-3 control-label" for="password_confirmation">Confirm Password</label>
			<div class="col-sm-5">
				<input type="password" class="form-control input-global" name="password_confirmation"/>
				@if ($errors->has('password_confirmation'))
				<span class="help-block">{{ $errors->first('password_confirmation') }}</span>
				@endif
			</div>
		</div>
		<div class="editprofile-form-btns">
			<a href="{{ route('home') }}"><button type="button" class="btn btn-default">Cancel</button></a>
			<button type="submit" class="btn btn-global">Reset Password</button>
		</div>
	</form>
@stop