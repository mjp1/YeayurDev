<!-- PROFILE PIC MODAL -->

<div class="modal fade edit-profile-pic" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Profile Picture</h4>
            </div>
            <div class="modal-body">
                <form role="form" method="post" action="{{ route('profile.edit.pic') }}" id="my-dropzone" enctype="multipart/form-data" class="dropzone">
                    <div class="form-group new-pic">
                        <button class="btn btn-default upload-new-pic">Upload Picture</button>
                    </div>
                    <input type="hidden" name="_token" value="{{Session::token()}}"/>
                </form>
                <span class="help-block">File size must be less than 5MB.</span>
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
               <button type="button" class="btn btn-global btn-edit-profile-pic">Save changes</button>
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
                    <div class="form-group new-about{{ $errors->has('about_me') ? ' has-error' : '' }}">
                        <textarea class="form-control about-text" rows="5" name="about_me">{{ $aboutMe }}</textarea>
                    </div>
                    <input type="hidden" name="_token" value="{{Session::token()}}"/>
                </form>
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
               <button type="button" class="btn btn-global btn-edit-profile-aboutme">Save changes</button>
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