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

		


@stop