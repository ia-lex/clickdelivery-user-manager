<div id="manager-modal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">User Data</h4>
      </div>
      <div class="modal-body">        
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <div class="panel panel-default">
                        <div class="panel-heading">User Data</div>
                        <div class="panel-body">
                            <form class="form-horizontal" role="form" method="POST" action="{{ route('update') }}">
                                {{ csrf_field() }}
                                {{ method_field('PUT') }}

                                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                    <label for="name" class="col-md-4 control-label">Name</label>

                                    <div class="col-md-6">
                                        <input id="name" type="text" class="form-control" name="name" value="" required autofocus>
                                        @if ($errors->has('name'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                    <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                                    <div class="col-md-6">
                                        <input id="email" type="email" class="form-control" name="email" required>

                                        @if ($errors->has('email'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                    <label for="password" class="col-md-4 control-label">Password</label>

                                    <div class="col-md-6">
                                        <input id="password" type="password" class="form-control" name="password" >

                                        @if ($errors->has('password'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('phone_number') ? 'has-error' : ''}}">
                                    <label for="phone_number" class="col-md-4 control-label">Phone number</label>

                                    <div class="col-md-6">
                                        <input id="phone_number" type="number" class="form-control" name="phone_number">

                                        @if($errors->has('phone_number'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('phone_number') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                @if(Auth::user()->role_id == 1)

                                <div class="form-group{{ $errors->has('role_id') ? 'has-error' : ''}}">
                                    <label for="role_id" class="col-md-4 control-label">Role</label>

                                    <div class="col-md-6">
                                        <select id="role_id" class="form-control" name="role_id">
                                            <option value="1">Administrator</option>
                                            <option value="2">Agent</option>
                                            <option value="3">User</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('able_to_read') ? 'has-error' : ''}}">
                                    <label for="able_to_read" class="col-md-4 control-label">Can read</label>

                                    <div class="col-md-6 top-separate">
                                        <input type="checkbox" name="able_to_read" id="able_to_read">

                                        @if($errors->has('able_to_read'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('able_to_read') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                

                                <div class="form-group{{ $errors->has('activate') ? 'has-error' : ''}}">
                                    <label for="activate" class="col-md-4 control-label">Activate</label>

                                    <div class="col-md-6 top-separate">
                                        <input type="checkbox" name="activate" id="activate">

                                        @if($errors->has('activate'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('activate') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                @endif

                                <input id="id" type="hidden" name="id">

                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-4">
                                        <button type="submit" class="btn btn-primary">
                                            Update
                                        </button>
                                    </div>
                                </div>                                
                            </form>                            
                        </div>
                    </div>
                </div>
            </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<script type="text/javascript">
    @if(count($errors) > 0)
        //showModal();
    @endif
</script>
