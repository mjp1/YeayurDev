  <!-- My Lists Modal -->

  <div class="modal" id="user-list-modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">My Streamer Lists</h4>
          <span class="help-block">This is where you create and store lists of streamers you enjoy viewing, like playlists.</span>
        </div>
        <div class="modal-body">
          <div class="create-new-list-wrapper">
            <span class="create-new-list"><i class="fa fa-plus" aria-hidden="true"></i> Create New List</span>
            <form role="form" id="newList" name="newList">
              <div class="input-group newList-inputs col-xs-10">
                <div class="input-group">
                  <label class="sr-only" for="exampleInputEmail3">List Name</label>
                  <input type="text" class="form-control input-global" id="listName" placeholder="List Name">
                </div>
                <div class="input-group">
                  <input type="text" class="form-control input-global" id="listItem" name="userListItem[]" placeholder="Streamer Name">
                  <span class="input-group-addon newList-inputs-addon"><i class="fa fa-times" aria-hidden="true"></i></span>
                </div>
                <div class="input-group">
                  <input type="text" class="form-control input-global" id="listItem" name="userListItem[]" placeholder="Streamer Name">
                  <span class="input-group-addon newList-inputs-addon"><i class="fa fa-times" aria-hidden="true"></i></span>
                </div>
                <div class="input-group">
                  <input type="text" class="form-control input-global" id="listItem" name="userListItem[]" placeholder="Streamer Name">
                  <span class="input-group-addon newList-inputs-addon"><i class="fa fa-times" aria-hidden="true"></i></span>
                </div>
                <span class="user-list-add"><i class="fa fa-plus" aria-hidden="true"></i> Add Another</span>
              </div>
              <button type="button" class="btn btn-default" id="newList-submit">Save</button>
              <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
            </form>
          </div>

          <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
            <div class="panel panel-default">
              <div class="panel-heading" role="tab" id="headingOne">
                <h4 class="panel-title">
                  <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    Collapsible Group Item #1
                  </a>
                </h4>
              </div>
              <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                <div class="panel-body">
                  Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                </div>
              </div>
            </div>
            
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-global" data-dismiss="modal">Close</button>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
