@extends('templates.default')

@section('content')

	<!-- Show signed up alert for new users -->
	@include('templates.partials.alerts')
	

	<h3>Account Settings</h3>
		<form role="form" method="post" action="{{ route('profile.edit') }}"class="form-horizontal edit-prof-form" enctype="multipart/form-data">
			<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
				<label class="col-sm-3 control-label" for="email">Update Email</label>
				<div class="col-sm-5">
					<input type="email" class="form-control input-global input-email" placeholder="Enter new email" name="email" value="{{ Auth::user()->email }}"/>
					@if ($errors->has('email'))
						<span class="help-block">{{ $errors->first('email') }}</span>
					@endif
				</div>
			</div>
			<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
				<label class="col-sm-3 control-label" for="password">Change password</label>
				<div class="col-sm-5">
					<input type="password" class="form-control input-global" placeholder="Enter new password" name="password"/>
					@if ($errors->has('password'))
						<span class="help-block">{{ $errors->first('password') }}</span>
					@endif
				</div>
			</div>
			<div class="form-group{{ $errors->has('confirm_password') ? ' has-error' : '' }}">
				<div class="col-sm-5 col-sm-offset-3">
					<input type="password" class="form-control input-global" placeholder="Confirm new password" name="confirm_password"/>
					@if ($errors->has('confirm_password'))
						<span class="help-block">{{ $errors->first('confirm_password') }}</span>
					@endif
				</div>
			</div>

			<!-- Will implement at a later date -->	
			<!--<div class="form-group">
				<label class="col-sm-3 control-label">Email Notifications</label>
				<div class="col-sm-5">
					<div class="checkbox">
					<label>
						<input type="checkbox"> When I get a new fan
					</label>
					</div>
					<div class="checkbox">
						<label>
							<input type="checkbox"> When someone posts on my feed
						</label>
					</div>
					<div class="checkbox">
						<label>
							<input type="checkbox"> When my favorite streamers post updates
						</label>
					</div>
				</div>
			</div>-->	
			<div class="form-group pull-right editprofile-form-btns">
				<!-- CANCEL TAKES USER BACK TO THEIR PROFILE -->
				<a href="{{route('profile', ['username' => Auth::user()->username]) }}"><button type="button" class="btn btn-default btn-close">Cancel</button></a>
				<button type="submit" class="btn btn-global">Save changes</button>
			</div>		
			<input type="hidden" name="_token" value="{{Session::token()}}"/>			
		</form> 
		
		<script src="{{ asset('js/editprofile.js') }}"></script>

@stop