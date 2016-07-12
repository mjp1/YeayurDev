@extends('templates.default')

@section('content')
	<div class="main-wrapper"></div>
	<div class="main-welcome">
		<img src="images/logo_full.png" class="welcome-logo" />
		<h3 class="main-mission">Where the Streamer Meets the Viewer</h3>
	</div>

	<div class="main-content">
		<div class="main-new-users col-sm-12 row">
			<h4 class="section-title new-users row">NEW PROFILES</h4>
			@if ($newUsers)
				@foreach ($newUsers as $user)
					<div class="new-users-item-wrapper col-sm-3 col-xs-6">
						<div class="new-users-item">
							<a href="{{ route('profile', ['username' => $user->username]) }}">
								@if (!$user->image_path)
									<img src="{{ asset('images/no-pic.jpg') }}" class="new-user-item-img img-responsive" />
								@else
									<img src="{{ $user->image_path }}" class="new-user-item-img img-responsive" />
								@endif
							</a>
							<a href="{{ route('profile', ['username' => $user->username]) }}"><span class="new-user-username" title="{{ $user->username }}">{{ $user->username }}</span></a>
							<div class="item-details">
								<span class="new-user-followers" title="Number of followers"><i class="fa fa-users"></i>{{ $user->followers()->count() }}</span>
								<span class="new-user-views" title="Profile Views"><i class="fa fa-eye" aria-hidden="true"></i>{{ $user->myProfileViews() }}</span>
							</div>
						</div>
					</div>
				@endforeach
			@endif
		</div>
	</div>
<script>
/*var $grid = $('.main-content').imagesLoaded( function() {
		$grid.masonry({
			  // options
			  itemSelector: '.new-users-item-wrapper',
			  columnWidth: '.new-users-item-wrapper'
		});
	});*/

	// Infinite Scroll 
/*
	$('.main-content').infinitescroll({

		

		navSelector: '.pagination',
		nextSelector: '.pagination a:last',
		itemSelector: '.new-users-item-wrapper',
		bufferPx: 400
	},*/

	// Use Masonry appended method to add new elements to page

	/*	function (newElements) {
			var $newElems = $( newElements);

			var $grid = $('.main-content').imagesLoaded( function() {
				$('.main-content').masonry('appended', $newElems);
			});
			
		}
	);*/
</script>
@stop