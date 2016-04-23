@extends('templates.default')

@section('content')

	<!-- Show signed up alert for new users -->
	@include('templates.partials.success')
	
	<h1>Support</h1>
	<form role="form" method="post" action="" class="form-horizontal support-form col-sm-6 col-sm-offset-3">
		<div class="form-group{{ $errors->has('support_content') ? ' has-error' : '' }}">
			<span class="help-block">Please contact us with any questions or comments.</span>
			<textarea class="form-control support-text input-global" rows="5" name="support_content"></textarea>
			@if ($errors->has('support_content'))
				<span class="help-block">{{ $errors->first('support_content') }}</span>
			@endif
		</div>
		<div class="form-group pull-right support-form-btns">
			<a href="{{route('profile', ['username' => Auth::user()->username]) }}"><button type="button" class="btn btn-default btn-close">Cancel</button></a>
			<button type="submit" class="btn btn-global">Submit</button>
		</div>		
		<input type="hidden" name="_token" value="{{Session::token()}}"/>			
	</form>

		


@stop