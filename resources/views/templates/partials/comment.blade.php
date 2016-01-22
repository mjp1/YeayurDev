<div class="col-sm-3 col-sm-offset-9 comment-box">
	<div class="comment-box-tab">Text</div>
	<form method="#" action="#" class="form-horizontal" role="form">
		<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
			<textarea type="text" class="form-control input-global" name="comments" placeholder="Let us know your comments."></textarea>
			<!-- @if ($errors->has('email'))
				<span class="help-block">{{ $errors->first('email') }}</span>
			@endif -->
		</div>
		
		<div class="form-group form-button-global">
			<button type="submit" class="btn btn-global disabled">Submit</button>
		</div>
		<input type="hidden" name="_token" value="{{ Session::token() }}"/>
	</form>
</div>