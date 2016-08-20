@extends('templates.default')

@section('content')
	<div class="main-wrapper"></div>
	<div class="main-welcome">
		<img src="images/logo_full.png" class="welcome-logo" />
		<h3 class="main-mission">Where the Streamer Meets the Viewer</h3>
	</div>

	<div class="main-content">
		<div class="main-new-users col-sm-12 row">
			<h4 class="section-title off-main new-users">NEW PROFILES</h4>
			@if ($newUsers)
				@foreach ($newUsers as $user)
				<div class="new-users-item-wrapper col-sm-3 col-xs-4">
					<div class="new-users-item">
						@if (!$user->image_path)
							<img src="{{ asset('images/no-pic.JPG') }}" class="new-user-item-img img-responsive" />
						@else
							<img src="{{ $user->getImagePath() }}" class="new-user-item-img img-responsive" />
						@endif
						<div class="item-details-top">
							<h4 class="item-details-top-username">{{ $user->username }}</h4>
							<h5 class="new-users-followers" title="Number of followers"><i class="fa fa-users"></i>{{ $user->followers()->count() }}</h5>
						</div>
						<div class="item-details-bottom">
							<h4><a href="{{ route('profile', ['username' => $user->username]) }}" class="bottom-profile">Profile</a></h4>
							<h4><a href="https://www.twitch.tv/{{ $user->username }}" target="_blank" class="bottom-twitch">Twitch <i class="fa fa-external-link" aria-hidden="true"></i></a></h4>
						</div>
						<div class="item-overlay"></div>
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