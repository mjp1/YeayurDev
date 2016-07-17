@extends('templates.default')

@section('content')
	<div class="main-wrapper"></div>
	<div class="main-welcome">
		<img src="images/logo_full.png" class="welcome-logo" />
		<h3 class="main-mission">Where the Streamer Meets the Viewer</h3>
	</div>

	<div class="main-content">
		<div class="main-recent-posts col-sm-12 row">
			<h4 class="section-title recent-posts row">RECENT POSTS</h4>
			<div class="recent-post-item-wrapper row">
				@if ($posts)
					@foreach ($posts as $post)
						<div class="recent-post-item">
							<div class="post-streamer-img-wrapper img-responsive">
								<a href="{{ route('profile', ['username' => $post->user->username]) }}">
									@if ($post->user->getImagePath() === "")
										<i class="fa fa-user-secret fa-4x post-streamer-img"></i>
									@else
										<img src="{{ $post->user->getImagePath() }}" class="post-streamer-img" alt="{{ $post->user->username }}" />
									@endif
								</a>
							</div>
							<a href="{{ route('profile', ['username' => $post->user->username]) }}" class="post-streamer-username"><h4>{{ $post->user->username }}</h4></a>
							<span class="recent-post-time">{{ $post->created_at->diffForHumans() }}</span>
							<span class="recent-post-user-followers" title="Number of followers"><i class="fa fa-users"></i>{{ $post->user->followers()->count() }}</span>
							<div class="post-vote-count">Votes: {{ $post->votes() }}</div>
							<div class="post-body-wrapper">
								@if ($post->fan)
									<h5 class="post-details">Leaving post for <a href="{{ route('fan', ['displayName' => $post->fan->display_name]) }}">{{ $post->fan->display_name }}</a> (Fan Page)</h5>
								@else
									<h5 class="post-details">Leaving post for <a href="{{ route('profile', ['username' => $post->profile->username]) }}">{{ $post->profile->username }}</a></h5>
								@endif
								<span class="post-body"><?php echo $post->body ?></span>
							</div>
						</div>
					@endforeach
				@endif
			</div>
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