@extends('templates.default')

@section('content')
	<h3>Welcome to Yeayur</h3>

  <!-- This section uses AngularJS to pull in steams from Twitch -->

	<!-- <div ng-app="myApp" ng-controller="twitchCtrl">
    <div infinite-scroll='loadMore()' infinite-scroll-distance='0'>
      <div class="row">
        <div ng-repeat="x in data" class="col-sm-3">
          <a href="#" class="thumbnail main-thumbnail">
            <div class="thumbnail-top">
              <span class="stream-name">@{{x.channel.display_name}}</span>
              <span class="stream-game">@{{x.channel.game}}</span>
            </div>
            <img src="@{{x.preview.large}}" class="img-responsive stream-img" />
            <div class="thumbnail-bottom">
              <span class="stream-viewers">@{{x.viewers | number}} viewers</span>
            </div>
          </a>
        </div>
      </div>
    </div>
  </div> -->
<div class="row post-grid">

  @if (!$posts->count())

    @else
    @foreach ($posts as $post)
                
    <div class="main-user-post col-lg-3 col-md-4 col-sm-6 col-xs-12">
      <div class="thumbnail">
        <div class="main-streamer-post-pic pic-responsive">
          <a href="{{ route('profile', ['username' => $post->user->username]) }}">
            @if ($post->user->getImagePath() === "")
              <i class="fa fa-user-secret fa-3x"></i>
            @else
              <img src="{{ asset('images/profiles') }}/{{ $post->user->getImagePath() }}" alt="{{ $post->user->username }}"/>
            @endif
          </a>
        </div>
        <div class="streamer-post-id">
          <a href="{{ route('profile', ['username' => $post->user->username]) }}">
            <h5 class="streamer-post-name">{{ $post->user->username }}</h5>
          </a>
          <span class="post-time">{{ $post->created_at->diffForHumans() }}</span>
        </div>
        <div class="main-btn-group">
            <span class="glyphicon glyphicon-option-horizontal main-post-options dropdown-toggle" data-toggle="dropdown"></span>
            <ul class="dropdown-menu streamer-list-item-options-menu">
                </li><a href="#" class="main-btn-group-link">Report</a></li>
            </ul>
          </div>
        <div class="streamer-post-message-main">
          <div class="message-content">
            <span>{{ $post->body }}</span>
          </div>
        </div>
      </div>
    </div>
    @endforeach

    {!! $posts->render() !!}
  @endif     
</div>

@stop