@extends('templates.default')

@section('content')
	<div class="main-wrapper"></div>
	<div class="main-welcome">
		<img src="images/logo_full.png" class="welcome-logo" />
		<h3 class="main-mission">Connecting Streamers and Viewers</h3>
	</div>

	<div class="main-content">
		<div class="main-new-users col-sm-8">
			<h4>New Users and Fan Pages</h4>

			<div class="new-users-item col-xs-4">
				<img src="https://static-cdn.jtvnw.net/jtv_user_pictures/mpierce486-profile_image-22bacbeb1fb983c0-300x300.png" class="new-user-item-img img-responsive" />
				<span class="new-user-username">MPierce486</span>
				<span class="new-user-followers"><i class="fa fa-users" title="Number of followers">3</i></span>
			</div>

		</div>
		<div class="main-auth-activity col-sm-4">
			<h4>My Activity</h4>
		</div>
	</div>

@stop