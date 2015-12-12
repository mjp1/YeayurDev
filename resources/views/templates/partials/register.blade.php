<div class="container">

	<div class="main-welcome">
		<img src="images/logo_full.png" class="welcome-logo" />
		<p class="main-mission">Successfully bringing together streamers and viewers since 2015</p>
		<!-- <button class="btn btn-primary btn-reg visible-md visible-lg" data-toggle="modal" data-target="#myModal">Register</button> -->
		<button class="btn btn-primary btn-reg"><a href="{{ route('auth.signup') }}" class="btn-reg-xs-sm">Register</a></button>
	</div>
	
<!-------------------------------------------------->						
		<!-- FORGOT PASSWORD MODAL -->		
<!-------------------------------------------------->						
	
	<div class="modal fade" id="forgotPass" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title reg-title" id="myModalLabel">Retrieve Password</h4>
			</div>
			<div class="modal-body">
				<div class="form-group">
					<p class="help-block">Enter email used to register.</p>
					<div class="input-group">
						<span class="input-group-addon glyphicon glyphicon-envelope"></span>
						<input type="email" class="form-control forgot-pass-input" name="email" />
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default modal-cancel" data-dismiss="modal">Cancel</button>
				<button type="submit" class="btn btn-primary btn-global btn-forgotpass-submit">Send Email</button>
			</div>
			<div class="forgot-pass-message" style="display:none;">
				<div class="forgot-pass-message-text">Check email for secure link.</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default modal-forgotpass-confirm-close" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	  </div>
	</div>

	
<!-------------------------------------------------->						
		<!-- REGISTER MODAL -->		
<!-------------------------------------------------->						

	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title reg-title" id="myModalLabel">Register for Yeayur</h4>
			</div>
			<div class="modal-body">
				<form role="form" method="post" action="{{ route('auth.signup') }}">
					<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
						<label for="email">Enter Email</label>
						<input type="email" class="form-control input-global" name="email" value="{{ Request::old('email') ?: '' }}"/>
						@if ($errors->has('email'))
						<span class="help-block">{{ $errors->first('email') }}</span>
						@endif
					</div>
					<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
						<label for="password">Enter Password</label>
						<input type="password" class="form-control input-global" name="password"/>
						@if ($errors->has('password'))
						<span class="help-block">You must enter a password</span>
						@endif
					</div>
					<div class="form-group{{ $errors->has('confirm_password') ? ' has-error' : '' }}">
						<label for="confirm_password">Confirm Password</label>
						<input type="password" class="form-control input-global" name="confirm_password"/>
						@if ($errors->has('confirm_password'))
						<span class="help-block">You must confirm your password.</span>
						@endif
					</div>
					<div class="form-group form-inline">
						<label for="birthdate">Birthdate</label>
						<input type="date" name="birthdate" class="form-control input-global"/>
					</div>
					<div class="form-group reg-terms{{ $errors->has('agreed_terms') ? ' has-error' : '' }}">
						<div class="checkbox">
							<label><input type="checkbox" name="agreed_terms" value="1">Agree to our <a href="#" target="_blank">Terms of Service</a></label>
							@if ($errors->has('agreed_terms'))
							<span class="help-block">You must accept the Terms and Conditions</span>
							@endif
						</div>
					</div>
					<div class="form-group pull-right">
						<a href="{{ route('home') }}"><button class="btn btn-default btn-close">Cancel</button></a>
						<button type="submit" class="btn btn-global">Register</button>
					</div>
					<div style="clear:both;"></div>
					<input type="hidden" name="_token" value="{{ Session::token() }}"/>
				</form>
			</div>

			
			<!-- DISPLAY MESSAGE WHEN USER SUBMITS THE FORM -->
			<div class="reg-confirm-message" style="display:none;">
				<div class="reg-confirm-message-text">Check email for confirmation link.</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default modal-confirm-close" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	  </div>
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
	

</div>

