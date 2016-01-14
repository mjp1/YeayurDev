@extends('templates.default')

@section('content')
	<h1>Forgot Password</h1>
	<div class="row">
	<form role="form" method="post" action="/password/email" class="form-horizontal">
		<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
			<label class="col-sm-3 control-label" for="email">Enter Email</label>
			<div class="col-sm-5">
				<input type="email" class="form-control input-global" name="email"/>
				@if ($errors->has('email'))
				<span class="help-block">{{ $errors->first('email') }}</span>
				@endif
			</div>
		</div>	
		<div class="editprofile-form-btns">
			<a href="{{ route('home') }}"><button type="button" class="btn btn-default">Cancel</button></a>
			<button type="submit" class="btn btn-global">Send Email</button>
			<input type="hidden" name="_token" value="{{ Session::token() }}"/>
		</div>
	</form>
</div>
@stop