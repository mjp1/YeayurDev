@extends('templates.default')

@section('content')
	<h3>Your search for "{{ Request::input('query') }}"</h3>
	@if (!$users->count())
		<p>No results found.</p>
	@else
		<div class="search-results-list">	
			@foreach ($users as $user)
				@include('user/partials/userblock')
			@endforeach
		</div>
	@endif
@stop