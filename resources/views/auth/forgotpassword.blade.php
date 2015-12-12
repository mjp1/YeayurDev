@extends('templates.default')

@section('content')
	<h1>Forgot Password</h1>
	<form role="form" method="post" action="#">
		<div class="form-group">
			<p class="help-block">Enter email used to register.</p>
			<div class="input-group">
				<span class="input-group-addon glyphicon glyphicon-envelope"></span>
				<input type="email" class="form-control forgot-pass-input input-global" name="email" />
			</div>
		</div>	
		<div class="editprofile-form-btns">
			<a href="{{ route('home') }}"><button type="button" class="btn btn-default">Cancel</button></a>
			<button type="submit" class="btn btn-global">Send Email</button>
			<input type="hidden" name="_token" value="{{ Session::token() }}"/>
		</div>
	</form>
@stop