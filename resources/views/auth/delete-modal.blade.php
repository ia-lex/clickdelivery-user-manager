<div id="delete-modal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Are You Sure!!!</h4>
        </div>
        <div class="modal-body">        
            <form class="form-horizontal" role="form" method="POST" action="{{ route('delete') }}">
                {{ csrf_field() }}
                <input type="hidden" name="id" id="id">
                <div class="alert alert-info">
                    <p>Do you want to delete this user?</p>
                </div>
                <div class="form-group">
                    <div class="col-md-6">
                        <button 
                            type="submit" 
                            class="btn btn-warning pull-left"
                        >
                            Delete
                        </button>
                    </div>
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button 
                type="button" 
                class="btn btn-default" 
                data-dismiss="modal"
            >
                Close
            </button>
      </div>
    </div>

  </div>
</div>