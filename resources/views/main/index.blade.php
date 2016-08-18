@extends('templates.default')

@section('content')
	<div class="main-wrapper"></div>
	<div class="main-welcome">
		<img src="images/logo_full.png" class="welcome-logo" />
		<h3 class="main-mission">Where the Streamer Meets the Viewer</h3>
	</div>

	<div class="main-content">
		<div class="main-new-users">
			<div class="header-row">
				<h4 class="section-title new-users">NEW PROFILES</h4>
				<a href="{{ route('index.profiles') }}" class="view-more"><h6>VIEW MORE <i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i></h6></a>
			</div>
			<div class="owl-carousel">
			
			<!-- @if ($newUsers)
				@foreach ($newUsers as $user)
					<div class="new-users-item-wrapper col-sm-3 col-xs-6">
						<div class="new-users-item">
							<a href="{{ route('profile', ['username' => $user->username]) }}">
								@if (!$user->image_path)
									<img src="{{ asset('images/no-pic.JPG') }}" class="new-user-item-img img-responsive" />
								@else
									<img src="{{ $user->getImagePath() }}" class="new-user-item-img img-responsive" />
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
			@endif -->
				
				<div class="new-users-item">
					<img src="{{ $user->getImagePath() }}" class="new-user-item-img img-responsive" />
					<div class="item-details-top">
						<p>Hello</p>
					</div>
					<div class="item-details-bottom">
						<p>Goodbye</p>
					</div>
					<div class="item-overlay"></div>
				</div>
				<div class="new-users-item">
					<img src="{{ $user->getImagePath() }}" class="new-user-item-img img-responsive" />
					<div class="item-details-top">
						<p>Hello</p>
					</div>
					<div class="item-details-bottom">
						<p>Goodbye</p>
					</div>
					<div class="item-overlay"></div>
				</div>
				<div class="new-users-item">
					<img src="{{ $user->getImagePath() }}" class="new-user-item-img img-responsive" />
					<div class="item-details-top">
						<p>Hello</p>
					</div>
					<div class="item-details-bottom">
						<p>Goodbye</p>
					</div>
					<div class="item-overlay"></div>
				</div>
				<div class="new-users-item">
					<img src="{{ $user->getImagePath() }}" class="new-user-item-img img-responsive" />
					<div class="item-details-top">
						<p>Hello</p>
					</div>
					<div class="item-details-bottom">
						<p>Goodbye</p>
					</div>
					<div class="item-overlay"></div>
				</div>
				<div class="new-users-item">
					<img src="{{ $user->getImagePath() }}" class="new-user-item-img img-responsive" />
					<div class="item-details-top">
						<p>Hello</p>
					</div>
					<div class="item-details-bottom">
						<p>Goodbye</p>
					</div>
					<div class="item-overlay"></div>
				</div>
				<div class="new-users-item">
					<img src="{{ $user->getImagePath() }}" class="new-user-item-img img-responsive" />
					<div class="item-details-top">
						<p>Hello</p>
					</div>
					<div class="item-details-bottom">
						<p>Goodbye</p>
					</div>
					<div class="item-overlay"></div>
				</div>
				<div class="new-users-item">
					<img src="{{ $user->getImagePath() }}" class="new-user-item-img img-responsive" />
					<div class="item-details-top">
						<p>Hello</p>
					</div>
					<div class="item-details-bottom">
						<p>Goodbye</p>
					</div>
					<div class="item-overlay"></div>
				</div>
				<div class="new-users-item">
					<img src="{{ $user->getImagePath() }}" class="new-user-item-img img-responsive" />
					<div class="item-details-top">
						<p>Hello</p>
					</div>
					<div class="item-details-bottom">
						<p>Goodbye</p>
					</div>
					<div class="item-overlay"></div>
				</div>
				<div class="new-users-item">
					<img src="{{ $user->getImagePath() }}" class="new-user-item-img img-responsive" />
					<div class="item-details-top">
						<p>Hello</p>
					</div>
					<div class="item-details-bottom">
						<p>Goodbye</p>
					</div>
					<div class="item-overlay"></div>
				</div>
				<div class="new-users-item">
					<img src="{{ $user->getImagePath() }}" class="new-user-item-img img-responsive" />
					<div class="item-details-top">
						<p>Hello</p>
					</div>
					<div class="item-details-bottom">
						<p>Goodbye</p>
					</div>
					<div class="item-overlay"></div>
				</div>
				
				
			</div>
		</div>

	</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.min.js"></script>
<script>
	$(document).ready(function() {
		$('.owl-carousel').owlCarousel({

		});

		$('.new-users-item').hover(function() {
			$(this).find('.item-details-top, .item-details-bottom').slideDown(100);
			$(this).find('.item-overlay').fadeIn(100);
		}, function () {
			$(this).find('.item-details-top, .item-details-bottom').slideUp(100);
			$(this).find('.item-overlay').fadeOut(100);
		});
	});
</script>
@stop