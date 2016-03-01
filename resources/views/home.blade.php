@extends('templates.default')

@section('content')
	<div class="main-welcome">
		<img src="images/logo_full.png" class="welcome-logo" />
		<p class="main-mission">Successfully bringing together streamers and viewers since 2015</p>
		<!-- <button class="btn btn-primary btn-reg visible-md visible-lg" data-toggle="modal" data-target="#myModal">Register</button> -->
		<a href="{{ route('auth.signup') }}"class="btn btn-primary btn-reg">Register</a>
	</div>

	<div class="main-info-list">
		<ul>
			<li class="reg-li">Streamers create and market your brand</li>
			<li role="separator" class="divider info-div"></li>
			<li class="reg-li">Viewers easily search and follow your favorite streamers</li>
			<li role="separator" class="divider info-div"></li>
			<li class="reg-li">Interact with the booming world of game streaming</li>
		</ul>
	</div>
@stop