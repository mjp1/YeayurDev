@extends('templates.default')

@section('content')
	<h3>Welcome to Yeayur</h3>
	<div ng-app="myApp" ng-controller="twitchCtrl">
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
  </div>
@stop