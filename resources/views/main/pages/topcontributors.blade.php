@extends('templates.default')

@section('content')
	<div class="main-wrapper"></div>
	<div class="main-welcome">
		<img src="images/logo_full.png" class="welcome-logo" />
		<h3 class="main-mission">Where the Streamer Meets the Viewer</h3>
	</div>

	<div class="main-content">
		<div class="main-top-contributors col-sm-12 row">
			<h4 class="section-title top-contributors row">TOP CONTRIBUTORS</h4>
			@if ($topContributors)
				@foreach ($topContributors as $contributor)
					<div class="new-users-item-wrapper col-sm-3 col-xs-6">
						<div class="new-users-item">
							<a href="{{ route('profile', ['username' => $contributor->username]) }}">
								@if (!$contributor->image_path)
									<img src="{{ asset('images/no-pic.JPG') }}" class="new-user-item-img img-responsive" />
								@else
									<img src="{{ $contributor->getImagePath() }}" class="new-user-item-img img-responsive" />
								@endif
							</a>
							<a href="{{ route('profile', ['username' => $contributor->username]) }}"><span class="new-user-username" title="{{ $contributor->username }}">{{ $contributor->username }} <span title="Reputation Points">({{$contributor->user_points }})</span></span></a>
							<div class="item-details">
								<span class="new-user-followers" title="Number of followers"><i class="fa fa-users"></i>{{ $contributor->followers()->count() }}</span>
								<span class="new-user-views" title="Profile Views"><i class="fa fa-eye" aria-hidden="true"></i>{{ $contributor->myProfileViews() }}</span>
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