@extends('templates.default')

@section('content')
	<div class="main-wrapper"></div>
	<div class="main-welcome">
		<img src="images/logo_full.png" class="welcome-logo" />
		<h3 class="main-mission">Connecting Streamers and Viewers</h3>
	</div>
	<div class="main-posts-nav">
		<ul class="main-posts-nav-list">
			<li class="main-posts-nav-tab visible tab-connections">My Connections</li>
			<li class="main-posts-nav-tab tab-community">Community</li>
		</ul>
	</div>
	<div class="main-posts connections">
		<h5 class="main-posts-header">Recent Activity</h5>
		<div class="post-grid">
			@if ($connectionsPosts->count())
			    @foreach ($connectionsPosts as $connectionsPosts)
				    <div class="main-user-post col-lg-3 col-md-4 col-sm-6 col-xs-12">
				      <div class="thumbnail">
				        <div class="main-streamer-post-pic pic-responsive">
				          <a href="{{ route('profile', ['username' => $connectionsPosts->user->username]) }}">
				            @if ($connectionsPosts->user->getImagePath() === "")
				              <i class="fa fa-user-secret fa-3x"></i>
				            @else
				              <img src="{{ $connectionsPosts->user->getImagePath() }}" alt="{{ $connectionsPosts->user->username }}"/>
				            @endif
				          </a>
				        </div>
				        <div class="streamer-post-id">
				          <a href="{{ route('profile', ['username' => $connectionsPosts->user->username]) }}">
				            <h5 class="streamer-post-name">{{ $connectionsPosts->user->username }}</h5>
				          </a>
				          <span class="post-time">{{ $connectionsPosts->created_at->diffForHumans() }}</span>
				        </div>
				        <div class="streamer-post-message-main">
				          <div class="message-content">
				            <span>{{ $connectionsPosts->body }}</span>
				            <br>
							<img src="{{ $connectionsPosts->getImagePath() }}" class="img-responsive" />
				          </div>
				        </div>
				        <ul class="streamer-post-message-footer">
				        	<li class="streamer-followers">
								<i class="fa fa-users" title="Followers"></i>
								<span class="fan-count">{{ $connectionsPosts->user->followers()->count() }}</span>
							</li>
							<li class="streamer-post-like-count">
								<img src="{{ asset('images/logo_compact_black.png') }}" class="streamer-post-like-count-img" title="Likes" />
								<span class="like-count">{{ $connectionsPosts->likes->count() }}</span>
							</li>
						</ul>																																			
				      </div>
				    </div>
			    @endforeach
			@endif
		</div>
	</div>
	<div class="main-posts community">
		<h5 class="main-posts-header">Recent Activity</h5>
		<div class="post-grid">
			@if ($communityPosts->count())
			    @foreach ($communityPosts as $communityPosts)
				    <div class="main-user-post col-lg-3 col-md-4 col-sm-6 col-xs-12">
				      <div class="thumbnail">
				        <div class="main-streamer-post-pic pic-responsive">
				          <a href="{{ route('profile', ['username' => $communityPosts->user->username]) }}">
				            @if ($communityPosts->user->getImagePath() === "")
				              <i class="fa fa-user-secret fa-3x"></i>
				            @else
				              <img src="{{ $communityPosts->user->getImagePath() }}" alt="{{ $communityPosts->user->username }}"/>
				            @endif
				          </a>
				        </div>
				        <div class="streamer-post-id">
				          <a href="{{ route('profile', ['username' => $communityPosts->user->username]) }}">
				            <h5 class="streamer-post-name">{{ $communityPosts->user->username }}</h5>
				          </a>
				          <span class="post-time">{{ $communityPosts->created_at->diffForHumans() }}</span>
				        </div>
				        <div class="streamer-post-message-main">
				          <div class="message-content">
				            <span>{{ $communityPosts->body }}</span>
				            <br>
							<img src="{{ $communityPosts->getImagePath() }}" class="img-responsive" />
				          </div>
				        </div>
				        <ul class="streamer-post-message-footer">
				        	<li class="streamer-followers">
								<i class="fa fa-users" title="Followers"></i>
								<span class="fan-count">{{ $communityPosts->user->followers()->count() }}</span>
							</li>
							<li class="streamer-post-like-count">
								<img src="{{ asset('images/logo_compact_black.png') }}" class="streamer-post-like-count-img" title="Likes" />
								<span class="like-count">{{ $communityPosts->likes->count() }}</span>
							</li>
						</ul>																																			
				      </div>
				    </div>
			    @endforeach
			@endif
		</div>
	</div>


@stop