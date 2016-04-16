@extends('templates.default')

@section('content')

	<form method="post" action="{{ route('test.post') }}" class="form-horizontal col-sm-6">
		<input type="text" name="url" class="form-control" id="url"/>
		@if ($errors->has('url'))
			<span class="help-block">{{ $errors->first('url') }}</span>
		@endif
		<button type="submit" class="btn btn-submit btn-global">Submit</button>
		<input type="hidden" name="_token" value="{{Session::token()}}"/>
	</form>

@stop