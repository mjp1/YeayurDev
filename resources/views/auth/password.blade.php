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

@include ('auth.signinmodal')	

@stop