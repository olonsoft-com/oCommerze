@extends('admin.layout._layout')

@section('content')
<div class="top-menu">

      <!-- column 2 --> 
      <div class="col-sm-5">
       <h3><i class="fa fa-cubes"></i> Users</h3>  
      </div>
      <div class="col-sm-7">
        <ul class="nav nav-pills pull-right page-top-navigation">
              <li><a href="{{ route('dashboard.user.create') }}"><i class="fa fa-edit"></i> Add new user</a></li>
              <li><a href="{{ route('dashboard.user.index') }}"><i class="fa fa-users"></i> Users</a></li>
              <li><a href="{{ route('roles.index') }}"><i class="fa fa-bars"></i> Roles</a></li>
              <li><a href="{{ route('dashboard.permissions.index') }}"><i class="fa fa-wrench"></i> Permissions</a></li>
            </ul>
      </div>
      <div class="clearfix border-top"></div>
</div>  
        <div class="col-sm-9">
          <?php
            if(isset($_GET['action'])) :
              if($_GET['action']=='true') :
                echo '
                  <div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <strong>Success!</strong> Your request has been accepted.
                  </div>
                ';
              else :
                echo '
                  <div class="alert alert-warning alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <strong>Sorry!</strong> Your request cannot be processed.
                  </div>
                ';
              endif;
            endif;
          ?>
        <div class="clearfix"></div>
          <form action="{{ route('dashboard.user.update', $user->id) }}" method="POST">
            {{ method_field('PUT') }}
            @csrf
            <!-- Validation errors -->
            @if( count( $errors ) )
            <div class="alert alert-warning"> 
            @foreach( $errors->all() as $error )
              <p>{{ $error }}</p>
            @endforeach
            </div>
            @endif
            <table class="table table-striped">
              <tbody>
                <tr>
                  <th>Name</th>
                  <td>
                    <input type="text" name="name" value="{{ $user->name }}" class="form-control">
                  </td>
                </tr>
                <tr>
                  <th>Email address</th>
                  <td>
                    <input type="text" name="email" value="{{ $user->email }}" class="form-control">
                  </td>
                </tr>
                <tr>
                  <th>Counter Number</th>
                  <td>
                    <input type="text" name="counter" value="{{ $user->counter }}" class="form-control">
                  </td>
                </tr>
                <tr>
                  <th>Role</th>
                  <td>
                    <select class="form-control" name="role">
                      <option value="1" <?php echo ( isset( $_POST['role'] ) && $_POST['role'] == '1' || $user->hasRole('superadmin')) ? 'selected="selected"' : ''; ?>>Super Admin</option>
                      <option value="2" <?php echo ( isset( $_POST['role'] ) && $_POST['role'] == '2' || $user->hasRole('admin')) ? 'selected="selected"' : ''; ?>>Admin</option>
                      <option value="3" <?php echo ( isset( $_POST['role'] ) && $_POST['role'] == '3' || $user->hasRole('artist')) ? 'selected="selected"' : ''; ?>>Artist</option>
                    </select>
                  </td>
                </tr>
                <tr>
                  <th>Status</th>
                  <td>
                    <select class="form-control" name="status">
                      <option value="0" @if (old('status', $user->status) == 0) selected="selected" @endif>Pending</option>
                      <option value="1" @if (old('status', $user->status) == 1) selected="selected" @endif>Active</option>
                      <option value="2" @if (old('status', $user->status) == 2) selected="selected" @endif>Disabled</option>
                    </select>
                  </td>
                </tr>
                <tr>
                  <th></th>
                  <td>
                    <button type="submit" class="btn btn-success">Update user</button>
                  </td>
                </tr>
              </tbody>
            </table>
          </form>
          
          <div class="clearfix"></div>
        </div><!--/col-->
@endsection


@section('footer')
<script type="text/javascript">
$(function(){
  $('.activate').click(function(){
    var role = $(this).attr('role');
    if(role ==1){
      $(this).html('<i class="fa fa-check"></i> Active');
    }else{
      $(this).html('<i class="fa fa-ban"></i> Disabled');
    }
    var id = $(this).attr('id');
    var url = "dashboard/ajax/user_activate/"+id+"/"+role;
    $.get(url, function(msg){
      if(msg == 'ok'){
          alert($ok);
            
            $('.global-error').hide();
            $('.global-success').show();
            $('.global-success').delay( 1000 ).fadeOut( 800 );
          }else{
            $('.global-success').hide();
            $('.global-error').show();
            $('.global-error').delay( 1000 ).fadeOut( 800 );
          }
    });
    return false;
  });
});
</script>
@endsection