  <!-- Modal for creating a new streamer fan page -->

  <div class="modal fade" id="create-fan-page" tabindex="-1" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Create Fan Page</h4>
        </div>
        <div class="modal-body">
          <span class="help-block">Enter the streamer's Twitch URL.</span>
          <form method="post" id="create-fan-page-form">
            <input type="url" class="form-control input-global" id="fanpageurl" name="fanpageurl" />
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-global create-streamer-fan-page">Create Page</button>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
