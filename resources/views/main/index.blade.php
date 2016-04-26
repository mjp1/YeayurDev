@extends('templates.default')

@section('content')
	<div class="main-wrapper"></div>
	<div class="main-posts">
		<h5 class="main-posts-header">Recent Activity</h5>
		<div class="post-grid">
			@if ($posts->count())
			    @foreach ($posts as $post)
				    <div class="main-user-post col-lg-3 col-md-4 col-sm-6 col-xs-12">
				      <div class="thumbnail">
				        <div class="main-streamer-post-pic pic-responsive">
				          <a href="{{ route('profile', ['username' => $post->user->username]) }}">
				            @if ($post->user->getImagePath() === "")
				              <i class="fa fa-user-secret fa-3x"></i>
				            @else
				              <img src="{{ $post->user->getImagePath() }}" alt="{{ $post->user->username }}"/>
				            @endif
				          </a>
				        </div>
				        <div class="streamer-post-id">
				          <a href="{{ route('profile', ['username' => $post->user->username]) }}">
				            <h5 class="streamer-post-name">{{ $post->user->username }}</h5>
				          </a>
				          <span class="post-time">{{ $post->created_at->diffForHumans() }}</span>
				        </div>
				        <div class="streamer-post-message-main">
				          <div class="message-content">
				            <span>{{ $post->body }}</span>
				            <br>
							<img src="{{ $post->getImagePath() }}" class="img-responsive" />
				          </div>
				        </div>
				      </div>
				    </div>
			    @endforeach
			@endif
		</div>
	</div>


@stop