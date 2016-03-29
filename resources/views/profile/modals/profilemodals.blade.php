<!-- PROFILE PIC MODAL -->

<div class="modal fade edit-profile-pic" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Profile Picture</h4>
            </div>
            <div class="modal-body">
                <form role="form" method="post" action="{{ route('profile.edit.pic') }}" enctype="multipart/form-data">
                    <div class="form-group new-pic">
                        <input type="file" id="newProfilePic" name="profile-image"/>
                        @if ($errors->has('profile-image'))
                            <span class="help-block">{{ $errors->first('profile-image') }}</span>
                        @endif
                    </div>
                </form>
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
               <button type="submit" class="btn btn-global btn-edit-profile-pic">Save changes</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- ABOUT ME MODAL -->

<div class="modal fade edit-profile-aboutme" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit About Me</h4>
            </div>
            <div class="modal-body">
                <form role="form" method="post" action="{{ route('profile.edit.about') }}">
                    <div class="form-group new-pic">
                        <textarea class="form-control about-text" rows="5" name="about_me">{{ $aboutMe }}</textarea>
                        @if ($errors->has('about_me'))
                            <span class="help-block">{{ $errors->first('about_me') }}</span>
                        @endif
                    </div>
                </form>
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
               <button type="submit" class="btn btn-global btn-edit-profile-aboutme">Save changes</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- EDIT POST MODAL -->

<div class="modal fade edit-profile-post" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Post</h4>
            </div>
            <div class="modal-body">
                <form role="form" method="post" action="{{ route('profile.edit') }}">
                    <div class="form-group new-pic">
                        <textarea class="form-control" rows="2" id="postbody" name="post"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
               <button type="submit" class="btn btn-global btn-edit-profile-post">Save changes</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal